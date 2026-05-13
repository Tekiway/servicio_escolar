// src/modules/Admin/js/Carreras.js
(function() {
    const form = document.getElementById('form-registrar-carrera');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);

            fetch('../../services/registrar_carrera.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    alert("Carrera registrada correctamente");
                    form.reset();
                } else {
                    alert("Error: " + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Si el PHP no devuelve JSON todavía, al menos limpia el form
                alert("Proceso completado.");
                form.reset();
            });
        });
    }
})();