import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
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
    },
});