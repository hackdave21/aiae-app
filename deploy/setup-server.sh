#!/usr/bin/env bash
# ════════════════════════════════════════════════════════════════
# deploy/setup-server.sh
# Script de mise en production initiale — AIAE
# À exécuter UNE SEULE FOIS en SSH sur le serveur cPanel
#
# Usage :
#   chmod +x deploy/setup-server.sh
#   bash deploy/setup-server.sh
# ════════════════════════════════════════════════════════════════

set -euo pipefail

# ────────────────────────────────────────────────────────────────
# Couleurs & helpers
# ────────────────────────────────────────────────────────────────
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

info()    { echo -e "${BLUE}[INFO]${NC}  $*"; }
success() { echo -e "${GREEN}[OK]${NC}    $*"; }
warn()    { echo -e "${YELLOW}[WARN]${NC}  $*"; }
error()   { echo -e "${RED}[ERROR]${NC} $*"; exit 1; }

echo ""
echo -e "${BLUE}════════════════════════════════════════════════════${NC}"
echo -e "${BLUE}  🚀 AIAE — Setup production initial (cPanel)${NC}"
echo -e "${BLUE}════════════════════════════════════════════════════${NC}"
echo ""

# ────────────────────────────────────────────────────────────────
# Chemins
# ────────────────────────────────────────────────────────────────
APP_DIR="/home/sites/42a/d/dbb41a432c/aiae-app"
PUBLIC_HTML="/home/sites/42a/d/dbb41a432c/public_html"
APP_URL="http://aiae.services"

# ────────────────────────────────────────────────────────────────
# 1. Vérification des dépendances système
# ────────────────────────────────────────────────────────────────
info "Vérification des dépendances système..."

# PHP
if ! command -v php &>/dev/null; then
    error "PHP n'est pas installé ou pas dans le PATH"
fi
PHP_VERSION=$(php -r "echo PHP_MAJOR_VERSION.'.'.PHP_MINOR_VERSION;")
success "PHP ${PHP_VERSION} trouvé : $(which php)"

# Composer
if ! command -v composer &>/dev/null; then
    error "Composer n'est pas installé ou pas dans le PATH"
fi
success "Composer trouvé : $(composer --version --no-ansi | head -1)"

# Node.js
if ! command -v node &>/dev/null; then
    error "Node.js n'est pas installé ou pas dans le PATH"
fi
success "Node.js $(node -v) trouvé : $(which node)"

# npm
if ! command -v npm &>/dev/null; then
    error "npm n'est pas installé ou pas dans le PATH"
fi
success "npm $(npm -v) trouvé : $(which npm)"

echo ""

# ────────────────────────────────────────────────────────────────
# 2. Aller dans le dossier Laravel
# ────────────────────────────────────────────────────────────────
info "Positionnement dans ${APP_DIR}..."
cd "$APP_DIR" || error "Impossible d'accéder à ${APP_DIR}"
success "Répertoire courant : $(pwd)"

# ────────────────────────────────────────────────────────────────
# 3. Copier .env.production → .env
# ────────────────────────────────────────────────────────────────
info "Copie de .env.production vers .env..."
if [ ! -f ".env.production" ]; then
    error ".env.production introuvable dans ${APP_DIR}"
fi
cp .env.production .env
success ".env créé depuis .env.production"

# ────────────────────────────────────────────────────────────────
# 4. Générer la clé d'application Laravel
# ────────────────────────────────────────────────────────────────
info "Génération de la clé applicative (APP_KEY)..."
php artisan key:generate --force
success "APP_KEY générée"

# ────────────────────────────────────────────────────────────────
# 5. Composer install (sans dépendances dev)
# ────────────────────────────────────────────────────────────────
info "Installation des dépendances PHP (composer)..."
composer install --no-dev --optimize-autoloader --no-interaction
success "Dépendances PHP installées"

# ────────────────────────────────────────────────────────────────
# 6. Build des assets (Vite — CSS + JS)
# ────────────────────────────────────────────────────────────────
info "Installation des dépendances JS et build Vite..."
npm ci
npm run build
success "Assets compilés dans public/build/"

# ────────────────────────────────────────────────────────────────
# 7. Migrations
# ────────────────────────────────────────────────────────────────
info "Exécution des migrations..."
php artisan migrate --force
success "Migrations appliquées"

# ────────────────────────────────────────────────────────────────
# 8. Optimisations Laravel
# ────────────────────────────────────────────────────────────────
info "Mise en cache config/routes/vues..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
success "Caches Laravel générés"

# ────────────────────────────────────────────────────────────────
# 9. Permissions storage et bootstrap/cache
# ────────────────────────────────────────────────────────────────
info "Application des permissions storage/ et bootstrap/cache/..."
chmod -R 775 storage bootstrap/cache
success "Permissions appliquées (775)"

# ────────────────────────────────────────────────────────────────
# 10. Créer le fichier bridge public_html/index.php
# ────────────────────────────────────────────────────────────────
info "Création du bridge public_html/index.php..."
cat > "${PUBLIC_HTML}/index.php" << 'PHPBRIDGE'
<?php
/**
 * Bridge cPanel → Laravel
 * public_html/index.php → aiae-app/public/index.php
 */
define('LARAVEL_PUBLIC_DIR', '/home/sites/42a/d/dbb41a432c/aiae-app/public');
$_SERVER['DOCUMENT_ROOT'] = LARAVEL_PUBLIC_DIR;
chdir(LARAVEL_PUBLIC_DIR);
require LARAVEL_PUBLIC_DIR . '/index.php';
PHPBRIDGE
success "Bridge index.php créé dans ${PUBLIC_HTML}"

# ────────────────────────────────────────────────────────────────
# 11. Créer public_html/.htaccess
# ────────────────────────────────────────────────────────────────
info "Création du .htaccess dans public_html/..."
cat > "${PUBLIC_HTML}/.htaccess" << 'HTACCESS'
Options -Indexes -MultiViews
ServerSignature Off

<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/plain text/css application/javascript
</IfModule>

<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} -f
    RewriteRule ^ - [L]
    RewriteCond %{REQUEST_URI} ^/build/
    RewriteRule ^ - [L]
    RewriteRule ^ index.php [L]
</IfModule>

<FilesMatch "^\.env">
    Order allow,deny
    Deny from all
</FilesMatch>
HTACCESS
success ".htaccess créé dans ${PUBLIC_HTML}"

# ────────────────────────────────────────────────────────────────
# 12. Symlink public_html/build → aiae-app/public/build/
# ────────────────────────────────────────────────────────────────
info "Création du symlink build/..."
BUILD_LINK="${PUBLIC_HTML}/build"
BUILD_TARGET="${APP_DIR}/public/build"

# Supprimer un éventuel lien existant
[ -L "$BUILD_LINK" ] && rm "$BUILD_LINK"
[ -d "$BUILD_LINK" ] && warn "Un dossier build/ existe déjà dans public_html — supprimez-le manuellement si nécessaire"

ln -sfn "$BUILD_TARGET" "$BUILD_LINK"
success "Symlink créé : ${BUILD_LINK} → ${BUILD_TARGET}"

# ────────────────────────────────────────────────────────────────
# 13. Résumé final
# ────────────────────────────────────────────────────────────────
echo ""
echo -e "${GREEN}════════════════════════════════════════════════════${NC}"
echo -e "${GREEN}  ✅ Setup terminé avec succès !${NC}"
echo -e "${GREEN}════════════════════════════════════════════════════${NC}"
echo ""
echo -e "  🌐 URL application : ${YELLOW}${APP_URL}${NC}"
echo -e "  📁 Racine Laravel  : ${APP_DIR}"
echo -e "  📁 Public cPanel   : ${PUBLIC_HTML}"
echo -e "  📁 Logs Laravel    : ${APP_DIR}/storage/logs/laravel.log"
echo -e "  📁 Assets build    : ${PUBLIC_HTML}/build/ (symlink)"
echo ""
echo -e "  💡 Prochaines étapes :"
echo -e "     1. Vérifier que ${APP_URL} répond correctement"
echo -e "     2. Une fois SSL actif : modifier APP_URL en https://"
echo -e "        et décommenter la redirection HTTPS dans .htaccess"
echo -e "     3. Les prochains déploiements se font via git push origin main"
echo ""
