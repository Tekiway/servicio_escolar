<div class="animate__animated animate__fadeIn" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Encabezado -->
    <div class="module-header" style="margin-bottom: 5px;">
        <h2 style="color: #1e293b; font-size: 1.8rem; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i class='bx bxs-coupon' style="color: var(--primary);"></i> Pase de Acceso al Examen
        </h2>
        <p style="color: #64748b;">Tu boleto de entrada oficial para presentar el examen de admisión 2026.</p>
    </div>

    <!-- Si NO ha tramitado la ficha o el pago -->
    <div id="pase-bloqueado" style="display: none; background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 40px; border-radius: 16px; text-align: center; backdrop-filter: blur(10px);">
        <i class='bx bxs-lock-alt' style="font-size: 4rem; color: #94a3b8; margin-bottom: 15px;"></i>
        <h3 style="color: #1e293b; font-weight: 800; margin: 0 0 10px 0;">Pase no Generado</h3>
        <p style="color: #64748b; max-width: 500px; margin: 0 auto 20px auto; font-size: 0.9rem;" id="pase-mensaje-bloqueo">
            Debes completar tu trámite de ficha y haber validado tu pago de admisión para poder generar tu Pase de Acceso Oficial.
        </p>
        <button class="btn-finance-action" id="btn-pase-redireccion" onclick="cargarModulo('Ficha')" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white; margin: 0 auto;">
            Ir a Trámite de Ficha <i class='bx bx-right-arrow-alt'></i>
        </button>
    </div>

    <!-- Contenido del Pase Activo -->
    <div id="pase-activo" style="display: grid; grid-template-columns: 1.8fr 1.2fr; gap: 25px;">
        
        <!-- Columna Izquierda: El Pase Oficial (Diseño Premium de Boleto) -->
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); border-radius: 16px; backdrop-filter: blur(10px); box-shadow: 0 10px 25px rgba(0,0,0,0.03); overflow: hidden;">
            <!-- Parte superior del boleto -->
            <div style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; padding: 25px; position: relative;">
                <span style="font-size: 0.75rem; font-weight: 800; letter-spacing: 0.15em; text-transform: uppercase; opacity: 0.9;">PASE OFICIAL DE ADMISIÓN</span>
                <h3 style="margin: 5px 0 0 0; font-size: 1.6rem; font-weight: 900; line-height: 1.2;">EXAMEN DE INGRESO 2026</h3>
                
                <!-- Circulitos de corte estéticos para simular boleto en los lados -->
                <div style="position: absolute; bottom: -12px; left: -12px; width: 24px; height: 24px; border-radius: 50%; background: #f8fafc; z-index: 10;"></div>
                <div style="position: absolute; bottom: -12px; right: -12px; width: 24px; height: 24px; border-radius: 50%; background: #f8fafc; z-index: 10;"></div>
            </div>

            <!-- Cuerpo del boleto -->
            <div style="padding: 25px; display: flex; flex-direction: column; gap: 20px; background: rgba(255,255,255,0.4);">
                
                <!-- Datos del Alumno -->
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 15px; border-bottom: 1px solid rgba(0,0,0,0.05); padding-bottom: 15px;">
                    <div>
                        <span style="display:block; font-size:0.75rem; font-weight:700; color:#94a3b8; margin-bottom:2px;">ASPIRANTE</span>
                        <span style="font-size:1.1rem; font-weight:800; color:#1e293b;" id="pase-nombre">Diana Karen Santos Reyes</span>
                    </div>
                    <div>
                        <span style="display:block; font-size:0.75rem; font-weight:700; color:#94a3b8; margin-bottom:2px;">FOLIO EXAMEN</span>
                        <span style="font-size:1.1rem; font-weight:800; color:var(--primary-dark);" id="pase-folio">#EX2026-99120</span>
                    </div>
                </div>

                <!-- Detalles de la Asignación -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; border-bottom: 1px solid rgba(0,0,0,0.05); padding-bottom: 15px;">
                    <div>
                        <span style="display:block; font-size:0.75rem; font-weight:700; color:#94a3b8; margin-bottom:2px;">CARRERA SELECCIONADA</span>
                        <span style="font-weight:700; color:#475569;" id="pase-carrera">Ingeniería en TICs</span>
                    </div>
                    <div>
                        <span style="display:block; font-size:0.75rem; font-weight:700; color:#94a3b8; margin-bottom:2px;">MODALIDAD DE ESTUDIO</span>
                        <span style="font-weight:700; color:#475569;" id="pase-modalidad">Escolarizada</span>
                    </div>
                </div>

                <!-- Aula, Banco, Fecha y Hora -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; border-bottom: 1px dashed rgba(168, 85, 247, 0.3); padding-bottom: 20px;">
                    <div style="background: rgba(168, 85, 247, 0.03); border: 1px solid rgba(168, 85, 247, 0.08); padding: 12px; border-radius: 8px;">
                        <span style="display:block; font-size:0.7rem; font-weight:800; color:var(--primary); margin-bottom:3px; text-transform:uppercase;">Ubicación Asignada</span>
                        <span style="font-size:0.95rem; font-weight:800; color:#1e293b; display:block;">Edificio K - Aula 102</span>
                        <span style="font-size:0.8rem; color:#64748b;">Banco N° 14</span>
                    </div>
                    <div style="background: rgba(14, 165, 233, 0.03); border: 1px solid rgba(14, 165, 233, 0.08); padding: 12px; border-radius: 8px;">
                        <span style="display:block; font-size:0.7rem; font-weight:800; color:var(--secondary); margin-bottom:3px; text-transform:uppercase;">Fecha y Hora</span>
                        <span style="font-size:0.95rem; font-weight:800; color:#1e293b; display:block;">25 de Junio, 2026</span>
                        <span style="font-size:0.8rem; color:#64748b;">08:00 AM (Acceso)</span>
                    </div>
                </div>

                <!-- Botón Imprimir -->
                <div style="display: flex; gap: 15px; justify-content: flex-end;">
                    <button class="btn-finance-action secondary" onclick="imprimirPase()"><i class='bx bx-printer'></i> Imprimir Pase</button>
                    <button class="btn-finance-action" onclick="imprimirPase()" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white;"><i class='bx bxs-file-pdf'></i> Descargar PDF</button>
                </div>
            </div>
        </div>

        <!-- Columna Derecha: Indicaciones y QR -->
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 25px; border-radius: 16px; backdrop-filter: blur(10px); display: flex; flex-direction: column; gap: 20px; justify-content: space-between;">
            
            <!-- Indicaciones -->
            <div>
                <h3 style="margin: 0 0 12px 0; color: #1e293b; font-weight: 800; display: flex; align-items: center; gap: 8px;"><i class='bx bxs-info-circle' style="color: var(--primary);"></i> Instrucciones para el Examen</h3>
                <ul style="padding-left: 15px; font-size: 0.8rem; color: #64748b; display: flex; flex-direction: column; gap: 8px; margin: 0; line-height: 1.4;">
                    <li>Llega al menos <strong>30 minutos antes</strong> de la hora marcada de inicio.</li>
                    <li>Es obligatorio presentar este <strong>Pase Impreso</strong> junto con una <strong>Identificación Oficial</strong> vigente (INE, pasaporte o credencial escolar).</li>
                    <li>Traer lápiz del número 2 o 2.5, goma de borrar y sacapuntas.</li>
                    <li>Solo se permite el uso de calculadora básica (no científica).</li>
                    <li>Queda prohibido el ingreso de celulares al aula.</li>
                </ul>
            </div>

            <!-- Código QR -->
            <div style="border-top: 1px solid rgba(0,0,0,0.05); padding-top: 20px; text-align: center;">
                <div style="background: #fff; border: 1px solid #cbd5e1; border-radius: 8px; padding: 10px; width: 130px; height: 130px; margin: 0 auto 10px auto; display: flex; align-items: center; justify-content: center;">
                    <i class='bx bx-qr' style="font-size: 7rem; color: #1e293b;"></i>
                </div>
                <span style="font-size: 0.7rem; color: #94a3b8; font-weight: 700; letter-spacing: 0.1em; display: block; text-transform: uppercase;">
                    Código de Validación Único
                </span>
            </div>

        </div>
    </div>
</div>

<script>
    (function() {
        const storedFicha = localStorage.getItem('aspirante_ficha');
        const storedPago = localStorage.getItem('aspirante_pago');

        if (!storedFicha) {
            document.getElementById('pase-bloqueado').style.display = 'block';
            document.getElementById('btn-pase-redireccion').setAttribute('onclick', "cargarModulo('Ficha')");
            document.getElementById('btn-pase-redireccion').innerHTML = "Ir a Trámite de Ficha <i class='bx bx-right-arrow-alt'></i>";
            document.getElementById('pase-activo').style.display = 'none';
            return;
        }

        if (!storedPago) {
            document.getElementById('pase-bloqueado').style.display = 'block';
            document.getElementById('pase-mensaje-bloqueo').innerHTML = "Debes completar y registrar tu <strong>Pago de Admisión</strong> en el sistema para activar y visualizar tu Pase de Acceso Oficial.";
            document.getElementById('btn-pase-redireccion').setAttribute('onclick', "cargarModulo('Pago')");
            document.getElementById('btn-pase-redireccion').innerHTML = "Ir a Pago de Ficha <i class='bx bx-right-arrow-alt'></i>";
            document.getElementById('pase-activo').style.display = 'none';
            return;
        }

        // Mostrar pase activo
        document.getElementById('pase-bloqueado').style.display = 'none';
        document.getElementById('pase-activo').style.display = 'grid';

        // Cargar datos reales
        const dataFicha = JSON.parse(storedFicha);
        document.getElementById('pase-nombre').textContent = dataFicha.nombre;
        document.getElementById('pase-carrera').textContent = dataFicha.carrera;
        
        // Generar un folio de examen pseudoaleatorio basado en el nombre
        let hash = 0;
        for (let i = 0; i < dataFicha.nombre.length; i++) {
            hash = dataFicha.nombre.charCodeAt(i) + ((hash << 5) - hash);
        }
        const folioNum = Math.abs(hash % 90000) + 10000;
        document.getElementById('pase-folio').textContent = `#EX2026-${folioNum}`;

        // Obtener modalidad si existe
        if (dataFicha.modalidad) {
            document.getElementById('pase-modalidad').textContent = dataFicha.modalidad;
        } else {
            document.getElementById('pase-modalidad').textContent = "Escolarizada";
        }
    })();

    function imprimirPase() {
        alert("Preparando formato oficial para impresión y descarga...\n\nDocumento generado: Pase_Examen_Admision_2026.pdf (Listo para imprimir).");
    }
</script>
