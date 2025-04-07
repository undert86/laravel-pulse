import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';


export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/svg/Pulse_logo.svg', 'resources/css/dashboard.css', 'resources/css/admin.dashboard.css', 'resources/svg/Union.svg', 'resources/css/grades.css'],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
