const mongoose = require('mongoose');

const TareaSchema = new mongoose.Schema({
    titulo: { type: String, required: true },
    grupo: { type: String, required: true },
    puntos: { type: Number, default: 10 },
    fecha: { type: Date, required: true },
    instrucciones: { type: String },
    entregas: { type: Number, default: 0 },
    total: { type: Number, default: 0 },
    fechaCreacion: { type: Date, default: Date.now }
});

module.exports = mongoose.model('Tarea', TareaSchema);
