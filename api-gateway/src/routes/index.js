const express = require('express');
const router = express.Router();

// Importar rutas de la estructura modular por dominios
const docenteRoutes = require('../modules/docentes/routes');

// Registrar módulo
router.use('/docentes', docenteRoutes);

// Health Check Central
router.get('/health', (req, res) => {
    res.status(200).json({
        status: 'OK',
        timestamp: new Date(),
        gateway: 'Online',
        modules: {
            docentes: 'Active (Domain-Based)'
        }
    });
});

module.exports = router;
