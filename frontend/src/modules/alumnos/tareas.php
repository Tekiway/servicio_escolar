<div class="animate-fade-in" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Encabezado -->
    <div class="header-seccion" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
        <div>
            <h2 style="color: #1e293b; font-size: 1.8rem; font-weight: 800; display: flex; align-items: center; gap: 8px; margin: 0;">
                <i class='bx bx-book-content' style="color: var(--primary);"></i> Mis Tareas
            </h2>
            <p style="color: #64748b; margin: 5px 0 0 0;">Consulta y entrega las tareas asignadas por tus docentes.</p>
        </div>
    </div>

    <!-- Lista de Tareas -->
    <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); border-radius: 16px; padding: 25px; backdrop-filter: blur(10px); box-shadow: 0 8px 32px rgba(31, 38, 135, 0.04);">
        <h3 style="margin: 0 0 20px 0; color: #1e293b; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i class='bx bx-task' style="color: var(--primary);"></i> Tareas Pendientes y Asignadas
        </h3>
        
        <div style="display: flex; flex-direction: column; gap: 15px;" id="alumnos-tareas-list">
            <div style="text-align:center; padding:30px; color:#64748b;">Cargando tus tareas...</div>
        </div>
    </div>
</div>

<script>
    async function initAlumnoTareas() {
        try {
            // Suponemos que el alumno actual pertenece al grupo T4A para demostración
            // En la vida real, se sacaría del perfil del alumno guardado
            const grupoAlumno = 'T4A'; 
            const tareas = await API.Docentes.obtenerTareas(grupoAlumno);
            renderAlumnoTareasList(tareas);
        } catch (error) {
            console.error('Error al cargar tareas del alumno:', error);
            document.getElementById('alumnos-tareas-list').innerHTML = `<div style="text-align:center; padding:30px; color:#ef4444;">Error al cargar las tareas asignadas.</div>`;
        }
    }

    function renderAlumnoTareasList(tareas) {
        const container = document.getElementById('alumnos-tareas-list');
        container.innerHTML = '';

        if (!tareas || tareas.length === 0) {
            container.innerHTML = `<div style="text-align:center; padding:30px; color:#64748b;">¡Felicidades! No tienes tareas pendientes en este momento.</div>`;
            return;
        }

        tareas.forEach(t => {
            const card = document.createElement('div');
            card.style.cssText = "background: rgba(255,255,255,0.8); border: 1px solid rgba(226, 232, 240, 1); border-radius: 12px; padding: 18px; display: flex; flex-direction: column; gap: 12px; transition: transform 0.2s;";
            
            card.innerHTML = `
                <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 15px;">
                    <div>
                        <span style="font-size: 0.72rem; padding: 3px 8px; border-radius: 20px; background: rgba(99,102,241,0.1); color: var(--primary); font-weight: 700; margin-bottom: 6px; display: inline-block;">GRUPO ${t.grupo}</span>
                        <h4 style="margin: 0; font-size: 1.05rem; font-weight: 800; color: #1e293b; line-height: 1.4;">${t.titulo}</h4>
                        <p style="margin: 8px 0 0 0; font-size: 0.85rem; color: #475569;">${t.instrucciones}</p>
                    </div>
                    <div style="text-align: right;">
                        <span style="font-size: 1rem; font-weight: 800; color: var(--primary-dark); display: block;">${t.puntos} Pts</span>
                    </div>
                </div>
                
                <div style="border-top: 1px dashed rgba(226,232,240,0.8); padding-top: 12px; display: flex; align-items: center; justify-content: space-between; gap: 15px;">
                    <span style="font-size: 0.8rem; color: #ef4444; font-weight: 700;"><i class='bx bx-time'></i> Entrega límite: ${formatearFechaISO(t.fecha)}</span>
                    <button class="btn-finance-action" style="padding: 8px 16px; font-size: 0.85rem; background: var(--primary); color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold;" onclick="alert('Funcionalidad de entrega en desarrollo.')">Entregar Tarea</button>
                </div>
            `;

            container.appendChild(card);
        });
    }

    function formatearFechaISO(isoString) {
        if (!isoString) return '';
        const parts = isoString.split('T');
        const fecha = parts[0].split('-').reverse().join('/');
        const hora = parts[1] ? parts[1].substring(0, 5) : '';
        return `${fecha} a las ${hora} hrs`;
    }

    initAlumnoTareas();
</script>
