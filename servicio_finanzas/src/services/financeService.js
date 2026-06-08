// services/financeService.js
const Tuition = require('../models/Tuition');

class FinanceService {
    // Registrar una nueva colegiatura por cobrar
    async createInvoice(data) {
        const invoice = new Tuition(data);
        return await invoice.save();
    }

    // Registrar el pago de una colegiatura
    async processPayment(id) {
        const invoice = await Tuition.findById(id);
        if (!invoice) throw new Error('La factura de colegiatura no existe');
        if (invoice.status === 'PAGADO') throw new Error('Esta colegiatura ya fue pagada');

        invoice.status = 'PAGADO';
        invoice.paymentDate = new Date();
        return await invoice.save();
    }

    // Obtener el historial financiero de un estudiante en específico
    async getStudentHistory(studentId) {
        return await Tuition.find({ studentId }).sort({ dueDate: -1 });
    }
}

module.exports = new FinanceService();