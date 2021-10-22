require('./bootstrap');
const Lang = require('lang.js');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import translations from './lang/vue-translations.js';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({
                methods: {
                    route,
                    $trans: () => new Lang({
                            messages: translations,
                            locale: 'pt-br', // Set locale
                            fallback: 'pt-br' // Set fallback lacale
                        })
                },
            })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
