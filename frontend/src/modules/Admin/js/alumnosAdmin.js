// Configuración de la vista de Alumnos Admin
async function cargarAlumnos() {
    try {
        const alumnos = await window.API.Alumnos.listar();
        const tbody = document.querySelector('.tabla-sistema tbody');
        tbody.innerHTML = '';

        if (!alumnos || alumnos.length === 0) {
            tbody.innerHTML = '<tr><td colspan="6" style="text-align:center; padding: 20px; color: #64748b;">No hay alumnos inscritos en el sistema.</td></tr>';
            return;
        }

        alumnos.forEach(al => {
            const statusColor = al.status === 'Activo' ? '#d1fae5' : '#f1f5f9';
            const statusText = al.status === 'Activo' ? '#065f46' : '#64748b';
            
            tbody.innerHTML += `
                <tr>
                    <td><b>${al.nombre} ${al.apellidos || ''}</b><br><small>CURP: ${al.curp || 'N/D'}</small></td>
                    <td>${al.matricula || 'N/A'}<br><small>${al.email}</small></td>
                    <td>${al.carrera || 'Sin Asignar'}<br>
                        <small style="color:#2563eb;font-weight:600;">Usr: ${al.username || 'N/A'}</small><br>
                        <small style="color:#d97706;font-weight:600;">Pass: ${al.password || '***'}</small>
                    </td>
                    <td>${al.semestre || '1ro'}<br><small>Grupo ${al.grupo || 'N/A'}</small></td>
                    <td><span style="background:${statusColor};color:${statusText};padding:3px 10px;border-radius:20px;font-size:0.78rem;font-weight:700;">${al.status || 'Activo'}</span></td>
                    <td>
                        <div class="acciones-group-flex">
                            <button class="btn-action-view" title="Editar Datos" onclick="abrirModalDatosAlumno('${encodeURIComponent(JSON.stringify(al))}')"><i class='bx bx-edit-alt'></i></button>
                            <button class="btn-action-view" style="background:rgba(245,158,11,.15);color:#d97706;" title="Cambiar Accesos" onclick="abrirModalAccesosAlumno('${al._id}', '${al.username}')"><i class='bx bx-lock-open-alt'></i></button>
                            <button class="btn-action-delete" title="Eliminar Alumno" onclick="eliminarAlumno('${al._id}')"><i class='bx bx-trash'></i></button>
                        </div>
                    </td>
                </tr>
            `;
        });
    } catch (error) {
        console.error("Error al cargar alumnos:", error);
        document.querySelector('.tabla-sistema tbody').innerHTML = '<tr><td colspan="6" style="text-align:center; color: red;">Error al conectar con la base de datos de Alumnos.</td></tr>';
    }
}

// Inscribir un alumno manualmente
async function registrarAlumnoManual() {
    const btn = document.querySelector('.btn-registrar-docente');
    
    const elements = document.querySelectorAll('#form-reg-alumno input, #form-reg-alumno select');
    const datos = {
        nombre: elements[0].value,
        apellidos: elements[1].value + " " + elements[2].value, // Paterno + Materno
        curp: elements[3].value,
        sexo: elements[4].value,
        telefono: elements[5].value,
        matricula: elements[6].value,
        email: elements[7].value,
        username: elements[8].value, // AHORA ES EXPLICITO
        carrera: elements[9].value,
        semestre: elements[10].value,
        grupo: elements[11].value,
        password: elements[12].value
    };

    if (!datos.nombre || !datos.username || !datos.password) {
        return alert("Por favor llena Nombre, Usuario y Contraseña.");
    }

    btn.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i> Inscribiendo...";
    
    try {
        await window.API.Alumnos.registrar(datos);
        alert("Alumno inscrito exitosamente.");
        cargarAlumnos();
        document.querySelector('.form-carga-grid').reset();
    } catch(err) {
        alert("Error al registrar: " + err.message);
    } finally {
        btn.innerHTML = "<i class='bx bx-save'></i> Inscribir Alumno";
    }
}

function abrirModalAccesosAlumno(id, currentUsername) {
    document.getElementById('edit-id-alumno').value = id;
    document.getElementById('edit-user-alumno').value = currentUsername;
    document.getElementById('edit-pass-alumno').value = '';
    document.getElementById('modal-editar-acceso-alumno').style.display = 'flex';
}

async function guardarNuevosAccesosAlumno() {
    const id = document.getElementById('edit-id-alumno').value;
    const newUsername = document.getElementById('edit-user-alumno').value;
    const newPassword = document.getElementById('edit-pass-alumno').value;

    if (!newUsername) return alert('El usuario no puede estar vacío');

    try {
        await window.API.Alumnos.actualizarCredenciales(id, newUsername, newPassword);
        alert('Credenciales actualizadas correctamente.');
        document.getElementById('modal-editar-acceso-alumno').style.display = 'none';
        cargarAlumnos();
    } catch (err) {
        alert('Error: ' + err.message);
    }
}

function abrirModalDatosAlumno(jsonString) {
    const al = JSON.parse(decodeURIComponent(jsonString));
    document.getElementById('edit-id-datos-alumno').value = al._id;
    document.getElementById('edit-nombre-alumno').value = al.nombre || '';
    document.getElementById('edit-apellidos-alumno').value = al.apellidos || '';
    document.getElementById('edit-curp-alumno').value = al.curp || '';
    document.getElementById('edit-sexo-alumno').value = al.sexo || 'Masculino';
    document.getElementById('edit-telefono-alumno').value = al.telefono || '';
    document.getElementById('edit-matricula-alumno').value = al.matricula || '';
    document.getElementById('edit-email-alumno').value = al.email || '';
    document.getElementById('edit-username-alumno').value = al.username || '';
    document.getElementById('edit-carrera-alumno').value = al.carrera || 'Ing. Sistemas';
    document.getElementById('edit-semestre-alumno').value = al.semestre || '1ro';
    document.getElementById('edit-grupo-alumno').value = al.grupo || '';
    document.getElementById('edit-status-alumno').value = al.status || 'Activo';
    
    document.getElementById('modal-editar-datos-alumno').style.display = 'flex';
}

async function guardarDatosAlumno() {
    const id = document.getElementById('edit-id-datos-alumno').value;
    const datos = {
        nombre: document.getElementById('edit-nombre-alumno').value,
        apellidos: document.getElementById('edit-apellidos-alumno').value,
        curp: document.getElementById('edit-curp-alumno').value,
        sexo: document.getElementById('edit-sexo-alumno').value,
        telefono: document.getElementById('edit-telefono-alumno').value,
        matricula: document.getElementById('edit-matricula-alumno').value,
        email: document.getElementById('edit-email-alumno').value,
        username: document.getElementById('edit-username-alumno').value,
        carrera: document.getElementById('edit-carrera-alumno').value,
        semestre: document.getElementById('edit-semestre-alumno').value,
        grupo: document.getElementById('edit-grupo-alumno').value,
        status: document.getElementById('edit-status-alumno').value
    };

    if (!datos.nombre || !datos.email || !datos.matricula) return alert('Nombre, Correo y Matrícula son obligatorios.');

    try {
        await window.API.Alumnos.editar(id, datos);
        alert('Datos actualizados correctamente.');
        document.getElementById('modal-editar-datos-alumno').style.display = 'none';
        cargarAlumnos();
    } catch (err) {
        alert('Error: ' + err.message);
    }
}

async function eliminarAlumno(id) {
    if (confirm("¿Estás seguro de que deseas eliminar este alumno? Esta acción no se puede deshacer.")) {
        try {
            await window.API.Alumnos.eliminar(id);
            alert('Alumno eliminado.');
            cargarAlumnos();
        } catch (err) {
            alert('Error al eliminar: ' + err.message);
        }
    }
}

// Inicialización global
window.cargarAlumnos = cargarAlumnos;
window.registrarAlumnoManual = registrarAlumnoManual;
window.abrirModalAccesosAlumno = abrirModalAccesosAlumno;
window.guardarNuevosAccesosAlumno = guardarNuevosAccesosAlumno;
window.abrirModalDatosAlumno = abrirModalDatosAlumno;
window.guardarDatosAlumno = guardarDatosAlumno;
window.eliminarAlumno = eliminarAlumno;

function toggleSeccion(idCuerpo, idIcono) {
    const cuerpo = document.getElementById(idCuerpo);
    const icono  = document.getElementById(idIcono);
    if (!cuerpo) return;
    const visible = cuerpo.style.display === 'block';
    cuerpo.style.display = visible ? 'none' : 'block';
    if (icono) icono.style.transform = visible ? 'rotate(-90deg)' : 'rotate(0deg)';
}
window.toggleSeccion = toggleSeccion;

// Ejecutar al cargar
cargarAlumnos();
