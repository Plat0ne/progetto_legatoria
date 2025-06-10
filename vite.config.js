import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/css/font.css', 'resources/css/star-button.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
