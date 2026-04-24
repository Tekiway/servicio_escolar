const Docente = require('../models/Docente');

// Registrar un nuevo docente
exports.registrarDocente = async (req, res) => {
    try {
        const nuevoDocente = new Docente(req.body);
        await nuevoDocente.save();
        res.status(201).json(nuevoDocente);
    } catch (error) {
        res.status(400).json({ error: error.message });
    }
};

// Eliminar un docente
exports.eliminarDocente = async (req, res) => {
    try {
        const docente = await Docente.findByIdAndDelete(req.params.id);
        if (!docente) return res.status(404).json({ message: "Docente no encontrado" });
        res.json({ message: "Docente eliminado correctamente" });
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};

// Editar información del docente
exports.editarDocente = async (req, res) => {
    try {
        const docenteActualizado = await Docente.findByIdAndUpdate(
            req.params.id, 
            req.body, 
            { new: true, runValidators: true }
        );
        if (!docenteActualizado) return res.status(404).json({ message: "Docente no encontrado" });
        res.json(docenteActualizado);
    } catch (error) {
        res.status(400).json({ error: error.message });
    }
};

// Buscar docentes por nombre o número de empleado
exports.buscarDocentes = async (req, res) => {
    const { filtro } = req.query; // Ejemplo: /buscar?filtro=12345
    try {
        const docentes = await Docente.find({
            $or: [
                { nombre: { $regex: filtro, $options: 'i' } },
                { numeroEmpleado: filtro }
            ]
        });
        res.json(docentes);
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};

// Obtener todos (Auxiliar para pruebas)
exports.obtenerTodos = async (req, res) => {
    try {
        const docentes = await Docente.find();
        res.json(docentes);
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};