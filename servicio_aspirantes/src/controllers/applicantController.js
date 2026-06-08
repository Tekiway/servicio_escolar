const applicantService = require('../services/applicantService');

exports.createApplicant = async (req, res) => {
    try {
        const applicant = await applicantService.registerApplicant(req.body);
        res.status(201).json({ success: true, data: applicant });
    } catch (error) {
        res.status(400).json({ success: false, error: error.message });
    }
};

exports.submitExam = async (req, res) => {
    try {
        const { id } = req.params;
        const { score } = req.body;

        if (score === undefined || score < 0 || score > 100) {
            return res.status(400).json({ success: false, error: 'La puntuación debe estar entre 0 y 100' });
        }

        const updated = await applicantService.evaluateExam(id, score);
        res.status(200).json({ success: true, data: updated });
    } catch (error) {
        res.status(400).json({ success: false, error: error.message });
    }
};

exports.listApplicants = async (req, res) => {
    try {
        const { status } = req.query;
        const list = await applicantService.getApplicants(status);
        res.status(200).json({ success: true, count: list.length, data: list });
    } catch (error) {
        res.status(500).json({ success: false, error: error.message });
    }
};

exports.listPendingApplicants = async (req, res) => {
    try {
        const list = await applicantService.getPendingApplicants();
        res.status(200).json({ success: true, count: list.length, data: list });
    } catch (error) {
        res.status(500).json({ success: false, error: error.message });
    }
};

exports.listAcceptedApplicants = async (req, res) => {
    try {
        const list = await applicantService.getAcceptedApplicants();
        res.status(200).json({ success: true, count: list.length, data: list });
    } catch (error) {
        res.status(500).json({ success: false, error: error.message });
    }
};

exports.acceptApplicant = async (req, res) => {
    try {
        const { id } = req.params;
        const { carrera } = req.body;
        const acceptedBy = req.user?.username || req.user?.email || req.user?.id || null;

        const updated = await applicantService.acceptApplicant(id, acceptedBy, carrera);
        res.status(200).json({ success: true, data: updated });
    } catch (error) {
        res.status(400).json({ success: false, error: error.message });
    }
};