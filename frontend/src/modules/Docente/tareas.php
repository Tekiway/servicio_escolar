<div class="animate__animated animate__fadeIn" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Encabezado -->
    <div class="module-header" style="margin-bottom: 5px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
        <div>
            <h2 style="color: #1e293b; font-size: 1.8rem; font-weight: 800; display: flex; align-items: center; gap: 8px; margin: 0;">
                <i class='bx bxs-edit-location' style="color: var(--primary);"></i> Actividades y Tareas
            </h2>
            <p style="color: #64748b; margin: 5px 0 0 0;">Publica nuevas tareas, calendariza fechas límite y revisa el progreso de entregas de los estudiantes.</p>
        </div>
        <button class="btn-finance-action" onclick="mostrarModalCrearTarea()" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white; display: inline-flex; align-items: center; gap: 8px;">
            <i class='bx bx-plus-circle'></i> Crear Nueva Actividad
        </button>
    </div>

    <!-- Layout: Lista de Tareas (Izquierda) y Crear/Detalles (Derecha) -->
    <div style="display: grid; grid-template-columns: 1.8fr 1.2fr; gap: 25px; align-items: start;">
        
        <!-- Lista de Actividades Asignadas -->
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); border-radius: 16px; padding: 25px; backdrop-filter: blur(10px); box-shadow: 0 8px 32px rgba(31, 38, 135, 0.04);">
            <h3 style="margin: 0 0 20px 0; color: #1e293b; font-weight: 800; display: flex; align-items: center; gap: 8px;">
                <i class='bx bx-task' style="color: var(--primary);"></i> Tareas Activas del Periodo
            </h3>
            
            <div style="display: flex; flex-direction: column; gap: 15px;" id="doc-tareas-list">
                <!-- Se inyecta por JS -->
            </div>
        </div>

        <!-- Panel de Creación / Detalles de Actividad -->
        <div style="background: white; border: 1px solid #e2e8f0; border-radius: 16px; padding: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.02);" id="panel-tarea-accion">
            <h3 style="margin: 0 0 20px 0; font-size: 1.1rem; font-weight: 800; color: #1e293b; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 6px;">
                <i class='bx bxs-file-plus' style="color: var(--secondary);"></i> ASIGNAR NUEVA TAREA
            </h3>
            
            <form id="form-crear-tarea" onsubmit="guardarNuevaTarea(event)" style="display: flex; flex-direction: column; gap: 15px;">
                <div style="display: flex; flex-direction: column; gap: 5px;">
                    <label style="font-size: 0.75rem; font-weight: 700; color: #64748b;">TÍTULO DE LA TAREA</label>
                    <input type="text" id="tarea-titulo" required placeholder="Ej. Práctica 3: Consumo de APIs REST" style="padding: 10px 12px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none;">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div style="display: flex; flex-direction: column; gap: 5px;">
                        <label style="font-size: 0.75rem; font-weight: 700; color: #64748b;">GRUPO DESTINO</label>
                        <select id="tarea-grupo" style="padding: 10px 12px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; font-weight: 600; color: #475569;">
                <option value="" disabled selected>Cargando grupos...</option>
            </select>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 5px;">
                        <label style="font-size: 0.75rem; font-weight: 700; color: #64748b;">PUNTOS MÁXIMOS</label>
                        <input type="number" id="tarea-puntos" value="10" min="1" max="100" style="padding: 10px 12px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; font-weight: 700; text-align: center;">
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap: 5px;">
                    <label style="font-size: 0.75rem; font-weight: 700; color: #64748b;">FECHA Y HORA LÍMITE</label>
                    <input type="datetime-local" id="tarea-fecha" required style="padding: 10px 12px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none;">
                </div>

                <div style="display: flex; flex-direction: column; gap: 5px;">
                    <label style="font-size: 0.75rem; font-weight: 700; color: #64748b;">INSTRUCCIONES Y RECURSOS</label>
                    <textarea id="tarea-instrucciones" required rows="4" placeholder="Especificar los lineamientos de la entrega..." style="padding: 10px 12px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; font-family: inherit; resize: none;"></textarea>
                </div>

                <button class="btn-finance-action" type="submit" style="margin-top: 10px; justify-content: center; width: 100%; background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white;">
                    <i class='bx bx-cloud-upload'></i> PUBLICAR TAREA AL GRUPO
                </button>
            </form>
        </div>

    </div>
</div>

<script>
    // Tareas iniciales del docente en localStorage para simulación persistente
    let listaTareasDocente = [];

    function initTareas() {
        const storedTareas = localStorage.getItem('docente_lista_tareas');
        if (storedTareas) {
            listaTareasDocente = JSON.parse(storedTareas);
        } else {
            listaTareasDocente = [];
            localStorage.setItem('docente_lista_tareas', JSON.stringify(listaTareasDocente));
        }

        renderTareasList();
    }

    function renderTareasList() {
        const container = document.getElementById('doc-tareas-list');
        container.innerHTML = '';

        if (listaTareasDocente.length === 0) {
            container.innerHTML = `<div style="text-align:center; padding:30px; color:#64748b;">No hay tareas publicadas en este periodo escolar.</div>`;
            return;
        }

        listaTareasDocente.forEach(t => {
            const ratio = t.entregas / t.total;
            const pct = (ratio * 100).toFixed(0);
            
            const card = document.createElement('div');
            card.style.cssText = "background: rgba(255,255,255,0.4); border: 1px solid rgba(226, 232, 240, 0.8); border-radius: 12px; padding: 18px; display: flex; flex-direction: column; gap: 12px; transition: transform 0.2s;";
            
            card.innerHTML = `
                <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 15px;">
                    <div>
                        <span style="font-size: 0.72rem; padding: 3px 8px; border-radius: 20px; background: rgba(99,102,241,0.1); color: var(--primary); font-weight: 700; margin-bottom: 6px; display: inline-block;">GRUPO ${t.grupo}</span>
                        <h4 style="margin: 0; font-size: 0.95rem; font-weight: 800; color: #1e293b; line-height: 1.4;">${t.titulo}</h4>
                        <p style="margin: 5px 0 0 0; font-size: 0.78rem; color: #64748b;"><i class='bx bx-calendar'></i> Límite: ${formatearFechaISO(t.fecha)}</p>
                    </div>
                    <span style="font-size: 0.85rem; font-weight: 800; color: var(--primary-dark);">${t.puntos} Pts</span>
                </div>
                
                <div style="border-top: 1px dashed rgba(226,232,240,0.8); padding-top: 10px; display: flex; align-items: center; justify-content: space-between; gap: 15px;">
                    <div style="display: flex; align-items: center; gap: 10px; flex: 1;">
                        <div style="background: #e2e8f0; height: 6px; border-radius: 3px; overflow: hidden; width: 80px;">
                            <div style="background: #059669; width: ${pct}%; height: 100%;"></div>
                        </div>
                        <span style="font-size: 0.75rem; color: #64748b; font-weight: 600;">Entregas: ${t.entregas} de ${t.total} (${pct}%)</span>
                    </div>
                    <button class="btn-finance-action" style="padding: 6px 12px; font-size: 0.75rem;" onclick="revisarEntregas(${t.id})">Revisar</button>
                </div>
            `;

            container.appendChild(card);
        });
    }

    function formatearFechaISO(isoString) {
        if (!isoString) return '';
        const parts = isoString.split('T');
        const fecha = parts[0].split('-').reverse().join('/');
        const hora = parts[1] || '';
        return `${fecha} a las ${hora} hrs`;
    }

    function mostrarModalCrearTarea() {
        document.getElementById('form-crear-tarea').reset();
        document.getElementById('panel-tarea-accion').innerHTML = `
            <h3 style="margin: 0 0 20px 0; font-size: 1.1rem; font-weight: 800; color: #1e293b; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 6px;">
                <i class='bx bxs-file-plus' style="color: var(--secondary);"></i> ASIGNAR NUEVA TAREA
            </h3>
            
            <form id="form-crear-tarea" onsubmit="guardarNuevaTarea(event)" style="display: flex; flex-direction: column; gap: 15px;">
                <div style="display: flex; flex-direction: column; gap: 5px;">
                    <label style="font-size: 0.75rem; font-weight: 700; color: #64748b;">TÍTULO DE LA TAREA</label>
                    <input type="text" id="tarea-titulo" required placeholder="Ej. Práctica 3: Consumo de APIs REST" style="padding: 10px 12px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none;">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div style="display: flex; flex-direction: column; gap: 5px;">
                        <label style="font-size: 0.75rem; font-weight: 700; color: #64748b;">GRUPO DESTINO</label>
                        <select id="tarea-grupo" style="padding: 10px 12px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; font-weight: 600; color: #475569;">
                <option value="" disabled selected>Cargando grupos...</option>
            </select>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 5px;">
                        <label style="font-size: 0.75rem; font-weight: 700; color: #64748b;">PUNTOS MÁXIMOS</label>
                        <input type="number" id="tarea-puntos" value="10" min="1" max="100" style="padding: 10px 12px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; font-weight: 700; text-align: center;">
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap: 5px;">
                    <label style="font-size: 0.75rem; font-weight: 700; color: #64748b;">FECHA Y HORA LÍMITE</label>
                    <input type="datetime-local" id="tarea-fecha" required style="padding: 10px 12px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none;">
                </div>

                <div style="display: flex; flex-direction: column; gap: 5px;">
                    <label style="font-size: 0.75rem; font-weight: 700; color: #64748b;">INSTRUCCIONES Y RECURSOS</label>
                    <textarea id="tarea-instrucciones" required rows="4" placeholder="Especificar los lineamientos de la entrega..." style="padding: 10px 12px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; font-family: inherit; resize: none;"></textarea>
                </div>

                <button class="btn-finance-action" type="submit" style="margin-top: 10px; justify-content: center; width: 100%; background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white;">
                    <i class='bx bx-cloud-upload'></i> PUBLICAR TAREA AL GRUPO
                </button>
            </form>
        `;
    }

    function guardarNuevaTarea(event) {
        event.preventDefault();
        const titulo = document.getElementById('tarea-titulo').value;
        const grupo = document.getElementById('tarea-grupo').value;
        const puntos = parseInt(document.getElementById('tarea-puntos').value) || 10;
        const fecha = document.getElementById('tarea-fecha').value;
        const instrucciones = document.getElementById('tarea-instrucciones').value;

        const totalAlumnos = grupo === 'T4A' ? 6 : 4;

        const nueva = {
            id: Date.now(),
            titulo,
            grupo,
            entregas: 0,
            total: totalAlumnos,
            puntos,
            fecha,
            instrucciones
        };

        listaTareasDocente.push(nueva);
        localStorage.setItem('docente_lista_tareas', JSON.stringify(listaTareasDocente));

        alert("¡Éxito!\nTarea publicada y notificada a los alumnos de forma exitosa.");
        
        renderTareasList();
        mostrarModalCrearTarea();
    }

    function revisarEntregas(id) {
        const tarea = listaTareasDocente.find(t => t.id === id);
        const panel = document.getElementById('panel-tarea-accion');

        panel.innerHTML = `
            <div style="display: flex; flex-direction: column; gap: 15px;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h3 style="margin: 0; font-size: 1.1rem; font-weight: 800; color: #1e293b; font-family: 'Outfit', sans-serif;">DETALLE Y ENTREGAS</h3>
                    <button onclick="mostrarModalCrearTarea()" style="border: none; background: none; color: var(--primary); font-weight: 700; cursor: pointer; font-size: 0.8rem;"><i class='bx bx-arrow-back'></i> Volver</button>
                </div>
                
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 15px; border-radius: 12px;">
                    <span style="font-size: 0.72rem; padding: 2px 6px; border-radius: 20px; background: rgba(99,102,241,0.1); color: var(--primary); font-weight: 700;">GRUPO ${tarea.grupo}</span>
                    <h4 style="margin: 5px 0 5px 0; color: #1e293b; font-size: 0.95rem; font-weight: 800;">${tarea.titulo}</h4>
                    <p style="font-size: 0.8rem; color: #64748b; margin: 0;">${tarea.instrucciones}</p>
                </div>

                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <span style="font-size: 0.75rem; font-weight: bold; color: #64748b; text-transform: uppercase;">Entregas de Estudiantes:</span>
                    
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <!-- Entregas dinámicas -->
                    </div>
                </div>
            </div>
        `;
    }

    // Inicializar
    initTareas();
</script>
