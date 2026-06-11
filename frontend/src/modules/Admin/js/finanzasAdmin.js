async function cargarFinanzas() {
    try {
        const directivos = await window.API.Directivos.listar();
        const tbody = document.getElementById('tabla-finanzas-body');
        tbody.innerHTML = '';

        // Filtrar solo los del área de finanzas
        const finanzas = directivos.filter(d => d.area === 'Finanzas');

        if (!finanzas || finanzas.length === 0) {
            tbody.innerHTML = '<tr><td colspan="6" style="text-align:center; padding: 20px; color: #64748b;">No hay personal financiero registrado.</td></tr>';
            return;
        }

        finanzas.forEach(f => {
            const statusColor = f.estatus === 'Activo' ? '#d1fae5' : '#f1f5f9';
            const statusText = f.estatus === 'Activo' ? '#065f46' : '#64748b';
            
            tbody.innerHTML += `
                <tr>
                    <td><b>${f.nombre} ${f.apellidoPaterno}</b></td>
                    <td>${f.numeroEmpleado}<br><small>${f.email}</small></td>
                    <td>${f.departamento || 'Cajero'}<br>
                        <small style="color:#2563eb;font-weight:600;">Usr: ${f.username || 'N/A'}</small><br>
                        <small style="color:#d97706;font-weight:600;">Pass: ${f.password || '***'}</small>
                    </td>
                    <td>${f.cargo}</td>
                    <td><span style="background:${statusColor};color:${statusText};padding:3px 10px;border-radius:20px;font-size:0.78rem;font-weight:700;">${f.estatus || 'Activo'}</span></td>
                    <td>
                        <div class="acciones-group-flex">
                            <button class="btn-action-view" title="Editar Datos" onclick="abrirModalDatosFinanzas('${encodeURIComponent(JSON.stringify(f))}')"><i class='bx bx-edit-alt'></i></button>
                            <button class="btn-action-view" style="background:rgba(245,158,11,.15);color:#d97706;" title="Cambiar Accesos" onclick="abrirModalAccesosFinanzas('${f._id}', '${f.username}')"><i class='bx bx-lock-open-alt'></i></button>
                            <button class="btn-action-delete" title="Eliminar Personal" onclick="eliminarFinanzas('${f._id}')"><i class='bx bx-trash'></i></button>
                        </div>
                    </td>
                </tr>
            `;
        });
    } catch (error) {
        console.error("Error al cargar finanzas:", error);
    }
}

async function registrarPersonalFinanzas() {
    const btn = document.querySelector('.btn-registrar-docente');
    const elements = document.querySelectorAll('#form-reg-personal input, #form-reg-personal select');
    
    // Separar nombre
    const full = elements[0].value.split(' ');
    const name = full[0] || '';
    const lastName = full.slice(1).join(' ') || '';

    const datos = {
        nombre: name,
        apellidoPaterno: lastName || 'N/A',
        numeroEmpleado: elements[1].value,
        telefono: elements[2].value || '0000000000',
        departamento: 'Finanzas', // Siempre Finanzas
        cargo: elements[3].value,
        email: elements[4].value,
        username: elements[5].value,
        password: elements[6].value,
        area: 'Finanzas',
        fechaIngreso: new Date()
    };

    if (!datos.nombre || !datos.username || !datos.password) {
        return alert("Por favor llena Nombre, Usuario y Contraseña.");
    }

    btn.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i> Registrando...";
    
    try {
        await window.API.Directivos.registrar(datos);
        alert("Personal financiero registrado exitosamente.");
        cargarFinanzas();
        document.querySelector('.form-carga-grid').reset();
    } catch(err) {
        alert("Error al registrar: " + err.message);
    } finally {
        btn.innerHTML = "<i class='bx bx-save'></i> Registrar Cajero";
    }
}

function abrirModalAccesosFinanzas(id, currentUsername) {
    document.getElementById('edit-id-finanzas').value = id;
    document.getElementById('edit-user-finanzas').value = currentUsername;
    document.getElementById('edit-pass-finanzas').value = '';
    document.getElementById('modal-editar-acceso-finanzas').style.display = 'flex';
}

async function guardarNuevosAccesosFinanzas() {
    const id = document.getElementById('edit-id-finanzas').value;
    const newUsername = document.getElementById('edit-user-finanzas').value;
    const newPassword = document.getElementById('edit-pass-finanzas').value;

    if (!newUsername) return alert('El usuario no puede estar vacío');

    try {
        await window.API.Directivos.actualizarCredenciales(id, newUsername, newPassword);
        alert('Credenciales actualizadas correctamente.');
        document.getElementById('modal-editar-acceso-finanzas').style.display = 'none';
        cargarFinanzas();
    } catch (err) {
        alert('Error: ' + err.message);
    }
}

function abrirModalDatosFinanzas(jsonString) {
    const f = JSON.parse(decodeURIComponent(jsonString));
    document.getElementById('edit-id-datos-finanzas').value = f._id;
    document.getElementById('edit-nombre-finanzas').value = f.nombre || '';
    document.getElementById('edit-apellidos-finanzas').value = f.apellidoPaterno || '';
    document.getElementById('edit-num-empleado-finanzas').value = f.numeroEmpleado || '';
    document.getElementById('edit-telefono-finanzas').value = f.telefono || '';
    document.getElementById('edit-cargo-finanzas').value = f.cargo || '';
    document.getElementById('edit-email-finanzas').value = f.email || '';
    document.getElementById('edit-username-finanzas').value = f.username || '';
    document.getElementById('modal-editar-datos-finanzas').style.display = 'flex';
}

async function guardarDatosFinanzas() {
    const id = document.getElementById('edit-id-datos-finanzas').value;
    const datos = {
        nombre: document.getElementById('edit-nombre-finanzas').value,
        apellidoPaterno: document.getElementById('edit-apellidos-finanzas').value,
        numeroEmpleado: document.getElementById('edit-num-empleado-finanzas').value,
        telefono: document.getElementById('edit-telefono-finanzas').value,
        departamento: 'Finanzas', // Siempre Finanzas
        cargo: document.getElementById('edit-cargo-finanzas').value,
        email: document.getElementById('edit-email-finanzas').value,
        username: document.getElementById('edit-username-finanzas').value
    };

    if (!datos.nombre || !datos.email) return alert('Nombre y Correo son obligatorios.');

    try {
        await window.API.Directivos.editar(id, datos);
        alert('Datos actualizados correctamente.');
        document.getElementById('modal-editar-datos-finanzas').style.display = 'none';
        cargarFinanzas();
    } catch (err) {
        alert('Error: ' + err.message);
    }
}

async function eliminarFinanzas(id) {
    if (confirm("¿Estás seguro de que deseas eliminar a este personal? Esta acción no se puede deshacer.")) {
        try {
            await window.API.Directivos.eliminar(id);
            alert('Personal eliminado.');
            cargarFinanzas();
        } catch (err) {
            alert('Error al eliminar: ' + err.message);
        }
    }
}

function toggleSeccion(idCuerpo, idIcono) {
    const cuerpo = document.getElementById(idCuerpo);
    const icono  = document.getElementById(idIcono);
    if (!cuerpo) return;
    const visible = cuerpo.style.display === 'block';
    cuerpo.style.display = visible ? 'none' : 'block';
    if (icono) icono.style.transform = visible ? 'rotate(-90deg)' : 'rotate(0deg)';
}

window.toggleSeccion = toggleSeccion;
window.cargarFinanzas = cargarFinanzas;
window.registrarPersonalFinanzas = registrarPersonalFinanzas;
window.abrirModalAccesosFinanzas = abrirModalAccesosFinanzas;
window.guardarNuevosAccesosFinanzas = guardarNuevosAccesosFinanzas;
window.abrirModalDatosFinanzas = abrirModalDatosFinanzas;
window.guardarDatosFinanzas = guardarDatosFinanzas;
window.eliminarFinanzas = eliminarFinanzas;

// Ejecutar al cargar
cargarFinanzas();
