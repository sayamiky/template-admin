import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // Aset dari proyek Anda yang sudah ada
                'resources/css/app.css',
                'resources/js/app.js',

                // --- Aset Baru dari Template Materio ---

                // Vendor CSS
                'resources/assets/vendor/scss/core.scss',
                'resources/assets/vendor/scss/theme-default.scss',
                'resources/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.scss', // Untuk scrollbar kustom
                'resources/assets/vendor/libs/apex-charts/apex-charts.scss', // Jika Anda butuh chart

                // Vendor JS
                'resources/assets/vendor/js/helpers.js',
                'resources/assets/vendor/js/menu.js',
                'resources/assets/vendor/libs/jquery/jquery.js',
                'resources/assets/vendor/libs/popper/popper.js',
                'resources/assets/vendor/js/bootstrap.js',
                'resources/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js',
                'resources/assets/vendor/libs/apex-charts/apexcharts.js', // Jika Anda butuh chart

                // Main CSS & JS Template
                'resources/assets/css/demo.css',
                'resources/assets/js/main.js',

                // JS spesifik untuk halaman dashboard (contoh)
                'resources/assets/js/dashboards-analytics.js',
            ],
            refresh: true,
        }),
    ],
    // Konfigurasi tambahan untuk resolve alias jika dibutuhkan nanti
    resolve: {
        alias: {
            '@': '/resources',
        },
    },
});
