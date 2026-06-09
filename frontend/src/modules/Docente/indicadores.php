<div class="animate__animated animate__fadeIn" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Encabezado -->
    <div class="module-header" style="margin-bottom: 5px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
        <div>
            <h2 style="color: #1e293b; font-size: 1.8rem; font-weight: 800; display: flex; align-items: center; gap: 8px; margin: 0;">
                <i class='bx bxs-bar-chart-alt-2' style="color: var(--primary);"></i> Indicadores de Rendimiento Docente
            </h2>
            <p style="color: #64748b; margin: 5px 0 0 0;">Monitorea métricas clave de asistencia escolar, entrega de tareas y rendimiento grupal de tus clases.</p>
        </div>
        <div>
            <select id="ind-grupo-select" onchange="cambiarGrupoIndicadores()" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; font-weight: 600; color: #475569;">
                <option value="" disabled selected>Cargando grupos...</option>
            </select>
        </div>
    </div>

    <!-- Malla de Estadísticas Clave -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px;">
        <!-- Promedio Aula -->
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); border-left: 5px solid var(--primary); padding: 20px; border-radius: 12px; display: flex; align-items: center; gap: 15px; backdrop-filter: blur(10px);">
            <div style="background: rgba(99,102,241,0.1); color: var(--primary); padding: 12px; border-radius: 10px; font-size: 1.8rem;"><i class='bx bx-star'></i></div>
            <div>
                <span style="font-size: 0.8rem; color: #64748b; font-weight: 700; display: block; text-transform: uppercase;">Promedio del Grupo</span>
                <span style="font-size: 1.6rem; font-weight: 800; color: #1e293b;" id="ind-stat-promedio">0.00 / 10</span>
            </div>
        </div>

        <!-- Asistencia Promedio -->
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); border-left: 5px solid var(--secondary); padding: 20px; border-radius: 12px; display: flex; align-items: center; gap: 15px; backdrop-filter: blur(10px);">
            <div style="background: rgba(168,85,247,0.1); color: var(--secondary); padding: 12px; border-radius: 10px; font-size: 1.8rem;"><i class='bx bx-calendar-check'></i></div>
            <div>
                <span style="font-size: 0.8rem; color: #64748b; font-weight: 700; display: block; text-transform: uppercase;">Asistencia Promedio</span>
                <span style="font-size: 1.6rem; font-weight: 800; color: #1e293b;" id="ind-stat-asistencia">0%</span>
            </div>
        </div>

        <!-- Cumplimiento Actividades -->
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); border-left: 5px solid var(--accent); padding: 20px; border-radius: 12px; display: flex; align-items: center; gap: 15px; backdrop-filter: blur(10px);">
            <div style="background: rgba(14,165,233,0.1); color: var(--accent); padding: 12px; border-radius: 10px; font-size: 1.8rem;"><i class='bx bx-task'></i></div>
            <div>
                <span style="font-size: 0.8rem; color: #64748b; font-weight: 700; display: block; text-transform: uppercase;">Cumplimiento Tareas</span>
                <span style="font-size: 1.6rem; font-weight: 800; color: #1e293b;" id="ind-stat-tareas">0%</span>
            </div>
        </div>
    </div>

    <!-- Layout: Gráficos de Rendimiento y Top de Alumnos -->
    <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 25px; align-items: start;">
        
        <!-- Distribución de Calificaciones (Gráfico CSS) -->
        <div style="background: white; border: 1px solid #e2e8f0; border-radius: 16px; padding: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.02); display: flex; flex-direction: column; gap: 20px;">
            <h3 style="margin: 0; font-size: 1.1rem; font-weight: 800; color: #1e293b; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 6px;">
                <i class='bx bxs-bar-chart-alt-2' style="color: var(--primary);"></i> RENDIMIENTO POR RANGO DE NOTAS
            </h3>
            
            <div style="display: flex; flex-direction: column; gap: 15px;" id="ind-grafico-container">
                <!-- Se llena dinámicamente -->
            </div>
        </div>

        <!-- Datos dinámicos -->

    </div>
</div>

<script>
    const indicadoresGrupoData = {};

    function cambiarGrupoIndicadores() {
        renderIndicadores();
    }

    function renderIndicadores() {
        const grupo = document.getElementById('ind-grupo-select').value;
        const data = indicadoresGrupoData[grupo];

        document.getElementById('ind-stat-promedio').textContent = `${data.promedio} / 10`;
        document.getElementById('ind-stat-asistencia').textContent = data.asistencia;
        document.getElementById('ind-stat-tareas').textContent = data.tareas;

        // Renderizar Gráfico
        const graficoContainer = document.getElementById('ind-grafico-container');
        graficoContainer.innerHTML = '';
        data.grafico.forEach(g => {
            const barRow = document.createElement('div');
            barRow.style.cssText = "display: flex; flex-direction: column; gap: 6px;";
            barRow.innerHTML = `
                <div style="display: flex; justify-content: space-between; font-size: 0.82rem; font-weight: 700; color: #475569;">
                    <span>${g.rango}</span>
                    <span>${g.alumnos} Alumnos (${g.pct})</span>
                </div>
                <div style="background: #e2e8f0; height: 12px; border-radius: 6px; overflow: hidden; width: 100%;">
                    <div style="background: linear-gradient(90deg, var(--primary), var(--secondary)); width: ${g.pct}; height: 100%; border-radius: 6px; transition: width 0.5s ease-out;"></div>
                </div>
            `;
            graficoContainer.appendChild(barRow);
        });

        // Renderizar Alertas
        const alertasContainer = document.getElementById('ind-alertas-container');
        alertasContainer.innerHTML = '';

        if (data.alertas.length === 0) {
            alertasContainer.innerHTML = `<div style="text-align:center; padding:20px; color:#64748b; font-size:0.85rem;">No hay alumnos en estado crítico en este grupo. ¡Excelente desempeño!</div>`;
            return;
        }

        data.alertas.forEach(a => {
            const alertCard = document.createElement('div');
            alertCard.style.cssText = "background: rgba(239, 68, 68, 0.04); border: 1px solid rgba(239, 68, 68, 0.15); border-left: 4px solid #ef4444; border-radius: 12px; padding: 12px 15px; display: flex; flex-direction: column; gap: 6px;";
            
            alertCard.innerHTML = `
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <strong style="color: #1e293b; font-size: 0.88rem;">${a.nombre}</strong>
                    <span style="font-size: 0.72rem; padding: 2px 6px; border-radius: 10px; background: rgba(239, 68, 68, 0.1); color: #ef4444; font-weight: 700;">Prom: ${a.promedio}</span>
                </div>
                <p style="margin: 0; font-size: 0.75rem; color: #64748b;"><strong>Detalle:</strong> ${a.motivo}</p>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 5px; border-top: 1px dashed rgba(239, 68, 68, 0.15); padding-top: 5px;">
                    <span style="font-size: 0.72rem; color: #ef4444;"><i class='bx bx-calendar'></i> Asist: ${a.asistencia}</span>
                    <button class="btn-finance-action" style="padding: 2px 8px; font-size: 0.68rem; background: #ef4444; border: none; color: white;" onclick="canalizarTutoría('${a.nombre}')">Canalizar</button>
                </div>
            `;
            alertasContainer.appendChild(alertCard);
        });
    }

    function canalizarTutoría(nombreAlumno) {
        alert(`¡Canalización Exitosa!\nSe ha enviado un reporte oficial al área de Tutorías y al correo institucional del tutor asignado para el alumno: ${nombreAlumno}.`);
    }

    // Inicializar
    renderIndicadores();
</script>
