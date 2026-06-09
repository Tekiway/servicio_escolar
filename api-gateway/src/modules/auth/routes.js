const express = require('express');
const router = express.Router();

router.post('/login', (req, res) => {
    const { usuario, password } = req.body;
    const userKey = (usuario || '').trim().toLowerCase();
    const pwd = (password || '').trim();

    // Mapeo centralizado: el nombre de usuario dicta a qué módulo debe ir
    const routesMap = {
        'admin': '../../../../index.php',
        'directivo': '../../../../index.php',
        'finanzas': '../Finanzas/finanzas.php',
        'docente': '../Docente/docente.php',
        'rrhh': '../../../../index.php', 
        'alumno': '../alumnos/alumnos.php',
        'aspirante': '../Aspirantes/aspirantes.php'
    };

    // Requisito: Contraseña "prueba1" para todos, y el usuario debe existir en el mapa
    if (!routesMap[userKey] || pwd !== 'prueba1') {
        return res.status(401).json({
            status: 'error',
            message: "Credenciales incorrectas. Usa tu área como usuario (ej. 'docente', 'finanzas') y la clave 'prueba1'."
        });
    }

    const redirectUrl = routesMap[userKey];
    const fakeToken = "mock_jwt_token_" + Buffer.from(userKey).toString('base64');

    res.status(200).json({
        status: 'success',
        data: {
            token: fakeToken,
            role: userKey,
            redirectUrl: redirectUrl
        }
    });
});

module.exports = router;
