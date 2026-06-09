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
                <option value="" disabled selected>Cargando grupos...</option>
            </select>
        </div>
    </div>

    <!-- Malla de Reportes Disponibles -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
        
        <!-- Datos dinámicos -->

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
