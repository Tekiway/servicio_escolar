const express = require('express');
const router = express.Router();
const http = require('http');
const https = require('https');

const ALUMNO_URL = process.env.ALUMNO_SERVICE_URL || 'http://localhost:3001';
const TIMEOUT_MS = 2000;

let alumnosMemoria = [
    {
        _id: 'alu-001',
        nombre: 'Carlos Rodríguez López',
        username: 'crodriguez',
        matricula: 'A2024001',
        email: 'crodriguez@escuela.edu.mx',
        carrera: 'Ingeniería en TICs'
    },
    {
        _id: 'alu-002',
        nombre: 'Sofía Hernández Méndez',
        username: 'shernandez',
        matricula: 'A2024002',
        email: 'shernandez@escuela.edu.mx',
        carrera: 'Ingeniería en TICs'
    }
];

function httpRequest(method, urlStr, body, headers, timeoutMs) {
    return new Promise((resolve) => {
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
                'Authorization': headers['authorization'] || '',
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
    });
}

async function tryAlumno(method, path, body, headers) {
    const r = await httpRequest(method, `${ALUMNO_URL}${path}`, body, headers, TIMEOUT_MS);
    if (!r.ok) console.warn(`[GATEWAY→Alumnos] No disponible (${r.error}), usando memoria.`);
    return r;
}

// GET /api/alumnos
router.get('/', async (req, res) => {
    const r = await tryAlumno('GET', '/api/alumnos/solo-info', null, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    res.json(alumnosMemoria);
});

// GET /api/alumnos/solo-info
router.get('/solo-info', async (req, res) => {
    const r = await tryAlumno('GET', '/api/alumnos/solo-info', null, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    res.json(alumnosMemoria.map(a => ({
        _id: a._id, nombre: a.nombre, matricula: a.matricula,
        carrera: a.carrera, email: a.email
    })));
});

// GET /api/alumnos/buscar
router.get('/buscar', async (req, res) => {
    const q = (req.query.query || '').toLowerCase();
    const r = await tryAlumno('GET', `/api/alumnos/buscar?query=${q}`, null, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    res.json(alumnosMemoria.filter(a =>
        a.nombre.toLowerCase().includes(q) || a.matricula.toLowerCase().includes(q)
    ));
});

// POST /api/alumnos
router.post('/', async (req, res) => {
    const r = await tryAlumno('POST', '/api/alumnos', req.body, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    const nuevo = {
        _id: 'alu-' + Date.now(),
        nombre: req.body.nombre || '',
        username: req.body.username || '',
        matricula: req.body.matricula || '',
        email: req.body.email || '',
        carrera: req.body.carrera || 'General'
    };
    alumnosMemoria.push(nuevo);
    res.status(201).json(nuevo);
});

// POST /api/alumnos/login
router.post('/login', async (req, res) => {
    const r = await tryAlumno('POST', '/api/alumnos/login', req.body, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    const payload = Buffer.from(JSON.stringify({ rol: 'alumno', id: 'mock', ts: Date.now() })).toString('base64');
    res.json({ token: `mock.${payload}.sig`, rol: 'alumno', _modo: 'memoria' });
});


// PUT /api/alumnos/mi-info
router.put('/mi-info', async (req, res) => {
    const r = await tryAlumno('PUT', '/api/alumnos/mi-info', req.body, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    res.status(503).json({ error: 'Servicio de Alumnos no disponible' });
});

// GET /api/alumnos/:id
router.get('/:id', async (req, res) => {
    const r = await tryAlumno('GET', `/api/alumnos/${req.params.id}`, null, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    const alumno = alumnosMemoria.find(a => a._id === req.params.id);
    if (!alumno) return res.status(404).json({ message: 'Alumno no encontrado' });
    res.json(alumno);
});

// PUT /api/alumnos/:id/carrera
router.put('/:id/carrera', async (req, res) => {
    const r = await tryAlumno('PUT', `/api/alumnos/${req.params.id}/carrera`, req.body, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    const idx = alumnosMemoria.findIndex(a => a._id === req.params.id);
    if (idx === -1) return res.status(404).json({ message: 'Alumno no encontrado' });
    alumnosMemoria[idx].carrera = req.body.carrera || alumnosMemoria[idx].carrera;
    res.json(alumnosMemoria[idx]);
});

// PUT /api/alumnos/:id
router.put('/:id', async (req, res) => {
    const r = await tryAlumno('PUT', `/api/alumnos/${req.params.id}`, req.body, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    const idx = alumnosMemoria.findIndex(a => a._id === req.params.id);
    if (idx !== -1) {
        Object.assign(alumnosMemoria[idx], req.body);
        return res.json(alumnosMemoria[idx]);
    }
    res.status(503).json({ error: 'Servicio de Alumnos no disponible' });
});

// DELETE /api/alumnos/:id
router.delete('/:id', async (req, res) => {
    const r = await tryAlumno('DELETE', `/api/alumnos/${req.params.id}`, null, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    const idx = alumnosMemoria.findIndex(a => a._id === req.params.id);
    if (idx !== -1) {
        alumnosMemoria.splice(idx, 1);
        return res.json({ message: "Alumno eliminado (memoria)" });
    }
    res.status(503).json({ error: 'Servicio de Alumnos no disponible' });
});

// PATCH /api/alumnos/:id/credenciales
router.patch('/:id/credenciales', async (req, res) => {
    const r = await tryAlumno('PATCH', `/api/alumnos/${req.params.id}/credenciales`, req.body, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    const idx = alumnosMemoria.findIndex(a => a._id === req.params.id);
    if (idx !== -1) {
        if (req.body.username) alumnosMemoria[idx].username = req.body.username;
        if (req.body.password) alumnosMemoria[idx].password = req.body.password;
        return res.json(alumnosMemoria[idx]);
    }
    res.status(503).json({ error: 'Servicio de Alumnos no disponible' });
});

// PATCH /api/alumnos/:id/reset-password
router.patch('/:id/reset-password', async (req, res) => {
    const r = await tryAlumno('PATCH', `/api/alumnos/${req.params.id}/reset-password`, req.body, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    res.status(503).json({ error: 'Servicio de Alumnos no disponible' });
});

// GET /api/alumnos/:id/materias
router.get('/:id/materias', async (req, res) => {
    const r = await tryAlumno('GET', `/api/alumnos/${req.params.id}/materias`, null, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    res.json([]);
});

// POST /api/alumnos/:id/materias
router.post('/:id/materias', async (req, res) => {
    const r = await tryAlumno('POST', `/api/alumnos/${req.params.id}/materias`, req.body, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    res.status(503).json({ error: 'Servicio de Alumnos no disponible' });
});

// GET /api/alumnos/:id/materias/:materiaNombre/calificaciones
router.get('/:id/materias/:materiaNombre/calificaciones', async (req, res) => {
    const materia = encodeURIComponent(req.params.materiaNombre);
    const r = await tryAlumno('GET', `/api/alumnos/${req.params.id}/materias/${materia}/calificaciones`, null, req.headers);
    if (r.ok) return res.status(r.status).json(r.data);
    res.status(503).json({ error: 'Servicio de Alumnos no disponible' });
});

// PATCH /api/alumnos/:id/materias/:materiaNombre/unidades/:numUnidad
router.patch('/:id/materias/:materiaNombre/unidades/:numUnidad', async (req, res) => {
    const materia = encodeURIComponent(req.params.materiaNombre);
    const r = await tryAlumno(
        'PATCH',
        `/api/alumnos/${req.params.id}/materias/${materia}/unidades/${req.params.numUnidad}`,
        req.body,
        req.headers
    );
    if (r.ok) return res.status(r.status).json(r.data);
    res.status(503).json({ error: 'Servicio de Alumnos no disponible' });
});

module.exports = router;
