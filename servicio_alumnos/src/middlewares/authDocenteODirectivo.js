const jwt = require('jsonwebtoken');

module.exports = function (req, res, next) {
    const authHeader = req.headers['authorization'];
    const token = authHeader && authHeader.split(' ')[1];

    if (!token) {
        return res.status(401).json({ error: 'Token no proporcionado' });
    }

    try {
        const decoded = jwt.verify(token, process.env.JWT_SECRET || 'secreto');

        // Compatibilidad: tokens antiguos de docente no traen rol,
        // pero sí incluyen numeroEmpleado.
        const esDocente = decoded.rol === 'docente' || Boolean(decoded.numeroEmpleado);
        const esDirectivo = decoded.rol === 'directivo';

        if (!esDocente && !esDirectivo) {
            return res.status(403).json({ error: 'Acceso denegado: solo docente o directivo' });
        }

        req.user = decoded;
        next();
    } catch (err) {
        return res.status(403).json({ error: 'Token inválido' });
    }
};
