import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    base: '/jetstream/build',
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',

                'resources/assets/css/style.css',
                'resources/assets/js/jquery.cookie.js',
                'resources/assets/js/off-canvas.js',
                'resources/assets/js/hoverable-collapse.js',
                'resources/assets/js/misc.js',
                
                'resources/assets/js/dashboard.js',
                'resources/assets/js/todolist.js',
                
                'resources/assets/js/chart.js'
            ],
            refresh: true,
        }),
    ],
});
