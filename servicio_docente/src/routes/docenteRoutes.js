const express = require('express');
const router = express.Router();
const ctrl = require('../controllers/docenteController');
const jwt = require('jsonwebtoken');
const bcrypt = require('bcryptjs');
const directivoAuth = require('../middlewares/directivoAuth');

router.post('/', directivoAuth, ctrl.registrarDocente);

// Login docente
router.post('/login', directivoAuth, async (req, res) => {
	const { email, username, password } = req.body;
	try {
		if ((!email && !username) || !password) {
			return res.status(400).json({ error: 'Debes enviar usuario o email y contrasena' });
		}
		const filtros = [];
		if (email) filtros.push({ email });
		if (username) filtros.push({ username });
		const docente = await require('../models/Docente').findOne({ $or: filtros });
		if (!docente) return res.status(404).json({ error: 'Docente no encontrado' });
		const valid = await bcrypt.compare(password, docente.password);
		if (!valid) return res.status(401).json({ error: 'Contraseña incorrecta' });
		const token = jwt.sign(
			{ id: docente._id, nombre: docente.nombre, username: docente.username, numeroEmpleado: docente.numeroEmpleado, email: docente.email, rol: 'docente' },
			process.env.JWT_SECRET || 'secreto',
			{ expiresIn: '1d' }
		);
		res.json({ token, docente: { id: docente._id, nombre: docente.nombre, username: docente.username, numeroEmpleado: docente.numeroEmpleado, email: docente.email } });
	} catch (error) {
		res.status(500).json({ error: error.message });
	}
});
router.post('/tareas', require('../controllers/tareaController').crearTarea);
router.get('/tareas', require('../controllers/tareaController').obtenerTareas);

router.get('/', directivoAuth, ctrl.obtenerTodos);
router.get('/buscar', directivoAuth, ctrl.buscarDocentes); // Uso: /buscar?filtro=NombreOId
router.put('/:id', directivoAuth, ctrl.editarDocente);
router.delete('/:id', directivoAuth, ctrl.eliminarDocente);

module.exports = router;