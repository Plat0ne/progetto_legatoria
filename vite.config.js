import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/css/font.css', 'resources/css/cards.css', 'resources/css/delete.css', 'resources/css/edit.css', 'resources/css/click.css', 'resources/css/fill.css', 'resources/css/cancel.css', 'resources/css/save.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
