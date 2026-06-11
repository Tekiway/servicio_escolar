/**
 * carga.js — Gestión completa de Docentes
 * Campos completos, credenciales, reset de contraseña.
 */

var docenteEnEdicion = null;

// ─── Bootstrap ────────────────────────────────────────────────────────────────
if (!window.API) {
    const s = document.createElement('script');
    s.src = '../../js/apiGateway.js';
    s.onload = _inicializarBoot;
    document.head.appendChild(s);
} else {
    _inicializarBoot();
}

function _inicializarBoot() {
    if (document.readyState !== 'loading') {
        _inicializar();
    } else {
        document.addEventListener('DOMContentLoaded', _inicializar);
    }
}

function _inicializar() {
    _sincronizarNombreModal();
    _registrarEventos();
    cargarTablaDocentes();
    // Establecer fecha de ingreso por defecto a hoy
    const fechaInput = document.getElementById('reg-fecha-ingreso');
    if (fechaInput) fechaInput.value = new Date().toISOString().split('T')[0];
}

// ─── Sugerir username desde email ─────────────────────────────────────────────
function sugerirUsername() {
    const email    = document.getElementById('reg-email')?.value || '';
    const usernameInput = document.getElementById('reg-username');
    if (usernameInput && !usernameInput.dataset.editadoManualmente) {
        usernameInput.value = email.split('@')[0].toLowerCase().replace(/[^a-z0-9.]/g, '');
    }
}

// Marcar que el username fue editado manualmente
(function() {
    const u = document.getElementById('reg-username');
    if (u) u.addEventListener('input', () => { u.dataset.editadoManualmente = 'true'; });
})();

// ─── Toggle ver contraseña ────────────────────────────────────────────────────
function toggleVerPass() {
    const inp = document.getElementById('reg-password');
    const ico = document.getElementById('toggle-pass-ico');
    if (!inp) return;
    if (inp.type === 'password') {
        inp.type = 'text';
        if (ico) ico.className = 'bx bx-hide';
    } else {
        inp.type = 'password';
        if (ico) ico.className = 'bx bx-show';
    }
}

function toggleVerPassReset() {
    const inp = document.getElementById('reset-nueva-pass');
    const ico = document.getElementById('toggle-reset-ico');
    if (!inp) return;
    if (inp.type === 'password') {
        inp.type = 'text';
        if (ico) ico.className = 'bx bx-hide';
    } else {
        inp.type = 'password';
        if (ico) ico.className = 'bx bx-show';
    }
}

// ─── Helpers UI ───────────────────────────────────────────────────────────────
function _sincronizarNombreModal() {
    const inputNombre  = document.getElementById('edit-nombre');
    const headerNombre = document.getElementById('edit-header-nombre');
    if (inputNombre && headerNombre) {
        inputNombre.addEventListener('input',  () => headerNombre.value = inputNombre.value);
        headerNombre.addEventListener('input', () => inputNombre.value  = headerNombre.value);
    }
}

function _mostrarFeedback(mensaje, tipo = 'success') {
    const colores = { success: '#059669', error: '#dc2626', info: '#6366f1', warning: '#f59e0b' };
    const toast   = Object.assign(document.createElement('div'), {
        innerHTML: mensaje,
        style: [
            'position:fixed;top:20px;right:20px;z-index:99999',
            'padding:12px 20px;border-radius:10px;color:#fff;font-weight:700',
            `background:${colores[tipo] || colores.info}`,
            'box-shadow:0 4px 20px rgba(0,0,0,.25)',
            'transition:opacity .4s;font-family:inherit;max-width:350px'
        ].join(';')
    });
    document.body.appendChild(toast);
    setTimeout(() => { toast.style.opacity = '0'; setTimeout(() => toast.remove(), 400); }, 3500);
}

function _mostrarError(msg) {
    const errDiv = document.getElementById('reg-error');
    if (errDiv) { errDiv.textContent = msg; errDiv.style.display = 'block';
        setTimeout(() => errDiv.style.display = 'none', 5000); }
    _mostrarFeedback(msg, 'error');
}

function _setBtnLoading(btn, loading, textoLoading = 'Procesando...') {
    if (!btn) return;
    if (loading) {
        btn.disabled     = true;
        btn.dataset.orig = btn.innerHTML;
        btn.innerHTML    = `<i class='bx bx-loader-alt bx-spin'></i> ${textoLoading}`;
    } else {
        btn.disabled  = false;
        btn.innerHTML = btn.dataset.orig || btn.textContent;
    }
}

// ─── Tabla de docentes ────────────────────────────────────────────────────────
function cargarTablaDocentes() {
    const tbody = document.getElementById('tabla-docentes-body');
    if (!tbody) return;

    if (!window.API) {
        tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;padding:20px;color:#dc2626;">
            API Gateway no disponible.</td></tr>`;
        return;
    }

    tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;padding:20px;">
        <i class='bx bx-loader-alt bx-spin'></i> Cargando docentes...</td></tr>`;

    API.Docentes.listar()
        .then(data => {
            const lista = Array.isArray(data) ? data : (data?.data || []);
            _renderTabla(tbody, lista);
        })
        .catch(err => {
            tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;padding:20px;color:#dc2626;">
                <i class='bx bx-error'></i> ${err.message}</td></tr>`;
        });
}

function _badgeEstatus(estatus) {
    const colores = {
        'Activo':        'background:#d1fae5;color:#065f46;',
        'Inactivo':      'background:#fee2e2;color:#991b1b;',
        'Baja Temporal': 'background:#fef3c7;color:#92400e;'
    };
    const estilo = colores[estatus] || 'background:#e2e8f0;color:#475569;';
    return `<span style="padding:3px 10px;border-radius:20px;font-size:0.78rem;font-weight:700;${estilo}">${estatus || 'N/A'}</span>`;
}

function _renderTabla(tbody, docentes) {
    if (!docentes.length) {
        tbody.innerHTML = `<tr><td colspan="7" style="text-align:center;padding:25px;color:#94a3b8;">
            <i class='bx bx-info-circle' style="font-size:1.5rem;display:block;margin-bottom:8px;"></i>
            No hay docentes registrados aún.</td></tr>`;
        return;
    }

    tbody.innerHTML = docentes.map(d => {
        const nombreCompleto = [d.nombre, d.apellidoPaterno, d.apellidoMaterno].filter(Boolean).join(' ');
        const jsonSeguro = JSON.stringify(d).replace(/'/g, "&#39;").replace(/"/g, "&quot;");
        return `
        <tr>
            <td><b>${nombreCompleto || d.nombre || '—'}</b><br>
                <small style="color:#94a3b8;">${d.gradoAcademico || ''}</small></td>
            <td>${d.email || '—'}<br>
                <small style="color:#a855f7;font-weight:600;">@${d.username || '—'}</small></td>
            <td>${d.numeroEmpleado || '—'}</td>
            <td>${d.especialidad || '—'}<br>
                <small style="color:#94a3b8;">${d.formacionProfesional || d.carrera || ''}</small></td>
            <td>${d.tipoContrato || '—'}<br>
                <small style="color:#94a3b8;">${d.turno || ''}</small></td>
            <td>${_badgeEstatus(d.estatus)}</td>
            <td>
                <div class="acciones-group-flex">
                    <button class="btn-action-view"
                        onclick="abrirModalEditar('${jsonSeguro}')"
                        title="Editar docente">
                        <i class='bx bx-edit-alt'></i>
                    </button>
                    <button class="btn-action-view" style="background:rgba(245,158,11,.15);color:#d97706;"
                        onclick="abrirModalReset('${d._id}', '${(nombreCompleto || d.nombre || '').replace(/'/g, "\\'")}')"
                        title="Resetear contraseña">
                        <i class='bx bx-lock-open-alt'></i>
                    </button>
                    <button class="btn-action-delete"
                        onclick="eliminarDocente('${d._id}', '${(nombreCompleto || d.nombre || '').replace(/'/g, "\\'")}')"
                        title="Eliminar docente">
                        <i class='bx bx-trash'></i>
                    </button>
                </div>
            </td>
        </tr>`;
    }).join('');
}

// ─── Registro de docente ──────────────────────────────────────────────────────
function _registrarEventos() {
    if (document.body.dataset.cargaListenerAttached) return;
    document.body.dataset.cargaListenerAttached = 'true';

    document.addEventListener('submit', async (e) => {
        const form = e.target;
        if (!form || form.id !== 'form-registrar-docente') return;
        e.preventDefault();

        if (!window.API) { _mostrarError('API Gateway no disponible.'); return; }

        const btn = document.getElementById('btn-registrar-docente');
        _setBtnLoading(btn, true, 'Registrando...');

        const get = id => (document.getElementById(id)?.value || '').trim();

        const datos = {
            nombre:               get('reg-nombre'),
            apellidoPaterno:      get('reg-apellido-paterno'),
            apellidoMaterno:      get('reg-apellido-materno'),
            email:                get('reg-email'),
            username:             get('reg-username'),
            password:             get('reg-password'),
            numeroEmpleado:       get('reg-numero-empleado'),
            especialidad:         get('reg-especialidad'),
            formacionProfesional: get('reg-formacion'),
            carrera:              get('reg-carrera'),
            gradoAcademico:       get('reg-grado'),
            tipoContrato:         get('reg-contrato'),
            turno:                get('reg-turno'),
            telefono:             get('reg-telefono'),
            fechaIngreso:         get('reg-fecha-ingreso') || new Date().toISOString().split('T')[0]
        };

        if (!datos.nombre)          { _mostrarError('El nombre es obligatorio.');           _setBtnLoading(btn, false); return; }
        if (!datos.apellidoPaterno) { _mostrarError('El apellido paterno es obligatorio.');  _setBtnLoading(btn, false); return; }
        if (!datos.email)           { _mostrarError('El email es obligatorio.');             _setBtnLoading(btn, false); return; }
        if (!datos.password)        { _mostrarError('La contraseña inicial es obligatoria.'); _setBtnLoading(btn, false); return; }
        if (datos.password.length < 6) { _mostrarError('La contraseña debe tener al menos 6 caracteres.'); _setBtnLoading(btn, false); return; }
        if (!datos.numeroEmpleado)  { _mostrarError('El número de empleado es obligatorio.'); _setBtnLoading(btn, false); return; }

        try {
            const resultado = await API.Docentes.registrar(datos);
            const nombreCompleto = [datos.nombre, datos.apellidoPaterno].join(' ');
            _mostrarFeedback(`✅ Docente "<b>${nombreCompleto}</b>" registrado. Usuario: <b>${resultado.username || datos.username || datos.email.split('@')[0]}</b>`);
            form.reset();
            // Restaurar fecha de hoy
            const fi = document.getElementById('reg-fecha-ingreso');
            if (fi) fi.value = new Date().toISOString().split('T')[0];
            // Limpiar flag de username manual
            const u = document.getElementById('reg-username');
            if (u) delete u.dataset.editadoManualmente;
            cargarTablaDocentes();
        } catch (err) {
            _mostrarError(err.message);
        } finally {
            _setBtnLoading(btn, false);
        }
    });
}

// ─── Modal de edición ─────────────────────────────────────────────────────────
function abrirModalEditar(datosJson) {
    const d = (typeof datosJson === 'string') ? JSON.parse(datosJson.replace(/&quot;/g, '"').replace(/&#39;/g, "'")) : datosJson;
    docenteEnEdicion = d;

    const set    = (id, val) => { const el = document.getElementById(id); if (el) el.value = val || ''; };
    const setOpt = (id, val) => { const el = document.getElementById(id); if (el && val) el.value = val; };

    set('edit-id',           d._id);
    set('edit-nombre',       d.nombre);
    set('edit-header-nombre', [d.nombre, d.apellidoPaterno, d.apellidoMaterno].filter(Boolean).join(' '));
    set('edit-ap-paterno',   d.apellidoPaterno);
    set('edit-ap-materno',   d.apellidoMaterno);
    set('edit-email',        d.email);
    set('edit-telefono',     d.telefono);
    set('edit-rfc',          d.numeroEmpleado);
    set('edit-especialidad', d.especialidad);
    set('edit-formacion',    d.formacionProfesional);
    setOpt('edit-grado',     d.gradoAcademico);
    setOpt('edit-contrato',  d.tipoContrato);
    setOpt('edit-turno',     d.turno);
    setOpt('edit-carrera',   d.carrera);
    setOpt('edit-estatus',   d.estatus);

    document.getElementById('modal-editar-docente').style.display = 'flex';
}

function cerrarModalEditar() {
    const modal = document.getElementById('modal-editar-docente');
    if (modal) modal.style.display = 'none';
    docenteEnEdicion = null;
}

async function guardarCambios() {
    if (!docenteEnEdicion || !window.API) return;

    const btn = document.getElementById('btn-guardar-edicion');
    _setBtnLoading(btn, true, 'Guardando...');

    const get    = id => (document.getElementById(id)?.value || '').trim();
    const getOpt = id => document.getElementById(id)?.value || '';

    const datos = {
        nombre:               get('edit-nombre'),
        apellidoPaterno:      get('edit-ap-paterno'),
        apellidoMaterno:      get('edit-ap-materno'),
        email:                get('edit-email'),
        telefono:             get('edit-telefono'),
        numeroEmpleado:       get('edit-rfc'),
        especialidad:         get('edit-especialidad'),
        formacionProfesional: get('edit-formacion'),
        gradoAcademico:       getOpt('edit-grado'),
        tipoContrato:         getOpt('edit-contrato'),
        turno:                getOpt('edit-turno'),
        carrera:              getOpt('edit-carrera'),
        estatus:              getOpt('edit-estatus')
    };

    try {
        await API.Docentes.editar(docenteEnEdicion._id, datos);
        _mostrarFeedback('✅ Datos actualizados correctamente.');
        cerrarModalEditar();
        cargarTablaDocentes();
    } catch (err) {
        _mostrarFeedback(err.message, 'error');
    } finally {
        _setBtnLoading(btn, false);
    }
}

// ─── Modal de reset de contraseña ─────────────────────────────────────────────
function abrirModalReset(id, nombre) {
    document.getElementById('reset-docente-id').value = id;
    document.getElementById('reset-pass-titulo').textContent = `Restablecer contraseña de ${nombre}`;
    document.getElementById('reset-nueva-pass').value = '';
    const err = document.getElementById('reset-error');
    if (err) err.style.display = 'none';
    document.getElementById('modal-reset-pass').style.display = 'flex';
}

function cerrarModalReset() {
    const modal = document.getElementById('modal-reset-pass');
    if (modal) modal.style.display = 'none';
}

async function confirmarResetPassword() {
    const id            = document.getElementById('reset-docente-id')?.value;
    const nuevaPassword = document.getElementById('reset-nueva-pass')?.value?.trim();
    const errEl         = document.getElementById('reset-error');

    if (!nuevaPassword || nuevaPassword.length < 6) {
        if (errEl) { errEl.textContent = 'La contraseña debe tener al menos 6 caracteres.'; errEl.style.display = 'block'; }
        return;
    }
    if (errEl) errEl.style.display = 'none';

    const btn = document.getElementById('btn-confirmar-reset');
    _setBtnLoading(btn, true, 'Restableciendo...');

    try {
        const res = await API.Docentes.resetPassword(id, nuevaPassword);
        _mostrarFeedback(`✅ ${res.message || 'Contraseña restablecida correctamente.'}`, 'warning');
        cerrarModalReset();
    } catch (err) {
        if (errEl) { errEl.textContent = err.message; errEl.style.display = 'block'; }
        _mostrarFeedback(err.message, 'error');
    } finally {
        _setBtnLoading(btn, false);
    }
}

// ─── Eliminar docente ─────────────────────────────────────────────────────────
async function eliminarDocente(id, nombre) {
    if (!confirm(`¿Eliminar a "${nombre}" del sistema?\nEsta acción no se puede deshacer.`)) return;
    if (!window.API) return;

    try {
        await API.Docentes.eliminar(id);
        _mostrarFeedback(`✅ ${nombre} eliminado correctamente.`);
        cargarTablaDocentes();
    } catch (err) {
        _mostrarFeedback(err.message, 'error');
    }
}

// ─── Colapsar secciones ───────────────────────────────────────────────────────
function toggleSeccion(idCuerpo, idIcono) {
    const cuerpo = document.getElementById(idCuerpo);
    const icono  = document.getElementById(idIcono);
    if (!cuerpo) return;
    const visible = cuerpo.style.display === 'block';
    cuerpo.style.display = visible ? 'none' : 'block';
    if (icono) icono.style.transform = visible ? 'rotate(-90deg)' : 'rotate(0deg)';
}

// ─── Cerrar modales al clic fuera ─────────────────────────────────────────────
window.addEventListener('click', (e) => {
    const modalEditar = document.getElementById('modal-editar-docente');
    const modalReset  = document.getElementById('modal-reset-pass');
    if (modalEditar && e.target === modalEditar) cerrarModalEditar();
    if (modalReset  && e.target === modalReset)  cerrarModalReset();
});