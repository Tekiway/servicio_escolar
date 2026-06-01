function cargarModulo(nombre) {
    const contenedor = document.getElementById('vista-dinamica');
    
    // Ruta corregida según tu estructura de carpetas
    const nombreArchivo = nombre.charAt(0).toLowerCase() + nombre.slice(1);
    const ruta = `./${nombreArchivo}.php`; 

    fetch(ruta)
        .then(response => {
            if (!response.ok) throw new Error('No se encontró el módulo: ' + nombre);
            return response.text();
        })
        .then(html => {
            contenedor.innerHTML = html;
            
            // Si el módulo es Carreras, intentamos cargar su JS específico
            if(nombre === 'Carreras') {
                const scriptExistente = document.getElementById('script-modulo');
                if (scriptExistente) scriptExistente.remove();

                const nuevoScript = document.createElement('script');
                nuevoScript.id = 'script-modulo';
                nuevoScript.src = `./js/carreras.js?v=${new Date().getTime()}`;
                document.body.appendChild(nuevoScript);
            }
        })
        .catch(error => {
            console.error(error);
            contenedor.innerHTML = `<div class="error">Error al cargar el contenido de ${nombre}</div>`;
        });
}

// Al cargar la página, carga automáticamente el inicio
document.addEventListener('DOMContentLoaded', () => {
    cargarModulo('inicio'); 
});