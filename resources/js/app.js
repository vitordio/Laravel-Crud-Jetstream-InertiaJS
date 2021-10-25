require('./bootstrap');
const Lang = require('lang.js');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import translations from './lang/vue-translations.js';
import { Components } from '@protonemedia/inertiajs-tables-laravel-query-builder';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

// Instância do Lang do lang.js para usarmos no Vue os arquivos de tradução do laravel
const lang = new Lang({
    messages: translations,
    locale: 'pt-br', // Set locale
    fallback: 'pt-br' // Set fallback lacale
});

// Tradução dos itens das tabelas
Components.Pagination.setTranslations({
    no_results_found: lang.get('labels.no_results_found'),
    previous: lang.get('pagination.previous'),
    next: lang.get('pagination.next'),
    to: lang.get('pagination.to'),
    of: lang.get('pagination.of'),
    results: lang.get('pagination.results'),
});

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({
                methods: {
                    route,
                    $trans: () => lang
                },
            })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
