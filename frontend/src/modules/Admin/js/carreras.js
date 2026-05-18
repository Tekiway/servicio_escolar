// --- 1. GESTIÓN DE PANELES (ACORDEÓN) ---
function togglePanel(panelId) {
    const panel = document.getElementById(panelId);
    if (panel) {
        panel.classList.toggle('active');
    }
}

// --- 2. GESTIÓN DE TABS DENTRO DEL MODAL ---
window.switchTab = function(tabId) {
    document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    
    document.getElementById(tabId).classList.add('active');
    event.currentTarget.classList.add('active');
};

// --- 3. ABRIR Y CERRAR MODAL (VISTA) ---
window.abrirModalCarrera = function(datos) {
    const modal = document.getElementById('modalCarrera');
    
    // Llenar datos de texto
    document.getElementById('modal-id-carrera').value = datos.id;
    document.getElementById('modal-nombre-text').innerText = datos.nombre;
    document.getElementById('modal-clave-text').innerText = datos.clave;
    document.getElementById('modal-modalidad-text').innerText = datos.modalidad;
    document.getElementById('modal-duracion-text').innerText = datos.duracion + " Sem.";
    document.getElementById('modal-estado-text').innerText = datos.estado;
    document.getElementById('modal-objetivo-text').innerText = datos.objetivo;
    document.getElementById('modal-ingreso-text').innerText = datos.ingreso;
    document.getElementById('modal-egreso-text').innerText = datos.egreso;

    // Resetear visibilidad (por si se cerró estando en modo edición)
    document.querySelectorAll('#modalCarrera span, #modalCarrera p, #modal-nombre-text').forEach(el => el.style.display = '');
    document.querySelectorAll('.modal-input-edit').forEach(el => el.style.display = 'none');
    document.getElementById('btn-editar-modal').style.display = 'inline-block';
    document.getElementById('btn-guardar-modal').style.display = 'none';

    modal.classList.add('active');
};

window.cerrarModalCarrera = function() {
    document.getElementById('modalCarrera').classList.remove('active');
};

// --- 4. LÓGICA DE EDICIÓN DENTRO DEL MODAL ---

// Paso 1: Activar los cuadros de texto
window.prepararEdicionDesdeModal = function() {
    console.log("Cambiando modal a modo edición...");

    // Ocultar etiquetas de texto
    document.querySelectorAll('#modalCarrera span, #modalCarrera p, #modal-nombre-text').forEach(el => el.style.display = 'none');
    
    // Mostrar inputs y textareas de edición
    const inputs = document.querySelectorAll('.modal-input-edit');
    inputs.forEach(el => el.style.display = 'block');

    // Sincronizar valores (Texto -> Input)
    document.getElementById('modal-nombre-input').value = document.getElementById('modal-nombre-text').innerText;
    document.getElementById('modal-clave-input').value = document.getElementById('modal-clave-text').innerText;
    document.getElementById('modal-duracion-input').value = document.getElementById('modal-duracion-text').innerText.replace(/\D/g, "");
    document.getElementById('modal-objetivo-input').value = document.getElementById('modal-objetivo-text').innerText;
    document.getElementById('modal-ingreso-input').value = document.getElementById('modal-ingreso-text').innerText;
    document.getElementById('modal-egreso-input').value = document.getElementById('modal-egreso-text').innerText;
    document.getElementById('modal-modalidad-input').value = document.getElementById('modal-modalidad-text').innerText;
    document.getElementById('modal-estado-input').value = document.getElementById('modal-estado-text').innerText;

    // Intercambiar botones del footer
    document.getElementById('btn-editar-modal').style.display = 'none';
    document.getElementById('btn-guardar-modal').style.display = 'inline-block';
};

// Paso 2: Enviar datos editados al PHP
window.enviarEdicionModal = function() {
    const formElement = document.getElementById('form-editar-modal');
    const formData = new FormData(formElement);

    // Mostramos feedback de carga
    const btnGuardar = document.getElementById('btn-guardar-modal');
    btnGuardar.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i> Guardando...";
    btnGuardar.disabled = true;

    fetch('../../services/registrar_carrera.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            alert("¡Cambios guardados con éxito en Nakumi!");
            location.reload(); // Recargar para ver reflejado en la tabla
        } else {
            alert("Error al actualizar: " + data.message);
            btnGuardar.innerHTML = "<i class='bx bx-check-double'></i> Guardar Cambios";
            btnGuardar.disabled = false;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("Error crítico de conexión.");
    });
};

window.eliminarCarrera = function(id, nombre) {
    if (confirm(`¿Estás seguro de eliminar la carrera "${nombre}"? Esta acción no se puede deshacer.`)) {
        
        // Usamos FormData para enviar el ID al servidor
        const datos = new FormData();
        datos.append('id_eliminar', id);

        fetch('../../services/eliminar_carrera.php', {
            method: 'POST',
            body: datos
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert("Carrera eliminada correctamente.");
                location.reload(); // Refrescamos la tabla
            } else {
                alert("Error al eliminar: " + data.message);
            }
        })
        .catch(err => console.error("Error en la petición:", err));
    }
};