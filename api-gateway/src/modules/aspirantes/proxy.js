const { createProxyMiddleware } = require('http-proxy-middleware');
const env = require('../../config/env');

const aspiranteProxy = createProxyMiddleware({
    target: env.ASPIRANTE_SERVICE_URL,
    changeOrigin: true,
    on: {
        proxyReq: (proxyReq, req) => {
            console.log(`[GATEWAY ➡️ Aspirantes] ${req.method} ${req.originalUrl}`);
        },
        error: (err, req, res) => {
            console.error(`[GATEWAY ❌ Aspirantes Error]:`, err.message);
            res.status(502).json({
                status: 'Error',
                message: 'El módulo de Aspirantes no está disponible.',
                code: 'ASPIRANTES_OFFLINE'
            });
        }
    }
});

module.exports = aspiranteProxy;
