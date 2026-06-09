const express = require('express');
const router  = express.Router();
const fs = require('fs');
const path = require('path');

const DATA_FILE = path.join(__dirname, 'materias.json');

// Inicializar archivo si no existe
if (!fs.existsSync(DATA_FILE)) {
    const defaultData = [
        {
            _id: 'mat-001',
            clave: 'AED-1285',
            nombre: 'Estructura de Datos',
            carrera: 'TICs',
            semestre: '2',
            creditos: 5,
            descripcion: 'Fundamentos teóricos y prácticos de estructuras de datos.',
            horas_teoricas: 2,
            horas_practicas: 3,
            total_horas: 5,
            clasificacion_academica: 'Ciencias Básicas',
            area_conocimiento: 'Programación',
            modalidad: 'Presencial',
            competencia_general: 'Conocer y aplicar estructuras de datos lineales y no lineales.',
            competencias_especificas: 'Manejo de memoria dinámica.',
            objetivo_general: 'Aprender a optimizar algoritmos a través de estructuras adecuadas.',
            prerrequisitos: 'Fundamentos de Programación',
            estado: 'Activa',
            version_programa: '2024-1',
            fecha_creacion: '2024-01-10',
            observaciones: 'Materia clave para la carrera.',
            caracteristicas: 'Práctica',
            unidades: [
                { tema: 'Introducción a ED', objetivo: 'Entender conceptos básicos', competencia: 'Análisis de datos', subtemas: '1.1 Tipos de datos', observaciones: '' },
                { tema: 'Pilas y Colas', objetivo: 'Implementar memoria estática', competencia: 'Desarrollo lógico', subtemas: '2.1 Definición de Pila', observaciones: '' }
            ]
        }
    ];
    fs.writeFileSync(DATA_FILE, JSON.stringify(defaultData, null, 2));
}

function getMaterias() {
    try {
        const data = fs.readFileSync(DATA_FILE, 'utf-8');
        return JSON.parse(data);
    } catch (err) {
        return [];
    }
}

function saveMaterias(materias) {
    fs.writeFileSync(DATA_FILE, JSON.stringify(materias, null, 2));
}

// GET /api/materias
router.get('/', (req, res) => {
    res.json({ success: true, data: getMaterias() });
});

// POST /api/materias
router.post('/', (req, res) => {
    const materias = getMaterias();
    const nueva = { _id: 'mat-' + Date.now(), ...req.body };
    materias.push(nueva);
    saveMaterias(materias);
    res.status(201).json({ success: true, data: nueva });
});

// PUT /api/materias/:id
router.put('/:id', (req, res) => {
    const materias = getMaterias();
    const idx = materias.findIndex(m => m._id === req.params.id);
    if (idx === -1) return res.status(404).json({ error: 'Materia no encontrada' });
    
    materias[idx] = { ...materias[idx], ...req.body };
    saveMaterias(materias);
    res.json({ success: true, data: materias[idx] });
});

// DELETE /api/materias/:id
router.delete('/:id', (req, res) => {
    const materias = getMaterias();
    const idx = materias.findIndex(m => m._id === req.params.id);
    if (idx !== -1) {
        materias.splice(idx, 1);
        saveMaterias(materias);
    }
    res.json({ success: true, message: 'Materia eliminada.' });
});

module.exports = router;
