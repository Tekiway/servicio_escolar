const express = require('express');
const http    = require('http');
const https   = require('https');
const router  = express.Router();

const env           = require('../../config/env');
const ASPIRANTE_URL = env.ASPIRANTE_SERVICE_URL;
const TIMEOUT_MS    = 2000;

// ─── Helper de petición HTTP nativa ──────────────────────────────────────────

function httpRequest(method, urlStr, body, headers, timeoutMs) {
    return new Promise((resolve) => {
        try {
            const url     = new URL(urlStr);
            const lib     = url.protocol === 'https:' ? https : http;
            const bodyStr = body ? JSON.stringify(body) : '';
            const options = {
                hostname: url.hostname,
                port:     url.port || 80,
                path:     url.pathname + url.search,
                method:   method.toUpperCase(),
                headers: {
                    'Content-Type':    'application/json',
                    'Authorization':   (headers && headers['authorization']) || '',
                    'Content-Length':  Buffer.byteLength(bodyStr)
                },
                timeout: timeoutMs
            };
            const req = lib.request(options, (res) => {
                let data = '';
                res.on('data',  c => data += c);
                res.on('end',  () => {
                    try   { resolve({ ok: true, status: res.statusCode, data: JSON.parse(data) }); }
                    catch { resolve({ ok: true, status: res.statusCode, data }); }
                });
            });
            req.on('timeout', () => { req.destroy(); resolve({ ok: false, error: 'timeout' }); });
            req.on('error',   (err) => resolve({ ok: false, error: err.message }));
            if (bodyStr) req.write(bodyStr);
            req.end();
        } catch (e) {
            resolve({ ok: false, error: e.message });
        }
    });
}

async function tryAspirante(method, path, body, headers) {
    const r = await httpRequest(method, `${ASPIRANTE_URL}${path}`, body, headers, TIMEOUT_MS);
    if (!r.ok) console.warn(`[GATEWAY→Aspirantes] No disponible (${r.error})`);
    return r;
}

// ─── Validación de token (reusa el patrón del gateway) ────────────────────────

function validarToken(req, res, next) {
    const authHeader = req.headers['authorization'];
    const token      = authHeader && authHeader.split(' ')[1];
    if (!token) return res.status(401).json({ error: 'Token no proporcionado' });
    // Delegar validación completa al microservicio; aquí solo verificamos que exista
    req.token = token;
    next();
}

// ─── Rutas de Aspirantes ──────────────────────────────────────────────────────

// POST /api/aspirantes/register
router.post('/register', async (req, res) => {
    const r = await tryAspirante('POST', '/api/aspirantes/register', req.body, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    res.status(503).json({ success: false, error: 'Servicio de Aspirantes no disponible.', code: 'ASPIRANTES_OFFLINE' });
});

// GET /api/aspirantes
router.get('/', validarToken, async (req, res) => {
    const qs = req.url.includes('?') ? req.url.substring(req.url.indexOf('?')) : '';
    const r  = await tryAspirante('GET', `/api/aspirantes${qs}`, null, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    res.status(503).json({ success: false, error: 'Servicio de Aspirantes no disponible.' });
});

// GET /api/aspirantes/pendientes
router.get('/pendientes', validarToken, async (req, res) => {
    const r = await tryAspirante('GET', '/api/aspirantes/pendientes', null, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    res.status(503).json({ success: false, error: 'Servicio de Aspirantes no disponible.' });
});

// GET /api/aspirantes/aceptados
router.get('/aceptados', validarToken, async (req, res) => {
    const r = await tryAspirante('GET', '/api/aspirantes/aceptados', null, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    res.status(503).json({ success: false, error: 'Servicio de Aspirantes no disponible.' });
});

// PATCH /api/aspirantes/:id/exam
router.patch('/:id/exam', validarToken, async (req, res) => {
    const r = await tryAspirante('PATCH', `/api/aspirantes/${req.params.id}/exam`, req.body, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    res.status(503).json({ success: false, error: 'Servicio de Aspirantes no disponible.' });
});

// PATCH /api/aspirantes/:id/accept
router.patch('/:id/accept', validarToken, async (req, res) => {
    const r = await tryAspirante('PATCH', `/api/aspirantes/${req.params.id}/accept`, req.body, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    res.status(503).json({ success: false, error: 'Servicio de Aspirantes no disponible.' });
});

module.exports = router;
