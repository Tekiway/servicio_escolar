require('dotenv').config();
const nodeCrypto = require('crypto');
const express = require('express');
const connectDB = require('./src/config/db');
const applicantRoutes = require('./src/routes/applicantRoutes');

if (!globalThis.crypto) {
    globalThis.crypto = nodeCrypto.webcrypto;
}

const app = express();
app.use(express.json());

// Conectar a la base de datos
connectDB();

// Rutas mundiales del microservicio
app.use('/api/aspirantes', applicantRoutes);

const PORT = process.env.PORT || 3005;
app.listen(PORT, () => {
    console.log(`🚀 Microservicio de Aspirantes activo en el puerto ${PORT}`);
});