const express = require('express');
const router = express.Router();
const ctrl = require('../controllers/alumnoController');
const auth = require('../middlewares/auth');
const authDocenteODirectivo = require('../middlewares/authDocenteODirectivo');

// 
// Obtener mapa curricular del alumno
router.get('/:id/mapa-curricular', async (req, res) => {
	const Alumno = require('../models/Alumno');
	try {
		const alumno = await Alumno.findById(req.params.id);
		if (!alumno) return res.status(404).json({ error: 'Alumno no encontrado' });

		// Construir mapa curricular solo con las materias inscritas hasta ahora
		const mapa = alumno.materias.map(m => ({
			nombre: m.nombre,
			periodo: m.periodo,
			unidades: m.unidades,
			estado: m.unidades.every(u => u.calificacion >= 6) ? 'Aprobada' : 'Inscrita'
		}));

		res.json({ carrera: alumno.carrera, materias: mapa });
	} catch (error) {
		res.status(500).json({ error: error.message });
	}
});

// Registro de alumno (solo para uso interno desde el microservicio de docente)
router.post('/', ctrl.registrarAlumno);
// Solo login es público
router.post('/login', ctrl.autenticarAlumno);

// Visualizacion y modificaciones de alumnos para docente/directivo autenticado
router.get('/solo-info', authDocenteODirectivo, ctrl.obtenerTodosSoloInfo);
router.get('/buscar', authDocenteODirectivo, ctrl.buscarAlumnos);
router.put('/:id/carrera', authDocenteODirectivo, ctrl.actualizarCarrera);
router.post('/:id/materias', authDocenteODirectivo, ctrl.registrarMateria);
router.get('/:id/materias/:materiaNombre/calificaciones', authDocenteODirectivo, ctrl.verCalificacionesMateria);

router.get('/:id/materias', authDocenteODirectivo, async (req, res) => {
	try {
		const alumno = await require('../models/Alumno').findById(req.params.id);
		if (!alumno) return res.status(404).json({ error: 'Alumno no encontrado' });

		if (req.query.periodo) {
			return res.json(alumno.materias.filter(m => m.periodo === req.query.periodo));
		}

		res.json(alumno.materias);
	} catch (error) {
		res.status(500).json({ error: error.message });
	}
});

// Modificación de calificaciones (solo docente/directivo autenticado)
router.patch('/:id/materias/:materiaNombre/unidades/:numUnidad', authDocenteODirectivo, ctrl.modificarCalificacion);

// Solo visualización para alumno autenticado

router.put('/mi-info', auth, async (req, res) => {
	try {
		const alumno = await require('../models/Alumno').findById(req.user.id);
		if (!alumno) return res.status(404).json({ error: 'Alumno no encontrado' });

        const { nombre, username, email, carrera } = req.body;
        if(nombre) alumno.nombre = nombre;
        if(username) alumno.username = username;
        if(email) alumno.email = email;
        if(carrera) alumno.carrera = carrera;

        await alumno.save();
		res.json({ message: 'Perfil actualizado con éxito', alumno });
	} catch (error) {
		res.status(500).json({ error: error.message });
	}
});

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