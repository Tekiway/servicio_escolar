/**
 * agregarMateria.js
 * Lógica para el registro y gestión de la retícula de materias.
 */

// Estado global
var materiaEnEdicion = null;

// Bootstrap
if (document.readyState !== 'loading') {
    _inicializarMaterias();
} else {
    document.addEventListener('DOMContentLoaded', _inicializarMaterias);
}

function _inicializarMaterias() {
    console.log('[Materias] Módulo inicializado.');
    // Validar que exista el objeto API y específicamente el nuevo submódulo Materias
    if (!window.API || !window.API.Materias) {
        console.log('[Materias] apiGateway.js incompleto o no detectado. Forzando recarga sin caché...');
        const s = document.createElement('script');
        s.src = '/frontend/src/js/apiGateway.js?v=' + Date.now(); // Forzar siempre la última versión
        s.onload = () => {
            _configurarEventosMaterias();
            cargarTablaMaterias();
        };
        document.head.appendChild(s);
    } else {
        _configurarEventosMaterias();
        cargarTablaMaterias();
    }
}

// ─── Utilidades UI ────────────────────────────────────────────────────────────

function _mostrarFeedback(mensaje, tipo = 'success') {
    const colores = { success: '#059669', error: '#dc2626', info: '#6366f1' };
    const toast = document.createElement('div');
    toast.textContent = mensaje;
    Object.assign(toast.style, {
        position: 'fixed', top: '20px', right: '20px', zIndex: '99999',
        padding: '12px 20px', borderRadius: '10px', color: '#fff', fontWeight: '700',
        background: colores[tipo] || colores.info,
        boxShadow: '0 4px 20px rgba(0,0,0,.2)', transition: 'opacity .4s', fontFamily: 'inherit'
    });
    document.body.appendChild(toast);
    setTimeout(() => { toast.style.opacity = '0'; setTimeout(() => toast.remove(), 400); }, 3500);
}

function _setBtnLoading(btn, loading) {
    if (!btn) return;
    if (loading) {
        btn.disabled = true;
        btn.dataset.orig = btn.innerHTML;
        btn.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i> Guardando...";
    } else {
        btn.disabled = false;
        btn.innerHTML = btn.dataset.orig || 'Guardar';
    }
}

// ─── Unidades Temáticas ───────────────────────────────────────────────────────

function _agregarFilaUnidad(unidad = {}) {
    const container = document.getElementById('unidades-container');
    if (!container) return;

    const num = container.children.length + 1;
    const div = document.createElement('div');
    div.className = 'unidad-card';
    div.style.background = '#f8fafc';
    div.style.border = '1px solid #e2e8f0';
    div.style.padding = '15px';
    div.style.borderRadius = '8px';
    div.style.marginBottom = '15px';
    div.style.position = 'relative';

    div.innerHTML = `
        <div style="font-weight: 600; color: #475569; margin-bottom: 10px;">Unidad <span class="unidad-num">${num}</span></div>
        <button type="button" class="btn-eliminar-unidad" style="position: absolute; top: 15px; right: 15px; background: #fee2e2; color: #dc2626; border: none; padding: 5px 10px; border-radius: 6px; cursor: pointer;">
            <i class='bx bx-trash'></i> Quitar
        </button>
        <div style="display: flex; flex-direction: column; gap: 10px;">
            <input type="text" class="input-unidad-tema" placeholder="Nombre o tema central de la unidad..." value="${unidad.tema || ''}" style="padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;" required>
            <textarea class="input-unidad-objetivo" placeholder="Objetivo de la unidad..." style="padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; resize: vertical;" rows="2">${unidad.objetivo || ''}</textarea>
            <textarea class="input-unidad-competencia" placeholder="Competencia específica..." style="padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; resize: vertical;" rows="2">${unidad.competencia || ''}</textarea>
            <textarea class="input-unidad-subtemas" placeholder="Escribe los subtemas separados por comas o renglones..." style="padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; resize: vertical;" rows="2">${unidad.subtemas || ''}</textarea>
            <textarea class="input-unidad-observaciones" placeholder="Observaciones..." style="padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; resize: vertical;" rows="2">${unidad.observaciones || ''}</textarea>
        </div>
    `;

    div.querySelector('.btn-eliminar-unidad').addEventListener('click', () => {
        div.remove();
        // Renumerar las unidades restantes
        Array.from(container.children).forEach((card, index) => {
            card.querySelector('.unidad-num').textContent = index + 1;
        });
        // Actualizar el número de unidades en el input si existe
        const inputNumUnidades = document.getElementById('num-unidades');
        if (inputNumUnidades) {
            inputNumUnidades.value = container.children.length;
        }
    });
    
    container.appendChild(div);
}

// ─── Carga de Datos y Eventos ─────────────────────────────────────────────────

function _configurarEventosMaterias() {
    const form = document.getElementById('form-agregar-materia');
    const btnAddUnidad = document.getElementById('btn-agregar-unidad');

    // Acordeón UI
    document.querySelectorAll('.accordion-header').forEach(header => {
        if (header.dataset.listener) return;
        header.dataset.listener = 'true';
        header.addEventListener('click', () => {
            const targetId = header.getAttribute('data-target');
            const content = document.getElementById(targetId);
            if (content) {
                content.classList.toggle('open');
                header.classList.toggle('active');
            }
        });
    });

    if (btnAddUnidad && !btnAddUnidad.dataset.listener) {
        btnAddUnidad.dataset.listener = 'true';
        btnAddUnidad.addEventListener('click', () => {
            _agregarFilaUnidad();
            const inputNumUnidades = document.getElementById('num-unidades');
            const container = document.getElementById('unidades-container');
            if (inputNumUnidades && container) {
                inputNumUnidades.value = container.children.length;
            }
        });
    }

    const inputNumUnidades = document.getElementById('num-unidades');
    if (inputNumUnidades && !inputNumUnidades.dataset.listener) {
        inputNumUnidades.dataset.listener = 'true';
        inputNumUnidades.addEventListener('input', (e) => {
            const num = parseInt(e.target.value) || 0;
            const container = document.getElementById('unidades-container');
            if (!container) return;
            const currentCount = container.children.length;
            
            if (num > currentCount) {
                for (let i = 0; i < num - currentCount; i++) {
                    _agregarFilaUnidad();
                }
            } else if (num < currentCount && num >= 0) {
                for (let i = 0; i < currentCount - num; i++) {
                    if (container.lastChild) {
                        container.removeChild(container.lastChild);
                    }
                }
            }
        });
    }

    if (form && !form.dataset.listener) {
        form.dataset.listener = 'true';
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const btnSubmit = form.querySelector('[type="submit"]');
            _setBtnLoading(btnSubmit, true);

            // Recopilar datos
            const formData = new FormData(form);
            const unidadesCards = form.querySelectorAll('.unidad-card');
            const unidades = Array.from(unidadesCards).map(card => ({
                tema: card.querySelector('.input-unidad-tema').value.trim(),
                objetivo: card.querySelector('.input-unidad-objetivo').value.trim(),
                competencia: card.querySelector('.input-unidad-competencia').value.trim(),
                subtemas: card.querySelector('.input-unidad-subtemas').value.trim(),
                observaciones: card.querySelector('.input-unidad-observaciones').value.trim()
            })).filter(u => u.tema);

            const datos = {
                carrera: formData.get('carrera_materia'),
                semestre: formData.get('semestre_materia'),
                tipo_materia: formData.get('tipo_materia'),
                nombre: formData.get('nombre_materia'),
                clave: formData.get('clave_materia'),
                descripcion: formData.get('descripcion_materia'),
                horas_teoricas: parseInt(formData.get('horas_teoricas')) || 0,
                horas_practicas: parseInt(formData.get('horas_practicas')) || 0,
                total_horas: (parseInt(formData.get('horas_teoricas')) || 0) + (parseInt(formData.get('horas_practicas')) || 0),
                creditos: parseInt(formData.get('creditos')) || 0,
                clasificacion_academica: formData.get('clasificacion_academica'),
                area_conocimiento: formData.get('area_conocimiento'),
                modalidad: formData.get('modalidad'),
                competencia_general: formData.get('competencia_general'),
                competencias_especificas: formData.get('competencias_especificas'),
                objetivo_general: formData.get('objetivo_materia') || formData.get('objetivo_general'),
                prerrequisitos: formData.get('prerrequisitos'),
                estado: formData.get('estado') || 'Activa',
                version_programa: formData.get('version_programa'),
                fecha_creacion: formData.get('fecha_creacion'),
                observaciones: formData.get('observaciones'),
                unidades: unidades
            };

            try {
                if (materiaEnEdicion) {
                    await API.Materias.editar(materiaEnEdicion._id, datos);
                    _mostrarFeedback('✅ Materia actualizada correctamente.');
                    materiaEnEdicion = null;
                    btnSubmit.innerHTML = "<i class='bx bx-save'></i> Guardar Materia en Retícula";
                } else {
                    await API.Materias.registrar(datos);
                    _mostrarFeedback(`✅ Materia "${datos.nombre}" registrada correctamente.`);
                }
                
                form.reset();
                document.getElementById('unidades-container').innerHTML = '';
                cargarTablaMaterias();
                
                // Cerrar acordeón de formulario y abrir de tabla
                const accordionForm = document.getElementById('form-registro');
                if (accordionForm) accordionForm.classList.remove('open');
                const accordionTabla = document.getElementById('tabla-registros');
                if (accordionTabla) accordionTabla.classList.add('open');
            } catch (err) {
                _mostrarFeedback(err.message, 'error');
            } finally {
                _setBtnLoading(btnSubmit, false);
            }
        });
    }
}

// ─── Tabla de Materias ────────────────────────────────────────────────────────

async function cargarTablaMaterias() {
    const tbody = document.getElementById('lista-materias-body');
    if (!tbody || !window.API) return;

    tbody.innerHTML = `<tr><td colspan="5" style="text-align:center;padding:20px;">
        <i class='bx bx-loader-alt bx-spin'></i> Cargando materias...
    </td></tr>`;

    try {
        const res = await API.Materias.listar();
        const lista = Array.isArray(res) ? res : (res?.data || []);
        
        if (!lista.length) {
            tbody.innerHTML = `<tr><td colspan="5" style="text-align:center;padding:25px;color:#94a3b8;">
                <i class='bx bx-info-circle' style="font-size:1.5rem;display:block;margin-bottom:8px;"></i>
                No hay materias registradas aún en la retícula.
            </td></tr>`;
            return;
        }

        tbody.innerHTML = lista.map(m => {
            const jsonSeguro = JSON.stringify(m).replace(/'/g, "&#39;").replace(/"/g, "&quot;");
            return `
            <tr>
                <td>
                    <div style="font-weight:700; color:#4f46e5;">${m.clave || '—'}</div>
                    <div style="font-size:0.75rem; color:#64748b; margin-top:2px;">${m.modalidad || 'Presencial'}</div>
                </td>
                <td>
                    <div style="font-weight:600; color:#1e293b; margin-bottom:4px;">${m.nombre || '—'}</div>
                    <div style="font-size:0.8rem; color:#64748b;">
                        <span style="background:#f1f5f9; padding:2px 6px; border-radius:4px; margin-right:5px;">${m.creditos || 0} Créditos</span>
                        <span style="background:#f1f5f9; padding:2px 6px; border-radius:4px;">${m.total_horas || 0} Horas</span>
                    </div>
                </td>
                <td>
                    <div style="color:#334155;">${m.carrera || '—'}</div>
                    <div style="font-size:0.8rem; color:#94a3b8; margin-top:2px;">${m.semestre ? m.semestre + 'º Semestre' : '—'}</div>
                </td>
                <td>
                    <span style="padding:4px 8px; border-radius:20px; font-size:0.75rem; font-weight:700; background: ${m.estado === 'Inactiva' ? '#fee2e2' : '#dcfce7'}; color: ${m.estado === 'Inactiva' ? '#dc2626' : '#16a34a'};">
                        ${m.estado || 'Activa'}
                    </span>
                </td>
                <td style="text-align: center;">
                    <button class="btn-edit" style="background:transparent; border:none; cursor:pointer; color:#6366f1; font-size:1.4rem; margin-right:8px; transition:0.2s;"
                        onclick="editarMateria('${jsonSeguro}')" title="Editar Materia">
                        <i class='bx bx-edit-alt'></i>
                    </button>
                    <button class="btn-delete" style="background:transparent; border:none; cursor:pointer; color:#dc2626; font-size:1.4rem; transition:0.2s;"
                        onclick="eliminarMateria('${m._id}', '${(m.nombre || '').replace(/'/g, "\\'")}')" title="Eliminar Materia">
                        <i class='bx bx-trash'></i>
                    </button>
                </td>
            </tr>`;
        }).join('');
    } catch (err) {
        tbody.innerHTML = `<tr><td colspan="5" style="text-align:center;padding:20px;color:#dc2626;">
            <i class='bx bx-error'></i> Error: ${err.message}
        </td></tr>`;
    }
}

// ─── Acciones de Fila ─────────────────────────────────────────────────────────

function editarMateria(datosJson) {
    const m = JSON.parse(datosJson);
    materiaEnEdicion = m;

    const form = document.getElementById('form-agregar-materia');
    if (!form) return;

    // Llenar campos con seguridad
    if(form.querySelector('[name="carrera_materia"]')) form.querySelector('[name="carrera_materia"]').value = m.carrera || '';
    if(form.querySelector('[name="semestre_materia"]')) form.querySelector('[name="semestre_materia"]').value = m.semestre || '';
    if(form.querySelector('[name="tipo_materia"]')) form.querySelector('[name="tipo_materia"]').value = m.tipo_materia || 'Obligatoria';
    if(form.querySelector('[name="nombre_materia"]')) form.querySelector('[name="nombre_materia"]').value = m.nombre || '';
    if(form.querySelector('[name="clave_materia"]')) form.querySelector('[name="clave_materia"]').value = m.clave || '';
    if(form.querySelector('[name="horas_teoricas"]')) form.querySelector('[name="horas_teoricas"]').value = m.horas_teoricas || '';
    if(form.querySelector('[name="horas_practicas"]')) form.querySelector('[name="horas_practicas"]').value = m.horas_practicas || '';
    if(form.querySelector('[name="creditos"]')) form.querySelector('[name="creditos"]').value = m.creditos || '';
    if(form.querySelector('[name="objetivo_materia"]')) form.querySelector('[name="objetivo_materia"]').value = m.objetivo_general || m.objetivo_materia || '';
    if(form.querySelector('[name="descripcion_materia"]')) form.querySelector('[name="descripcion_materia"]').value = m.descripcion || '';
    if(form.querySelector('[name="clasificacion_academica"]')) form.querySelector('[name="clasificacion_academica"]').value = m.clasificacion_academica || '';
    if(form.querySelector('[name="area_conocimiento"]')) form.querySelector('[name="area_conocimiento"]').value = m.area_conocimiento || '';
    if(form.querySelector('[name="modalidad"]')) form.querySelector('[name="modalidad"]').value = m.modalidad || 'Presencial';
    if(form.querySelector('[name="competencia_general"]')) form.querySelector('[name="competencia_general"]').value = m.competencia_general || '';
    if(form.querySelector('[name="competencias_especificas"]')) form.querySelector('[name="competencias_especificas"]').value = m.competencias_especificas || '';
    if(form.querySelector('[name="prerrequisitos"]')) form.querySelector('[name="prerrequisitos"]').value = m.prerrequisitos || '';
    if(form.querySelector('[name="estado"]')) form.querySelector('[name="estado"]').value = m.estado || 'Activa';
    if(form.querySelector('[name="version_programa"]')) form.querySelector('[name="version_programa"]').value = m.version_programa || '';
    if(form.querySelector('[name="observaciones"]')) form.querySelector('[name="observaciones"]').value = m.observaciones || '';

    // Llenar unidades
    const container = document.getElementById('unidades-container');
    container.innerHTML = '';
    if (m.unidades && m.unidades.length) {
        m.unidades.forEach(u => _agregarFilaUnidad(u));
    }

    // Cambiar botón a Actualizar
    const btnSubmit = form.querySelector('[type="submit"]');
    btnSubmit.innerHTML = "<i class='bx bx-edit'></i> Actualizar Materia";
    
    // Abrir acordeón del formulario
    const accordionForm = document.getElementById('form-registro');
    if (accordionForm) accordionForm.classList.add('open');
    const accordionTabla = document.getElementById('tabla-registros');
    if (accordionTabla) accordionTabla.classList.remove('open');
    
    // Scroll arriba
    form.scrollIntoView({ behavior: 'smooth' });
}

async function eliminarMateria(id, nombre) {
    if (!confirm(`¿Estás seguro de eliminar la materia "${nombre}"?\nEsta acción la quitará de la retícula.`)) return;

    try {
        await API.Materias.eliminar(id);
        _mostrarFeedback(`✅ Materia eliminada correctamente.`);
        cargarTablaMaterias();
    } catch (err) {
        _mostrarFeedback(err.message, 'error');
    }
}