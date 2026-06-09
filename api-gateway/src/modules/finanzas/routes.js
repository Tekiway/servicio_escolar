const express = require('express');
const http    = require('http');
const https   = require('https');
const router  = express.Router();

const env          = require('../../config/env');
const FINANZAS_URL = env.FINANZAS_SERVICE_URL;
const TIMEOUT_MS   = 2000;

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

async function tryFinanzas(method, path, body, headers) {
    const r = await httpRequest(method, `${FINANZAS_URL}${path}`, body, headers, TIMEOUT_MS);
    if (!r.ok) console.warn(`[GATEWAY→Finanzas] No disponible (${r.error})`);
    return r;
}

function validarToken(req, res, next) {
    const authHeader = req.headers['authorization'];
    const token      = authHeader && authHeader.split(' ')[1];
    if (!token) return res.status(401).json({ error: 'Token no proporcionado' });
    req.token = token;
    next();
}

// ─── Rutas de Finanzas ────────────────────────────────────────────────────────

// POST /api/finanzas/tuitions

// GET /api/finanzas/tuitions
router.get('/tuitions', validarToken, async (req, res) => {
    const r = await tryFinanzas('GET', '/api/finanzas/tuitions', null, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    res.status(503).json({ error: 'Servicio de Finanzas no disponible.' });
});

router.post('/tuitions', validarToken, async (req, res) => {
    const r = await tryFinanzas('POST', '/api/finanzas/tuitions', req.body, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    res.status(503).json({ error: 'Servicio de Finanzas no disponible.', code: 'FINANZAS_OFFLINE' });
});

// PATCH /api/finanzas/tuitions/:id/pay
router.patch('/tuitions/:id/pay', validarToken, async (req, res) => {
    const r = await tryFinanzas('PATCH', `/api/finanzas/tuitions/${req.params.id}/pay`, req.body, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    res.status(503).json({ error: 'Servicio de Finanzas no disponible.' });
});

// GET /api/finanzas/tuitions/student/:studentId
router.get('/tuitions/student/:studentId', validarToken, async (req, res) => {
    const r = await tryFinanzas('GET', `/api/finanzas/tuitions/student/${req.params.studentId}`, null, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    res.status(503).json({ error: 'Servicio de Finanzas no disponible.' });
});

module.exports = router;
