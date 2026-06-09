<div class="animate__animated animate__fadeIn" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Encabezado -->
    <div class="module-header" style="margin-bottom: 5px;">
        <h2 style="color: #1e293b; font-size: 1.8rem; font-weight: 800; display: flex; align-items: center; gap: 8px; margin: 0;">
            <i class='bx bxs-group' style="color: var(--primary);"></i> Gestión de Grupos y Listas
        </h2>
        <p style="color: #64748b; margin: 5px 0 0 0;">Consulta listas de asistencia, horarios del grupo, información académica de tus alumnos y estados escolares.</p>
    </div>

    <!-- Selección de Grupo y Resumen -->
    <div style="display: grid; grid-template-columns: 1.2fr 2fr; gap: 25px; align-items: start;">
        
        <!-- Ficha de Selección de Grupo -->
        <div style="background: white; border: 1px solid #e2e8f0; border-radius: 16px; padding: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.02); display: flex; flex-direction: column; gap: 15px;">
            <h3 style="margin: 0; font-size: 1.1rem; font-weight: 800; color: #1e293b; font-family: 'Outfit', sans-serif;">SELECCIÓN DE CLASE ACTIVA</h3>
            
            <div style="display: flex; flex-direction: column; gap: 6px;">
                <label style="font-size: 0.75rem; font-weight: 700; color: #64748b;">ELEGIR GRUPO Y MATERIA:</label>
                <select id="doc-grupo-select" onchange="actualizarTablaGrupo()" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; font-weight: 600; color: #475569;">
                <option value="" disabled selected>Cargando grupos...</option>
            </select>
            </div>

            <div style="border-top: 1px solid #e2e8f0; padding-top: 15px; display: flex; flex-direction: column; gap: 10px;">
                <span style="font-size: 0.8rem; color: #64748b;"><strong>Horario de Clase:</strong></span>
                <div style="background: rgba(99, 102, 241, 0.05); padding: 12px; border-radius: 10px; font-size: 0.85rem; color: #475569;" id="doc-grupo-horario-info">
                    <!-- Se llena dinámicamente -->
                </div>
            </div>
            
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 15px; text-align: center; display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                <div>
                    <span style="font-size: 0.75rem; color: #64748b; font-weight: 600; display: block;">Total Alumnos</span>
                    <strong style="font-size: 1.5rem; color: var(--primary);" id="doc-grupo-total-alumnos">0</strong>
                </div>
                <div>
                    <span style="font-size: 0.75rem; color: #64748b; font-weight: 600; display: block;">Promedio Aula</span>
                    <strong style="font-size: 1.5rem; color: #059669;" id="doc-grupo-promedio-aula">0.0</strong>
                </div>
            </div>
        </div>

        <!-- Tabla y Lista de Alumnos -->
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); border-radius: 16px; padding: 25px; backdrop-filter: blur(10px); box-shadow: 0 8px 32px rgba(31, 38, 135, 0.04);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="margin: 0; color: #1e293b; font-weight: 800; display: flex; align-items: center; gap: 8px;">
                    <i class='bx bx-list-ul' style="color: var(--primary);"></i> Lista Oficial del Grupo <span id="doc-grupo-badge-title" style="font-size:0.8rem; background:rgba(99,102,241,0.1); color:var(--primary); padding:2px 8px; border-radius:10px;">--</span>
                </h3>
                <input type="text" id="doc-grupo-search" placeholder="Buscar alumno..." oninput="buscarAlumnoEnGrupo()" style="padding: 6px 12px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; font-size: 0.85rem; width: 180px;">
            </div>

            <div style="overflow-x: auto; max-height: 400px;" class="custom-scroll">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="border-bottom: 2px solid #e2e8f0;">
                            <th style="padding: 12px 10px; font-size: 0.78rem; font-weight: 700; color: #64748b; text-transform: uppercase;">Matrícula</th>
                            <th style="padding: 12px 10px; font-size: 0.78rem; font-weight: 700; color: #64748b; text-transform: uppercase;">Alumno</th>
                            <th style="padding: 12px 10px; font-size: 0.78rem; font-weight: 700; color: #64748b; text-transform: uppercase; text-align: center;">Asistencia</th>
                            <th style="padding: 12px 10px; font-size: 0.78rem; font-weight: 700; color: #64748b; text-transform: uppercase; text-align: center;">Calificación</th>
                            <th style="padding: 12px 10px; font-size: 0.78rem; font-weight: 700; color: #64748b; text-transform: uppercase; text-align: center;">Estado</th>
                        </tr>
                    </thead>
                    <tbody id="doc-grupo-tabla-rows">
                            <!-- Datos dinámicos -->
                        </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script>
    // Datos mockup de alumnos por grupo
    const alumnosPorGrupoData = {};

    function actualizarTablaGrupo() {
        const grupoSelect = document.getElementById('doc-grupo-select').value;
        const info = alumnosPorGrupoData[grupoSelect];

        document.getElementById('doc-grupo-horario-info').innerHTML = info.horario;
        document.getElementById('doc-grupo-total-alumnos').textContent = info.alumnos.length;
        document.getElementById('doc-grupo-promedio-aula').textContent = info.promedio;
        document.getElementById('doc-grupo-badge-title').textContent = grupoSelect;

        renderAlumnosList(info.alumnos);
    }

    function renderAlumnosList(alumnos) {
        const tbody = document.getElementById('doc-grupo-tabla-rows');
        tbody.innerHTML = '';

        alumnos.forEach(a => {
            let badgeStyle = "background: rgba(5,150,105,0.1); color: #059669;";
            if (a.estado === 'Condicionado') {
                badgeStyle = "background: rgba(245,158,11,0.1); color: #d97706;";
            } else if (a.estado === 'Riesgo Deserción') {
                badgeStyle = "background: rgba(239,68,68,0.1); color: #ef4444;";
            }

            const tr = document.createElement('tr');
            tr.style.cssText = "border-bottom: 1px solid rgba(226, 232, 240, 0.5); font-size: 0.88rem; transition: background 0.2s;";
            tr.onmouseenter = () => tr.style.background = "rgba(99, 102, 241, 0.02)";
            tr.onmouseleave = () => tr.style.background = "transparent";

            tr.innerHTML = `
                <td style="padding: 14px 10px; font-weight: 700; color: #475569;">${a.matricula}</td>
                <td style="padding: 14px 10px; font-weight: 600; color: #1e293b;">${a.nombre}</td>
                <td style="padding: 14px 10px; text-align: center; color: #475569;">${a.asistencia}</td>
                <td style="padding: 14px 10px; text-align: center; font-weight: 800; color: var(--primary-dark);">${a.promedio}</td>
                <td style="padding: 14px 10px; text-align: center;">
                    <span style="padding: 3px 8px; border-radius: 20px; font-size: 0.72rem; font-weight: 700; ${badgeStyle}">${a.estado}</span>
                </td>
            `;

            tbody.appendChild(tr);
        });
    }

    function buscarAlumnoEnGrupo() {
        const query = document.getElementById('doc-grupo-search').value.toLowerCase().trim();
        const grupoSelect = document.getElementById('doc-grupo-select').value;
        const info = alumnosPorGrupoData[grupoSelect];

        const filtrados = info.alumnos.filter(a => 
            a.nombre.toLowerCase().includes(query) || 
            a.matricula.toLowerCase().includes(query)
        );

        renderAlumnosList(filtrados);
    }

    // Inicializar al cargar
    actualizarTablaGrupo();
</script>
