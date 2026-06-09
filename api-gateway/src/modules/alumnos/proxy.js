const { createProxyMiddleware } = require('http-proxy-middleware');
const env = require('../../config/env');

const alumnoProxy = createProxyMiddleware({
    target: env.ALUMNO_SERVICE_URL,
    changeOrigin: true,
    on: {
        proxyReq: (proxyReq, req, res) => {
            console.log(`[GATEWAY ➡️ Alumnos] ${req.method} ${req.originalUrl}`);
        },
        error: (err, req, res) => {
            console.error(`[GATEWAY ❌ Alumnos Error]:`, err.message);
            res.status(502).json({
                status: 'Error',
                message: 'El módulo de comunicación con Alumnos no pudo enlazar la petición.',
                code: 'ALUMNOS_OFFLINE'
            });
        }
    }
});

module.exports = alumnoProxy;
