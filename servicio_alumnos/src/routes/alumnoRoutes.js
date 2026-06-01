const express = require('express');
const router = express.Router();
const ctrl = require('../controllers/alumnoController');
const auth = require('../middlewares/auth');

// Alumnos



// Registro de alumno (solo para uso interno desde el microservicio de docente)
router.post('/', ctrl.registrarAlumno);
// Solo login es público
router.post('/login', ctrl.autenticarAlumno);

// Solo visualización para alumno autenticado
router.get('/mi-info', auth, async (req, res) => {
	try {
		const alumno = await require('../models/Alumno').findById(req.user.id, '-password');
		if (!alumno) return res.status(404).json({ error: 'Alumno no encontrado' });
		res.json(alumno);
	} catch (error) {
		res.status(500).json({ error: error.message });
	}
});

router.get('/mis-materias', auth, async (req, res) => {
	try {
		const alumno = await require('../models/Alumno').findById(req.user.id);
		if (!alumno) return res.status(404).json({ error: 'Alumno no encontrado' });
		res.json(alumno.materias);
	} catch (error) {
		res.status(500).json({ error: error.message });
	}
});

router.get('/mis-materias/:materiaNombre/calificaciones', auth, async (req, res) => {
	try {
		const alumno = await require('../models/Alumno').findById(req.user.id);
		if (!alumno) return res.status(404).json({ error: 'Alumno no encontrado' });
		const materia = alumno.materias.find(m => m.nombre === req.params.materiaNombre);
		if (!materia) return res.status(404).json({ error: 'Materia no encontrada' });
		res.json(materia.unidades.map(u => ({ numero: u.numero, calificacion: u.calificacion })));
	} catch (error) {
		res.status(500).json({ error: error.message });
	}
});

module.exports = router;