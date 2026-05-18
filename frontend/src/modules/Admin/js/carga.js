document.addEventListener("DOMContentLoaded", function() {
    console.log("Sistema Escolar: Módulo de Carga Académica listo.");

    // Sincronización de nombre en tiempo real para el modal
    const inputNombre = document.getElementById('edit-nombre');
    const headerNombre = document.getElementById('edit-header-nombre');
    
    if(inputNombre && headerNombre) {
        inputNombre.addEventListener('input', () => headerNombre.value = inputNombre.value);
        headerNombre.addEventListener('input', () => inputNombre.value = headerNombre.value);
    }
});

// Función para colapsar/expandir secciones
function toggleSeccion(idCuerpo, idIcono) {
    const cuerpo = document.getElementById(idCuerpo);
    const icono = document.getElementById(idIcono);
    if (cuerpo.style.display === "none" || cuerpo.style.display === "") {
        cuerpo.style.display = "block";
        if(icono) icono.style.transform = "rotate(0deg)";
    } else {
        cuerpo.style.display = "none";
        if(icono) icono.style.transform = "rotate(-90deg)";
    }
}

// Lógica del Modal
function abrirModalEditar(datos) {
    document.getElementById('edit-id').value = datos.id;
    document.getElementById('edit-nombre').value = datos.nombre;
    document.getElementById('edit-header-nombre').value = datos.nombre;
    document.getElementById('edit-rfc').value = datos.rfc;
    document.getElementById('edit-carrera').value = datos.carrera;
    
    document.getElementById('modal-editar-docente').style.display = 'flex';
}

function cerrarModalEditar() {
    document.getElementById('modal-editar-docente').style.display = 'none';
}

function guardarCambios() {
    const id = document.getElementById('edit-id').value;
    const nombre = document.getElementById('edit-nombre').value;
    console.log("Sistema Escolar - Guardando ID:", id);
    alert("Cambios guardados exitosamente para: " + nombre);
    cerrarModalEditar();
}

function eliminarDocente(id, nombre) {
    if(confirm("¿Seguro que desea eliminar a " + nombre + " del Sistema Escolar?")) {
        console.log("Registro eliminado:", id);
    }
}

// Cerrar al hacer clic fuera del modal
window.onclick = function(event) {
    const modal = document.getElementById('modal-editar-docente');
    if (event.target == modal) cerrarModalEditar();
}