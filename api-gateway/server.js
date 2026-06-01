const express = require('express');
const cors = require('cors');
const morgan = require('morgan');
const env = require('./src/config/env');
const apiRoutes = require('./src/routes');

const app = express();

// 1. Middlewares globales
app.use(cors());
app.use(morgan('dev')); // Logger de peticiones HTTP en consola
app.use(express.json());

// 2. Registro de rutas principales bajo el prefijo /api
app.use('/api', apiRoutes);

// 3. Manejador de rutas no encontradas (404)
app.use((req, res, next) => {
    res.status(404).json({
        status: 'Error',
        message: 'La ruta solicitada no existe en la pasarela API Gateway.',
        code: 'NOT_FOUND'
    });
});

// 4. Encendido del servidor central
app.listen(env.PORT, () => {
    console.log(`===================================================`);
    console.log(`🚀 API GATEWAY central activo en puerto ${env.PORT}`);
    console.log(`📂 Módulos Enrutados:`);
    console.log(`   ➡️  /api/docentes -> ${env.DOCENTE_SERVICE_URL}`);
    console.log(`===================================================`);
});
