const express = require('express');
const router = express.Router();
const http = require('http');
const https = require('https');

const DIRECTIVO_URL = process.env.DIRECTIVO_SERVICE_URL || 'http://localhost:3003';
const TIMEOUT_MS = 2000;
const JWT_SECRET_STR = process.env.JWT_SECRET || 'secreto';

// ────────────────────────────────────────────────
// ALMACENAMIENTO EN MEMORIA (fallback)
// ────────────────────────────────────────────────
let directivosMemoria = [
    {
        _id: 'dir-001',
        nombre: 'Laura Ramírez Soto',
        username: 'laura.rh',
        email: 'laura.rh@escuela.edu.mx',
        password: 'Admin1234', // Solo en memoria/mock
        numeroEmpleado: 'DIR-2026-001',
        cargo: 'Jefa de Recursos Humanos',
        area: 'Recursos Humanos',
        estatus: 'Activo'
    }
];

function httpRequest(method, urlStr, body, headers, timeoutMs) {
    return new Promise((resolve) => {
        try {
            const url = new URL(urlStr);
            const lib = url.protocol === 'https:' ? https : http;
            const bodyStr = body ? JSON.stringify(body) : '';
            const options = {
                hostname: url.hostname,
                port: url.port || 80,
                path: url.pathname + url.search,
                method: method.toUpperCase(),
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': (headers && headers['authorization']) || '',
                    'Content-Length': Buffer.byteLength(bodyStr)
                },
                timeout: timeoutMs
            };
            const req = lib.request(options, (res) => {
                let data = '';
                res.on('data', chunk => data += chunk);
                res.on('end', () => {
                    try { resolve({ ok: true, status: res.statusCode, data: JSON.parse(data) }); }
                    catch (e) { resolve({ ok: true, status: res.statusCode, data }); }
                });
            });
            req.on('timeout', () => { req.destroy(); resolve({ ok: false, error: 'timeout' }); });
            req.on('error', (err) => resolve({ ok: false, error: err.message }));
            if (bodyStr) req.write(bodyStr);
            req.end();
        } catch (e) {
            resolve({ ok: false, error: e.message });
        }
    });
}

async function tryDirectivo(method, path, body, headers) {
    const r = await httpRequest(method, `${DIRECTIVO_URL}${path}`, body, headers, TIMEOUT_MS);
    if (!r.ok) console.warn(`[GATEWAY→Directivos] No disponible (${r.error}), usando memoria.`);
    return r;
}

// Generar token mock simple (sin dependencias externas)
function mockToken(payload) {
    const header = Buffer.from('{"alg":"none","typ":"JWT"}').toString('base64url');
    const body64 = Buffer.from(JSON.stringify({ ...payload, iat: Math.floor(Date.now()/1000), exp: Math.floor(Date.now()/1000) + 28800 })).toString('base64url');
    return `${header}.${body64}.mock_sig`;
}

// GET /api/directivos
router.get('/', async (req, res) => {
    const r = await tryDirectivo('GET', '/api/directivos', null, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    res.json(directivosMemoria.map(d => ({ ...d, password: undefined })));
});

// GET /api/directivos/:id
router.get('/:id', async (req, res) => {
    if (req.params.id === 'login') return res.status(400).json({ message: 'Use POST /api/directivos/login' });
    const r = await tryDirectivo('GET', `/api/directivos/${req.params.id}`, null, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    const d = directivosMemoria.find(x => x._id === req.params.id);
    if (!d) return res.status(404).json({ message: 'Directivo no encontrado' });
    res.json({ ...d, password: undefined });
});

// POST /api/directivos → Registrar
router.post('/', async (req, res) => {
    const r = await tryDirectivo('POST', '/api/directivos', req.body, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    const nuevo = {
        _id: 'dir-' + Date.now(),
        nombre: req.body.nombre || '',
        username: req.body.username || '',
        email: req.body.email || '',
        password: req.body.password || '',
        numeroEmpleado: req.body.numeroEmpleado || '',
        cargo: req.body.cargo || '',
        area: req.body.area || '',
        estatus: 'Activo'
    };
    directivosMemoria.push(nuevo);
    res.status(201).json({ ...nuevo, password: undefined });
});

// POST /api/directivos/login
router.post('/login', async (req, res) => {
    const r = await tryDirectivo('POST', '/api/directivos/login', req.body, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);

    // Fallback: buscar en memoria
    const { email, username, password } = req.body;
    const directivo = directivosMemoria.find(d =>
        (email && d.email === email) || (username && d.username === username)
    );

    if (!directivo) {
        return res.status(401).json({ message: 'Credenciales inválidas' });
    }
    if (directivo.password !== password) {
        return res.status(401).json({ message: 'Contraseña incorrecta' });
    }

    const token = mockToken({ rol: 'directivo', id: directivo._id, username: directivo.username });
    res.json({
        token,
        rol: 'directivo',
        nombre: directivo.nombre,
        _modo: 'memoria'
    });
});

// PUT /api/directivos/:id
router.put('/:id', async (req, res) => {
    const r = await tryDirectivo('PUT', `/api/directivos/${req.params.id}`, req.body, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    
    // Fallback in memory
    const idx = directivosMemoria.findIndex(d => d._id === req.params.id);
    if (idx !== -1) {
        Object.assign(directivosMemoria[idx], req.body);
        return res.json(directivosMemoria[idx]);
    }
    
    res.status(503).json({ error: 'Servicio de Directivos no disponible' });
});

// DELETE /api/directivos/:id
router.delete('/:id', async (req, res) => {
    const r = await tryDirectivo('DELETE', `/api/directivos/${req.params.id}`, null, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    res.status(503).json({ error: 'Servicio de Directivos no disponible' });
});

// PATCH /api/directivos/:id/credenciales
router.patch('/:id/credenciales', async (req, res) => {
    const r = await tryDirectivo('PATCH', `/api/directivos/${req.params.id}/credenciales`, req.body, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    
    // Fallback in memory
    const idx = directivosMemoria.findIndex(d => d._id === req.params.id);
    if (idx !== -1) {
        if (req.body.username) directivosMemoria[idx].username = req.body.username;
        if (req.body.password) directivosMemoria[idx].password = req.body.password;
        return res.json({ success: true, message: 'Credenciales actualizadas en memoria.', data: directivosMemoria[idx] });
    }
    
    res.status(503).json({ error: 'Servicio de Directivos no disponible' });
});

module.exports = router;
