const mongoose = require('mongoose');
const bcrypt = require('bcryptjs');
const Directivo = require('../models/Directivos');

// Nota:
// - Dentro de Docker Compose, el servicio directivo recibe MONGO_URI=mongodb://mongo-directivos:27017/directivos_db
// - Ejecutando este script desde host (npm run seed:directivo), por defecto usamos el puerto publicado del contenedor: 27019
const MONGO_URI = process.env.MONGO_URI || 'mongodb://localhost:27019/directivos_db';

async function seedDirectivo() {
    console.log('Usando MONGO_URI para semilla:', MONGO_URI);
    await mongoose.connect(MONGO_URI);

    const total = await Directivo.countDocuments();
    if (total > 0) {
        console.log('Semilla cancelada: ya existe al menos un directivo.');
        return;
    }

    const nombre = process.env.SEED_DIRECTIVO_NOMBRE || 'Admin';
    const apellidoPaterno = process.env.SEED_DIRECTIVO_APELLIDO_PATERNO || 'Sistema';
    const apellidoMaterno = process.env.SEED_DIRECTIVO_APELLIDO_MATERNO || 'Escolar';
    const username = (process.env.SEED_DIRECTIVO_USERNAME || 'admin.directivo').toLowerCase().trim();
    const email = (process.env.SEED_DIRECTIVO_EMAIL || 'admin.directivo@escuela.edu.mx').toLowerCase().trim();
    const passwordPlano = process.env.SEED_DIRECTIVO_PASSWORD || 'Admin1234';
    const numeroEmpleado = process.env.SEED_DIRECTIVO_NUMERO_EMPLEADO || 'DIR-SEED-001';
    const telefono = process.env.SEED_DIRECTIVO_TELEFONO || '5500000000';
    const cargo = process.env.SEED_DIRECTIVO_CARGO || 'Director General';
    const area = process.env.SEED_DIRECTIVO_AREA || 'Direccion';
    const departamento = process.env.SEED_DIRECTIVO_DEPARTAMENTO || 'Administracion';
    const tipoContrato = process.env.SEED_DIRECTIVO_TIPO_CONTRATO || 'Confianza';
    const turno = process.env.SEED_DIRECTIVO_TURNO || 'Mixto';
    const fechaIngreso = process.env.SEED_DIRECTIVO_FECHA_INGRESO || '2026-01-01';
    const estatus = process.env.SEED_DIRECTIVO_ESTATUS || 'Activo';

    const existeConflicto = await Directivo.findOne({
        $or: [{ email }, { username }, { numeroEmpleado }]
    });

    if (existeConflicto) {
        console.log('Semilla cancelada: ya existe un directivo con email/username/numeroEmpleado de semilla.');
        return;
    }

    const salt = await bcrypt.genSalt(10);
    const passwordHash = await bcrypt.hash(passwordPlano, salt);

    const nuevo = await Directivo.create({
        nombre,
        apellidoPaterno,
        apellidoMaterno,
        username,
        email,
        password: passwordHash,
        numeroEmpleado,
        telefono,
        cargo,
        area,
        departamento,
        tipoContrato,
        turno,
        fechaIngreso,
        estatus,
        permisos: {
            gestionarAlumnos: true,
            gestionarDocentes: true,
            generarReportes: true,
            administrarUsuarios: true
        }
    });

    console.log('Directivo semilla creado:', {
        id: nuevo._id.toString(),
        username: nuevo.username,
        email: nuevo.email,
        numeroEmpleado: nuevo.numeroEmpleado
    });
}

seedDirectivo()
    .catch((error) => {
        console.error('Error ejecutando semilla de directivo:', error.message);
        process.exitCode = 1;
    })
    .finally(async () => {
        await mongoose.connection.close();
    });
