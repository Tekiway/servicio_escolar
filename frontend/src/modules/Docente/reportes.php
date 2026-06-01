<div class="animate__animated animate__fadeIn" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Encabezado -->
    <div class="module-header" style="margin-bottom: 5px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
        <div>
            <h2 style="color: #1e293b; font-size: 1.8rem; font-weight: 800; display: flex; align-items: center; gap: 8px; margin: 0;">
                <i class='bx bxs-cloud-download' style="color: var(--primary);"></i> Reportes Académicos del Periodo
            </h2>
            <p style="color: #64748b; margin: 5px 0 0 0;">Descarga boletas del grupo, registros de calificaciones acumuladas, listas de firmas y kárdex académicos.</p>
        </div>
        <div>
            <select id="rep-grupo-select" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; font-weight: 600; color: #475569;">
                <option value="T4A">Programación Web I (T4A)</option>
                <option value="T6B">Bases de Datos Avanzadas (T6B)</option>
            </select>
        </div>
    </div>

    <!-- Malla de Reportes Disponibles -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
        
        <!-- Reporte 1: Boletas Consolidadas -->
        <div style="background: white; border: 1px solid #e2e8f0; border-radius: 16px; padding: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.02); display: flex; flex-direction: column; justify-content: space-between; gap: 15px;">
            <div>
                <div style="width: 45px; height: 45px; border-radius: 10px; background: rgba(99,102,241,0.1); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 15px;"><i class='bx bxs-spreadsheet'></i></div>
                <h3 style="margin: 0 0 5px 0; font-size: 1.05rem; font-weight: 800; color: #1e293b; font-family: 'Outfit', sans-serif;">Boletas Consolidadas del Grupo</h3>
                <p style="font-size: 0.8rem; color: #64748b; margin: 0; line-height: 1.5;">Descarga un archivo comprimido conteniendo las boletas oficiales de calificaciones de todos los alumnos inscritos en este ciclo.</p>
            </div>
            <button class="btn-finance-action" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white; width: 100%; justify-content: center; font-size: 0.82rem;" onclick="procesarDescargaReporte('Boletas Consolidadas', 'ZIP')">
                <i class='bx bxs-download'></i> DESCARGAR ZIP (BOLETAS)
            </button>
        </div>

        <!-- Reporte 2: Registro de Calificaciones -->
        <div style="background: white; border: 1px solid #e2e8f0; border-radius: 16px; padding: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.02); display: flex; flex-direction: column; justify-content: space-between; gap: 15px;">
            <div>
                <div style="width: 45px; height: 45px; border-radius: 10px; background: rgba(168,85,247,0.1); color: var(--secondary); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 15px;"><i class='bx bxs-medal'></i></div>
                <h3 style="margin: 0 0 5px 0; font-size: 1.05rem; font-weight: 800; color: #1e293b; font-family: 'Outfit', sans-serif;">Acta de Evaluación Continua</h3>
                <p style="font-size: 0.8rem; color: #64748b; margin: 0; line-height: 1.5;">Reporte detallado en formato Excel con todas las calificaciones de tareas, proyectos y exámenes parciales de los estudiantes.</p>
            </div>
            <button class="btn-finance-action" style="background: #0ea5e9; border: none; color: white; width: 100%; justify-content: center; font-size: 0.82rem;" onclick="procesarDescargaReporte('Acta de Evaluación Continua', 'XLSX')">
                <i class='bx bxs-file-blank'></i> DESCARGAR EXCEL (ACTA)
            </button>
        </div>

        <!-- Reporte 3: Lista de Firmas de Examen -->
        <div style="background: white; border: 1px solid #e2e8f0; border-radius: 16px; padding: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.02); display: flex; flex-direction: column; justify-content: space-between; gap: 15px;">
            <div>
                <div style="width: 45px; height: 45px; border-radius: 10px; background: rgba(14,165,233,0.1); color: var(--accent); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 15px;"><i class='bx bxs-user-check'></i></div>
                <h3 style="margin: 0 0 5px 0; font-size: 1.05rem; font-weight: 800; color: #1e293b; font-family: 'Outfit', sans-serif;">Lista de Firmas de Alumnos</h3>
                <p style="font-size: 0.8rem; color: #64748b; margin: 0; line-height: 1.5;">Descarga el formato de firmas oficial para la aplicación de exámenes finales presenciales y entrega de actas aprobadas.</p>
            </div>
            <button class="btn-finance-action" style="background: #10b981; border: none; color: white; width: 100%; justify-content: center; font-size: 0.82rem;" onclick="procesarDescargaReporte('Lista de Firmas de Alumnos', 'PDF')">
                <i class='bx bxs-file-pdf'></i> DESCARGAR PDF (FIRMAS)
            </button>
        </div>

    </div>

    <!-- Barra de Estado / Simulador de Descarga -->
    <div id="rep-simulador-panel" style="display: none; background: rgba(255,255,255,0.7); border: 1px solid rgba(226,232,240,0.8); border-radius: 12px; padding: 20px; text-align: center; max-width: 500px; margin: 20px auto 0 auto; flex-direction: column; gap: 12px; align-items: center;">
        <span style="font-size: 0.85rem; font-weight: 700; color: #1e293b;" id="rep-sim-titulo">Descargando...</span>
        <div style="background: #e2e8f0; height: 6px; border-radius: 3px; overflow: hidden; width: 100%; max-width: 250px;">
            <div id="rep-sim-bar" style="background: linear-gradient(90deg, var(--primary), var(--secondary)); width: 0%; height: 100%; transition: width 0.1s;"></div>
        </div>
        <span style="font-size: 0.75rem; color: #64748b;" id="rep-sim-desc">Conectando con el servidor escolar...</span>
    </div>
</div>

<script>
    function procesarDescargaReporte(nombreDoc, ext) {
        const grupo = document.getElementById('rep-grupo-select').value;
        const panel = document.getElementById('rep-simulador-panel');
        const titulo = document.getElementById('rep-sim-titulo');
        const desc = document.getElementById('rep-sim-desc');
        const bar = document.getElementById('rep-sim-bar');

        panel.style.display = 'flex';
        titulo.textContent = `Generando ${nombreDoc}...`;
        desc.textContent = "Cargando registros académicos en tiempo real...";
        bar.style.width = '0%';

        let pct = 0;
        const interval = setInterval(() => {
            pct += 20;
            bar.style.width = pct + '%';

            if (pct === 40) {
                desc.textContent = "Estructurando y formateando archivo oficial...";
            } else if (pct === 80) {
                desc.textContent = "Aplicando certificado de validez institucional digital...";
            }

            if (pct >= 100) {
                clearInterval(interval);
                desc.innerHTML = `<span style="color:#059669; font-weight:700;"><i class='bx bx-check-circle'></i> ¡Descarga Completa!</span>`;
                
                setTimeout(() => {
                    alert(`¡Éxito!\nArchivo descargado: ${nombreDoc.toUpperCase().replace(/\s+/g, '_')}_${grupo}_2026.${ext.toLowerCase()}`);
                    panel.style.display = 'none';
                }, 400);
            }
        }, 200);
    }
</script>
