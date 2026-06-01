<div class="animate__animated animate__fadeIn">
    <!-- Encabezado de Sección -->
    <div class="module-header" style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2 style="color: var(--finanzas-text-main); font-size: 1.8rem; font-weight: 800;">
                <i class='bx bxs-dashboard' style="color: var(--finanzas-primary-dark);"></i> Resumen de Salud Económica
            </h2>
            <p style="color: var(--finanzas-text-muted);">Periodo actual: Mayo 2026 | Resumen Institucional</p>
        </div>
        <div>
            <button class="btn-finance-action" onclick="cargarModulo('Reportes')">
                <i class='bx bxs-file-pdf'></i> Exportar Cierre de Mes
            </button>
        </div>
    </div>

    <!-- Malla de Estadísticas -->
    <div class="finance-stats-grid">
        <!-- Colegiaturas Ingresadas -->
        <div class="finance-stat-card">
            <div class="stat-icon-wrapper income">
                <i class='bx bx-trending-up'></i>
            </div>
            <div class="stat-info">
                <span class="label">Ingresos Colegiaturas</span>
                <span class="value" id="dash-ingresos">$0.00</span>
            </div>
        </div>

        <!-- Egresos de Nómina -->
        <div class="finance-stat-card">
            <div class="stat-icon-wrapper expense">
                <i class='bx bx-trending-down'></i>
            </div>
            <div class="stat-info">
                <span class="label">Egreso Nómina</span>
                <span class="value" id="dash-egresos">$0.00</span>
            </div>
        </div>

        <!-- Balance Neto -->
        <div class="finance-stat-card">
            <div class="stat-icon-wrapper balance">
                <i class='bx bx-dollar-circle'></i>
            </div>
            <div class="stat-info">
                <span class="label">Balance Neto</span>
                <span class="value" id="dash-balance" style="color: #059669;">+$0.00</span>
            </div>
        </div>

        <!-- Pendiente de Cobro -->
        <div class="finance-stat-card">
            <div class="stat-icon-wrapper pending">
                <i class='bx bx-time'></i>
            </div>
            <div class="stat-info">
                <span class="label">Pendiente de Cobro</span>
                <span class="value" id="dash-pendiente" style="color: #d97706;">$0.00</span>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 25px; margin-bottom: 25px;">
        <!-- Últimas Transacciones -->
        <div class="finance-section-card" style="margin-bottom: 0;">
            <h2><i class='bx bx-transfer'></i> Últimos Movimientos Registrados</h2>
            <div style="overflow-x: auto;">
                <table class="finance-table">
                    <thead>
                        <tr>
                            <th>ID Transacción</th>
                            <th>Concepto</th>
                            <th>Tipo</th>
                            <th>Monto</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody id="dash-transacciones-rows">
                        <!-- Transacciones dinámicas -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Distribución del Flujo Semestral -->
        <div class="finance-section-card" style="margin-bottom: 0; display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <h2><i class='bx bxs-doughnut-chart'></i> Flujo de Caja (Ene-May)</h2>
                <p style="font-size: 0.85rem; color: var(--finanzas-text-muted);">Histórico mensual de ingresos institucionales en miles de pesos.</p>
            </div>
            
            <div class="finance-chart-container">
                <div class="chart-bar-wrapper">
                    <div class="chart-bar income" style="height: 50%;" data-value="$120k"></div>
                    <span class="chart-label">Ene</span>
                </div>
                <div class="chart-bar-wrapper">
                    <div class="chart-bar income" style="height: 65%;" data-value="$160k"></div>
                    <span class="chart-label">Feb</span>
                </div>
                <div class="chart-bar-wrapper">
                    <div class="chart-bar income" style="height: 80%;" data-value="$210k"></div>
                    <span class="chart-label">Mar</span>
                </div>
                <div class="chart-bar-wrapper">
                    <div class="chart-bar income" style="height: 45%;" data-value="$110k"></div>
                    <span class="chart-label">Abr</span>
                </div>
                <div class="chart-bar-wrapper">
                    <div class="chart-bar income" id="chart-may-bar" style="height: 10%;" data-value="$0k"></div>
                    <span class="chart-label">May</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function renderDashboard() {
        const colegiaturas = JSON.parse(localStorage.getItem('colegiaturas') || '[]');
        const nominas = JSON.parse(localStorage.getItem('nominas') || '[]');

        // Calcular métricas
        let ingresosTotal = 0;
        let cobroPendiente = 0;
        colegiaturas.forEach(item => {
            const monto = parseFloat(item.monto);
            if (item.estado === 'Pagado') {
                ingresosTotal += monto;
            } else {
                cobroPendiente += monto;
            }
        });

        let egresosTotal = 0;
        nominas.forEach(item => {
            const monto = parseFloat(item.horas) * parseFloat(item.tarifa);
            if (item.estado === 'Dispersado') {
                egresosTotal += monto;
            }
        });

        const balanceNeto = ingresosTotal - egresosTotal;

        // Renderizar métricas en pantalla
        document.getElementById('dash-ingresos').textContent = `$${ingresosTotal.toLocaleString('en-US', {minimumFractionDigits: 2})}`;
        document.getElementById('dash-egresos').textContent = `$${egresosTotal.toLocaleString('en-US', {minimumFractionDigits: 2})}`;
        
        const balanceField = document.getElementById('dash-balance');
        if (balanceNeto >= 0) {
            balanceField.textContent = `+$${balanceNeto.toLocaleString('en-US', {minimumFractionDigits: 2})}`;
            balanceField.style.color = '#059669'; // verde
        } else {
            balanceField.textContent = `-$${Math.abs(balanceNeto).toLocaleString('en-US', {minimumFractionDigits: 2})}`;
            balanceField.style.color = '#ef4444'; // rojo
        }

        document.getElementById('dash-pendiente').textContent = `$${cobroPendiente.toLocaleString('en-US', {minimumFractionDigits: 2})}`;

        // Consolidar transacciones para el log de movimientos recientes
        const transacciones = [];
        
        colegiaturas.forEach((item, index) => {
            const montoNum = parseFloat(item.monto);
            const badgeClass = item.estado === 'Pagado' ? 'badge success' : (item.estado === 'Atrasado' ? 'badge danger' : 'badge warning');
            const iconClass = item.estado === 'Pagado' ? 'bx bxs-check-circle' : (item.estado === 'Atrasado' ? 'bx bxs-error-circle' : 'bx bxs-info-circle');
            const statusLabel = item.estado === 'Pagado' ? 'Aplicado' : (item.estado === 'Atrasado' ? 'Atrasado' : 'Pendiente');

            transacciones.push({
                id: `#TX-8${100 + index}`,
                concepto: `Colegiatura - ${item.nombre}`,
                tipo: 'Ingreso',
                tipoColor: '#059669',
                monto: `$${montoNum.toLocaleString('en-US', {minimumFractionDigits: 2})}`,
                statusBadge: `<span class="${badgeClass}"><i class='${iconClass}'></i> ${statusLabel}</span>`
            });
        });

        nominas.forEach((item, index) => {
            const honorarios = parseFloat(item.horas) * parseFloat(item.tarifa);
            const badgeClass = item.estado === 'Dispersado' ? 'badge success' : 'badge warning';
            const iconClass = item.estado === 'Dispersado' ? 'bx bxs-check-circle' : 'bx bxs-time';
            const statusLabel = item.estado === 'Dispersado' ? 'Transferido' : 'En Cola';

            transacciones.push({
                id: `#TX-9${100 + index}`,
                concepto: `Nómina - ${item.nombre}`,
                tipo: 'Egreso',
                tipoColor: '#ef4444',
                monto: `$${honorarios.toLocaleString('en-US', {minimumFractionDigits: 2})}`,
                statusBadge: `<span class="${badgeClass}"><i class='${iconClass}'></i> ${statusLabel}</span>`
            });
        });

        // Ordenar las transacciones simulando orden de registro (más recientes primero)
        // Ya que las cargamos con unshift en los formularios, el índice de menor valor es el más nuevo.
        const tbody = document.getElementById('dash-transacciones-rows');
        
        if (transacciones.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="5" style="text-align: center; color: var(--finanzas-text-muted); padding: 30px;">
                        No hay movimientos registrados. Capture cobros o nóminas para ver transacciones en tiempo real.
                    </td>
                </tr>`;
        } else {
            let html = '';
            // Mostrar hasta 6 transacciones recientes
            const aMostrar = transacciones.slice(0, 6);
            aMostrar.forEach(tx => {
                html += `
                    <tr>
                        <td><strong>${tx.id}</strong></td>
                        <td>${tx.concepto}</td>
                        <td><span style="color: ${tx.tipoColor}; font-weight: 700;">${tx.tipo}</span></td>
                        <td><strong>${tx.monto}</strong></td>
                        <td>${tx.statusBadge}</td>
                    </tr>`;
            });
            tbody.innerHTML = html;
        }

        // Dinamizar barra del mes actual (Mayo) en la gráfica
        const chartMayBar = document.getElementById('chart-may-bar');
        if (chartMayBar) {
            // Escalar altura del gráfico de acuerdo a los ingresos de Mayo.
            // Digamos que el 100% de la barra es $250k de ingresos.
            const maxVal = 250000;
            const porcentaje = Math.min((ingresosTotal / maxVal) * 100, 100);
            
            // Asignar los estilos y atributos correspondientes
            chartMayBar.style.height = `${Math.max(porcentaje, 8)}%`;
            chartMayBar.setAttribute('data-value', `$${Math.round(ingresosTotal/1000)}k`);
        }
    }

    renderDashboard();
</script>
