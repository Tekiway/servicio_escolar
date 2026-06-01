<div class="animate__animated animate__fadeIn" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Encabezado -->
    <div class="module-header" style="margin-bottom: 5px;">
        <h2 style="color: #1e293b; font-size: 1.8rem; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i class='bx bxs-credit-card' style="color: var(--primary);"></i> Pago de Ficha de Admisión
        </h2>
        <p style="color: #64748b;">Descarga tu formato referenciado y reporta tu comprobante para activar tu pase de examen.</p>
    </div>

    <!-- Si NO ha tramitado la ficha -->
    <div id="pago-bloqueado" style="display: none; background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 40px; border-radius: 16px; text-align: center; backdrop-filter: blur(10px);">
        <i class='bx bxs-lock-alt' style="font-size: 4rem; color: #94a3b8; margin-bottom: 15px;"></i>
        <h3 style="color: #1e293b; font-weight: 800; margin: 0 0 10px 0;">Paso Bloqueado</h3>
        <p style="color: #64748b; max-width: 500px; margin: 0 auto 20px auto; font-size: 0.9rem;">
            Antes de realizar el pago, debes completar tu registro escolar y selección de carrera en el módulo de <strong>Trámite de Ficha</strong>.
        </p>
        <button class="btn-finance-action" onclick="cargarModulo('Ficha')" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white; margin: 0 auto;">
            Ir a Trámite de Ficha <i class='bx bx-right-arrow-alt'></i>
        </button>
    </div>

    <!-- Contenido de Pago -->
    <div id="pago-activo" style="display: grid; grid-template-columns: 1.2fr 1.8fr; gap: 25px;">
        
        <!-- Columna Izquierda: Detalles del Pago -->
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 25px; border-radius: 16px; backdrop-filter: blur(10px); display: flex; flex-direction: column; gap: 20px;">
            <h3 style="margin: 0; color: #1e293b; font-weight: 800;">Detalles del Depósito</h3>
            
            <div style="background: rgba(168, 85, 247, 0.05); border: 1px solid rgba(168, 85, 247, 0.15); padding: 15px; border-radius: 12px; display: flex; flex-direction: column; gap: 10px;">
                <span style="font-size: 0.8rem; font-weight: 700; color: var(--primary);">CONCEPTO DE PAGO</span>
                <span style="font-size: 1.1rem; font-weight: 800; color: #1e293b;">Derecho a Examen de Admisión</span>
                <div style="display: flex; justify-content: space-between; align-items: baseline; margin-top: 5px;">
                    <span style="font-size: 0.8rem; color: #64748b;">Monto oficial:</span>
                    <span style="font-size: 1.5rem; font-weight: 900; color: var(--primary-dark);">$850.00 MXN</span>
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 12px; font-size: 0.85rem; color: #64748b;">
                <div style="display: flex; justify-content: space-between; border-bottom: 1px dashed #e2e8f0; padding-bottom: 8px;">
                    <strong>Banco Receptor:</strong>
                    <span>BBVA Bancomer</span>
                </div>
                <div style="display: flex; justify-content: space-between; border-bottom: 1px dashed #e2e8f0; padding-bottom: 8px;">
                    <strong>Convenio CIE:</strong>
                    <span>1882931</span>
                </div>
                <div style="display: flex; justify-content: space-between; border-bottom: 1px dashed #e2e8f0; padding-bottom: 8px;">
                    <strong>Referencia Personal:</strong>
                    <span id="pago-referencia" style="font-family: monospace; font-weight: 700; color: #1e293b;">ASP2026-0918-A</span>
                </div>
            </div>

            <button class="btn-finance-action secondary" onclick="descargarOrdenPago()" style="width: 100%; justify-content: center;">
                <i class='bx bxs-file-pdf'></i> Descargar Orden de Pago PDF
            </button>
        </div>

        <!-- Columna Derecha: Subir Comprobante -->
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 25px; border-radius: 16px; backdrop-filter: blur(10px); display: flex; flex-direction: column; gap: 20px;">
            <h3 style="margin: 0; color: #1e293b; font-weight: 800;">Reportar Comprobante</h3>
            
            <!-- Estado 1: Pendiente de Subir -->
            <div id="pago-estado-subir" style="display: flex; flex-direction: column; gap: 15px;">
                <p style="margin: 0; font-size: 0.9rem; color: #64748b;">
                    Una vez realizado el depósito bancario o transferencia, escribe los datos de la transacción y adjunta una captura legible de tu comprobante.
                </p>

                <form id="form-reportar-pago" onsubmit="enviarComprobantePago(event)" style="display: flex; flex-direction: column; gap: 15px;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                        <div style="display: flex; flex-direction: column; gap: 5px;">
                            <label style="font-size: 0.75rem; font-weight: 700; color: #64748b;">FOLIO DE OPERACIÓN / AUTORIZACIÓN</label>
                            <input type="text" id="pago-transaccion" required placeholder="Ej. 182749" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none;">
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 5px;">
                            <label style="font-size: 0.75rem; font-weight: 700; color: #64748b;">FECHA DE PAGO</label>
                            <input type="date" id="pago-fecha" required style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none;">
                        </div>
                    </div>

                    <!-- Drag and Drop Mock -->
                    <div style="border: 2px dashed rgba(168, 85, 247, 0.4); background: rgba(168, 85, 247, 0.02); padding: 30px; border-radius: 12px; text-align: center; cursor: pointer; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 8px;" onclick="document.getElementById('pago-archivo').click()">
                        <i class='bx bx-cloud-upload' style="font-size: 3rem; color: var(--primary);"></i>
                        <span style="font-weight: 700; color: #1e293b; font-size: 0.9rem;">Haz clic para seleccionar tu comprobante</span>
                        <span style="font-size: 0.75rem; color: #94a3b8;">Formatos permitidos: JPG, PNG o PDF (Máx 5MB)</span>
                        <input type="file" id="pago-archivo" style="display: none;" required onchange="actualizarNombreArchivo(this)">
                        <span id="nombre-archivo-cargado" style="font-size: 0.8rem; font-weight: 700; color: #059669; display: none;"></span>
                    </div>

                    <button class="btn-finance-action" type="submit" style="justify-content: center; width: 100%; background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white;">
                        <i class='bx bx-send'></i> ENVIAR COMPROBANTE A VALIDACIÓN
                    </button>
                </form>
            </div>

            <!-- Estado 2: Comprobante Enviado / Validado -->
            <div id="pago-estado-validado" style="display: none; text-align: center; padding: 20px 0; display: flex; flex-direction: column; align-items: center; gap: 15px;">
                <div style="background: rgba(5,150,105,0.1); color: #059669; width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 3rem; box-shadow: 0 4px 15px rgba(5,150,105,0.2);">
                    <i class='bx bx-check-shield'></i>
                </div>
                <div>
                    <h4 style="color: #1e293b; font-size: 1.2rem; font-weight: 800; margin: 0 0 5px 0;">Comprobante de Pago Validado</h4>
                    <p style="color: #64748b; font-size: 0.9rem; max-width: 400px; margin: 0;">
                        Tu pago ha sido registrado e integrado con éxito al Sistema de Control Escolar. Se ha habilitado la descarga de tu guía de estudio y tu pase de examen.
                    </p>
                </div>

                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 15px; width: 100%; max-width: 400px; text-align: left; font-size: 0.85rem; color: #64748b; display: flex; flex-direction: column; gap: 8px;">
                    <div><strong>Folio Transacción:</strong> <span id="val-transaccion" style="color:#1e293b; font-weight:700;">#9981273</span></div>
                    <div><strong>Fecha Reporte:</strong> <span id="val-fecha" style="color:#1e293b; font-weight:700;">01 de Junio de 2026</span></div>
                    <div><strong>Estado:</strong> <span class="badge" style="background:#rgba(5,150,105,0.1); color:#059669; font-weight:700; padding:2px 8px; border-radius:10px;">Aprobado</span></div>
                </div>

                <button class="btn-finance-action secondary" onclick="cancelarPagoReportado()" style="margin-top: 10px;">
                    <i class='bx bx-undo'></i> Reportar Otro Comprobante
                </button>
            </div>

        </div>
    </div>
</div>

<script>
    (function() {
        const storedFicha = localStorage.getItem('aspirante_ficha');
        if (!storedFicha) {
            document.getElementById('pago-bloqueado').style.display = 'block';
            document.getElementById('pago-activo').style.display = 'none';
            return;
        }

        // Generar referencia en base al CURP
        const dataFicha = JSON.parse(storedFicha);
        if (dataFicha.curp) {
            const curpCorto = dataFicha.curp.substring(0, 10).toUpperCase();
            document.getElementById('pago-referencia').textContent = `ASP-${curpCorto}-2026`;
        }

        // Verificar si ya reportó su pago
        const storedPago = localStorage.getItem('aspirante_pago');
        if (storedPago) {
            const dataPago = JSON.parse(storedPago);
            mostrarPagoValidado(dataPago);
        } else {
            document.getElementById('pago-estado-subir').style.display = 'flex';
            document.getElementById('pago-estado-validado').style.display = 'none';
        }
    })();

    function actualizarNombreArchivo(input) {
        const nombreArchivoSpan = document.getElementById('nombre-archivo-cargado');
        if (input.files && input.files[0]) {
            nombreArchivoSpan.textContent = `✓ Archivo seleccionado: ${input.files[0].name}`;
            nombreArchivoSpan.style.display = 'block';
        } else {
            nombreArchivoSpan.style.display = 'none';
        }
    }

    function mostrarPagoValidado(data) {
        document.getElementById('val-transaccion').textContent = '#' + data.transaccion;
        
        // Formatear fecha bonita
        const dateParts = data.fecha.split('-');
        const dateObj = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('val-fecha').textContent = dateObj.toLocaleDateString('es-MX', options);

        document.getElementById('pago-estado-subir').style.display = 'none';
        document.getElementById('pago-estado-validado').style.display = 'flex';
    }

    function enviarComprobantePago(event) {
        event.preventDefault();
        const transaccion = document.getElementById('pago-transaccion').value;
        const fecha = document.getElementById('pago-fecha').value;

        const data = { transaccion, fecha };
        localStorage.setItem('aspirante_pago', JSON.stringify(data));

        alert("¡Comprobante de pago recibido!\n\nEl sistema validó automáticamente tu transacción en ventanilla CIE. Se han desbloqueado los pasos de Admisión.");
        mostrarPagoValidado(data);
        
        // Disparar refresco de header si es necesario
        cargarModulo('Pago');
    }

    function cancelarPagoReportado() {
        if (confirm("¿Seguro que deseas reportar un comprobante diferente? Esto invalidará tu pase actual temporalmente.")) {
            localStorage.removeItem('aspirante_pago');
            document.getElementById('pago-estado-validado').style.display = 'none';
            document.getElementById('pago-estado-subir').style.display = 'flex';
        }
    }

    function descargarOrdenPago() {
        alert("Generando orden de pago referenciada en formato PDF...\n\nConvenio CIE: 1882931\nConcepto: Examen Admisión 2026\nGuardado en Descargas.");
    }
</script>
