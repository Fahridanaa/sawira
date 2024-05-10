import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import {resolve} from 'path';

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
    resolve: {
        alias: {
            jquery: resolve(__dirname, './node_modules/jquery/dist/jquery.min.js')
        },
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
