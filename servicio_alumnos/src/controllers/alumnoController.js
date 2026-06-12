// Visualizar calificaciones de una materia (todas las unidades)
exports.verCalificacionesMateria = async (req, res) => {
    try {
        const alumno = await Alumno.findById(req.params.id);
        if (!alumno) {
            return res.status(404).json({ error: 'Alumno no encontrado' });
        }
        const materia = alumno.materias.find(m => m.nombre === req.params.materiaNombre);
        if (!materia) {
            return res.status(404).json({ error: 'Materia no encontrada' });
        }
        res.json(materia.unidades.map(u => ({ numero: u.numero, calificacion: u.calificacion })));
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};
const Alumno = require('../models/Alumno');

// --- ACTUALIZAR Y ELIMINAR ---
exports.actualizarAlumno = async (req, res) => {
    try {
        const { password, ...resto } = req.body;
        const alumno = await Alumno.findByIdAndUpdate(req.params.id, resto, { new: true }).select('-password');
        if (!alumno) return res.status(404).json({ error: 'Alumno no encontrado' });
        res.json(alumno);
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};

exports.eliminarAlumno = async (req, res) => {
    try {
        const alumno = await Alumno.findByIdAndDelete(req.params.id);
        if (!alumno) return res.status(404).json({ error: 'Alumno no encontrado' });
        res.json({ message: 'Alumno eliminado correctamente' });
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};

const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');
// --- AUTENTICACIÓN ---
exports.autenticarAlumno = async (req, res) => {
    const { email, username, password } = req.body;
    try {
        if ((!email && !username) || !password) {
            return res.status(400).json({ error: 'Debes enviar usuario o email y contrasena' });
        }

        const filtros = [];
        if (email) filtros.push({ email });
        if (username) filtros.push({ username });

        // Buscar por email o username
        const alumno = await Alumno.findOne({ $or: filtros });
        if (!alumno) {
            return res.status(404).json({ error: 'Alumno no encontrado' });
        }
        const passwordValida = await bcrypt.compare(password, alumno.password);
        if (!passwordValida) {
            return res.status(401).json({ error: 'Contraseña incorrecta' });
        }
        const token = jwt.sign(
            { id: alumno._id, nombre: alumno.nombre, username: alumno.username, matricula: alumno.matricula },
            process.env.JWT_SECRET || 'secreto',
            { expiresIn: '1d' }
        );
        res.json({ token, alumno: { id: alumno._id, nombre: alumno.nombre, username: alumno.username, matricula: alumno.matricula, email: alumno.email } });
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};
// --- SECCIÓN ALUMNOS ---
exports.registrarAlumno = async (req, res) => {
    try {
        const { password, username, ...resto } = req.body;
        if (!username) {
            return res.status(400).json({ error: 'El nombre de usuario es obligatorio' });
        }
        const salt = await bcrypt.genSalt(10);
        const passwordHash = await bcrypt.hash(password, salt);
        const nuevoAlumno = new Alumno({ ...resto, username, password: passwordHash });
        await nuevoAlumno.save();
        res.status(201).json(nuevoAlumno);
    } catch (error) {
        res.status(400).json({ error: error.message });
    }
};

exports.eliminarAlumno = async (req, res) => {
    try {
        await Alumno.findByIdAndDelete(req.params.id);
        res.json({ message: "Alumno eliminado" });
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};

exports.buscarAlumnos = async (req, res) => {
    const { query } = req.query; // Puede ser nombre o matricula
    try {
        const alumnos = await Alumno.find({
            $or: [
                { nombre: { $regex: query, $options: 'i' } },
                { matricula: query }
            ]
        });
        res.json(alumnos);
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};

exports.obtenerTodosSoloInfo = async (req, res) => {
    try {
        // Excluimos el campo 'materias' para solo dar info personal
        const alumnos = await Alumno.find({}, '-materias');
        res.json(alumnos);
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};

// --- SECCIÓN CARRERA ---
exports.actualizarCarrera = async (req, res) => {
    try {
        const alumno = await Alumno.findByIdAndUpdate(
            req.params.id, 
            { carrera: req.body.carrera }, 
            { new: true }
        );
        res.json(alumno);
    } catch (error) {
        res.status(400).json({ error: error.message });
    }
};

// --- RESET PASSWORD ---
exports.resetPassword = async (req, res) => {
    try {
        const alumno = await Alumno.findById(req.params.id);
        if (!alumno) return res.status(404).json({ error: 'Alumno no encontrado' });

        // Password is reset to their username (matricula) by default
        const salt = await bcrypt.genSalt(10);
        alumno.password = await bcrypt.hash(alumno.username, salt);
        await alumno.save();

        res.json({ message: 'Contraseña restablecida exitosamente a la matrícula del alumno.' });
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};

// --- EDITAR CREDENCIALES ---
exports.actualizarCredenciales = async (req, res) => {
    try {
        const alumno = await Alumno.findById(req.params.id);
        if (!alumno) return res.status(404).json({ error: 'Alumno no encontrado' });

        const { username, password } = req.body;
        if (username) alumno.username = username;
        
        if (password) {
            const salt = await bcrypt.genSalt(10);
            alumno.password = await bcrypt.hash(password, salt);
        }

        await alumno.save();
        res.json({ message: 'Credenciales actualizadas exitosamente.' });
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};

// --- SECCIÓN MATERIAS ---
exports.registrarMateria = async (req, res) => {
    const { id } = req.params;
    const { nombre, periodo, cantidadUnidades } = req.body;
    
    // Crear unidades automáticamente con valor 0
    const unidades = Array.from({ length: cantidadUnidades }, (_, i) => ({
        numero: i + 1,
        calificacion: 0
    }));

    try {
        const alumno = await Alumno.findByIdAndUpdate(
            id,
            { $push: { materias: { nombre, periodo, unidades } } },
            { new: true }
        );
        res.json(alumno);
    } catch (error) {
        res.status(400).json({ error: error.message });
    }
};

exports.eliminarMateria = async (req, res) => {
    try {
        const alumno = await Alumno.findByIdAndUpdate(
            req.params.id,
            { $pull: { materias: { nombre: req.params.materiaNombre } } },
            { new: true }
        );
        res.json(alumno);
    } catch (error) {
        res.status(400).json({ error: error.message });
    }
};

exports.verMateriasPorPeriodo = async (req, res) => {
    try {
        const alumno = await Alumno.findById(req.params.id);
        const filtradas = alumno.materias.filter(m => m.periodo === req.query.periodo);
        res.json(filtradas);
    } catch (error) {
        res.status(404).json({ message: "Alumno no encontrado" });
    }
};

// --- SECCIÓN UNIDADES ---
exports.modificarCalificacion = async (req, res) => {
    const { id, materiaNombre, numUnidad } = req.params;
    const { calificacion } = req.body;

    try {
        const alumno = await Alumno.findOneAndUpdate(
            { _id: id },
            { $set: { "materias.$[m].unidades.$[u].calificacion": calificacion } },
            { 
                arrayFilters: [
                    { "m.nombre": materiaNombre },
                    { "u.numero": parseInt(numUnidad) }
                ],
                new: true 
            }
        );
        res.json(alumno);
    } catch (error) {
        res.status(400).json({ error: error.message });
    }
};