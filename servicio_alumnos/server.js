require('dotenv').config();
const express = require('express');
const conectarDB = require('./src/config/db');
const alumnoRoutes = require('./src/routes/alumnoRoutes');

const app = express();

// Conectar a la base de datos
conectarDB();

// Middlewares
app.use(express.json());

// Rutas
app.use('/api/alumnos', alumnoRoutes);

const PORT = process.env.PORT || 3001;
app.listen(PORT, () => console.log(`🚀 Microservicio Alumnos en puerto ${PORT}`));