<div class="animate__animated animate__fadeIn">
    <!-- Encabezado de Sección -->
    <div class="module-header" style="margin-bottom: 30px;">
        <h2 style="color: var(--finanzas-text-main); font-size: 1.8rem; font-weight: 800;">
            <i class='bx bxs-wallet' style="color: var(--finanzas-primary-dark);"></i> Nómina y Honorarios de Docentes
        </h2>
        <p style="color: var(--finanzas-text-muted);">Administración del pago quincenal/mensual del personal académico de la institución.</p>
    </div>

    <!-- Estadísticas Rápidas de Nómina -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
        <div class="finance-stat-card" style="border-left: 5px solid var(--finanzas-primary-dark);">
            <div class="stat-icon-wrapper income">
                <i class='bx bx-user-check'></i>
            </div>
            <div class="stat-info">
                <span class="label">Nómina Pagada / Dispersada</span>
                <span class="value" id="stat-nomina-pagada">$0.00 <span style="font-size: 0.9rem; font-weight: 400; color: #64748b;">(0 Catedráticos)</span></span>
            </div>
        </div>

        <div class="finance-stat-card" style="border-left: 5px solid var(--finanzas-accent);">
            <div class="stat-icon-wrapper pending">
                <i class='bx bx-user-x'></i>
            </div>
            <div class="stat-info">
                <span class="label">Nómina Pendiente</span>
                <span class="value" id="stat-nomina-pendiente">$0.00 <span style="font-size: 0.9rem; font-weight: 400; color: #64748b;">(0 Catedráticos)</span></span>
            </div>
        </div>
    </div>

    <!-- Barra de acciones -->
    <div class="table-actions-bar" style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
        <button class="btn-finance-action" onclick="abrirModalNomina()">
            <i class='bx bx-plus'></i> Registrar Nómina Docente
        </button>
    </div>

    <!-- Lista de Docentes y Pagos -->
    <div class="finance-section-card">
        <h2><i class='bx bxs-group'></i> Relación de Pagos a Catedráticos - Periodo Actual</h2>
        <div style="overflow-x: auto;">
            <table class="finance-table">
                <thead>
                    <tr>
                        <th>Profesor</th>
                        <th>Departamento / Carrera</th>
                        <th>Horas Impartidas</th>
                        <th>Tarifa por Hora</th>
                        <th>Honorarios Totales</th>
                        <th>Estatus Nómina</th>
                        <th>Acción Financiera</th>
                    </tr>
                </thead>
                <tbody id="tabla-nomina-rows">
                    <!-- Filas cargadas dinámicamente -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL POPUP PARA REGISTRAR NÓMINA -->
    <div id="modal-nomina" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.4); backdrop-filter: blur(5px); z-index: 1000; align-items: center; justify-content: center;">
        <div class="finance-section-card" style="max-width: 500px; width: 90%; position: relative; margin-bottom: 0;">
            <i class='bx bx-x' style="position: absolute; top: 20px; right: 20px; font-size: 2rem; cursor: pointer; color: var(--finanzas-text-muted);" onclick="cerrarModalNomina()"></i>
            <h2><i class='bx bxs-user-plus'></i> Registrar Nómina Docente</h2>
            
            <form id="form-nomina-pago" style="display: flex; flex-direction: column; gap: 15px; margin-top: 15px;" onsubmit="registrarNominaExitosa(event)">
                <div style="display: flex; flex-direction: column; gap: 5px;">
                    <label style="font-size: 0.8rem; font-weight: 700; color: var(--finanzas-text-muted);">NOMBRE DEL DOCENTE</label>
                    <input type="text" id="nomina-nombre" required placeholder="Ej. Ing. Juan Pérez Gómez" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none;">
                </div>
                
                <div style="display: flex; flex-direction: column; gap: 5px;">
                    <label style="font-size: 0.8rem; font-weight: 700; color: var(--finanzas-text-muted);">DEPARTAMENTO / CARRERA</label>
                    <select id="nomina-departamento" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1;">
                        <option value="Ciencias de la Computación (TICs)">Ciencias de la Computación (TICs)</option>
                        <option value="Sistemas y Arquitectura Computacional">Sistemas y Arquitectura Computacional</option>
                        <option value="Área Económico Administrativa">Área Económico Administrativa</option>
                        <option value="Diseño y Comunicación Digital">Diseño y Comunicación Digital</option>
                    </select>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div style="display: flex; flex-direction: column; gap: 5px;">
                        <label style="font-size: 0.8rem; font-weight: 700; color: var(--finanzas-text-muted);">HORAS IMPARTIDAS</label>
                        <input type="number" id="nomina-horas" required value="40" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1;">
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 5px;">
                        <label style="font-size: 0.8rem; font-weight: 700; color: var(--finanzas-text-muted);">TARIFA POR HORA ($)</label>
                        <input type="number" id="nomina-tarifa" required value="310" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1;">
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap: 5px;">
                    <label style="font-size: 0.8rem; font-weight: 700; color: var(--finanzas-text-muted);">ESTATUS INICIAL</label>
                    <select id="nomina-estatus" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1;">
                        <option value="Pendiente">Pendiente de Pago</option>
                        <option value="Dispersado">Pagado / Dispersado</option>
                    </select>
                </div>

                <button class="btn-finance-action" type="submit" style="margin-top: 15px; justify-content: center; width: 100%;">
                    <i class='bx bx-check-double'></i> GUARDAR E INSCRIBIR NÓMINA
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function renderNomina() {
        const list = JSON.parse(localStorage.getItem('nominas') || '[]');
        const tbody = document.getElementById('tabla-nomina-rows');
        
        // Recalcular métricas de nómina
        let totalPagado = 0;
        let countPagado = 0;
        let totalPendiente = 0;
        let countPendiente = 0;

        list.forEach(item => {
            const monto = parseFloat(item.horas) * parseFloat(item.tarifa);
            if (item.estado === 'Dispersado') {
                totalPagado += monto;
                countPagado++;
            } else {
                totalPendiente += monto;
                countPendiente++;
            }
        });

        document.getElementById('stat-nomina-pagada').innerHTML = `$${totalPagado.toLocaleString('en-US', {minimumFractionDigits: 2})} <span style="font-size: 0.9rem; font-weight: 400; color: #64748b;">(${countPagado} Catedráticos)</span>`;
        document.getElementById('stat-nomina-pendiente').innerHTML = `$${totalPendiente.toLocaleString('en-US', {minimumFractionDigits: 2})} <span style="font-size: 0.9rem; font-weight: 400; color: #64748b;">(${countPendiente} Catedráticos)</span>`;

        if (list.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="7" style="text-align: center; color: var(--finanzas-text-muted); padding: 40px 10px;">
                        <i class='bx bx-wallet' style="font-size: 3rem; display: block; margin-bottom: 12px; color: #cbd5e1;"></i>
                        <span style="font-size: 0.95rem; font-weight: 600; display: block;">No hay registros de nómina capturados.</span>
                        <span style="font-size: 0.85rem; color: #94a3b8; display: block; margin-top: 4px;">Usa el botón "Registrar Nómina Docente" para dispersar o programar un pago.</span>
                    </td>
                </tr>`;
            return;
        }

        let html = '';
        list.forEach((item, index) => {
            const honorarios = parseFloat(item.horas) * parseFloat(item.tarifa);
            const badgeClass = item.estado === 'Dispersado' ? 'badge success' : 'badge warning';
            const iconClass = item.estado === 'Dispersado' ? 'bx bxs-check-circle' : 'bx bxs-time';
            const statusLabel = item.estado === 'Dispersado' ? 'Dispersado' : 'Pendiente de Pago';

            let actionButton = '';
            if (item.estado === 'Dispersado') {
                actionButton = `
                    <button class="btn-finance-action secondary" style="padding: 6px 12px; font-size: 0.8rem;" onclick="imprimirNomina('${item.nombre}', '$${honorarios.toLocaleString('en-US', {minimumFractionDigits: 2})}')">
                        <i class='bx bx-receipt'></i> Ver CFDI
                    </button>`;
            } else {
                actionButton = `
                    <button class="btn-finance-action" style="padding: 6px 12px; font-size: 0.8rem;" onclick="procesarPagoNomina(${index})">
                        <i class='bx bx-send'></i> Dispersar
                    </button>`;
            }

            html += `
                <tr>
                    <td><strong>${item.nombre}</strong></td>
                    <td>${item.departamento}</td>
                    <td>${item.horas} Horas</td>
                    <td>$${parseFloat(item.tarifa).toLocaleString('en-US', {minimumFractionDigits: 2})} / hr</td>
                    <td><strong>$${honorarios.toLocaleString('en-US', {minimumFractionDigits: 2})}</strong></td>
                    <td><span class="${badgeClass}"><i class='${iconClass}'></i> ${statusLabel}</span></td>
                    <td>${actionButton}</td>
                </tr>`;
        });
        tbody.innerHTML = html;
    }

    function abrirModalNomina() {
        document.getElementById('nomina-nombre').value = '';
        document.getElementById('modal-nomina').style.display = 'flex';
    }

    function cerrarModalNomina() {
        document.getElementById('modal-nomina').style.display = 'none';
    }

    function registrarNominaExitosa(event) {
        event.preventDefault();
        const nombre = document.getElementById('nomina-nombre').value;
        const departamento = document.getElementById('nomina-departamento').value;
        const horas = document.getElementById('nomina-horas').value;
        const tarifa = document.getElementById('nomina-tarifa').value;
        const estado = document.getElementById('nomina-estatus').value;

        const list = JSON.parse(localStorage.getItem('nominas') || '[]');
        list.unshift({
            nombre,
            departamento,
            horas,
            tarifa,
            estado
        });
        localStorage.setItem('nominas', JSON.stringify(list));

        alert("Nómina docente cargada y guardada exitosamente en el balance.");
        cerrarModalNomina();
        renderNomina();
    }

    function procesarPagoNomina(index) {
        const list = JSON.parse(localStorage.getItem('nominas') || '[]');
        const item = list[index];
        const honorarios = parseFloat(item.horas) * parseFloat(item.tarifa);

        if(confirm("¿Confirmas la dispersión de fondos para el pago de honorarios de " + item.nombre + " por un total de $" + honorarios.toLocaleString('en-US', {minimumFractionDigits: 2}) + " MN?")) {
            item.estado = 'Dispersado';
            localStorage.setItem('nominas', JSON.stringify(list));
            alert("Transferencia bancaria interbancaria SPEI autorizada con éxito.\nFondos liberados para el docente: " + item.nombre);
            renderNomina();
        }
    }

    function imprimirNomina(docente, monto) {
        alert("Descargando Comprobante Fiscal Digital (CFDI) de Nómina...\n\nDocente: " + docente + "\nMonto Liquidado: " + monto + " MN\nEmisor: Sistema de Control Escolar\n\nEl documento PDF digital se guardará en tu carpeta de descargas.");
    }

    // Inicializar render
    renderNomina();
</script>
