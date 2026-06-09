const mongoose = require('mongoose');

const TuitionSchema = new mongoose.Schema({
    studentId: { type: String }, 
    matricula: { type: String, required: true },
    studentName: { type: String, required: true },
    carrera: { type: String, required: true },
    grade: { type: String },       
    mes: { type: String, required: true },
    amount: { type: Number, required: true },      
    status: { 
        type: String, 
        enum: ['Pendiente', 'Pagado', 'Atrasado', 'PENDIENTE', 'PAGADO', 'ATRASADO'], 
        default: 'Pendiente' 
    },
    dueDate: { type: Date },       
    paymentDate: { type: Date }                    
}, { timestamps: true });

module.exports = mongoose.model('Tuition', TuitionSchema);