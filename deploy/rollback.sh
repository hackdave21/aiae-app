#!/usr/bin/env bash
# ════════════════════════════════════════════════════════════════
# deploy/rollback.sh
# Rollback rapide d'un déploiement défaillant
# À exécuter manuellement en SSH sur le serveur
#
# Usage :
#   cd /home/sites/42a/d/dbb41a432c/aiae-app
#   bash deploy/rollback.sh
# ════════════════════════════════════════════════════════════════

set -euo pipefail

# ────────────────────────────────────────────────────────────────
# Couleurs
# ────────────────────────────────────────────────────────────────
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

info()    { echo -e "${BLUE}[INFO]${NC}  $*"; }
success() { echo -e "${GREEN}[OK]${NC}    $*"; }
warn()    { echo -e "${YELLOW}[WARN]${NC}  $*"; }
error()   { echo -e "${RED}[ERROR]${NC} $*"; exit 1; }

echo ""
echo -e "${YELLOW}════════════════════════════════════════════════════${NC}"
echo -e "${YELLOW}  ⏪ AIAE — Rollback au commit précédent${NC}"
echo -e "${YELLOW}════════════════════════════════════════════════════${NC}"
echo ""

APP_DIR="/home/sites/42a/d/dbb41a432c/aiae-app"

# ────────────────────────────────────────────────────────────────
# Se positionner dans le dossier Laravel
# ────────────────────────────────────────────────────────────────
cd "$APP_DIR" || error "Impossible d'accéder à ${APP_DIR}"

# ────────────────────────────────────────────────────────────────
# ⚠️  AVERTISSEMENT MIGRATIONS
# ────────────────────────────────────────────────────────────────
echo -e "${RED}╔════════════════════════════════════════════════════╗${NC}"
echo -e "${RED}║  ⚠️  AVERTISSEMENT IMPORTANT                        ║${NC}"
echo -e "${RED}║                                                    ║${NC}"
echo -e "${RED}║  Les migrations de base de données NE sont PAS     ║${NC}"
echo -e "${RED}║  annulées automatiquement par ce script.           ║${NC}"
echo -e "${RED}║                                                    ║${NC}"
echo -e "${RED}║  Si le commit que vous annulez contenait des       ║${NC}"
echo -e "${RED}║  migrations, lancez MANUELLEMENT :                 ║${NC}"
echo -e "${RED}║  → php artisan migrate:rollback                    ║${NC}"
echo -e "${RED}║                                                    ║${NC}"
echo -e "${RED}╚════════════════════════════════════════════════════╝${NC}"
echo ""

# Confirmation
read -r -p "Continuer le rollback ? (oui/non) : " CONFIRM
if [[ "$CONFIRM" != "oui" ]]; then
    echo "Rollback annulé."
    exit 0
fi

echo ""

# ────────────────────────────────────────────────────────────────
# 1. Passer en maintenance
# ────────────────────────────────────────────────────────────────
info "Activation du mode maintenance..."
php artisan down --message="Rollback en cours..." --retry=30 || true
success "Mode maintenance activé"

# ────────────────────────────────────────────────────────────────
# 2. Afficher les 5 derniers commits
# ────────────────────────────────────────────────────────────────
info "Historique git récent (5 derniers commits) :"
echo ""
git log --oneline -5
echo ""

# ────────────────────────────────────────────────────────────────
# 3. Rollback git au commit précédent
# ────────────────────────────────────────────────────────────────
info "Rollback vers HEAD~1..."
git reset --hard HEAD~1
success "Code rollbacké au commit précédent"

# ────────────────────────────────────────────────────────────────
# 4. Réinstaller les dépendances PHP
# ────────────────────────────────────────────────────────────────
info "Réinstallation des dépendances PHP..."
composer install --no-dev --optimize-autoloader --no-interaction
success "Dépendances PHP installées"

# ────────────────────────────────────────────────────────────────
# 5. Rebuild des assets
# ────────────────────────────────────────────────────────────────
info "Rebuild des assets Vite..."
npm ci
npm run build
success "Assets reconstruits"

# ────────────────────────────────────────────────────────────────
# 6. Recalculer les caches Laravel
# ────────────────────────────────────────────────────────────────
info "Mise en cache Laravel..."
php artisan optimize
success "Caches régénérés"

# ────────────────────────────────────────────────────────────────
# 7. Sortir du mode maintenance
# ────────────────────────────────────────────────────────────────
info "Désactivation du mode maintenance..."
php artisan up
success "Application en ligne"

# ────────────────────────────────────────────────────────────────
# Résumé
# ────────────────────────────────────────────────────────────────
echo ""
echo -e "${GREEN}════════════════════════════════════════════════════${NC}"
echo -e "${GREEN}  ✅ Rollback effectué${NC}"
echo -e "${GREEN}════════════════════════════════════════════════════${NC}"
echo ""
echo -e "  Commit actuel :"
git log --oneline -1
echo ""
echo -e "  ${YELLOW}⚠️  N'oubliez pas : si des migrations ont été appliquées,${NC}"
echo -e "  ${YELLOW}   exécutez manuellement : php artisan migrate:rollback${NC}"
echo ""
