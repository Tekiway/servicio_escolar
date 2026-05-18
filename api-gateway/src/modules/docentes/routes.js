const express = require('express');
const router = express.Router();
const docenteProxy = require('./proxy');

// Mapeo del Proxy en el enrutador del módulo de docentes
router.use('/', docenteProxy);

module.exports = router;
