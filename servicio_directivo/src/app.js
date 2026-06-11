const express = require('express');
const mongoose = require('mongoose');
const nodeCrypto = require('crypto');
const { obtenerDirectivos, obtenerDirectivoPorId, crearDirectivo, loginDirectivo } = require('./controllers/directivosControllers');
const directivoAuth = require('./middlewares/directivoAuth');

// Compatibilidad para entornos donde globalThis.crypto no existe
if (!globalThis.crypto) {
    globalThis.crypto = nodeCrypto.webcrypto;
}

const app = express();
const PORT = process.env.PORT || 3003;
const MONGO_URI = process.env.MONGO_URI || 'mongodb://localhost:27017/directivos_db';

app.use(express.json());

// Conexión a MongoDB
mongoose.connect(MONGO_URI)
    .then(() => console.log('🍃 Conectado exitosamente a MongoDB'))
    .catch(err => console.error('❌ Error al conectar a MongoDB:', err));

// Rutas asociadas a los nuevos controladores
app.post('/api/directivos/login', loginDirectivo);
app.get('/api/directivos', directivoAuth, obtenerDirectivos);
app.get('/api/directivos/:id', directivoAuth, obtenerDirectivoPorId);
app.post('/api/directivos', directivoAuth, crearDirectivo);
app.put('/api/directivos/:id', directivoAuth, require('./controllers/directivosControllers').actualizarDirectivo);
app.delete('/api/directivos/:id', directivoAuth, require('./controllers/directivosControllers').eliminarDirectivo);
app.patch('/api/directivos/:id/credenciales', directivoAuth, require('./controllers/directivosControllers').actualizarCredenciales);

const academicoRoutes = require('./routes/academicoRoutes');
app.use('/api/academico', academicoRoutes);

app.listen(PORT, () => {
    console.log(`🚀 Microservicio corriendo en http://localhost:${PORT}`);
});