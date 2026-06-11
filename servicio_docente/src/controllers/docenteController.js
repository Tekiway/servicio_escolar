const Docente = require('../models/Docente');
const bcrypt  = require('bcryptjs');
const jwt     = require('jsonwebtoken');

// ── Registrar docente ─────────────────────────────────────────────────────────
exports.registrarDocente = async (req, res) => {
    try {
        const { password, username, email, ...resto } = req.body;

        if (!email)    return res.status(400).json({ error: 'El email es obligatorio' });
        if (!password) return res.status(400).json({ error: 'La contraseña es obligatoria' });

        if (!username) return res.status(400).json({ error: 'El usuario de login es obligatorio' });

        const base = username.toLowerCase().trim();
        let usernameFinal = base;
        let intento = 0;
        while (await Docente.exists({ username: usernameFinal })) {
            intento += 1;
            usernameFinal = `${base}${intento}`;
        }

        const salt         = await bcrypt.genSalt(10);
        const passwordHash = await bcrypt.hash(password, salt);

        const nuevoDocente = new Docente({
            ...resto,
            email,
            username: usernameFinal,
            password: passwordHash
        });
        await nuevoDocente.save();

        // Responder sin exponer el hash
        const doc = nuevoDocente.toObject();
        delete doc.password;
        res.status(201).json(doc);
    } catch (error) {
        if (error.code === 11000) {
            const campo = Object.keys(error.keyPattern || {})[0] || 'campo único';
            return res.status(409).json({ error: `Ya existe un docente con ese ${campo}.` });
        }
        res.status(400).json({ error: error.message });
    }
};

// ── Obtener todos ─────────────────────────────────────────────────────────────
exports.obtenerTodos = async (req, res) => {
    try {
        const docentes = await Docente.find().select('-password');
        res.json(docentes);
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};

// ── Buscar por nombre o número de empleado ────────────────────────────────────
exports.buscarDocentes = async (req, res) => {
    const { filtro } = req.query;
    try {
        const docentes = await Docente.find({
            $or: [
                { nombre:          { $regex: filtro, $options: 'i' } },
                { apellidoPaterno: { $regex: filtro, $options: 'i' } },
                { numeroEmpleado:  filtro }
            ]
        }).select('-password');
        res.json(docentes);
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};

// ── Editar docente ────────────────────────────────────────────────────────────
exports.editarDocente = async (req, res) => {
    try {
        // Nunca actualizar password por esta ruta — usar /reset-password
        const { password, ...datos } = req.body;

        const actualizado = await Docente.findByIdAndUpdate(
            req.params.id,
            datos,
            { new: true, runValidators: true }
        ).select('-password');

        if (!actualizado) return res.status(404).json({ message: 'Docente no encontrado' });
        res.json(actualizado);
    } catch (error) {
        res.status(400).json({ error: error.message });
    }
};

// ── Actualizar Credenciales ───────────────────────────────────────────────────
exports.actualizarCredenciales = async (req, res) => {
    try {
        const docente = await Docente.findById(req.params.id);
        if (!docente) return res.status(404).json({ error: 'Docente no encontrado' });

        const { username, password } = req.body;
        
        if (username) {
            docente.username = username;
        }

        if (password) {
            const salt = await bcrypt.genSalt(10);
            docente.password = await bcrypt.hash(password, salt);
        }

        await docente.save();
        res.json({ message: 'Credenciales actualizadas exitosamente.', docente });
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};

// ── Login docente ─────────────────────────────────────────────────────────────
exports.loginDocente = async (req, res) => {
    try {
        const { email, username, password } = req.body;
        if ((!email && !username) || !password) {
            return res.status(400).json({ error: 'Usuario/email y contraseña son requeridos.' });
        }

        const filtros = [];
        if (email)    filtros.push({ email:    String(email).toLowerCase().trim() });
        if (username) filtros.push({ username: String(username).toLowerCase().trim() });

        const docente = await Docente.findOne({ $or: filtros }).select('+password');
        if (!docente) return res.status(404).json({ error: 'Docente no encontrado.' });

        const valido = await bcrypt.compare(password, docente.password);
        if (!valido) return res.status(401).json({ error: 'Contraseña incorrecta.' });

        const token = jwt.sign(
            { id: docente._id, username: docente.username, rol: 'docente' },
            process.env.JWT_SECRET || 'secreto',
            { expiresIn: '1d' }
        );

        const doc = docente.toObject();
        delete doc.password;
        res.json({ token, docente: doc });
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};

// ── Eliminar docente ──────────────────────────────────────────────────────────
exports.eliminarDocente = async (req, res) => {
    try {
        const docente = await Docente.findByIdAndDelete(req.params.id);
        if (!docente) return res.status(404).json({ message: 'Docente no encontrado' });
        res.json({ message: 'Docente eliminado correctamente' });
    } catch (error) {
        res.status(500).json({ error: error.message });
    }
};