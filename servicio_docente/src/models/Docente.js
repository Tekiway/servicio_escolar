const mongoose = require('mongoose');

const DocenteSchema = new mongoose.Schema({
    nombre: { type: String, required: true },
    numeroEmpleado: { type: String, required: true, unique: true },
    especialidad: { type: String, required: true },
    email: { type: String, required: true },
    fechaIngreso: { type: Date, default: Date.now }
});

module.exports = mongoose.model('Docente', DocenteSchema);