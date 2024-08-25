import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,

        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    // server: {
    //     https: false,
    //     host: '0.0.0.0',
    //     hmr: 'admin.last6.local',
    //     port: 80,
    // },
    server: {
        https: false,
        host: '172.20.21.100', // Bind to all network interfaces
        hmr: {
            host: '172.20.21.100', // HMR connections should use localhost
            protocol: 'ws', // Use WebSocket for HMR
        },
        port: 5173,
    },
});
