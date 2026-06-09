/**
 * aspirantes.js
 * Módulo del portal de Aspirantes.
 * Conectado al API Gateway → /api/aspirantes
 * Requiere: apiGateway.js (window.API)
 */

const GATEWAY = 'http://localhost:3000/api';

// ─── Utilidad de toast ────────────────────────────────────────────────────────

function _toast(msg, tipo = 'success') {
    const colores = { success: '#059669', error: '#dc2626', info: '#6366f1' };
    const el = Object.assign(document.createElement('div'), {
        textContent: msg,
        style: [
            'position:fixed;top:20px;right:20px;z-index:9999',
            'padding:12px 22px;border-radius:10px;color:#fff;font-weight:700',
            `background:${colores[tipo] || colores.info}`,
            'box-shadow:0 4px 20px rgba(0,0,0,.15);transition:opacity .4s'
        ].join(';')
    });
    document.body.appendChild(el);
    setTimeout(() => { el.style.opacity = '0'; setTimeout(() => el.remove(), 400); }, 3500);
}

// ─── Obtener token del directivo en sesión ────────────────────────────────────

function _getAuthHeaders() {
    const token = localStorage.getItem('token') || '';
    return {
        'Content-Type': 'application/json',
        ...(token ? { 'Authorization': `Bearer ${token}` } : {})
    };
}

// ─── Registrar aspirante desde el formulario de ficha ────────────────────────

async function registrarAspirante(event) {
    event.preventDefault();
    const form = event.target;
    const btn  = form.querySelector('[type="submit"]');
    const orig = btn.innerHTML;

    btn.disabled  = true;
    btn.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i> Registrando...";

    const datos = {
        firstName:   form.querySelector('#ficha-nombre')?.value.trim()   || '',
        lastName:    form.querySelector('#ficha-apellidos')?.value.trim() || '',
        email:       form.querySelector('#ficha-email')?.value.trim()     || '',
        phoneNumber: form.querySelector('#ficha-telefono')?.value.trim()  || '',
        targetGrade: form.querySelector('#ficha-carrera')?.value.trim()   || ''
    };

    try {
        const res  = await fetch(`${GATEWAY}/aspirantes/register`, {
            method:  'POST',
            headers: _getAuthHeaders(),
            body:    JSON.stringify(datos)
        });
        const data = await res.json();

        if (!res.ok) throw new Error(data.error || data.message || `Error ${res.status}`);

        // Persistir en localStorage para flujo offline del aspirante
        localStorage.setItem('aspirante_ficha', JSON.stringify({
            ...datos,
            nombre:   `${datos.firstName} ${datos.lastName}`,
            id:       data.data?._id || '',
            status:   data.data?.status || 'REGISTRADO'
        }));
        localStorage.setItem('aspirante_registro', JSON.stringify({
            nombre: `${datos.firstName} ${datos.lastName}`,
            email:  datos.email
        }));

        _toast('¡Ficha registrada exitosamente!');
        form.reset();

        // Actualizar nombre en header si existe
        const headerName = document.getElementById('aspirante-header-name');
        if (headerName) headerName.textContent = `${datos.firstName} ${datos.lastName}`;

        // Ir a documentos si existe la función cargarModulo
        if (typeof cargarModulo === 'function') {
            setTimeout(() => cargarModulo('Documentos'), 1000);
        }
    } catch (err) {
        _toast(err.message, 'error');
    } finally {
        btn.disabled  = false;
        btn.innerHTML = orig;
    }
}

// ─── Panel Admin: listar aspirantes ──────────────────────────────────────────

async function cargarListaAspirantes(contenedorId = 'tabla-aspirantes-body', filtro = '') {
    const tbody = document.getElementById(contenedorId);
    if (!tbody) return;

    tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;padding:20px;">
        <i class='bx bx-loader-alt bx-spin'></i> Cargando aspirantes...
    </td></tr>`;

    try {
        const endpoint = filtro ? `${GATEWAY}/aspirantes${filtro}` : `${GATEWAY}/aspirantes`;
        const res  = await fetch(endpoint, { headers: _getAuthHeaders() });
        const data = await res.json();

        if (!res.ok) throw new Error(data.error || `Error ${res.status}`);

        const lista = data.data || [];

        if (!lista.length) {
            tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;padding:20px;color:#94a3b8;">
                Sin aspirantes registrados.
            </td></tr>`;
            return;
        }

        tbody.innerHTML = lista.map(a => `
            <tr>
                <td>${a.firstName} ${a.lastName}</td>
                <td>${a.email}</td>
                <td>${a.phoneNumber || '—'}</td>
                <td>${a.targetGrade || '—'}</td>
                <td><span class="badge-status badge-${a.status.toLowerCase()}">${a.status}</span></td>
                <td>${a.testScore !== null ? a.testScore : '—'}</td>
                <td>
                    ${a.status === 'REGISTRADO' ? `
                        <button class="btn-accion btn-editar"
                            onclick="abrirModalExamen('${a._id}', '${a.firstName} ${a.lastName}')"
                            title="Registrar puntaje de examen">
                            <i class='bx bx-pencil'></i> Calificar
                        </button>` : ''}
                    ${a.status === 'APROBADO' ? `
                        <button class="btn-accion btn-success"
                            onclick="abrirModalAceptar('${a._id}', '${a.firstName} ${a.lastName}')"
                            title="Aceptar aspirante">
                            <i class='bx bx-check'></i> Aceptar
                        </button>` : ''}
                </td>
            </tr>
        `).join('');
    } catch (err) {
        tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;padding:20px;color:#dc2626;">
            <i class='bx bx-error'></i> ${err.message}
        </td></tr>`;
    }
}

// ─── Modal: registrar examen ──────────────────────────────────────────────────

function abrirModalExamen(id, nombre) {
    const modal = document.getElementById('modal-examen');
    if (!modal) return;
    document.getElementById('examen-aspirante-id').value    = id;
    document.getElementById('examen-aspirante-nombre').textContent = nombre;
    modal.style.display = 'flex';
}

function cerrarModalExamen() {
    const modal = document.getElementById('modal-examen');
    if (modal) modal.style.display = 'none';
}

async function guardarExamen() {
    const id    = document.getElementById('examen-aspirante-id')?.value;
    const score = parseFloat(document.getElementById('examen-score')?.value);

    if (!id || isNaN(score) || score < 0 || score > 100) {
        _toast('Ingresa un puntaje válido entre 0 y 100.', 'error');
        return;
    }

    try {
        const res  = await fetch(`${GATEWAY}/aspirantes/${id}/exam`, {
            method:  'PATCH',
            headers: _getAuthHeaders(),
            body:    JSON.stringify({ score })
        });
        const data = await res.json();
        if (!res.ok) throw new Error(data.error || `Error ${res.status}`);

        _toast(`Puntaje registrado: ${score}/100`);
        cerrarModalExamen();
        cargarListaAspirantes();
    } catch (err) {
        _toast(err.message, 'error');
    }
}

// ─── Modal: aceptar aspirante ─────────────────────────────────────────────────

function abrirModalAceptar(id, nombre) {
    const modal = document.getElementById('modal-aceptar');
    if (!modal) return;
    document.getElementById('aceptar-aspirante-id').value             = id;
    document.getElementById('aceptar-aspirante-nombre').textContent   = nombre;
    modal.style.display = 'flex';
}

function cerrarModalAceptar() {
    const modal = document.getElementById('modal-aceptar');
    if (modal) modal.style.display = 'none';
}

async function confirmarAceptar() {
    const id      = document.getElementById('aceptar-aspirante-id')?.value;
    const carrera = document.getElementById('aceptar-carrera')?.value.trim();

    if (!id || !carrera) {
        _toast('Selecciona la carrera para aceptar al aspirante.', 'error');
        return;
    }

    try {
        const res  = await fetch(`${GATEWAY}/aspirantes/${id}/accept`, {
            method:  'PATCH',
            headers: _getAuthHeaders(),
            body:    JSON.stringify({ carrera })
        });
        const data = await res.json();
        if (!res.ok) throw new Error(data.error || `Error ${res.status}`);

        _toast('Aspirante aceptado y convertido en alumno.');
        cerrarModalAceptar();
        cargarListaAspirantes();
    } catch (err) {
        _toast(err.message, 'error');
    }
}

// ─── Cerrar modales al clic fuera ─────────────────────────────────────────────
window.addEventListener('click', (e) => {
    ['modal-examen', 'modal-aceptar'].forEach(id => {
        const modal = document.getElementById(id);
        if (modal && e.target === modal) modal.style.display = 'none';
    });
});

// ─── DOMContentLoaded ─────────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    // Autocargar tabla si existe en la página
    if (document.getElementById('tabla-aspirantes-body')) {
        cargarListaAspirantes();
    }
    // Conectar formulario de ficha si existe
    const formFicha = document.getElementById('form-ficha-aspirante');
    if (formFicha) formFicha.addEventListener('submit', registrarAspirante);
});
