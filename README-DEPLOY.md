# 🚀 Guide de Déploiement — AIAE (cPanel / afrique.host)

> **Stack** : Laravel + Blade + React (createRoot) + Tailwind CSS v4 + Vite  
> **Hébergeur** : Triooti / afrique.host  
> **Repo GitHub** : https://github.com/hackdave21/aiae-app

---

## 📋 Secrets GitHub à configurer

Aller dans : **GitHub → Settings → Secrets and variables → Actions → New repository secret**

| Secret | Valeur |
|--------|--------|
| `SSH_HOST` | `185.146.167.203` (IP serveur Triooti) |
| `SSH_USER` | Votre nom d'utilisateur SSH cPanel |
| `SSH_PRIVATE_KEY` | Contenu de `~/.ssh/id_ed25519` (clé privée) |
| `SSH_PORT` | `22` |
| `APP_URL` | `http://aiae.services` |

> **Comment générer une clé SSH** (si vous n'en avez pas) :
> ```bash
> ssh-keygen -t ed25519 -C "github-actions-aiae"
> # Copier la clé publique sur le serveur :
> ssh-copy-id -p 22 user@185.146.167.203
> # Copier la clé privée dans le secret SSH_PRIVATE_KEY :
> cat ~/.ssh/id_ed25519
> ```

---

## 🗂️ Arborescence serveur

```
/home/sites/42a/d/dbb41a432c/
├── aiae-app/                    ← Racine Laravel (git repo)
│   ├── app/
│   ├── public/
│   │   └── build/               ← Assets compilés par Vite
│   ├── resources/
│   ├── deploy/
│   │   ├── setup-server.sh      ← Script d'initialisation
│   │   └── rollback.sh          ← Script de rollback
│   └── .env                     ← Copié depuis .env.production
└── public_html/                 ← Dossier web cPanel (DOCUMENT_ROOT)
    ├── index.php                ← Bridge → aiae-app/public/index.php
    ├── .htaccess                ← Règles Apache + cache + sécurité
    └── build/                   ← Symlink → ../aiae-app/public/build/
```

---

## 🛠️ Étapes dans l'ordre (première mise en prod)

### Étape 1 — Configurer les secrets GitHub
Voir le tableau ci-dessus.

### Étape 2 — Connexion SSH et setup initial

```bash
# Se connecter au serveur
ssh -p 22 user@185.146.167.203

# Aller dans le repo
cd /home/sites/42a/d/dbb41a432c/aiae-app

# Rendre le script exécutable
chmod +x deploy/setup-server.sh

# Exécuter le setup (une seule fois)
bash deploy/setup-server.sh
```

Le script fait automatiquement :
1. ✅ Vérifie PHP, Composer, Node, npm
2. ✅ Copie `.env.production` → `.env`
3. ✅ Génère `APP_KEY`
4. ✅ `composer install --no-dev`
5. ✅ `npm ci && npm run build`
6. ✅ `php artisan migrate --force`
7. ✅ `php artisan optimize`
8. ✅ Permissions `storage/` et `bootstrap/cache/`
9. ✅ Crée `public_html/index.php` (bridge)
10. ✅ Crée `public_html/.htaccess`
11. ✅ Crée le symlink `public_html/build/`

### Étape 3 — Vérifier que le site répond

```bash
curl -I http://aiae.services
# Doit retourner : HTTP/1.1 200 OK
```

### Étape 4 — Activer HTTPS (après propagation DNS + SSL)

Une fois le certificat SSL actif sur cPanel :

1. Modifier `.env` sur le serveur :
   ```
   APP_URL=https://aiae.services
   ```
2. Décommenter les lignes HTTPS dans `public_html/.htaccess` :
   ```apache
   RewriteCond %{HTTPS} off
   RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
   ```
3. Relancer les caches :
   ```bash
   cd /home/sites/42a/d/dbb41a432c/aiae-app
   php artisan config:cache
   ```

---

## 🔄 Déploiements suivants

**Un simple `git push` suffit :**

```bash
git push origin main
```

GitHub Actions se charge de :
1. 🔒 Mode maintenance ON
2. ⬇️ `git pull origin main`
3. 🎵 `composer install --no-dev`
4. 🏗️ `npm ci && npm run build`
5. 🗄️ `php artisan migrate --force`
6. ⚡ Caches Laravel
7. 🔓 Mode maintenance OFF
8. 🩺 Health check HTTP (vérifie que le site répond 200)

---

## ⏪ Rollback d'urgence

```bash
ssh -p 22 user@185.146.167.203
cd /home/sites/42a/d/dbb41a432c/aiae-app
bash deploy/rollback.sh
```

> ⚠️ **Important** : Les migrations ne sont **pas** annulées automatiquement.  
> Si le commit rollbacké contenait des migrations, exécutez manuellement :  
> ```bash
> php artisan migrate:rollback
> ```

---

## 🔧 Commandes debug SSH utiles

```bash
# Logs d'erreur Laravel en temps réel
tail -f /home/sites/42a/d/dbb41a432c/aiae-app/storage/logs/laravel.log

# Vérifier la configuration Laravel active
php artisan config:show

# Vérifier la connexion à la base de données
php artisan db:show

# Vérifier les assets compilés
ls -la /home/sites/42a/d/dbb41a432c/public_html/build/

# Vérifier le symlink build/
ls -la /home/sites/42a/d/dbb41a432c/public_html/build

# Vider tous les caches manuellement
cd /home/sites/42a/d/dbb41a432c/aiae-app
php artisan optimize:clear

# Regénérer les caches
php artisan optimize

# Statut de la maintenance
php artisan down  # activer
php artisan up    # désactiver
```

---

## 📍 Chemins importants

| Élément | Chemin serveur |
|---------|----------------|
| Racine Laravel | `/home/sites/42a/d/dbb41a432c/aiae-app/` |
| Dossier public cPanel | `/home/sites/42a/d/dbb41a432c/public_html/` |
| Logs Laravel | `/home/sites/42a/d/dbb41a432c/aiae-app/storage/logs/laravel.log` |
| Assets compilés | `/home/sites/42a/d/dbb41a432c/public_html/build/` |
| Fichier .env | `/home/sites/42a/d/dbb41a432c/aiae-app/.env` |

---

## 📁 Fichiers de déploiement inclus

| Fichier | Rôle |
|---------|------|
| `.github/workflows/deploy.yml` | CI/CD GitHub Actions automatique |
| `.env.production` | Variables d'env production (ne pas commiter) |
| `deploy/setup-server.sh` | Setup initial serveur (une seule fois) |
| `deploy/rollback.sh` | Rollback rapide en SSH |
| `public_html/index.php` | Bridge cPanel → Laravel |
| `public_html/.htaccess` | Apache : réécriture, cache, compression |
| `vite.config.js` | Config Vite production-ready |
