import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: `@import 'node_modules/material-dashboard/assets/scss/material-dashboard.scss';`,
            },
        },
    },
    server: {
        hmr: {
            host: 'localhost',
        },
    },
    resolve: {
        alias: {
            'material-dashboard': 'material-dashboard/assets/js/material-dashboard.js',
        },
    },
    optimizeDeps: {
        include: ['jquery'],
    },
    build: {
        outDir: 'public/build',
    },
});
