const express = require('express');
const router  = express.Router();

const authRoutes       = require('../modules/auth/routes');
const docenteRoutes    = require('../modules/docentes/routes');
const alumnoRoutes     = require('../modules/alumnos/routes');
const directivoRoutes  = require('../modules/directivos/routes');
const academicoRoutes  = require('../modules/academico/routes');
const aspiranteRoutes  = require('../modules/aspirantes/routes');
const finanzasRoutes   = require('../modules/finanzas/routes');
const materiasRoutes   = require('../modules/materias/routes');

// Autenticación centralizada
router.use('/auth', authRoutes);

// Dominios de microservicios
router.use('/docentes',   docenteRoutes);
router.use('/alumnos',    alumnoRoutes);
router.use('/directivos', directivoRoutes);
router.use('/academico',  academicoRoutes);
router.use('/aspirantes', aspiranteRoutes);
router.use('/finanzas',   finanzasRoutes);
router.use('/materias',   materiasRoutes);

// Health Check Central
router.get('/health', (req, res) => {
    res.status(200).json({
        status:    'OK',
        timestamp: new Date(),
        gateway:   'Online'
    });
});

module.exports = router;
