const express = require('express');
const router  = express.Router();

const authRoutes       = require('../modules/auth/routes');
const docenteRoutes    = require('../modules/docentes/routes');
const alumnoRoutes     = require('../modules/alumnos/routes');
const directivoRoutes  = require('../modules/directivos/routes');
const aspiranteRoutes  = require('../modules/aspirantes/routes');
const finanzasRoutes   = require('../modules/finanzas/routes');
const materiasRoutes   = require('../modules/materias/routes');

// Autenticación centralizada
router.use('/auth', authRoutes);

// Dominios de microservicios
router.use('/docentes',   docenteRoutes);
router.use('/alumnos',    alumnoRoutes);
router.use('/directivos', directivoRoutes);
router.use('/aspirantes', aspiranteRoutes);
router.use('/finanzas',   finanzasRoutes);
router.use('/materias',   materiasRoutes);

// Health Check Central
router.get('/health', (req, res) => {
    res.status(200).json({
        status:    'OK',
        timestamp: new Date(),
        gateway:   'Online',
        modules: {
            auth:       'Active',
            docentes:   'Active → :3002',
            alumnos:    'Active → :3001',
            directivos: 'Active → :3003',
            finanzas:   'Active → :3004',
            aspirantes: 'Active → :3005',
            materias:   'Active → Memoria'
        }
    });
});

module.exports = router;
