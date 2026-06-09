const express   = require('express');
const env       = require('./src/config/env');
const apiRoutes = require('./src/routes');

const app = express();

// 1. CORS nativo (sin paquete cors)
app.use((req, res, next) => {
    res.setHeader('Access-Control-Allow-Origin',  '*');
    res.setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
    res.setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization');
    if (req.method === 'OPTIONS') return res.sendStatus(204);
    next();
});

// 2. Logger mínimo (sin morgan)
app.use((req, res, next) => {
    const start = Date.now();
    res.on('finish', () => {
        console.log(`[${new Date().toISOString()}] ${req.method} ${req.originalUrl} ${res.statusCode} +${Date.now() - start}ms`);
    });
    next();
});

// 3. Parser JSON
app.use(express.json());

// 4. Registro de rutas principales bajo el prefijo /api
app.use('/api', apiRoutes);

// 5. Manejador de rutas no encontradas (404)
app.use((req, res) => {
    res.status(404).json({
        status:  'Error',
        message: 'La ruta solicitada no existe en la pasarela API Gateway.',
        code:    'NOT_FOUND'
    });
});

// 6. Encendido del servidor central
app.listen(env.PORT, () => {
    console.log(`===================================================`);
    console.log(`🚀 API GATEWAY central activo en puerto ${env.PORT}`);
    console.log(`📂 Módulos Enrutados:`);
    console.log(`   ➡️  /api/auth        → Auth centralizada`);
    console.log(`   ➡️  /api/docentes    → ${env.DOCENTE_SERVICE_URL}`);
    console.log(`   ➡️  /api/alumnos     → ${env.ALUMNO_SERVICE_URL}`);
    console.log(`   ➡️  /api/directivos  → ${env.DIRECTIVO_SERVICE_URL}`);
    console.log(`   ➡️  /api/finanzas    → ${env.FINANZAS_SERVICE_URL}`);
    console.log(`   ➡️  /api/aspirantes  → ${env.ASPIRANTE_SERVICE_URL}`);
    console.log(`===================================================`);
});
