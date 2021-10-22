const path = require('path');
const WebpackShellPluginNext = require('webpack-shell-plugin-next');

module.exports = {
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
    plugins: [
        new WebpackShellPluginNext({
            onBuildStart:{
                scripts: ['php artisan lang:js resources/js/lang/vue-translations.js --no-lib --quiet'],
                blocking: true,
                parallel: false
            },
            onBuildEnd: []
        })
    ],
};
