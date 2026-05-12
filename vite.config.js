import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

/**
 * vite.config.js — AIAE (production-ready)
 *
 * Stack :
 *   - Laravel + Blade
 *   - React monté via createRoot() dans des vues Blade (pas d'Inertia)
 *   - Tailwind CSS v4 via @tailwindcss/vite
 *   - Babel + @babel/preset-react pour les fichiers .jsx
 *
 * Entry points (confirmés depuis le repo) :
 *   - resources/css/app.css  → styles globaux + Tailwind
 *   - resources/js/app.js    → JS principal (monte les composants React)
 *
 * Note : si de nouveaux fichiers .jsx autonomes sont ajoutés comme
 * entry points séparés, les déclarer dans le tableau `input` ci-dessous.
 */
export default defineConfig({
    plugins: [
        laravel({
            // Entry points Vite — à compléter si de nouveaux
            // fichiers JS/JSX autonomes sont ajoutés
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),

        // Tailwind CSS v4 (plugin natif Vite)
        tailwindcss(),
    ],

    // ─── Alias pratiques ──────────────────────────────────────────
    resolve: {
        alias: {
            // @ pointe vers resources/js/
            // Utilisez import MonComposant from '@/components/MonComposant'
            '@': '/resources/js',
        },
    },

    // ─── Build production ─────────────────────────────────────────
    build: {
        // Dossier de sortie (géré par laravel-vite-plugin → public/build/)
        outDir: 'public/build',
        emptyOutDir: true,

        // Minification activée en production
        minify: 'esbuild',

        // Sourcemaps désactivés en production (sécurité + poids)
        sourcemap: false,

        rollupOptions: {
            output: {
                // Noms de fichiers avec hash pour le cache busting
                entryFileNames: 'assets/[name]-[hash].js',
                chunkFileNames: 'assets/[name]-[hash].js',
                assetFileNames: 'assets/[name]-[hash][extname]',
            },
        },
    },

    // ─── Support JSX via Babel (@babel/preset-react) ──────────────
    // Babel est configuré dans babel.config.json ou .babelrc
    // Vite utilise esbuild par défaut pour .jsx — si vous avez
    // besoin de transformations Babel avancées, décommentez le plugin :
    //
    // import babel from 'vite-plugin-babel';
    // plugins: [..., babel()]
    //
    // Pour l'instant esbuild gère le JSX nativement et plus rapidement.
    esbuild: {
        // Permet à esbuild de transformer le JSX
        loader: 'jsx',
        include: /resources\/js\/.*\.[jt]sx?$/,
        exclude: [],
        jsxFactory: 'React.createElement',
        jsxFragment: 'React.Fragment',
    },

    // ─── Optimisations dev ────────────────────────────────────────
    optimizeDeps: {
        esbuildOptions: {
            loader: {
                '.js': 'jsx',
                '.jsx': 'jsx',
            },
        },
    },
});
