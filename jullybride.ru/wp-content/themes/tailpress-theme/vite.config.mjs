import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig(({ command }) => {
    const isBuild = command === 'build';

    return {
        base: isBuild ? '/wp-content/themes/tailpress/dist/' : '/',
        server: {
            // В Docker без host Vite слушает только 127.0.0.1 внутри контейнера — с Mac не достучаться даже с -p.
            host: true,
            port: 3000,
            cors: true,
            origin: 'http://wordpress.local',
        },
        build: {
            manifest: true,
            outDir: 'dist',
            rollupOptions: {
                input: [
                    'resources/js/app.js',
                    'resources/css/app.css',
                    'resources/css/editor-style.css'
                ],
            },
        },
        plugins: [
            tailwindcss(),
        ],
    }
});
