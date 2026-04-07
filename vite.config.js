import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/login-style.css',
                'resources/css/register-style.css',
            ],
            refresh: true,
        }),
    ],
});