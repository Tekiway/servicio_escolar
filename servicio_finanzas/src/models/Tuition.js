// models/Tuition.js
const mongoose = require('mongoose');

const TuitionSchema = new mongoose.Schema({
    studentId: { type: String, required: true }, // ID del estudiante (puede venir de otro microservicio)
    studentName: { type: String, required: true },
    grade: { type: String, required: true },       // Grado/Año escolar
    amount: { type: Number, required: true },      // Monto a pagar
    status: { 
        type: String, 
        enum: ['PENDIENTE', 'PAGADO', 'ATRASADO'], 
        default: 'PENDIENTE' 
    },
    dueDate: { type: Date, required: true },       // Fecha límite de pago
    paymentDate: { type: Date }                    // Fecha en la que realmente pagó
}, { timestamps: true });

module.exports = mongoose.model('Tuition', TuitionSchema);