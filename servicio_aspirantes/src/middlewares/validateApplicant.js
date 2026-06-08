module.exports = (req, res, next) => {
    const { firstName, lastName, email, phoneNumber, targetGrade } = req.body;

    if (!firstName || !lastName || !email || !phoneNumber || !targetGrade) {
        return res.status(400).json({ 
            success: false, 
            error: 'Faltan datos obligatorios para el registro del aspirante.' 
        });
    }
    next();
};