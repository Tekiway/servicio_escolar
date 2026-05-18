const { createProxyMiddleware } = require('http-proxy-middleware');
const env = require('../../config/env');

// Configuración de Proxy Reverso exclusiva para el Dominio/Módulo de Docentes
const docenteProxy = createProxyMiddleware({
    target: env.DOCENTE_SERVICE_URL,
    changeOrigin: true,
    on: {
        proxyReq: (proxyReq, req, res) => {
            console.log(`[GATEWAY ➡️ Docentes] ${req.method} ${req.originalUrl}`);
        },
        error: (err, req, res) => {
            console.error(`[GATEWAY ❌ Docentes Error]:`, err.message);
            res.status(502).json({
                status: 'Error',
                message: 'El módulo de comunicación con Docentes no pudo enlazar la petición.',
                code: 'DOCENTES_OFFLINE'
            });
        }
    }
});

module.exports = docenteProxy;
