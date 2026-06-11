const express       = require('express');
const router        = express.Router();
const ctrl          = require('../controllers/docenteController');
const directivoAuth = require('../middlewares/directivoAuth');

router.post('/',          directivoAuth, ctrl.registrarDocente);
router.post('/login',                    ctrl.loginDocente);
router.get('/',           directivoAuth, ctrl.obtenerTodos);
router.get('/buscar',     directivoAuth, ctrl.buscarDocentes);
router.put('/:id',        directivoAuth, ctrl.editarDocente);
router.delete('/:id',     directivoAuth, ctrl.eliminarDocente);

// ── Reset de contraseña ───────────────────────────────────────────────────────
router.patch('/:id/reset-password', directivoAuth, ctrl.resetPassword);

// ── Tareas ────────────────────────────────────────────────────────────────────
router.post('/tareas', require('../controllers/tareaController').crearTarea);
router.get('/tareas',  require('../controllers/tareaController').obtenerTareas);

module.exports = router;