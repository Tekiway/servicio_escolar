const Alumno = require('../models/Alumno');

// --- SECCIÓN ALUMNOS ---
exports.registrarAlumno = async (req, res) => {
    try {
        const nuevoAlumno = new Alumno(req.body);
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