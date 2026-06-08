const mongoose = require('mongoose');

const ApplicantSchema = new mongoose.Schema({
    firstName: { type: String, required: true, trim: true },
    lastName: { type: String, required: true, trim: true },
    email: { type: String, required: true, unique: true, lowercase: true },
    phoneNumber: { type: String, required: true },
    targetGrade: { type: String, required: true },
    status: { 
        type: String, 
        enum: ['REGISTRADO', 'APROBADO', 'RECHAZADO', 'ACEPTADO', 'TRANSFERIDO'], 
        default: 'REGISTRADO' 
    },
    testScore: { type: Number, default: null }
    ,acceptedAt: { type: Date, default: null },
    acceptedBy: { type: String, default: null },
    studentId: { type: String, default: null },
    studentUsername: { type: String, default: null },
    studentMatricula: { type: String, default: null },
    transferPassword: { type: String, default: null }
}, { timestamps: true });

module.exports = mongoose.model('Applicant', ApplicantSchema);