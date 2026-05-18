require('dotenv').config();

module.exports = {
    PORT: process.env.PORT || 3000,
    DOCENTE_SERVICE_URL: process.env.DOCENTE_SERVICE_URL || 'http://localhost:3002',
    ALUMNO_SERVICE_URL: process.env.ALUMNO_SERVICE_URL || 'http://localhost:3001'
};
