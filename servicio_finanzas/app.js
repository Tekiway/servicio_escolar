// index.js (Raíz del proyecto)
require('dotenv').config();
const nodeCrypto = require('crypto');
const express = require('express');
const connectDB = require('./src/config/db');
const financeRoutes = require('./src/routes/financeRoutes');

// Compatibilidad para entornos donde globalThis.crypto no existe
if (!globalThis.crypto) {
    globalThis.crypto = nodeCrypto.webcrypto;
}

const app = express();

// Conectar a la Base de Datos
connectDB();

// Middlewares globales
app.use(express.json());

// Montar las rutas del microservicio
app.use('/api/finance', financeRoutes);

const PORT = process.env.PORT || 3004;
app.listen(PORT, () => {
    console.log(`🚀 Microservicio de Finanzas corriendo en el puerto ${PORT}`);
});