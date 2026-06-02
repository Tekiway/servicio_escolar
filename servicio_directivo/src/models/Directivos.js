const mongoose = require('mongoose');

const DirectivoSchema = new mongoose.Schema({
    nombre: {
        type: String,
        required: [true, 'El nombre es obligatorio'],
        trim: true
    },
    apellidoPaterno: {
        type: String,
        required: [true, 'El apellido paterno es obligatorio'],
        trim: true
    },
    apellidoMaterno: {
        type: String,
        default: '',
        trim: true
    },
    username: {
        type: String,
        unique: true,
        sparse: true,
        lowercase: true,
        trim: true
    },
    email: {
        type: String,
        required: [true, 'El email es obligatorio'],
        unique: true,
        lowercase: true,
        trim: true
    },
    password: {
        type: String,
        required: [true, 'La contrasena es obligatoria'],
        select: false
    },
    numeroEmpleado: {
        type: String,
        required: [true, 'El numero de empleado es obligatorio'],
        unique: true,
        trim: true
    },
    telefono: {
        type: String,
        required: [true, 'El telefono es obligatorio'],
        trim: true
    },
    cargo: {
        type: String,
        required: [true, 'El cargo es obligatorio'],
        trim: true
    },
    area: {
        type: String,
        required: [true, 'El area es obligatoria'],
        enum: [
            'Recursos Humanos',
            'Control Escolar',
            'Secretaria Academica',
            'Secretaria Administrativa',
            'Direccion',
            'Subdireccion',
            'Servicios Escolares',
            'Finanzas',
            'Tecnologias'
        ]
    },
    departamento: {
        type: String,
        default: 'General'
    },
    tipoContrato: {
        type: String,
        enum: ['Base', 'Confianza', 'Honorarios', 'Temporal'],
        default: 'Confianza'
    },
    turno: {
        type: String,
        enum: ['Matutino', 'Vespertino', 'Mixto'],
        default: 'Mixto'
    },
    fechaIngreso: {
        type: Date,
        required: [true, 'La fecha de ingreso es obligatoria']
    },
    estatus: {
        type: String,
        enum: ['Activo', 'Inactivo', 'Suspendido'],
        default: 'Activo'
    },
    permisos: {
        gestionarAlumnos: { type: Boolean, default: true },
        gestionarDocentes: { type: Boolean, default: true },
        generarReportes: { type: Boolean, default: true },
        administrarUsuarios: { type: Boolean, default: false }
    }
}, {
    timestamps: true 
});

// El modelo se llamará 'Directivo' pero Mongoose creará la colección como 'directivos'
module.exports = mongoose.model('Directivo', DirectivoSchema);