<div class="animate__animated animate__fadeIn" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Encabezado -->
    <div class="module-header" style="margin-bottom: 5px;">
        <h2 style="color: #1e293b; font-size: 1.8rem; font-weight: 800; display: flex; align-items: center; gap: 8px; margin: 0;">
            <i class='bx bxs-file-blank' style="color: var(--primary);"></i> Documentos Automáticos
        </h2>
        <p style="color: #64748b; margin: 5px 0 0 0;">Genera listas oficiales, actas de calificaciones con validez institucional, reportes y constancias en un clic.</p>
    </div>

    <!-- Panel Principal de Generación -->
    <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 25px; align-items: start;">
        
        <!-- Opciones de Generación de Documentos -->
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); border-radius: 16px; padding: 25px; backdrop-filter: blur(10px); box-shadow: 0 8px 32px rgba(31, 38, 135, 0.04); display: flex; flex-direction: column; gap: 20px;">
            <h3 style="margin: 0; color: #1e293b; font-weight: 800; display: flex; align-items: center; gap: 8px;">
                <i class='bx bxs-file' style="color: var(--primary);"></i> Catálogo de Documentación Académica
            </h3>
            
            <div style="display: flex; flex-direction: column; gap: 15px;">
                <!-- Documento 1: Lista de Asistencia -->
                <div style="background: rgba(255,255,255,0.4); border: 1px solid rgba(226, 232, 240, 0.8); border-radius: 12px; padding: 15px; display: flex; justify-content: space-between; align-items: center; gap: 15px;">
                    <div style="display: flex; gap: 12px; align-items: center;">
                        <div style="width: 42px; height: 42px; border-radius: 8px; background: rgba(99,102,241,0.1); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1.3rem;"><i class='bx bxs-spreadsheet'></i></div>
                        <div>
                            <strong style="color: #1e293b; font-size: 0.9rem; display: block;">Lista de Asistencia Oficial</strong>
                            <span style="font-size: 0.78rem; color: #64748b;">Genera la lista con firmas en formato PDF para el control físico en aula.</span>
                        </div>
                    </div>
                    <button class="btn-finance-action" style="padding: 8px 14px; font-size: 0.8rem;" onclick="prepararGeneracion('Lista de Asistencia Oficial', 'asistencia')">Generar</button>
                </div>

                <!-- Documento 2: Acta de Calificaciones -->
                <div style="background: rgba(255,255,255,0.4); border: 1px solid rgba(226, 232, 240, 0.8); border-radius: 12px; padding: 15px; display: flex; justify-content: space-between; align-items: center; gap: 15px;">
                    <div style="display: flex; gap: 12px; align-items: center;">
                        <div style="width: 42px; height: 42px; border-radius: 8px; background: rgba(168,85,247,0.1); color: var(--secondary); display: flex; align-items: center; justify-content: center; font-size: 1.3rem;"><i class='bx bxs-badge-check'></i></div>
                        <div>
                            <strong style="color: #1e293b; font-size: 0.9rem; display: block;">Acta de Calificaciones Parciales</strong>
                            <span style="font-size: 0.78rem; color: #64748b;">Genera el acta con firma digital y códigos de validación de control escolar.</span>
                        </div>
                    </div>
                    <button class="btn-finance-action" style="padding: 8px 14px; font-size: 0.8rem;" onclick="prepararGeneracion('Acta de Calificaciones Parciales', 'acta')">Generar</button>
                </div>

                <!-- Documento 3: Reporte de Rendimiento -->
                <div style="background: rgba(255,255,255,0.4); border: 1px solid rgba(226, 232, 240, 0.8); border-radius: 12px; padding: 15px; display: flex; justify-content: space-between; align-items: center; gap: 15px;">
                    <div style="display: flex; gap: 12px; align-items: center;">
                        <div style="width: 42px; height: 42px; border-radius: 8px; background: rgba(14,165,233,0.1); color: var(--accent); display: flex; align-items: center; justify-content: center; font-size: 1.3rem;"><i class='bx bxs-chart'></i></div>
                        <div>
                            <strong style="color: #1e293b; font-size: 0.9rem; display: block;">Reporte de Rendimiento del Grupo</strong>
                            <span style="font-size: 0.78rem; color: #64748b;">Análisis estadístico de promedios, aprobados y reprobados del periodo.</span>
                        </div>
                    </div>
                    <button class="btn-finance-action" style="padding: 8px 14px; font-size: 0.8rem;" onclick="prepararGeneracion('Reporte de Rendimiento del Grupo', 'rendimiento')">Generar</button>
                </div>
            </div>
        </div>

        <!-- Panel de Generación en Tiempo Real -->
        <div style="background: white; border: 1px solid #e2e8f0; border-radius: 16px; padding: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.02);" id="panel-generacion-documento">
            <h3 style="margin: 0 0 15px 0; font-size: 1.1rem; font-weight: 800; color: #1e293b; font-family: 'Outfit', sans-serif;">PROCESAMIENTO DE DOCUMENTOS</h3>
            
            <div style="text-align: center; padding: 40px 10px; color: #64748b;" id="doc-generador-estado-inicial">
                <i class='bx bx-file-find' style="font-size: 3.5rem; color: #cbd5e1; margin-bottom: 10px; display: block;"></i>
                <p style="font-size: 0.9rem; margin: 0;">Selecciona un documento de la lista de la izquierda y haz clic en <strong>Generar</strong> para procesarlo con los datos del servidor.</p>
            </div>

            <!-- Pantalla de Proceso (Oculta al inicio) -->
            <div id="doc-generador-proceso" style="display: none; flex-direction: column; justify-content: center; align-items: center; text-align: center; padding: 30px 10px; gap: 20px;">
                <h4 style="margin: 0; color: #1e293b; font-size: 1rem; font-weight: 800;" id="doc-proceso-titulo">Generando Documento...</h4>
                
                <div style="display: flex; flex-direction: column; gap: 8px; width: 100%; max-width: 220px; align-items: center;">
                    <div style="background: #e2e8f0; height: 8px; border-radius: 4px; overflow: hidden; width: 100%;">
                        <div id="doc-proceso-bar" style="background: linear-gradient(90deg, var(--primary), var(--secondary)); width: 0%; height: 100%; transition: width 0.1s;"></div>
                    </div>
                    <span style="font-size: 0.8rem; color: #64748b; font-weight: 700;" id="doc-proceso-pct">0%</span>
                </div>
                <p style="font-size: 0.8rem; color: #94a3b8; margin: 0;">Compilando firmas institucionales y cifrando en PDF/A-1b...</p>
            </div>

            <!-- Pantalla de Éxito y Descarga -->
            <div id="doc-generador-resultado" style="display: none; flex-direction: column; align-items: center; text-align: center; padding: 30px 10px; gap: 15px;">
                <div style="width: 65px; height: 65px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 3rem; background: rgba(5,150,105,0.1); color: #059669; border: 2px solid #059669; margin-bottom: 5px;">
                    <i class='bx bxs-file-pdf'></i>
                </div>
                <h4 style="margin: 0; color: #1e293b; font-size: 1.1rem; font-weight: 800;" id="doc-resultado-titulo">Lista de Asistencia Generada</h4>
                <p style="font-size: 0.85rem; color: #64748b; margin: 0; max-width: 260px;">El documento se compiló con éxito y cuenta con código QR de verificación de validez oficial.</p>
                
                <div style="display: flex; flex-direction: column; gap: 8px; width: 100%; margin-top: 10px;">
                    <button class="btn-finance-action" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white; justify-content: center;" onclick="descargarDocumentoFinal()">
                        <i class='bx bxs-download'></i> DESCARGAR DOCUMENTO PDF
                    </button>
                    <button class="btn-finance-action" style="background: #e2e8f0; color: #475569; border: none; justify-content: center;" onclick="reiniciarGenerador()">
                        Generar Otro Documento
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    let activeDocName = "";
    let activeDocKey = "";

    function prepararGeneracion(docName, docKey) {
        activeDocName = docName;
        activeDocKey = docKey;

        document.getElementById('doc-generador-estado-inicial').style.display = 'none';
        document.getElementById('doc-generador-resultado').style.display = 'none';
        document.getElementById('doc-generador-proceso').style.display = 'flex';

        document.getElementById('doc-proceso-titulo').textContent = `Generando ${docName}...`;

        let pct = 0;
        const bar = document.getElementById('doc-proceso-bar');
        const textPct = document.getElementById('doc-proceso-pct');

        const interval = setInterval(() => {
            pct += 10;
            bar.style.width = pct + '%';
            textPct.textContent = pct + '%';

            if (pct >= 100) {
                clearInterval(interval);
                mostrarDocumentoResultado();
            }
        }, 150);
    }

    function mostrarDocumentoResultado() {
        document.getElementById('doc-generador-proceso').style.display = 'none';
        document.getElementById('doc-generador-resultado').style.display = 'flex';

        document.getElementById('doc-resultado-titulo').textContent = activeDocName;
    }

    function descargarDocumentoFinal() {
        alert(`Descargando el documento oficial compilado del servidor...\nArchivo: ${activeDocKey.toUpperCase()}_OFFICIAL_2026.pdf`);
    }

    function reiniciarGenerador() {
        document.getElementById('doc-generador-resultado').style.display = 'none';
        document.getElementById('doc-generador-estado-inicial').style.display = 'flex';
        activeDocName = "";
        activeDocKey = "";
    }
</script>
