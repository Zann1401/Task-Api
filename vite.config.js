import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
<<<<<<< HEAD
import { bunny } from 'laravel-vite-plugin/fonts';
=======
>>>>>>> 676b395fa7202dab0829ec243b286da87e6a46fc
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
<<<<<<< HEAD
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
=======
        }),
        tailwindcss(),
    ],
>>>>>>> 676b395fa7202dab0829ec243b286da87e6a46fc
});
