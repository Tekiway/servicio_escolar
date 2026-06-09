/**
 * alumnos.js
 * Módulo del portal de Alumnos.
 * Conectado al API Gateway → /api/alumnos
 * Requiere: apiGateway.js (window.API)
 */

// ─── Bootstrap ────────────────────────────────────────────────────────────────

document.addEventListener('DOMContentLoaded', () => {
    cargarPerfilAlumno();
});

// ─── Perfil del alumno ────────────────────────────────────────────────────────

async function cargarPerfilAlumno() {
    try {
        const data = await API.Alumnos.miInfo();

        // Persistir en localStorage para uso offline/fallback
        localStorage.setItem('alumno_perfil', JSON.stringify({
            nombre:    data.nombre    || '',
            matricula: data.matricula || '',
            email:     data.email     || '',
            username:  data.username  || '',
            carrera:   data.carrera   || ''
        }));

        // Actualizar elementos del DOM si existen
        _actualizarElemento('alumno-nombre',    data.nombre);
        _actualizarElemento('alumno-matricula', data.matricula);
        _actualizarElemento('alumno-email',     data.email);
        _actualizarElemento('alumno-carrera',   data.carrera);
    } catch (err) {
        // Fallback a datos en localStorage
        const local = localStorage.getItem('alumno_perfil');
        if (local) {
            const data = JSON.parse(local);
            _actualizarElemento('alumno-nombre',    data.nombre);
            _actualizarElemento('alumno-matricula', data.matricula);
            _actualizarElemento('alumno-carrera',   data.carrera);
        }
        console.warn('[Alumnos] Usando perfil desde caché local:', err.message);
    }
}

// ─── Materias del alumno ──────────────────────────────────────────────────────

async function cargarMisMateriasAlumno(contenedorId = 'alumno-materias-lista') {
    const contenedor = document.getElementById(contenedorId);
    if (!contenedor) return;

    try {
        const materias = await API.Alumnos.misMaterias();
        localStorage.setItem('alumno_materias', JSON.stringify(materias));

        if (!materias.length) {
            contenedor.innerHTML = `<p style="color:#94a3b8;text-align:center;">Sin materias inscritas.</p>`;
            return;
        }

        contenedor.innerHTML = materias.map(m => `
            <div class="materia-card">
                <strong>${m.nombre}</strong>
                <span>Periodo: ${m.periodo || '—'}</span>
                <span>Estado: ${m.unidades?.every(u => u.calificacion >= 6) ? '✅ Aprobada' : '📘 Inscrita'}</span>
            </div>
        `).join('');
    } catch (err) {
        console.warn('[Alumnos] Error al cargar materias:', err.message);
    }
}

// ─── Estado de colegiaturas ───────────────────────────────────────────────────

async function cargarEstadoColegiatura(studentId) {
    if (!studentId) return;
    try {
        const data = await API.Finanzas.estadoCuentaAlumno(studentId);
        return data;
    } catch (err) {
        console.warn('[Alumnos] Estado de colegiatura no disponible:', err.message);
        return null;
    }
}

// ─── Login de alumno ──────────────────────────────────────────────────────────

async function loginAlumno(event) {
    event.preventDefault();

    const form      = event.target;
    const credencial = form.querySelector('#alumno-usuario')?.value.trim();
    const password  = form.querySelector('#alumno-password')?.value.trim();
    const btnSubmit = form.querySelector('[type="submit"]');
    const alertBox  = document.getElementById('alert-message');
    const alertText = document.getElementById('alert-text');

    if (!credencial || !password) return;

    alertBox && (alertBox.style.display = 'none');
    btnSubmit.disabled  = true;
    btnSubmit.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i> Verificando...";

    try {
        const data = await API.Auth.loginAlumno(credencial, password);

        if (data.token) {
            localStorage.setItem('token',     data.token);
            localStorage.setItem('user_role', 'alumno');
            localStorage.setItem('user_data', JSON.stringify(data.alumno || {}));
            window.location.href = '../alumnos/alumnos.php';
        } else {
            throw new Error(data.message || 'Credenciales inválidas');
        }
    } catch (err) {
        if (alertBox && alertText) {
            alertText.textContent  = err.message;
            alertBox.style.display = 'flex';
            alertBox.style.animation = 'none';
            void alertBox.offsetWidth;
            alertBox.style.animation = 'shake 0.4s ease-in-out';
        }
        btnSubmit.disabled  = false;
        btnSubmit.innerHTML = "Ingresar <i class='bx bx-right-arrow-alt'></i>";
    }
}

// ─── Helpers ──────────────────────────────────────────────────────────────────

function _actualizarElemento(id, valor) {
    const el = document.getElementById(id);
    if (el && valor) el.textContent = valor;
}
