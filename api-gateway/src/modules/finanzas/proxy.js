const { createProxyMiddleware } = require('http-proxy-middleware');
const env = require('../../config/env');

const finanzasProxy = createProxyMiddleware({
    target: env.FINANZAS_SERVICE_URL,
    changeOrigin: true,
    on: {
        proxyReq: (proxyReq, req) => {
            console.log(`[GATEWAY ➡️ Finanzas] ${req.method} ${req.originalUrl}`);
        },
        error: (err, req, res) => {
            console.error(`[GATEWAY ❌ Finanzas Error]:`, err.message);
            res.status(502).json({
                status: 'Error',
                message: 'El módulo de Finanzas no está disponible.',
                code: 'FINANZAS_OFFLINE'
            });
        }
    }
});

module.exports = finanzasProxy;
