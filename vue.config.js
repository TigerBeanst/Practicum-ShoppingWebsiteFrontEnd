module.exports = {
    devServer: {
        proxy: {
            '/api': {
                target: 'http://api.store.com/store/',
                changeOrigin: true,
                pathRewrite: {
                    '^/api': ''
                }
            }
        }
    }
}
