import { defineConfig } from 'vite'; // importa la funzione defineConfig
import laravel from 'laravel-vite-plugin'; // importa il plugin laravel-vite-plugin

export default defineConfig({ // configurazione del plugin laravel-vite-plugin
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/css/font.css', 'resources/css/cards.css', 'resources/css/delete.css', 'resources/css/edit.css', 'resources/css/click.css', 'resources/css/fill.css', 'resources/css/cancel.css', 'resources/css/save.css', 'resources/css/close.css', 'resources/css/start.css', 'resources/css/home.css', 'resources/js/app.js'],
            refresh: true, // flag che indica se il plugin deve ricaricare automaticamente i file quando vengono modificati
        }),
    ],
});
