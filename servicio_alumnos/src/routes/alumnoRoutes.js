const express = require('express');
const router = express.Router();
const ctrl = require('../controllers/alumnoController');
const auth = require('../middlewares/auth');

// Alumnos
router.post('/', ctrl.registrarAlumno);
router.post('/login', ctrl.autenticarAlumno);
router.delete('/:id', ctrl.eliminarAlumno);
router.get('/buscar', auth, ctrl.buscarAlumnos); // /buscar?query=Juan
router.get('/info-basica', auth, ctrl.obtenerTodosSoloInfo);

// Carrera
router.patch('/:id/carrera', ctrl.actualizarCarrera);

// Materias
router.post('/:id/materias', ctrl.registrarMateria);
router.delete('/:id/materias/:materiaNombre', ctrl.eliminarMateria);
router.get('/:id/materias/periodo', auth, ctrl.verMateriasPorPeriodo); // /periodo?periodo=2024-1

// Unidades
router.patch('/:id/materias/:materiaNombre/unidades/:numUnidad', ctrl.modificarCalificacion);
// Visualizar calificaciones de una materia (todas las unidades)
router.get('/:id/materias/:materiaNombre/calificaciones', auth, ctrl.verCalificacionesMateria);

module.exports = router;