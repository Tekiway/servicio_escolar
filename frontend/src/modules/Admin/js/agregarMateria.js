$(document).ready(function() {
    console.log("✅ Módulo de Agregar Materia: Cargado correctamente.");

    // --- 1. LÓGICA DE LOS ACORDEONES ---
    // Permite abrir y cerrar las tarjetas de registro y tabla
    $(document).on('click', '.accordion-header', function(e) {
        e.preventDefault();
        const targetId = $(this).data('target');
        const content = $('#' + targetId);
        
        $(this).toggleClass('active');
        content.toggleClass('open');
        
        console.log("Acordeón accionado: " + targetId);
    });

    // --- 2. GESTOR DE UNIDADES TEMÁTICAS ---
    let unidadIdx = 0;

    $(document).on('click', '#btn-agregar-unidad', function(e) {
        e.preventDefault();
        unidadIdx++;
        
        // Construimos el HTML de la unidad paso a paso (JS puro)
        var nuevaUnidad = 
            '<div class="unidad-item" id="unid-' + unidadIdx + '" style="display:none; margin-bottom: 20px; padding: 15px; border-left: 5px solid #a855f7; background: #fdfaff; border-radius: 8px;">' +
                '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px;">' +
                    '<span style="color:#a855f7; font-weight:800; font-size:0.9rem;">' +
                        '<i class="bx bxs-layer"></i> UNIDAD ' + unidadIdx +
                    '</span>' +
                    '<button type="button" class="btn-remove-unidad" data-id="' + unidadIdx + '" style="color:#ef4444; border:none; background:none; cursor:pointer; display:flex; align-items:center; gap:5px;">' +
                        '<i class="bx bx-trash"></i> Eliminar' +
                    '</button>' +
                '</div>' +

                '' +
                '<div class="materia-input-group" style="margin-bottom: 15px;">' +
                    '<label style="display:block; margin-bottom:5px; font-weight:600;">Nombre de la Unidad</label>' +
                    '<input type="text" name="nombre_unidad[]" placeholder="Ej. Introducción a la materia" required style="width:100%;">' +
                '</div>' +

                '' +
                '<div class="materia-input-group">' +
                    '<label style="display:block; margin-bottom:5px; font-weight:600;">Objetivo de la Unidad</label>' +
                    '<textarea name="objetivo_unidad[]" placeholder="¿Qué aprenderá el alumno?" rows="2" required style="width:100%; resize:vertical;"></textarea>' +
                '</div>' +
            '</div>';
        
        // Inyectamos el nuevo bloque en el contenedor del PHP
        $('#unidades-container').append(nuevaUnidad);
        
        // Efecto de aparición suave
        $('#unid-' + unidadIdx).fadeIn(300);
    });

    // --- 3. ELIMINAR UNIDAD ---
    $(document).on('click', '.btn-remove-unidad', function() {
        const id = $(this).data('id');
        $('#unid-' + id).fadeOut(300, function() { 
            $(this).remove(); 
            console.log("Unidad " + id + " eliminada.");
        });
    });

    // --- 4. ENVÍO DEL FORMULARIO ---
    $(document).on('submit', '#form-agregar-materia', function(e) {
        e.preventDefault();
        
        // Serializamos los datos (incluyendo los arreglos de unidades)
        const datosMateria = $(this).serialize();
        
        console.log("Enviando datos de Nakumi:", datosMateria);
        alert("¡Materia configurada con éxito!");
        
        // Aquí podrías agregar tu llamada $.ajax cuando estés listo para el backend
    });
});