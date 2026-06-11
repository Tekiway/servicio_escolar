const mongoose = require('mongoose');

const GrupoSchema = new mongoose.Schema({
    nombre: { type: String, required: true }, // Ej. "1A"
    carrera: { type: String, required: true }, // Ej. "Ing. en TICs"
    cicloEscolar: { type: String, required: true }, // Ej. "2026-1"
    semestre: { type: String, required: true }, // Ej. "1ro"
    turno: { type: String, required: true }, // Ej. "Matutino"
    modalidad: { type: String, required: true }, // Ej. "Escolarizada"
    capacidad: { type: Number, required: true, default: 30 },
    estatus: { type: String, enum: ['Activo', 'Inactivo'], default: 'Activo' }
}, { timestamps: true });

// Índice compuesto para que no existan dos "1A" de la misma carrera en el mismo ciclo
GrupoSchema.index({ nombre: 1, carrera: 1, cicloEscolar: 1 }, { unique: true });

module.exports = mongoose.model('Grupo', GrupoSchema);
