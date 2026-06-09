const { createProxyMiddleware } = require('http-proxy-middleware');
const env = require('../../config/env');

const directivoProxy = createProxyMiddleware({
    target: env.DIRECTIVO_SERVICE_URL,
    changeOrigin: true,
    on: {
        proxyReq: (proxyReq, req, res) => {
            console.log(`[GATEWAY ➡️ Directivos] ${req.method} ${req.originalUrl}`);
        },
        error: (err, req, res) => {
            console.error(`[GATEWAY ❌ Directivos Error]:`, err.message);
            res.status(502).json({
                status: 'Error',
                message: 'El módulo de comunicación con Directivos no pudo enlazar la petición.',
                code: 'DIRECTIVOS_OFFLINE'
            });
        }
    }
});

module.exports = directivoProxy;
