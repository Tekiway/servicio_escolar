const Tarea = require('../models/Tarea');

exports.crearTarea = async (req, res) => {
    try {
        const nuevaTarea = new Tarea(req.body);
        await nuevaTarea.save();
        res.status(201).json(nuevaTarea);
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};

exports.obtenerTareas = async (req, res) => {
    try {
        const { grupo } = req.query;
        let query = {};
        if (grupo) query.grupo = grupo;
        const tareas = await Tarea.find(query).sort({ fechaCreacion: -1 });
        res.json(tareas);
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};
