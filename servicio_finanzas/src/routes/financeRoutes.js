// routes/financeRoutes.js
const express = require('express');
const router = express.Router();
const financeController = require('../controllers/financeController');
const checkFinanceAuth = require('../middlewares/authMiddleware');

// Crear un cobro (Protegido)
router.post('/tuitions', checkFinanceAuth, financeController.createInvoice);
router.get('/tuitions', checkFinanceAuth, financeController.getAllTuitions);

// Pagar una colegiatura (Protegido)
router.patch('/tuitions/:id/pay', checkFinanceAuth, financeController.collectPayment);

// Ver estado de cuenta de un alumno (solo directivo autenticado)
router.get('/tuitions/student/:studentId', checkFinanceAuth, financeController.getStudentAccount);

module.exports = router;