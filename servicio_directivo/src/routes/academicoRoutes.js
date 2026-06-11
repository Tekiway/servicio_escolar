const express = require('express');
const router = express.Router();
const academicoController = require('../controllers/academicoController');
const directivoAuth = require('../middlewares/directivoAuth');

// Todas estas rutas son protegidas para Directivos
router.post('/grupos', directivoAuth, academicoController.crearGrupo);
router.get('/grupos', directivoAuth, academicoController.obtenerGrupos);

router.post('/horarios', directivoAuth, academicoController.asignarHorario);
router.get('/horarios/grupo/:grupoId', directivoAuth, academicoController.obtenerHorariosPorGrupo);
router.get('/horarios/docente/:docenteId', directivoAuth, academicoController.obtenerHorarioDocente);

module.exports = router;
