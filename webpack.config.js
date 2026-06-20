const Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/')
    .setPublicPath('/bundles/markocupiccontaoschuldienstetheme')
    .setManifestKeyPrefix('')

    //.addEntry('select2', './assets/entries/select2.js')
    //.addEntry('frontend', './assets/filepond.js')
    .copyFiles({
      from: './node_modules/bootstrap/dist/js',
      to: 'bootstrap/dist/js/[path][name].[ext]',
      pattern: /(bootstrap\.bundle\.min\.js)$/,
    })

    .copyFiles({
      from: './assets/js',
      to: 'js/[path][name].[hash:8].[ext]'
    })

    .copyFiles({
      from: './assets/images/icons',
      to: 'images/icons/[path][name].[ext]'
    })

    .copyFiles({
      from: './assets/images/loginform',
      to: 'images/loginform/[path][name].[ext]'
    })

    .copyFiles({
      from: './assets/images/logos',
      to: 'images/logos/[path][name].[hash:8].[ext]'
    })

    .disableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableSourceMaps()
    .enableVersioning()

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
      config.useBuiltIns = 'usage';
      config.corejs = 3;
    })

    .enablePostCssLoader()
    // Preprocessing scss in css
    .enableSassLoader()
    .enablePostCssLoader()
    .addStyleEntry('styles/frontend', './assets/scss/main.scss')
;

module.exports = Encore.getWebpackConfig();
