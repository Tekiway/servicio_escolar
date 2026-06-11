const mongoose = require('mongoose');

const HorarioSchema = new mongoose.Schema({
    grupo: { type: mongoose.Schema.Types.ObjectId, ref: 'Grupo', required: true },
    materiaNombre: { type: String, required: true }, // Lo vinculamos por nombre de materia para simplicidad inter-servicio
    docenteId: { type: String, required: true }, // ID del docente en servicio_docentes
    docenteNombre: { type: String, required: true },
    sesiones: [{
        dia: { type: String, enum: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'], required: true },
        horaInicio: { type: String, required: true }, // Formato "08:00"
        horaFin: { type: String, required: true },    // Formato "10:00"
        aula: { type: String, required: true },       // Ej. "Edificio A - 101"
        tipo: { type: String, enum: ['Teoría', 'Práctica', 'Laboratorio'], default: 'Teoría' }
    }]
}, { timestamps: true });

module.exports = mongoose.model('Horario', HorarioSchema);
