require('dotenv').config();

module.exports = {
    PORT:                  process.env.PORT                  || 3000,
    DOCENTE_SERVICE_URL:   process.env.DOCENTE_SERVICE_URL   || 'http://localhost:3002',
    ALUMNO_SERVICE_URL:    process.env.ALUMNO_SERVICE_URL    || 'http://localhost:3001',
    DIRECTIVO_SERVICE_URL: process.env.DIRECTIVO_SERVICE_URL || 'http://localhost:3003',
    FINANZAS_SERVICE_URL:  process.env.FINANZAS_SERVICE_URL  || 'http://localhost:3004',
    ASPIRANTE_SERVICE_URL: process.env.ASPIRANTE_SERVICE_URL || 'http://localhost:3005',
    JWT_SECRET:            process.env.JWT_SECRET            || 'secreto'
};
