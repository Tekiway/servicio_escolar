<div class="animate__animated animate__fadeIn" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Encabezado -->
    <div class="module-header" style="margin-bottom: 5px;">
        <h2 style="color: #1e293b; font-size: 1.8rem; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i class='bx bxs-credit-card' style="color: var(--primary); font-size: 2rem;"></i> Pago de Colegiaturas y Servicios Escolares
        </h2>
        <p style="color: #64748b;">Genera tu referencia para ventanilla bancaria o liquida en línea mediante pasarela de pago express.</p>
    </div>

    <!-- Contenedor General de Pagos -->
    <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 30px; border-radius: 16px; backdrop-filter: blur(10px); box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
        
        <!-- Pestañas de Pago -->
        <div style="display: flex; gap: 15px; border-bottom: 1px solid #cbd5e1; padding-bottom: 15px; margin-bottom: 25px;">
            <button class="tab-btn active" id="tab-btn-stud-banco" onclick="switchStudentPagoTab('banco')" style="padding: 10px 20px; font-weight: 800; border: none; background: none; border-bottom: 3px solid var(--primary); color: var(--primary); cursor: pointer; display: flex; align-items: center; gap: 8px;">
                <i class='bx bxs-bank'></i> Referencia de Banco (BBVA)
            </button>
            <button class="tab-btn" id="tab-btn-stud-tarjeta" onclick="switchStudentPagoTab('tarjeta')" style="padding: 10px 20px; font-weight: 800; border: none; background: none; color: #64748b; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                <i class='bx bxs-credit-card-front'></i> Pago Directo con Tarjeta
            </button>
        </div>

        <!-- Opción 1: Ventanilla Bancaria -->
        <div id="pago-stud-tab-banco" style="display: block;">
            <div style="background: white; border: 2px dashed #6366f1; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.01);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <span style="font-weight: 800; color: #1e293b; font-size: 1.1rem; display: flex; align-items: center; gap: 6px;"><i class='bx bxs-institution' style="color:var(--primary);"></i> ORDEN DE PAGO SEMESTRAL / MENSUAL</span>
                    <span style="color: #64748b; font-size: 0.8rem; font-weight: 700;">---</span>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; font-size: 0.95rem; color: #475569; margin-bottom: 25px;">
                    <div style="display: flex; flex-direction: column; gap: 6px;">
                        <span><strong>Establecimiento:</strong> BBVA Bancomer</span>
                        <span><strong>Convenio CIE:</strong> #9382103</span>
                        <span><strong>Concepto:</strong> Pago de Colegiatura Mensual</span>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 6px;">
                        <span><strong>Referencia Única:</strong> <span style="font-family: monospace; font-weight: 800; color:var(--primary-dark);">---</span></span>
                        <span><strong>Importe Total:</strong> <strong style="color: #059669; font-size: 1.25rem;">$0.00 MXN</strong></span>
                        <span><strong>Vencimiento:</strong> ---</span>
                    </div>
                </div>

                <div style="border-top: 1px dashed #cbd5e1; padding-top: 20px; display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.8rem; color: #94a3b8; max-width: 60%;"><i class='bx bx-info-circle'></i> Recuerda guardar tu ticket de banco. La dispersión del pago tarda de 24 a 48 horas escolares en reflejarse.</span>
                    <button class="btn-finance-action" onclick="alert('Generando Referencia...')">
                        <i class='bx bxs-download'></i> Descargar Ficha CIE
                    </button>
                </div>
            </div>
            
            <div style="margin-top: 25px; text-align: center;">
                <p style="font-size: 0.85rem; color: #64748b;">¿Deseas liberar tu reinscripción al instante? Utiliza la pasarela en línea:</p>
                <button class="btn-finance-action" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white; margin-top: 10px; display: inline-flex;" onclick="switchStudentPagoTab('tarjeta')">
                    <i class='bx bxs-bolt' style="font-size: 1.1rem;"></i> Usar Pago Express Seguro
                </button>
            </div>
        </div>

        <!-- Opción 2: Tarjeta de Crédito en Línea -->
        <div id="pago-stud-tab-tarjeta" style="display: none;">
            <div style="display: grid; grid-template-columns: 1fr 1.2fr; gap: 30px; align-items: center;">
                <!-- Mock Card Visual -->
                <div style="background: linear-gradient(135deg, #311042, #7c3aed); color: white; padding: 25px; border-radius: 16px; box-shadow: 0 10px 25px rgba(124, 58, 237, 0.25); height: 210px; display: flex; flex-direction: column; justify-content: space-between; font-family: monospace; letter-spacing: 1px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-style: italic; font-weight: bold; font-size: 1.1rem;">STUDENT CARD</span>
                        <i class='bx bxl-mastercard' style="font-size: 3rem; line-height: 0;"></i>
                    </div>
                    
                    <div>
                        <div style="background: #e2e8f0; width: 45px; height: 35px; border-radius: 6px; margin-bottom: 15px; opacity: 0.8;"></div>
                        <span id="stud-visual-card-number" style="font-size: 1.2rem; display: block; font-weight: bold;">•••• •••• •••• ••••</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.8rem;">
                        <div>
                            <small style="opacity: 0.6; display: block; font-size: 0.6rem;">CARDHOLDER</small>
                            <span id="stud-visual-card-name" style="text-transform: uppercase;">---</span>
                        </div>
                        <div style="text-align: right;">
                            <small style="opacity: 0.6; display: block; font-size: 0.6rem;">EXPIRES</small>
                            <span id="stud-visual-card-expiry">MM/AA</span>
                        </div>
                    </div>
                </div>

                <!-- Formulario -->
                <form id="form-stud-pago-express" onsubmit="procesarStudentPago(event)" style="display: flex; flex-direction: column; gap: 15px;">
                    <div style="display: flex; flex-direction: column; gap: 4px;">
                        <label style="font-size: 0.75rem; font-weight: 700; color: #64748b;">NOMBRE DEL TITULAR</label>
                        <input type="text" id="stud-card-name" required placeholder="Ej. Nombre Apellido" oninput="updateStudentCardVisual()" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; text-transform: uppercase;">
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 4px;">
                        <label style="font-size: 0.75rem; font-weight: 700; color: #64748b;">NÚMERO DE TARJETA</label>
                        <input type="text" id="stud-card-number" required placeholder="5100 1234 5678 9010" maxlength="19" oninput="formatStudentCardNumber(); updateStudentCardVisual();" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none;">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                        <div style="display: flex; flex-direction: column; gap: 4px;">
                            <label style="font-size: 0.75rem; font-weight: 700; color: #64748b;">VENCIMIENTO</label>
                            <input type="text" id="stud-card-expiry" required placeholder="MM/AA" maxlength="5" oninput="formatStudentExpiry(); updateStudentCardVisual();" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; text-align: center;">
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 4px;">
                            <label style="font-size: 0.75rem; font-weight: 700; color: #64748b;">CVC / CVV</label>
                            <input type="password" id="stud-card-cvv" required placeholder="•••" maxlength="3" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; text-align: center;">
                        </div>
                    </div>

                    <button class="btn-finance-action" type="submit" style="margin-top: 10px; justify-content: center; width: 100%; background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white;" id="btn-stud-pay-action">
                        <i class='bx bx-check-shield' style="font-size:1.1rem;"></i> AUTORIZAR PAGO COLEGIO ($0.00)
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    (function() {
        const storedPerfil = localStorage.getItem('alumno_perfil');
        if (storedPerfil) {
            const data = JSON.parse(storedPerfil);
            document.getElementById('stud-card-name').value = data.nombre.toUpperCase();
            updateStudentCardVisual();
        }
    })();

    function switchStudentPagoTab(tab) {
        const btnBanco = document.getElementById('tab-btn-stud-banco');
        const btnTarjeta = document.getElementById('tab-btn-stud-tarjeta');
        const tabBanco = document.getElementById('pago-stud-tab-banco');
        const tabTarjeta = document.getElementById('pago-stud-tab-tarjeta');

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

    function updateStudentCardVisual() {
        const nameVal = document.getElementById('stud-card-name').value.trim();
        const numVal = document.getElementById('stud-card-number').value.trim();
        const expVal = document.getElementById('stud-card-expiry').value.trim();

        document.getElementById('stud-visual-card-name').textContent = nameVal ? nameVal : '---';
        document.getElementById('stud-visual-card-number').textContent = numVal ? numVal : '•••• •••• •••• ••••';
        document.getElementById('stud-visual-card-expiry').textContent = expVal ? expVal : 'MM/AA';
    }

    function formatStudentCardNumber() {
        let input = document.getElementById('stud-card-number');
        let val = input.value.replace(/\D/g, '');
        let formatted = '';
        for (let i = 0; i < val.length; i++) {
            if (i > 0 && i % 4 === 0) formatted += ' ';
            formatted += val[i];
        }
        input.value = formatted;
    }

    function formatStudentExpiry() {
        let input = document.getElementById('stud-card-expiry');
        let val = input.value.replace(/\D/g, '');
        if (val.length >= 2) {
            input.value = val.substring(0, 2) + '/' + val.substring(2, 4);
        } else {
            input.value = val;
        }
    }

    function procesarStudentPago(event) {
        event.preventDefault();
        const btn = document.getElementById('btn-stud-pay-action');
        btn.disabled = true;
        btn.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i> Acreditando Fondos de Matrícula...";

        setTimeout(() => {
            alert("¡Pago de Colegiatura Aprobado!\nMuchas gracias por estar al día en tus aportaciones.");
            localStorage.setItem('alumno_pago_colegiatura', 'true');
            cargarModulo('Inicio');
        }, 2000);
    }
</script>
