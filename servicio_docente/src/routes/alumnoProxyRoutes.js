const express = require('express');
const router = express.Router();
const axios = require('axios');
const docenteAuth = require('../middlewares/docenteAuth'); // Middleware de autenticación docente

// URL base del microservicio de alumnos (ajusta el puerto si es necesario)
const ALUMNOS_URL = process.env.ALUMNOS_URL || 'http://servicio_alumnos:3000';

// Modificar calificación de una unidad de un alumno
router.patch('/alumnos/:id/materias/:materiaNombre/unidades/:numUnidad', docenteAuth, async (req, res) => {
  try {
    const response = await axios.patch(
      `${ALUMNOS_URL}/api/alumnos/${req.params.id}/materias/${req.params.materiaNombre}/unidades/${req.params.numUnidad}`,
      req.body
    );
    res.status(response.status).json(response.data);
  } catch (error) {
    res.status(error.response?.status || 500).json({ error: error.message });
  }
});

// Obtener todos los alumnos (solo info personal)
router.get('/alumnos', docenteAuth, async (req, res) => {
  try {
    const response = await axios.get(`${ALUMNOS_URL}/api/alumnos/solo-info`);
    res.json(response.data);
  } catch (error) {
    res.status(error.response?.status || 500).json({ error: error.message });
  }
});

// Buscar alumnos
router.get('/alumnos/buscar', docenteAuth, async (req, res) => {
  try {
    const response = await axios.get(`${ALUMNOS_URL}/api/alumnos/buscar`, { params: req.query });
    res.json(response.data);
  } catch (error) {
    res.status(error.response?.status || 500).json({ error: error.message });
  }
});

// Ver materias de un alumno por periodo
router.get('/alumnos/:id/materias', docenteAuth, async (req, res) => {
  try {
    const response = await axios.get(`${ALUMNOS_URL}/api/alumnos/${req.params.id}/materias`, { params: req.query });
    res.json(response.data);
  } catch (error) {
    res.status(error.response?.status || 500).json({ error: error.message });
  }
});

// Ver calificaciones de una materia de un alumno
router.get('/alumnos/:id/materias/:materiaNombre/calificaciones', docenteAuth, async (req, res) => {
  try {
    const response = await axios.get(`${ALUMNOS_URL}/api/alumnos/${req.params.id}/materias/${req.params.materiaNombre}/calificaciones`);
    res.json(response.data);
  } catch (error) {
    res.status(error.response?.status || 500).json({ error: error.message });
  }
});

// Registrar alumno (proxy)
router.post('/alumnos', docenteAuth, async (req, res) => {
  try {
    const response = await axios.post(`${ALUMNOS_URL}/api/alumnos`, req.body);
    res.status(response.status).json(response.data);
  } catch (error) {
    res.status(error.response?.status || 500).json({ error: error.message });
  }
});

// Actualizar carrera de un alumno
router.put('/alumnos/:id/carrera', docenteAuth, async (req, res) => {
  try {
    const response = await axios.put(`${ALUMNOS_URL}/alumnos/${req.params.id}/carrera`, req.body);
    res.json(response.data);
  } catch (error) {
    res.status(error.response?.status || 500).json({ error: error.message });
  }
});

// Registrar materia a un alumno
router.post('/alumnos/:id/materias', docenteAuth, async (req, res) => {
  try {
    const response = await axios.post(`${ALUMNOS_URL}/alumnos/${req.params.id}/materias`, req.body);
    res.status(response.status).json(response.data);
  } catch (error) {
    res.status(error.response?.status || 500).json({ error: error.message });
  }
});

// Actualizar información de una materia (si aplica)
// Puedes agregar más rutas según las funciones permitidas

module.exports = router;
