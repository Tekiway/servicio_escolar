const jwt = require('jsonwebtoken');

module.exports = function (req, res, next) {
    const authHeader = req.headers['authorization'];
    const token = authHeader && authHeader.split(' ')[1];

    if (!token) {
        return res.status(401).json({ error: 'Token no proporcionado' });
    }

    try {
        const decoded = jwt.verify(token, process.env.JWT_SECRET || 'secreto');

        if (decoded.rol !== 'directivo') {
            return res.status(403).json({ error: 'Acceso denegado: solo directivo autenticado' });
        }

        req.user = decoded;
        next();
    } catch (err) {
        return res.status(403).json({ error: 'Token invalido' });
    }
};
