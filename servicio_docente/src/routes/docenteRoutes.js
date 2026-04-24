const express = require('express');
const router = express.Router();
const ctrl = require('../controllers/docenteController');

router.post('/', ctrl.registrarDocente);
router.get('/', ctrl.obtenerTodos);
router.get('/buscar', ctrl.buscarDocentes); // Uso: /buscar?filtro=NombreOId
router.put('/:id', ctrl.editarDocente);
router.delete('/:id', ctrl.eliminarDocente);

module.exports = router;