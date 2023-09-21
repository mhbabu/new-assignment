import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/css/toastr.min.css',
                'resources/js/app.js',
                'resources/js/jquery.min.js',
                'resources/js/toastr.min.js',
            ],
            refresh: true,
        }),
    ],
});
