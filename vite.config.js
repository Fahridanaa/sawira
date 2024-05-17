import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import importPlugin from 'vite-plugin-import';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/sass/app.scss',
                'resources/css/app.css'
            ],
            refresh: true,
        }),
    ],
    define: {
        'window.jQuery': 'jQuery',
    },
    server: {
        hmr: {
            host: 'localhost',
        },
    },
    optimizeDeps: {
        include: ['jquery'],
    },
    build: {
        outDir: 'public/build',
        rollupOptions: {
            external: ['jquery'],
        },
    },
});
