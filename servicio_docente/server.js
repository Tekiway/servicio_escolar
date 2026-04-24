require('dotenv').config();
const express = require('express');
const mongoose = require('mongoose');
const docenteRoutes = require('./src/routes/docenteRoutes');

const app = express();

// 1. Middlewares iniciales
app.use(express.json());

// 2. Conexión a MongoDB
// Usamos la variable de entorno MONGO_URI definida en docker-compose
mongoose.connect(process.env.MONGO_URI)
    .then(() => console.log('✅ Conectado a MongoDB (Servicio Docentes)'))
    .catch(err => console.error('❌ Error de conexión:', err));

// 3. Rutas
app.use('/api/docentes', docenteRoutes);

// 4. Encendido del servidor
const PORT = process.env.PORT || 3002;
app.listen(PORT, () => {
    console.log(`🚀 Microservicio Docentes ejecutándose en el puerto ${PORT}`);
});