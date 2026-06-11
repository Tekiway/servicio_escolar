const mongoose = require('mongoose');

const DocenteSchema = new mongoose.Schema({
    // ── Identidad ──────────────────────────────────────
    nombre:          { type: String, required: true, trim: true },
    apellidoPaterno: { type: String, required: true, trim: true },
    apellidoMaterno: { type: String, trim: true, default: '' },

    // ── Acceso al sistema ──────────────────────────────
    username: { type: String, unique: true, sparse: true, lowercase: true, trim: true },
    email:    { type: String, required: true, unique: true, lowercase: true, trim: true },
    password: { type: String, required: true, select: false },

    // ── Datos institucionales ──────────────────────────
    numeroEmpleado:  { type: String, required: true, unique: true, trim: true },
    especialidad:    { type: String, required: true, trim: true },
    formacionProfesional: { type: String, trim: true, default: '' }, // Ej: Ingeniero en Sistemas, Contador Público
    carrera:         { type: String, trim: true },
    gradoAcademico:  {
        type: String,
        enum: ['Técnico Superior', 'Licenciatura', 'Maestría', 'Doctorado', 'Otro'],
        default: 'Licenciatura'
    },

    // ── Contratación ───────────────────────────────────
    tipoContrato: {
        type: String,
        enum: ['Tiempo Completo', 'Medio Tiempo', 'Por Horas', 'Honorarios'],
        default: 'Tiempo Completo'
    },
    turno: {
        type: String,
        enum: ['Matutino', 'Vespertino', 'Nocturno', 'Mixto'],
        default: 'Matutino'
    },
    telefono:     { type: String, trim: true, default: '' },
    fechaIngreso: { type: Date, default: Date.now },

    // ── Estatus ────────────────────────────────────────
    estatus: {
        type: String,
        enum: ['Activo', 'Inactivo', 'Baja Temporal'],
        default: 'Activo'
    }
}, { timestamps: true });

module.exports = mongoose.model('Docente', DocenteSchema);
