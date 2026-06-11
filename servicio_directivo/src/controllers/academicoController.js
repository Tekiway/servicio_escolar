const Grupo = require('../models/Grupo');
const Horario = require('../models/Horario');

exports.crearGrupo = async (req, res) => {
    try {
        const nuevoGrupo = new Grupo(req.body);
        await nuevoGrupo.save();
        res.status(201).json(nuevoGrupo);
    } catch (error) {
        if (error.code === 11000) return res.status(400).json({ error: 'Ya existe un grupo con ese nombre en este ciclo y carrera.' });
        res.status(500).json({ error: error.message });
    }
};

exports.obtenerGrupos = async (req, res) => {
    try {
        const grupos = await Grupo.find().sort({ cicloEscolar: -1, nombre: 1 });
        res.json(grupos);
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};

exports.asignarHorario = async (req, res) => {
    try {
        const horario = new Horario(req.body);
        await horario.save();
        res.status(201).json(horario);
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};

exports.obtenerHorariosPorGrupo = async (req, res) => {
    try {
        const horarios = await Horario.find({ grupo: req.params.grupoId }).populate('grupo');
        res.json(horarios);
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};

exports.obtenerHorarioDocente = async (req, res) => {
    try {
        const horarios = await Horario.find({ docenteId: req.params.docenteId }).populate('grupo');
        res.json(horarios);
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};
