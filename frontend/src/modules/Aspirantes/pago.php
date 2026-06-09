<div class="animate__animated animate__fadeIn" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Encabezado -->
    <div class="module-header" style="margin-bottom: 5px;">
        <h2 style="color: #1e293b; font-size: 1.8rem; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i class='bx bxs-credit-card' style="color: var(--primary); font-size: 2rem;"></i> Formato y Pago del Examen de Admisión
        </h2>
        <p style="color: #64748b;">Descarga tu formato para depósito bancario o liquida en línea mediante pago express seguro.</p>
    </div>

    <!-- Blocker de Validación -->
    <div id="pago-blocker-message" style="display: none; background: #fff; border: 1px solid rgba(0,0,0,0.05); padding: 40px; text-align: center; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
        <i class='bx bx-lock-alt' style="font-size: 4.5rem; color: #ef4444; margin-bottom: 15px;"></i>
        <h3 style="font-size: 1.4rem; font-weight: 800; color: #1e293b;">Módulo Bloqueado</h3>
        <p style="color: #64748b; margin-top: 5px; max-width: 500px; margin-left: auto; margin-right: auto; line-height: 1.6;" id="pago-blocker-text">
            Antes de proceder al pago, debes tramitar tu <strong>Ficha de Examen</strong> y subir tus <strong>Documentos Oficiales</strong> para validación escolar.
        </p>
        <button id="pago-blocker-btn" class="btn-finance-action" style="margin-top: 20px; background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white;" onclick="cargarModulo('Ficha')">
            <i class='bx bxs-edit-location'></i> Completar Trámites Previos
        </button>
    </div>

    <!-- Interfaz de Pago General -->
    <div id="pago-container" style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 30px; border-radius: 16px; backdrop-filter: blur(10px); box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
        
        <!-- Pestañas de Pago -->
        <div style="display: flex; gap: 15px; border-bottom: 1px solid #cbd5e1; padding-bottom: 15px; margin-bottom: 25px;">
            <button class="tab-btn active" id="tab-btn-banco" onclick="switchPagoTab('banco')" style="padding: 10px 20px; font-weight: 800; border: none; background: none; border-bottom: 3px solid var(--primary); color: var(--primary); cursor: pointer; display: flex; align-items: center; gap: 8px;">
                <i class='bx bxs-bank'></i> Pago en Ventanilla (Banco)
            </button>
            <button class="tab-btn" id="tab-btn-tarjeta" onclick="switchPagoTab('tarjeta')" style="padding: 10px 20px; font-weight: 800; border: none; background: none; color: #64748b; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                <i class='bx bxs-credit-card-front'></i> Pago Express en Línea
            </button>
        </div>

        <!-- Opción 1: Banco Ficha de Depósito -->
        <div id="pago-tab-banco" style="display: block;">
            <div style="background: white; border: 2px dashed #9333ea; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.01);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <span style="font-weight: 800; color: #1e293b; font-size: 1.1rem; display: flex; align-items: center; gap: 6px;"><i class='bx bxs-institution' style="color:var(--primary);"></i> ORDEN DE PAGO REFERENCIADA</span>
                    <span style="color: #64748b; font-size: 0.8rem; font-weight: 700;">Emisión: 2026</span>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; font-size: 0.95rem; color: #475569; margin-bottom: 25px;">
                    <div style="display: flex; flex-direction: column; gap: 6px;">
                        <span><strong>Establecimiento/Banco:</strong> BBVA Bancomer</span>
                        <span><strong>Convenio CIE:</strong> #8392102</span>
                        <span><strong>Concepto:</strong> Examen de Admisión Nuevo Ingreso</span>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 6px;">
                        <span><strong>Referencia Única:</strong> <span style="font-family: monospace; font-weight: 800; color:var(--primary-dark);">REF2026ADM0881392A</span></span>
                        <span><strong>Importe Total:</strong> <strong style="color: #059669; font-size: 1.25rem;">--- MXN</strong></span>
                        <span><strong>Vencimiento:</strong> 20 de Junio, 2026</span>
                    </div>
                </div>

                <div style="border-top: 1px dashed #cbd5e1; padding-top: 20px; display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.8rem; color: #94a3b8; max-width: 60%;"><i class='bx bx-info-circle'></i> Una vez realizado tu depósito bancario, el pago se validará automáticamente en un plazo de 24 a 48 horas escolares.</span>
                    <button class="btn-finance-action" onclick="alert('Descargando PDF de Referencia CIE_BBVA_8392.pdf...')">
                        <i class='bx bxs-download'></i> Descargar Ficha CIE
                    </button>
                </div>
            </div>
            
            <div style="margin-top: 25px; text-align: center;">
                <p style="font-size: 0.85rem; color: #64748b;">¿Prefieres no ir al banco? Puedes pagar al instante y validar tu examen de inmediato:</p>
                <button class="btn-finance-action" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white; margin-top: 10px; display: inline-flex;" onclick="switchPagoTab('tarjeta')">
                    <i class='bx bxs-bolt' style="font-size: 1.1rem;"></i> Usar Pago Express Seguro
                </button>
            </div>
        </div>

        <!-- Opción 2: Tarjeta en Línea Express -->
        <div id="pago-tab-tarjeta" style="display: none;">
            <div style="display: grid; grid-template-columns: 1fr 1.2fr; gap: 30px; align-items: center;">
                <!-- Mock Card Visual -->
                <div style="background: linear-gradient(135deg, #1e1b4b, #4338ca); color: white; padding: 25px; border-radius: 16px; box-shadow: 0 10px 25px rgba(67, 56, 202, 0.25); height: 210px; display: flex; flex-direction: column; justify-content: space-between; font-family: monospace; letter-spacing: 1px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-style: italic; font-weight: bold; font-size: 1.1rem;">EXPRESS CARD</span>
                        <i class='bx bxl-visa' style="font-size: 3rem; line-height: 0;"></i>
                    </div>
                    
                    <div>
                        <div style="background: #e2e8f0; width: 45px; height: 35px; border-radius: 6px; margin-bottom: 15px; opacity: 0.8;"></div>
                        <span id="visual-card-number" style="font-size: 1.2rem; display: block; font-weight: bold;">•••• •••• •••• ••••</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.8rem;">
                        <div>
                            <small style="opacity: 0.6; display: block; font-size: 0.6rem;">CARDHOLDER</small>
                            <span id="visual-card-name" style="text-transform: uppercase;">TU NOMBRE</span>
                        </div>
                        <div style="text-align: right;">
                            <small style="opacity: 0.6; display: block; font-size: 0.6rem;">EXPIRES</small>
                            <span id="visual-card-expiry">MM/AA</span>
                        </div>
                    </div>
                </div>

                <!-- Formulario -->
                <form id="form-pago-express" onsubmit="procesarPagoExpress(event)" style="display: flex; flex-direction: column; gap: 15px;">
                    <div style="display: flex; flex-direction: column; gap: 4px;">
                        <label style="font-size: 0.75rem; font-weight: 700; color: #64748b;">NOMBRE EN LA TARJETA</label>
                        <input type="text" id="card-name" required placeholder="Ej. Diana Karen Santos Reyes" oninput="updateCardVisual()" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; text-transform: uppercase;">
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 4px;">
                        <label style="font-size: 0.75rem; font-weight: 700; color: #64748b;">NÚMERO DE TARJETA</label>
                        <input type="text" id="card-number" required placeholder="4000 1234 5678 9010" maxlength="19" oninput="formatCardNumber(); updateCardVisual();" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none;">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                        <div style="display: flex; flex-direction: column; gap: 4px;">
                            <label style="font-size: 0.75rem; font-weight: 700; color: #64748b;">VENCIMIENTO</label>
                            <input type="text" id="card-expiry" required placeholder="MM/AA" maxlength="5" oninput="formatExpiry(); updateCardVisual();" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; text-align: center;">
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 4px;">
                            <label style="font-size: 0.75rem; font-weight: 700; color: #64748b;">CVC / CVV</label>
                            <input type="password" id="card-cvv" required placeholder="•••" maxlength="3" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; text-align: center;">
                        </div>
                    </div>

                    <button class="btn-finance-action" type="submit" style="margin-top: 10px; justify-content: center; width: 100%; background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white;" id="btn-pay-action">
                        <i class='bx bx-check-shield' style="font-size:1.1rem;"></i> PAGAR CON PASARELA SEGURA (---)
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    (function() {
        const storedFicha = localStorage.getItem('aspirante_ficha');
        const storedDocs = localStorage.getItem('aspirante_documentos');
        // Bloqueos removidos.

        if (!storedDocs) {
            blocker.style.display = 'block';
            content.style.display = 'none';
            blockerText.innerHTML = "Tu ficha está registrada, pero aún debes realizar la <strong>Carga de Documentos</strong> oficiales de tu expediente escolar para poder pagar.";
            blockerBtn.innerHTML = "<i class='bx bxs-cloud-upload'></i> Subir Documentos Oficiales";
            blockerBtn.setAttribute("onclick", "cargarModulo('Documentos')");
            return;
        }

        // Cargar nombre del aspirante predeterminado si existe
        const data = JSON.parse(storedFicha);
        document.getElementById('card-name').value = data.nombre.toUpperCase();
        updateCardVisual();
    })();

    function switchPagoTab(tab) {
        const btnBanco = document.getElementById('tab-btn-banco');
        const btnTarjeta = document.getElementById('tab-btn-tarjeta');
        const tabBanco = document.getElementById('pago-tab-banco');
        const tabTarjeta = document.getElementById('pago-tab-tarjeta');

        if (tab === 'banco') {
            btnBanco.className = 'tab-btn active';
            btnBanco.style.borderBottom = '3px solid var(--primary)';
            btnBanco.style.color = 'var(--primary)';
            
            btnTarjeta.className = 'tab-btn';
            btnTarjeta.style.borderBottom = 'none';
            btnTarjeta.style.color = '#64748b';
            
            tabBanco.style.display = 'block';
            tabTarjeta.style.display = 'none';
        } else {
            btnTarjeta.className = 'tab-btn active';
            btnTarjeta.style.borderBottom = '3px solid var(--primary)';
            btnTarjeta.style.color = 'var(--primary)';
            
            btnBanco.className = 'tab-btn';
            btnBanco.style.borderBottom = 'none';
            btnBanco.style.color = '#64748b';
            
            tabTarjeta.style.display = 'block';
            tabBanco.style.display = 'none';
        }
    }

    // Actualizador visual de tarjeta
    function updateCardVisual() {
        const nameVal = document.getElementById('card-name').value.trim();
        const numVal = document.getElementById('card-number').value.trim();
        const expVal = document.getElementById('card-expiry').value.trim();

        document.getElementById('visual-card-name').textContent = nameVal ? nameVal : 'TU NOMBRE';
        document.getElementById('visual-card-number').textContent = numVal ? numVal : '•••• •••• •••• ••••';
        document.getElementById('visual-card-expiry').textContent = expVal ? expVal : 'MM/AA';
    }

    function formatCardNumber() {
        let input = document.getElementById('card-number');
        let val = input.value.replace(/\D/g, '');
        let formatted = '';
        for (let i = 0; i < val.length; i++) {
            if (i > 0 && i % 4 === 0) formatted += ' ';
            formatted += val[i];
        }
        input.value = formatted;
    }

    function formatExpiry() {
        let input = document.getElementById('card-expiry');
        let val = input.value.replace(/\D/g, '');
        if (val.length >= 2) {
            input.value = val.substring(0, 2) + '/' + val.substring(2, 4);
        } else {
            input.value = val;
        }
    }

    function procesarPagoExpress(event) {
        event.preventDefault();
        const btn = document.getElementById('btn-pay-action');
        btn.disabled = true;
        btn.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i> Autorizando Transacción con Banco...";

        setTimeout(() => {
            alert("¡Pago Aprobado exitosamente!\nReferencia de transacción: #TXN-9381-BBVA.\n\nFicha activada para examen.");
            localStorage.setItem('aspirante_pago', 'true');
            cargarModulo('Inicio');
        }, 2000);
    }
</script>
