/**
 * carga.js
 * Módulo de Carga Académica — Gestión de Docentes.
 * Se carga dinámicamente dentro del dashboard de Admin.
 * Usa window.API (apiGateway.js) para comunicarse con el backend.
 */

// ─── Estado del módulo ────────────────────────────────────────────────────────
var docenteEnEdicion = null;

// ─── Bootstrap: carga apiGateway.js dinámicamente si falta ────────────────
if (!window.API) {
    console.log('[Carga] apiGateway.js no detectado. Cargando dinámicamente...');
    const s = document.createElement('script');
    s.src = '/frontend/src/js/apiGateway.js';
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
    console.log('[Carga] Módulo inicializado.');
    _sincronizarNombreModal();
    _registrarEventos();
    cargarTablaDocentes();
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
    const colores = { success: '#059669', error: '#dc2626', info: '#6366f1' };
    const toast   = Object.assign(document.createElement('div'), {
        textContent: mensaje,
        style: [
            'position:fixed;top:20px;right:20px;z-index:99999',
            'padding:12px 20px;border-radius:10px;color:#fff;font-weight:700',
            `background:${colores[tipo] || colores.info}`,
            'box-shadow:0 4px 20px rgba(0,0,0,.2)',
            'transition:opacity .4s;font-family:inherit'
        ].join(';')
    });
    document.body.appendChild(toast);
    setTimeout(() => { toast.style.opacity = '0'; setTimeout(() => toast.remove(), 400); }, 3500);
}

function _mostrarError(msg) {
    const errDiv = document.getElementById('reg-error');
    if (errDiv) {
        errDiv.textContent  = msg;
        errDiv.style.display = 'block';
        setTimeout(() => errDiv.style.display = 'none', 5000);
    }
    _mostrarFeedback(msg, 'error');
}

function _setBtnLoading(btn, loading) {
    if (!btn) return;
    if (loading) {
        btn.disabled     = true;
        btn.dataset.orig = btn.innerHTML;
        btn.innerHTML    = "<i class='bx bx-loader-alt bx-spin'></i> Registrando...";
    } else {
        btn.disabled  = false;
        btn.innerHTML = btn.dataset.orig || 'Registrar Docente';
    }
}

// ─── Tabla de docentes ────────────────────────────────────────────────────────

function cargarTablaDocentes() {
    const tbody = document.getElementById('tabla-docentes-body');
    if (!tbody) return;

    if (!window.API) {
        tbody.innerHTML = `<tr><td colspan="6" style="text-align:center;padding:20px;color:#dc2626;">
            API Gateway no disponible. Verifica que el servidor esté corriendo en :3000.
        </td></tr>`;
        return;
    }

    tbody.innerHTML = `<tr><td colspan="6" style="text-align:center;padding:20px;">
        <i class='bx bx-loader-alt bx-spin'></i> Cargando docentes...
    </td></tr>`;

    API.Docentes.listar()
        .then(data => {
            const lista = Array.isArray(data) ? data : (data?.data || []);
            _renderTabla(tbody, lista);
        })
        .catch(err => {
            console.error('[Carga] Error al listar docentes:', err);
            tbody.innerHTML = `<tr><td colspan="6" style="text-align:center;padding:20px;color:#dc2626;">
                <i class='bx bx-error'></i> ${err.message}
            </td></tr>`;
        });
}

function _renderTabla(tbody, docentes) {
    if (!docentes.length) {
        tbody.innerHTML = `<tr><td colspan="6" style="text-align:center;padding:25px;color:#94a3b8;">
            <i class='bx bx-info-circle' style="font-size:1.5rem;display:block;margin-bottom:8px;"></i>
            No hay docentes registrados aún.
        </td></tr>`;
        return;
    }

    tbody.innerHTML = docentes.map(d => {
        // Escapar comillas dobles y simples para que HTML no se rompa
        const jsonSeguro = JSON.stringify(d).replace(/'/g, "&#39;").replace(/"/g, "&quot;");
        return `
        <tr>
            <td><b>${d.nombre || '—'}</b></td>
            <td>${d.email || '—'}</td>
            <td>${d.username || '—'}</td>
            <td>${d.numeroEmpleado || d.rfc || '—'}</td>
            <td>${d.especialidad || d.carrera || '—'}</td>
            <td>
                <div class="acciones-group-flex">
                    <button class="btn-action-view"
                        onclick="abrirModalEditar('${jsonSeguro}')"
                        title="Editar docente">
                        <i class='bx bx-edit-alt'></i>
                    </button>
                    <button class="btn-action-delete"
                        onclick="eliminarDocente('${d._id}', '${(d.nombre || '').replace(/'/g, "\\'")}')"
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
    // Usamos delegación de eventos para evitar que se pierda el listener cuando 
    // se recarga dinámicamente el HTML de carga.php
    if (document.body.dataset.cargaListenerAttached) return;
    document.body.dataset.cargaListenerAttached = 'true';

    document.addEventListener('submit', async (e) => {
        const form = e.target;
        if (form && form.id === 'form-registrar-docente') {
            e.preventDefault();

            if (!window.API) {
                _mostrarError('API Gateway no disponible. Verifica que el servidor esté en :3000.');
                return;
            }

            const btn = document.getElementById('btn-registrar-docente');
            _setBtnLoading(btn, true);

            const datos = {
                nombre:         (document.getElementById('reg-nombre')?.value || '').trim(),
                email:          (document.getElementById('reg-email')?.value || '').trim(),
                password:       (document.getElementById('reg-password')?.value || '').trim(),
                numeroEmpleado: (document.getElementById('reg-numero-empleado')?.value || '').trim(),
                especialidad:   (document.getElementById('reg-especialidad')?.value || '').trim(),
                username:       (document.getElementById('reg-username')?.value || '').trim(),
                carrera:        (document.getElementById('reg-carrera')?.value || '').trim()
            };

            // Validaciones mínimas locales
            if (!datos.nombre)    { _mostrarError('El nombre es obligatorio.');           _setBtnLoading(btn, false); return; }
            if (!datos.email)     { _mostrarError('El email es obligatorio.');             _setBtnLoading(btn, false); return; }
            if (!datos.password)  { _mostrarError('La contraseña inicial es obligatoria.'); _setBtnLoading(btn, false); return; }

            console.log('[Carga] Registrando docente:', datos.nombre, datos.email);

            try {
                const resultado = await API.Docentes.registrar(datos);
                console.log('[Carga] Docente registrado:', resultado);
                _mostrarFeedback(`✅ Docente "${datos.nombre}" registrado exitosamente.`);
                form.reset();
                cargarTablaDocentes();
            } catch (err) {
                console.error('[Carga] Error al registrar:', err);
                _mostrarError(err.message);
            } finally {
                _setBtnLoading(btn, false);
            }
        }
    });
}

// ─── Modal de edición ─────────────────────────────────────────────────────────

function abrirModalEditar(datosJson) {
    const datos = (typeof datosJson === 'string') ? JSON.parse(datosJson) : datosJson;
    docenteEnEdicion = datos;

    const set = (id, val) => {
        const el = document.getElementById(id);
        if (el) el.value = val || '';
    };

    set('edit-id',            datos._id);
    set('edit-nombre',        datos.nombre);
    set('edit-header-nombre', datos.nombre);
    set('edit-email',         datos.email);
    set('edit-rfc',           datos.numeroEmpleado || datos.rfc);
    set('edit-carrera',       datos.especialidad || datos.carrera);

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
    if (btn) {
        btn.disabled  = true;
        btn.dataset.orig = btn.innerHTML;
        btn.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i> Guardando...";
    }

    const datos = {
        nombre:         (document.getElementById('edit-nombre')?.value || '').trim(),
        email:          (document.getElementById('edit-email')?.value  || '').trim(),
        especialidad:   (document.getElementById('edit-carrera')?.value || '').trim(),
        numeroEmpleado: (document.getElementById('edit-rfc')?.value     || '').trim()
    };

    try {
        await API.Docentes.editar(docenteEnEdicion._id, datos);
        _mostrarFeedback('✅ Datos actualizados correctamente.');
        cerrarModalEditar();
        cargarTablaDocentes();
    } catch (err) {
        _mostrarFeedback(err.message, 'error');
    } finally {
        if (btn) { btn.disabled = false; btn.innerHTML = btn.dataset.orig || 'Guardar Cambios'; }
    }
}

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

// ─── Cerrar modal al clic fuera ───────────────────────────────────────────────
window.addEventListener('click', (e) => {
    const modal = document.getElementById('modal-editar-docente');
    if (modal && e.target === modal) cerrarModalEditar();
});