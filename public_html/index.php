<?php
/**
 * public_html/index.php
 * ─────────────────────────────────────────────────────────────
 * Bridge entre le dossier public cPanel (/home/.../public_html/)
 * et le vrai dossier public Laravel (/home/.../aiae-app/public/)
 *
 * Arborescence serveur :
 *   /home/sites/42a/d/dbb41a432c/
 *   ├── aiae-app/          ← Racine Laravel
 *   │   ├── public/        ← Public Laravel (avec server.php)
 *   │   └── ...
 *   └── public_html/       ← Dossier web cPanel (ce fichier)
 *       ├── index.php      ← CE FICHIER
 *       ├── .htaccess
 *       └── build/         ← Symlink → ../aiae-app/public/build/
 * ─────────────────────────────────────────────────────────────
 */

// Chemin absolu vers le dossier public/ de Laravel
define('LARAVEL_PUBLIC_DIR', '/home/sites/42a/d/dbb41a432c/aiae-app/public');

// Redéfinir $_SERVER['DOCUMENT_ROOT'] pour que Laravel
// calcule correctement les chemins de fichiers statiques
$_SERVER['DOCUMENT_ROOT'] = LARAVEL_PUBLIC_DIR;

// Charger le bootstrap Laravel depuis son vrai public/index.php
// en changeant le répertoire de travail pour que les includes
// relatifs fonctionnent correctement
chdir(LARAVEL_PUBLIC_DIR);

require LARAVEL_PUBLIC_DIR . '/index.php';
