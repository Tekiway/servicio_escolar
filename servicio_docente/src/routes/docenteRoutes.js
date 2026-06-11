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

// ── Actualizar Credenciales ───────────────────────────────────────────────────
router.patch('/:id/credenciales', directivoAuth, ctrl.actualizarCredenciales);

// ── Tareas ────────────────────────────────────────────────────────────────────
router.post('/tareas', require('../controllers/tareaController').crearTarea);
router.get('/tareas',  require('../controllers/tareaController').obtenerTareas);

module.exports = router;