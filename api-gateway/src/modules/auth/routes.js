const express = require('express');
const router = express.Router();

router.post('/login', (req, res) => {
    const { usuario, password } = req.body;

    // Validación mock inteligente
    const validUsers = {
        'prueba_admin': { role: 'admin', redirectUrl: '../../../../index.php' },
        'prueba_directivo': { role: 'directivo', redirectUrl: '../../../../index.php' },
        'prueba_docente': { role: 'docente', redirectUrl: '../Docente/docente.php' },
        'prueba_alumno': { role: 'alumno', redirectUrl: '../alumnos/alumnos.php' }
    };
    const userKey = (usuario || '').trim().toLowerCase();
    const pwd = (password || '').trim();
    const portal = req.body.portal || 'personal';

    // Lógica para usuario único 'prueba' y clave 'prueba1'
    if (userKey === 'prueba' && pwd === 'prueba1') {
        let redirect = '../../../../index.php'; // Por defecto Admin
        if (portal === 'estudiante') {
            redirect = '../alumnos/alumnos.php'; // Por defecto Alumno
        }
        res.status(200).json({
            status: 'success',
            data: { role: 'prueba', redirectUrl: redirect }
        });
    } else if (validUsers[userKey] && pwd === 'prueba1') {
        res.status(200).json({
            status: 'success',
            data: validUsers[userKey]
        });
    } else {
        res.status(401).json({
            status: 'error',
            message: "Usuario o contraseña incorrectos. Usa usuario 'prueba' y la clave 'prueba1'."
        });
    }
});

module.exports = router;
