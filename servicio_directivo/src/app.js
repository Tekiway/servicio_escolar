const express = require('express');
const mongoose = require('mongoose');
const { obtenerDirectivos, obtenerDirectivoPorId, crearDirectivo, loginDirectivo } = require('./controllers/directivosControllers');

const app = express();
const PORT = process.env.PORT || 3003;
const MONGO_URI = process.env.MONGO_URI || 'mongodb://localhost:27017/directivos_db';

app.use(express.json());

// Conexión a MongoDB
mongoose.connect(MONGO_URI)
    .then(() => console.log('🍃 Conectado exitosamente a MongoDB'))
    .catch(err => console.error('❌ Error al conectar a MongoDB:', err));

// Rutas asociadas a los nuevos controladores
app.get('/api/directivos', obtenerDirectivos);
app.get('/api/directivos/:id', obtenerDirectivoPorId);
app.post('/api/directivos', crearDirectivo);
app.post('/api/directivos/login', loginDirectivo);

app.listen(PORT, () => {
    console.log(`🚀 Microservicio corriendo en http://localhost:${PORT}`);
});