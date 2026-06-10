// controllers/financeController.js
const financeService = require('../services/financeService');
const Tuition = require('../models/Tuition');

// Crear factura de cobro
exports.createInvoice = async (req, res) => {
    try {
        const newInvoice = await financeService.createInvoice(req.body);
        res.status(201).json(newInvoice);
    } catch (error) {
        res.status(400).json({ success: false, error: error.message });
    }
};

// Registrar un pago recibido
exports.collectPayment = async (req, res) => {
    try {
        const { id } = req.params;
        const updatedInvoice = await financeService.processPayment(id);
        res.status(200).json({ success: true, data: updatedInvoice });
    } catch (error) {
        res.status(400).json({ success: false, error: error.message });
    }
};

// Obtener estado de cuenta del alumno
exports.getStudentAccount = async (req, res) => {
    try {
        const { studentId } = req.params;
        const history = await financeService.getStudentHistory(studentId);
        res.status(200).json(history);
    } catch (error) {
        res.status(500).json({ success: false, error: error.message });
    }
};
exports.getAllTuitions = async (req, res) => {
    try {
        const tuitions = await Tuition.find().sort({ createdAt: -1 });
        res.status(200).json({ success: true, count: tuitions.length, data: tuitions });
    } catch (error) {
        res.status(500).json({ success: false, error: error.message });
    }
};
