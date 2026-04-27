const mongoose = require('mongoose');

const UnidadSchema = new mongoose.Schema({
    numero: { type: Number, required: true },
    calificacion: { type: Number, default: 0 }
});

const MateriaSchema = new mongoose.Schema({
    nombre: { type: String, required: true },
    periodo: { type: String, required: true }, // Semestre, Cuatrimestre, etc.
    unidades: [UnidadSchema]
});

const AlumnoSchema = new mongoose.Schema({
    nombre: { type: String, required: true }, // Nombre real
    username: { type: String, required: true, unique: true }, // Nombre de usuario para autenticación
    matricula: { type: String, required: true, unique: true },
    email: { type: String, required: true, unique: true },
    password: { type: String, required: true },
    carrera: { type: String, required: true },
    materias: [MateriaSchema]
});

module.exports = mongoose.model('Alumno', AlumnoSchema);