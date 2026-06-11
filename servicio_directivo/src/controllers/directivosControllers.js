const Directivo = require('../models/Directivos');
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');

const obtenerDirectivos = async (req, res) => {
    try {
        const lista = await Directivo.find();
        res.json(lista);
    } catch (error) {
        res.status(500).json({ mensaje: "Error al obtener los directivos", error: error.message });
    }
};

const obtenerDirectivoPorId = async (req, res) => {
    try {
        const directivo = await Directivo.findById(req.params.id);
        if (!directivo) {
            return res.status(404).json({ mensaje: "Directivo no encontrado" });
        }
        res.json(directivo);
    } catch (error) {
        res.status(500).json({ mensaje: "Error al buscar el directivo", error: error.message });
    }
};

const crearDirectivo = async (req, res) => {
    try {
        const {
            nombre,
            apellidoPaterno,
            apellidoMaterno,
            username,
            email,
            password,
            numeroEmpleado,
            telefono,
            cargo,
            area,
            departamento,
            tipoContrato,
            turno,
            fechaIngreso,
            estatus,
            permisos
        } = req.body;
        
        if (!nombre || !apellidoPaterno || !email || !password || !numeroEmpleado || !telefono || !cargo || !area || !fechaIngreso) {
            return res.status(400).json({
                mensaje: "Nombre, apellidoPaterno, email, contrasena, numeroEmpleado, telefono, cargo, area y fechaIngreso son requeridos"
            });
        }

        const existente = await Directivo.findOne({ $or: [{ email }, { numeroEmpleado }] });
        if (existente) {
            return res.status(409).json({ mensaje: "Ya existe un directivo con ese email o numero de empleado" });
        }

        const baseUsername = (username || email.split('@')[0] || '').toLowerCase().trim();
        if (!baseUsername) {
            return res.status(400).json({ mensaje: 'El usuario es obligatorio' });
        }

        let usernameFinal = baseUsername;
        let intento = 0;
        while (await Directivo.exists({ username: usernameFinal })) {
            intento += 1;
            usernameFinal = `${baseUsername}${intento}`;
        }

        const salt = await bcrypt.genSalt(10);
        const passwordHash = await bcrypt.hash(password, salt);

        const nuevoDirectivo = new Directivo({
            nombre,
            apellidoPaterno,
            apellidoMaterno,
            username: usernameFinal,
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
            permisos
        });
        const guardado = await nuevoDirectivo.save();

        res.status(201).json({
            id: guardado._id,
            nombre: guardado.nombre,
            apellidoPaterno: guardado.apellidoPaterno,
            apellidoMaterno: guardado.apellidoMaterno,
            username: guardado.username,
            email: guardado.email,
            numeroEmpleado: guardado.numeroEmpleado,
            telefono: guardado.telefono,
            cargo: guardado.cargo,
            area: guardado.area,
            departamento: guardado.departamento,
            tipoContrato: guardado.tipoContrato,
            turno: guardado.turno,
            fechaIngreso: guardado.fechaIngreso,
            estatus: guardado.estatus,
            permisos: guardado.permisos
        });
    } catch (error) {
        // Duplicados por indices unicos (email, numeroEmpleado, username)
        if (error && error.code === 11000) {
            const campo = Object.keys(error.keyPattern || {})[0] || 'campo unico';
            return res.status(409).json({
                mensaje: `Ya existe un directivo con el valor de ${campo}`,
                campo,
                detalle: error.message
            });
        }

        // Validaciones de esquema (enum, requeridos, formato fecha, etc.)
        if (error && error.name === 'ValidationError') {
            return res.status(400).json({
                mensaje: 'Datos invalidos para registrar directivo',
                detalle: error.message
            });
        }

        res.status(500).json({ mensaje: "Error al guardar el directivo", error: error.message });
    }
};

const loginDirectivo = async (req, res) => {
    try {
        const { email, username, password } = req.body;
        if ((!email && !username) || !password) {
            return res.status(400).json({ mensaje: 'Debes enviar usuario o email y contrasena' });
        }

        const filtros = [];
        if (email) filtros.push({ email: String(email).toLowerCase().trim() });
        if (username) filtros.push({ username: String(username).toLowerCase().trim() });

        const directivo = await Directivo.findOne({ $or: filtros }).select('+password');
        if (!directivo) {
            return res.status(404).json({ mensaje: 'Directivo no encontrado' });
        }

        // Compatibilidad con registros legacy que no tengan password almacenada
        if (!directivo.password) {
            return res.status(401).json({ mensaje: 'Cuenta sin credenciales de acceso configuradas' });
        }

        const valido = await bcrypt.compare(password, directivo.password);
        if (!valido) {
            return res.status(401).json({ mensaje: 'Credenciales invalidas' });
        }

        const token = jwt.sign(
            {
                id: directivo._id,
                nombre: directivo.nombre,
                apellidoPaterno: directivo.apellidoPaterno,
                apellidoMaterno: directivo.apellidoMaterno,
                username: directivo.username,
                email: directivo.email,
                numeroEmpleado: directivo.numeroEmpleado,
                rol: 'directivo'
            },
            process.env.JWT_SECRET || 'secreto',
            { expiresIn: '1d' }
        );

        res.json({
            token,
            directivo: {
                id: directivo._id,
                nombre: directivo.nombre,
                apellidoPaterno: directivo.apellidoPaterno,
                apellidoMaterno: directivo.apellidoMaterno,
                username: directivo.username,
                email: directivo.email,
                numeroEmpleado: directivo.numeroEmpleado,
                telefono: directivo.telefono,
                cargo: directivo.cargo,
                area: directivo.area,
                departamento: directivo.departamento,
                tipoContrato: directivo.tipoContrato,
                turno: directivo.turno,
                fechaIngreso: directivo.fechaIngreso,
                estatus: directivo.estatus,
                permisos: directivo.permisos
            }
        });
    } catch (error) {
        res.status(500).json({ mensaje: 'Error al iniciar sesion', error: error.message });
    }
};

const actualizarCredenciales = async (req, res) => {
    try {
        const directivo = await Directivo.findById(req.params.id);
        if (!directivo) return res.status(404).json({ mensaje: 'Directivo no encontrado' });

        const { username, password } = req.body;
        if (username) directivo.username = username;
        
        if (password) {
            const salt = await bcrypt.genSalt(10);
            directivo.password = await bcrypt.hash(password, salt);
        }

        await directivo.save();
        res.json({ mensaje: 'Credenciales actualizadas exitosamente.' });
    } catch (error) {
        res.status(500).json({ mensaje: 'Error al actualizar credenciales', error: error.message });
    }
};
const actualizarDirectivo = async (req, res) => {
    try {
        const { password, ...resto } = req.body;
        const directivo = await Directivo.findByIdAndUpdate(req.params.id, resto, { new: true }).select('-password');
        if (!directivo) return res.status(404).json({ mensaje: 'Directivo no encontrado' });
        res.json(directivo);
    } catch (error) {
        res.status(500).json({ mensaje: 'Error al actualizar directivo', error: error.message });
    }
};

const eliminarDirectivo = async (req, res) => {
    try {
        const directivo = await Directivo.findByIdAndDelete(req.params.id);
        if (!directivo) return res.status(404).json({ mensaje: 'Directivo no encontrado' });
        res.json({ mensaje: 'Directivo eliminado correctamente' });
    } catch (error) {
        res.status(500).json({ mensaje: 'Error al eliminar directivo', error: error.message });
    }
};

module.exports = {
    obtenerDirectivos,
    obtenerDirectivoPorId,
    crearDirectivo,
    loginDirectivo,
    actualizarCredenciales,
    actualizarDirectivo,
    eliminarDirectivo
};