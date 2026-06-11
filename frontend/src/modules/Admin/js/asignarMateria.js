// asignarMateria.js

let selectedMateria = null;
let selectedDocente = null;

async function cargarMateriasAsignacion() {
    const listContainer = document.querySelector('.materias-flex-list');
    if (!listContainer) return;
    listContainer.innerHTML = '<p style="color: #64748b;"><i class="bx bx-loader-alt bx-spin"></i> Cargando materias...</p>';

    try {
        const res = await fetch('../../../services/listar_materias.php');
        const materias = await res.json();

        listContainer.innerHTML = '';
        if (materias.length === 0) {
            listContainer.innerHTML = '<p style="color: #64748b;">No hay materias registradas.</p>';
            return;
        }

        materias.forEach(mat => {
            const div = document.createElement('div');
            div.className = 'item-selection';
            div.innerHTML = `
                <strong>${mat.nombre}</strong>
                <small>${mat.semestre || 'Semestre Único'} • ${mat.creditos || 0} Créditos</small>
            `;
            div.onclick = () => seleccionarMateria(div, mat);
            listContainer.appendChild(div);
        });
    } catch (e) {
        listContainer.innerHTML = '<p style="color:red;">Error al cargar materias.</p>';
    }
}

async function cargarDocentesAsignacion() {
    const listContainer = document.querySelector('.docentes-flex-list');
    if (!listContainer) return;
    listContainer.innerHTML = '<p style="color: #64748b;"><i class="bx bx-loader-alt bx-spin"></i> Cargando docentes...</p>';

    try {
        const GATEWAY = 'http://localhost:3000/api';
        const res = await fetch(`${GATEWAY}/docentes`);
        const json = await res.json();
        const docentes = json.data || [];

        listContainer.innerHTML = '';
        if (docentes.length === 0) {
            listContainer.innerHTML = '<p style="color: #64748b;">No hay docentes registrados.</p>';
            return;
        }

        docentes.forEach(doc => {
            const div = document.createElement('div');
            div.className = 'user-card';
            div.innerHTML = `
                <div class="user-img"><i class='bx bxs-user-circle'></i></div>
                <div class="user-info">
                    <p class="u-name">${doc.nombre}</p>
                    <p class="u-email">${doc.email}</p>
                    <span class="badge load-low">${doc.especialidad || 'Sin especialidad'}</span>
                </div>
                <div class="check-icon"><i class='bx bxs-check-circle'></i></div>
            `;
            div.onclick = () => seleccionarDocente(div, doc);
            listContainer.appendChild(div);
        });
    } catch (e) {
        listContainer.innerHTML = '<p style="color:red;">Error al cargar docentes.</p>';
    }
}

function seleccionarMateria(element, mat) {
    document.querySelectorAll('.materias-flex-list .item-selection').forEach(e => e.classList.remove('selected'));
    element.classList.add('selected');
    selectedMateria = mat;
    actualizarResumen();
}

function seleccionarDocente(element, doc) {
    document.querySelectorAll('.docentes-flex-list .user-card').forEach(e => e.classList.remove('selected'));
    element.classList.add('selected');
    selectedDocente = doc;
    actualizarResumen();
}

function actualizarResumen() {
    const summary = document.querySelector('.summary-area');
    if (!summary) return;
    const nomMat = selectedMateria ? selectedMateria.nombre : '<i>No seleccionada</i>';
    const nomDoc = selectedDocente ? selectedDocente.nombre : '<i>No seleccionado</i>';
    summary.innerHTML = `
        <div class="summary-item"><strong>Materia:</strong> ${nomMat}</div>
        <div class="summary-item"><strong>Docente:</strong> ${nomDoc}</div>
    `;
}

function togglePanel(panelId) {
    const panel = document.getElementById(panelId);
    if (panel) panel.classList.toggle('active');
}

async function finalizarAsignacion() {
    if (!selectedMateria || !selectedDocente) {
        alert("Por favor selecciona una materia en el Paso 1 y un docente en el Paso 2.");
        return;
    }

    const grupo = document.getElementById('asignar-grupo').value.trim();
    const aula = document.getElementById('asignar-aula').value.trim();
    const horario = document.getElementById('asignar-horario').value.trim();

    if (!grupo || !aula || !horario) {
        alert("Llena los campos de Grupo, Aula y Horario en el Paso 3.");
        return;
    }

    const payload = {
        materia: selectedMateria.nombre,
        clave: selectedMateria.clave || 'SIN-CLAVE',
        docente: selectedDocente.nombre,
        docenteId: selectedDocente._id,
        grupo: grupo,
        aula: aula,
        horario: horario
    };

    const btn = document.getElementById('btn-confirm-asignacion');
    const oldText = btn.innerHTML;
    btn.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i> Procesando...";
    btn.disabled = true;

    try {
        const res = await fetch('../../../services/registrar_asignacion.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        });
        const data = await res.json();

        if (data.success) {
            alert("✅ " + data.message);
            reiniciarAsignacion();
        } else {
            alert("⚠️ Error: " + data.message);
        }
    } catch (e) {
        alert("❌ Hubo un problema de conexión al registrar la asignación.");
    } finally {
        btn.innerHTML = oldText;
        btn.disabled = false;
    }
}

function reiniciarAsignacion() {
    selectedMateria = null;
    selectedDocente = null;
    document.querySelectorAll('.item-selection').forEach(e => e.classList.remove('selected'));
    document.querySelectorAll('.user-card').forEach(e => e.classList.remove('selected'));
    document.getElementById('asignar-grupo').value = '';
    document.getElementById('asignar-aula').value = '';
    document.getElementById('asignar-horario').value = '';
    actualizarResumen();
    if (typeof cargarTablaAsignaciones === 'function') {
        cargarTablaAsignaciones();
    }
}

// Configurar buscador
setTimeout(() => {
    const searchInput = document.querySelector('.search-box input');
    if (searchInput) {
        searchInput.addEventListener('keyup', (e) => {
            const query = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('.docentes-flex-list .user-card');
            cards.forEach(card => {
                const name = card.querySelector('.u-name').textContent.toLowerCase();
                card.style.display = name.includes(query) ? 'flex' : 'none';
            });
        });
    }
}, 500);

async function cargarTablaAsignaciones() {
    const tbody = document.getElementById('lista-asignaciones-body');
    if (!tbody) return;

    tbody.innerHTML = '<tr><td colspan="5" style="text-align:center; padding:20px;"><i class="bx bx-loader-alt bx-spin"></i> Cargando asignaciones...</td></tr>';
    try {
        const res = await fetch('../../../services/listar_asignaciones.php');
        const json = await res.json();

        if (!json.success || !json.data || json.data.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5" style="text-align:center; padding:20px; color:#64748b;">No hay asignaciones registradas.</td></tr>';
            return;
        }

        let filas = '';
        json.data.forEach(asig => {
            const asigStr = JSON.stringify(asig).replace(/'/g, "&#39;").replace(/"/g, "&quot;");
            filas += `
            <tr style="border-bottom:1px solid #e2e8f0;">
                <td style="padding:12px;"><strong>${asig.materia}</strong><br><small>${asig.clave}</small></td>
                <td style="padding:12px;">${asig.docente}</td>
                <td style="padding:12px;">${asig.grupo}<br><small>${asig.aula}</small></td>
                <td style="padding:12px;">${asig.horario}</td>
                <td style="padding:12px; text-align:center;">
                    <button onclick="editarAsignacion('${asigStr}')" style="background:none; border:none; color:#3b82f6; cursor:pointer; font-size:1.2rem; margin-right:10px;"><i class='bx bx-edit'></i></button>
                    <button onclick="eliminarAsignacion('${asig.id}')" style="background:none; border:none; color:#dc2626; cursor:pointer; font-size:1.2rem;"><i class='bx bx-trash'></i></button>
                </td>
            </tr>`;
        });
        tbody.innerHTML = filas;
    } catch (e) {
        tbody.innerHTML = '<tr><td colspan="5" style="text-align:center; color:red;">Error al cargar las asignaciones.</td></tr>';
    }
}

function editarAsignacion(asigJson) {
    const asig = JSON.parse(asigJson);
    document.getElementById('edit-asig-id').value = asig.id;
    document.getElementById('edit-asig-grupo').value = asig.grupo;
    document.getElementById('edit-asig-aula').value = asig.aula;
    document.getElementById('edit-asig-horario').value = asig.horario;
    document.getElementById('modal-editar-asignacion').style.display = 'flex';
}

async function guardarEdicionAsignacion() {
    const id = document.getElementById('edit-asig-id').value;
    const grupo = document.getElementById('edit-asig-grupo').value;
    const aula = document.getElementById('edit-asig-aula').value;
    const horario = document.getElementById('edit-asig-horario').value;

    try {
        const res = await fetch('../../../services/editar_asignacion.php', {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id, grupo, aula, horario })
        });
        const data = await res.json();
        if (data.success) {
            alert('✅ ' + data.message);
            document.getElementById('modal-editar-asignacion').style.display = 'none';
            cargarTablaAsignaciones();
        } else {
            alert('⚠️ ' + data.message);
        }
    } catch (e) {
        alert('❌ Error de conexión al editar.');
    }
}

async function eliminarAsignacion(id) {
    if (!confirm('¿Seguro que deseas eliminar esta asignación?')) return;
    try {
        const res = await fetch('../../../services/eliminar_asignacion.php?id=' + id, { method: 'DELETE' });
        const data = await res.json();
        if (data.success) {
            alert('✅ ' + data.message);
            cargarTablaAsignaciones();
        } else {
            alert('⚠️ ' + data.message);
        }
    } catch (e) {
        alert('❌ Error de conexión al eliminar.');
    }
}

// Iniciar
cargarMateriasAsignacion();
cargarDocentesAsignacion();
actualizarResumen();
cargarTablaAsignaciones();