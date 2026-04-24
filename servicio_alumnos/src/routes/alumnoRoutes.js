const express = require('express');
const router = express.Router();
const ctrl = require('../controllers/alumnoController');

// Alumnos
router.post('/', ctrl.registrarAlumno);
router.delete('/:id', ctrl.eliminarAlumno);
router.get('/buscar', ctrl.buscarAlumnos); // /buscar?query=Juan
router.get('/info-basica', ctrl.obtenerTodosSoloInfo);

// Carrera
router.patch('/:id/carrera', ctrl.actualizarCarrera);

// Materias
router.post('/:id/materias', ctrl.registrarMateria);
router.delete('/:id/materias/:materiaNombre', ctrl.eliminarMateria);
router.get('/:id/materias/periodo', ctrl.verMateriasPorPeriodo); // /periodo?periodo=2024-1

// Unidades
router.patch('/:id/materias/:materiaNombre/unidades/:numUnidad', ctrl.modificarCalificacion);

module.exports = router;