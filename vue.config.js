module.exports = {
  pluginOptions: {
    i18n: {
      locale: "en",
      fallbackLocale: "en",
      localeDir: "config/locales",
      enableLegacy: true,
      runtimeOnly: false,
      compositionOnly: false,
      fullInstall: true,
    },
  },
  configureWebpack: {
    optimization: {
      splitChunks: {
        chunks: "async",
        minSize: 20000,
        maxSize: 0,
        minChunks: 1,
        maxAsyncRequests: 30,
        maxInitialRequests: 30,
        enforceSizeThreshold: 50000,
        cacheGroups: {
          defaultVendors: {
            test: /[\\/]node_modules[\\/]/,
            priority: -10,
            minChunks: 2,
            reuseExistingChunk: true,
          },
          default: {
            minChunks: 2,
            priority: -20,
            reuseExistingChunk: true,
          },
        },
      },
    },
  },
};
