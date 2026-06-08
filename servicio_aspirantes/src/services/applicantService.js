const Applicant = require('../models/Applicant');
const axios = require('axios');

const alumnosUrl = process.env.ALUMNOS_URL || 'http://localhost:3001';

function buildApplicantPayload(applicant, carrera) {
    const baseUsername = `${applicant.email.split('@')[0]}`.toLowerCase().replace(/[^a-z0-9._-]/g, '');
    const suffix = applicant._id.toString().slice(-5);
    const username = `${baseUsername}_${suffix}`;
    const matricula = `ASP-${applicant._id.toString().slice(-8).toUpperCase()}`;
    const password = `ASP-${applicant._id.toString().slice(-8)}`;

    return {
        username,
        matricula,
        password,
        nombre: `${applicant.firstName} ${applicant.lastName}`.trim(),
        email: applicant.email,
        carrera,
    };
}

class ApplicantService {
    async registerApplicant(applicantData) {
        const existing = await Applicant.findOne({ email: applicantData.email });
        if (existing) throw new Error('El correo electrónico ya está registrado');

        const newApplicant = new Applicant(applicantData);
        return await newApplicant.save();
    }

    async evaluateExam(id, score) {
        const applicant = await Applicant.findById(id);
        if (!applicant) throw new Error('Aspirante no encontrado');

        applicant.testScore = score;
        applicant.status = score >= 70 ? 'APROBADO' : 'RECHAZADO';

        return await applicant.save();
    }

    async acceptApplicant(id, acceptedBy, carrera) {
        const applicant = await Applicant.findById(id);
        if (!applicant) throw new Error('Aspirante no encontrado');

        if (applicant.status === 'TRANSFERIDO' && applicant.studentId) {
            return applicant;
        }

        const payload = buildApplicantPayload(applicant, carrera || applicant.targetGrade);

        try {
            const response = await axios.post(`${alumnosUrl}/api/alumnos`, payload, {
                headers: { 'Content-Type': 'application/json' },
            });

            applicant.status = 'TRANSFERIDO';
            applicant.acceptedAt = new Date();
            applicant.acceptedBy = acceptedBy || null;
            applicant.studentId = response.data?._id || response.data?.id || null;
            applicant.studentUsername = payload.username;
            applicant.studentMatricula = payload.matricula;
            applicant.transferPassword = payload.password;

            return await applicant.save();
        } catch (error) {
            const message = error.response?.data?.error || error.message || 'No se pudo transferir el aspirante a alumnos';
            throw new Error(message);
        }
    }

    async getApplicants(status) {
        const query = status ? { status } : {};
        return await Applicant.find(query).sort({ createdAt: -1 });
    }

    async getPendingApplicants() {
        return await Applicant.find({ status: 'REGISTRADO' }).sort({ createdAt: -1 });
    }

    async getAcceptedApplicants() {
        return await Applicant.find({ status: { $in: ['ACEPTADO', 'TRANSFERIDO'] } }).sort({ createdAt: -1 });
    }
}

module.exports = new ApplicantService();