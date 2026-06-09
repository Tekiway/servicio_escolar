const express = require('express');
const router = express.Router();
const applicantController = require('../controllers/applicantController');
const validateApplicant = require('../middlewares/validateApplicant');
const directivoAuth = require('../middlewares/directivoAuth');

router.post('/register', validateApplicant, applicantController.createApplicant);
router.patch('/:id/exam', directivoAuth, applicantController.submitExam);
router.get('/', directivoAuth, applicantController.listApplicants);
router.get('/pendientes', directivoAuth, applicantController.listPendingApplicants);
router.get('/aceptados', directivoAuth, applicantController.listAcceptedApplicants);
router.patch('/:id/accept', directivoAuth, applicantController.acceptApplicant);

module.exports = router;