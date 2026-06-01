const express = require('express');
const router = express.Router();
const ctrl = require('../controllers/docenteController');
const jwt = require('jsonwebtoken');
const bcrypt = require('bcryptjs');

router.post('/', ctrl.registrarDocente);

// Login docente
router.post('/login', async (req, res) => {
	const { email, password } = req.body;
	try {
		const docente = await require('../models/Docente').findOne({ email });
		if (!docente) return res.status(404).json({ error: 'Docente no encontrado' });
		const valid = await bcrypt.compare(password, docente.password);
		if (!valid) return res.status(401).json({ error: 'Contraseña incorrecta' });
		const token = jwt.sign(
			{ id: docente._id, nombre: docente.nombre, numeroEmpleado: docente.numeroEmpleado, email: docente.email },
			process.env.JWT_SECRET || 'secreto',
			{ expiresIn: '1d' }
		);
		res.json({ token, docente: { id: docente._id, nombre: docente.nombre, numeroEmpleado: docente.numeroEmpleado, email: docente.email } });
	} catch (error) {
		res.status(500).json({ error: error.message });
	}
});
router.get('/', ctrl.obtenerTodos);
router.get('/buscar', ctrl.buscarDocentes); // Uso: /buscar?filtro=NombreOId
router.put('/:id', ctrl.editarDocente);
router.delete('/:id', ctrl.eliminarDocente);

module.exports = router;