/**
 * apiGateway.js
 * Módulo central de comunicación con el API Gateway.
 * Toda petición al backend pasa por aquí — sin fetch dispersos en las vistas.
 */

const GATEWAY_URL = 'http://localhost:3000/api';

// ─── Utilidades internas ──────────────────────────────────────────────────────

function getToken() {
    return localStorage.getItem('token') || '';
}

function authHeaders() {
    const token = getToken();
    return {
        'Content-Type': 'application/json',
        ...(token ? { 'Authorization': `Bearer ${token}` } : {})
    };
}

async function request(method, endpoint, body = null) {
    const options = {
        method,
        headers: authHeaders(),
        ...(body ? { body: JSON.stringify(body) } : {})
    };

    const response = await fetch(`${GATEWAY_URL}${endpoint}`, options);
    const data = await response.json().catch(() => ({}));

    if (!response.ok) {
        const msg = data?.message || data?.error || `Error ${response.status}`;
        throw new Error(msg);
    }

    return data;
}

// ─── Auth ─────────────────────────────────────────────────────────────────────

const Auth = {
    loginPersonal: (usuario, password) =>
        request('POST', '/directivos/login', { email: usuario, username: usuario, password }),

    loginEstudiante: (usuario, password) =>
        request('POST', '/alumnos/login', { email: usuario, username: usuario, password }),

    loginAlumno: (credencial, password) =>
        request('POST', '/alumnos/login', { email: credencial, username: credencial, password }),

    loginDirectivo: (credencial, password) =>
        request('POST', '/directivos/login', { email: credencial, username: credencial, password }),

    logout: () => {
        localStorage.removeItem('token');
        localStorage.removeItem('user_role');
        localStorage.removeItem('user_data');
    }
};

// ─── Docentes ─────────────────────────────────────────────────────────────────

const Docentes = {
    listar: () =>
        request('GET', '/docentes'),

    registrar: (datos) =>
        request('POST', '/docentes', datos),

    editar: (id, datos) =>
        request('PUT', `/docentes/${id}`, datos),

    eliminar: (id) =>
        request('DELETE', `/docentes/${id}`),

    buscar: (filtro) =>
        request('GET', `/docentes/buscar?filtro=${encodeURIComponent(filtro)}`),

    crearTarea: (datos) =>
        request('POST', '/docentes/tareas', datos),

    obtenerTareas: (grupo = '') =>
        request('GET', `/docentes/tareas${grupo ? `?grupo=${encodeURIComponent(grupo)}` : ''}`)
};

// ─── Alumnos ──────────────────────────────────────────────────────────────────

const Alumnos = {
    listar: () =>
        request('GET', '/alumnos/solo-info'),

    buscar: (filtro) =>
        request('GET', `/alumnos/buscar?query=${encodeURIComponent(filtro)}`),

    miInfo: () =>
        request('GET', '/alumnos/mi-info'),

    misMaterias: () =>
        request('GET', '/alumnos/mis-materias'),

    registrar: (datos) =>
        request('POST', '/alumnos', datos),

    actualizarCarrera: (id, carrera) =>
        request('PUT', `/alumnos/${id}/carrera`, { carrera }),

    registrarMateria: (id, materia) =>
        request('POST', `/alumnos/${id}/materias`, materia),

    verCalificaciones: (id, materiaNombre) =>
        request('GET', `/alumnos/${id}/materias/${encodeURIComponent(materiaNombre)}/calificaciones`),

    modificarCalificacion: (id, materiaNombre, numUnidad, calificacion) =>
        request('PATCH', `/alumnos/${id}/materias/${encodeURIComponent(materiaNombre)}/unidades/${numUnidad}`, { calificacion })
};

// ─── Directivos ───────────────────────────────────────────────────────────────

const Directivos = {
    listar: () =>
        request('GET', '/directivos'),

    registrar: (datos) =>
        request('POST', '/directivos', datos),

    obtener: (id) =>
        request('GET', `/directivos/${id}`)
};

// ─── Aspirantes ───────────────────────────────────────────────────────────────

const Aspirantes = {
    registrar: (datos) =>
        request('POST', '/aspirantes/register', datos),

    listar: (status = '') =>
        request('GET', `/aspirantes${status ? `?status=${status}` : ''}`),

    pendientes: () =>
        request('GET', '/aspirantes/pendientes'),

    aceptados: () =>
        request('GET', '/aspirantes/aceptados'),

    subirExamen: (id, score) =>
        request('PATCH', `/aspirantes/${id}/exam`, { score }),

    aceptar: (id, carrera) =>
        request('PATCH', `/aspirantes/${id}/accept`, { carrera })
};

// ─── Materias (Retícula) ──────────────────────────────────────────────────────

const Materias = {
    listar: () =>
        request('GET', '/materias'),

    registrar: (datos) =>
        request('POST', '/materias', datos),

    editar: (id, datos) =>
        request('PUT', `/materias/${id}`, datos),

    eliminar: (id) =>
        request('DELETE', `/materias/${id}`)
};

// ─── Finanzas ─────────────────────────────────────────────────────────────────

const Finanzas = {
    crearCobro: (datos) =>
        request('POST', '/finanzas/tuitions', datos),

    pagarColegiatura: (id) =>
        request('PATCH', `/finanzas/tuitions/${id}/pay`, {}),

    estadoCuentaAlumno: (studentId) =>
        request('GET', `/finanzas/tuitions/student/${studentId}`)
};

// ─── Exports públicos ─────────────────────────────────────────────────────────

window.API = {
    Auth,
    Docentes,
    Alumnos,
    Directivos,
    Aspirantes,
    Finanzas,
    Materias
};
