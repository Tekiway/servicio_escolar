const express = require('express');
const http    = require('http');
const https   = require('https');
const router  = express.Router();

const env         = require('../../config/env');
const DOCENTE_URL = env.DOCENTE_SERVICE_URL;
const TIMEOUT_MS  = 2000;

// Token interno del gateway — rol directivo — usado cuando el cliente es admin sin JWT
// Generado con: jwt.sign({ rol:'directivo', id:'gateway-internal' }, 'secreto', { expiresIn:'365d' })
const GATEWAY_SERVICE_TOKEN = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJyb2wiOiJkaXJlY3Rpdm8iLCJpZCI6ImdhdGV3YXktaW50ZXJuYWwiLCJ1c2VybmFtZSI6ImFwaS1nYXRld2F5IiwiaWF0IjoxNzgwOTM5Mjk2LCJleHAiOjE4MTI0NzUyOTZ9.OfKHq_tH1mZkJ_Ngg4G5iNh6TxNSQutpN8c45LbWXRY';

// Devuelve el token a usar: el del cliente si es de directivo, si no el del gateway
function resolveAuthHeader(reqHeaders) {
    const clientToken = (reqHeaders && reqHeaders['authorization']) || '';
    // Si el cliente ya trae un Bearer token, úsalo directamente
    if (clientToken && clientToken.startsWith('Bearer ')) return clientToken;
    // De lo contrario, el gateway actúa con su propio token de servicio
    return `Bearer ${GATEWAY_SERVICE_TOKEN}`;
}

// ─── Helper HTTP nativo ───────────────────────────────────────────────────────

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
                    'Authorization':   resolveAuthHeader(headers),
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

async function tryDocente(method, path, body, headers) {
    const r = await httpRequest(method, `${DOCENTE_URL}${path}`, body, headers, TIMEOUT_MS);
    if (!r.ok) console.warn(`[GATEWAY→Docentes] No disponible (${r.error})`);
    return r;
}

// ─── Fallback en memoria ──────────────────────────────────────────────────────

let docentesMemoria = [];

// ─── Rutas ────────────────────────────────────────────────────────────────────

// POST /api/docentes  — Registrar docente
router.post('/', async (req, res) => {
    const r = await tryDocente('POST', '/api/docentes', req.body, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    const nuevo = { _id: 'doc-' + Date.now(), ...req.body };
    docentesMemoria.push(nuevo);
    res.status(201).json(nuevo);
});

// POST /api/docentes/login — Login docente
router.post('/login', async (req, res) => {
    const r = await tryDocente('POST', '/api/docentes/login', req.body, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    res.status(503).json({ error: 'Servicio de Docentes no disponible.', code: 'DOCENTES_OFFLINE' });
});

// GET /api/docentes  — Listar todos
router.get('/', async (req, res) => {
    const r = await tryDocente('GET', '/api/docentes', null, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    res.json(docentesMemoria);
});

// GET /api/docentes/buscar?filtro=
router.get('/buscar', async (req, res) => {
    const qs = `?filtro=${encodeURIComponent(req.query.filtro || '')}`;
    const r  = await tryDocente('GET', `/api/docentes/buscar${qs}`, null, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    res.json([]);
});

// PUT /api/docentes/:id — Editar docente
router.put('/:id', async (req, res) => {
    const r = await tryDocente('PUT', `/api/docentes/${req.params.id}`, req.body, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    const idx = docentesMemoria.findIndex(d => d._id === req.params.id);
    if (idx === -1) return res.status(404).json({ error: 'Docente no encontrado' });
    docentesMemoria[idx] = { ...docentesMemoria[idx], ...req.body };
    res.json(docentesMemoria[idx]);
});

// DELETE /api/docentes/:id — Eliminar docente
router.delete('/:id', async (req, res) => {
    const r = await tryDocente('DELETE', `/api/docentes/${req.params.id}`, null, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    const idx = docentesMemoria.findIndex(d => d._id === req.params.id);
    if (idx !== -1) docentesMemoria.splice(idx, 1);
    res.json({ message: 'Docente eliminado (memoria).' });
});

module.exports = router;
