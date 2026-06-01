<div class="animate__animated animate__fadeIn">
    <!-- Encabezado de Sección -->
    <div class="module-header" style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2 style="color: var(--finanzas-text-main); font-size: 1.8rem; font-weight: 800;">
                <i class='bx bxs-bar-chart-alt-2' style="color: var(--finanzas-primary-dark);"></i> Analítica de Ingresos y Egresos
            </h2>
            <p style="color: var(--finanzas-text-muted);">Visualización del balance contable e historial financiero consolidado.</p>
        </div>
        
        <div style="display: flex; gap: 10px;">
            <button class="btn-finance-action secondary" onclick="exportarExcel()">
                <i class='bx bx-spreadsheet'></i> Excel (.xlsx)
            </button>
            <button class="btn-finance-action" onclick="exportarPDF()">
                <i class='bx bxs-file-pdf'></i> PDF (.pdf)
            </button>
        </div>
    </div>

    <!-- Comparativa Visual -->
    <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 25px; margin-bottom: 25px;">
        <!-- Card 1: Balance Consolidado -->
        <div class="finance-section-card" style="margin-bottom: 0; display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <h2><i class='bx bxs-pie-chart-alt-2'></i> Distribución de Recursos</h2>
                <p style="font-size: 0.85rem; color: var(--finanzas-text-muted); margin-bottom: 20px;">Resumen comparativo porcentual del flujo de caja activo.</p>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 15px;">
                <!-- Ingresos de Colegiaturas -->
                <div>
                    <div style="display: flex; justify-content: space-between; font-size: 0.85rem; font-weight: 700; margin-bottom: 5px; color: var(--finanzas-primary-dark);">
                        <span>Colegiaturas Recibidas (Ingresos)</span>
                        <span id="dist-colegiaturas-porc">0% ($0.00)</span>
                    </div>
                    <div style="height: 10px; background: #e2e8f0; border-radius: 9999px; overflow: hidden;">
                        <div id="dist-colegiaturas-bar" style="height: 100%; background: var(--finanzas-primary); width: 0%; border-radius: 9999px; transition: width 0.4s ease;"></div>
                    </div>
                </div>

                <!-- Nóminas de Docentes -->
                <div>
                    <div style="display: flex; justify-content: space-between; font-size: 0.85rem; font-weight: 700; margin-bottom: 5px; color: var(--finanzas-secondary);">
                        <span>Honorarios y Nómina Docente (Egresos)</span>
                        <span id="dist-nomina-porc">0% ($0.00)</span>
                    </div>
                    <div style="height: 10px; background: #e2e8f0; border-radius: 9999px; overflow: hidden;">
                        <div id="dist-nomina-bar" style="height: 100%; background: var(--finanzas-secondary); width: 0%; border-radius: 9999px; transition: width 0.4s ease;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Historial Mensual -->
        <div class="finance-section-card" style="margin-bottom: 0;">
            <h2><i class='bx bx-trending-up'></i> Comparativa de Ingresos vs Egresos (Ene - May 2026)</h2>
            <p style="font-size: 0.85rem; color: var(--finanzas-text-muted);">Las barras índigo indican ingresos y las moradas representan egresos.</p>
            
            <div class="finance-chart-container" style="height: 150px;">
                <!-- Ene -->
                <div class="chart-bar-wrapper">
                    <div style="display: flex; gap: 4px; align-items: flex-end; height: 100%; width: 100%;">
                        <div class="chart-bar income" style="height: 60%; width: 45%;" data-value="Ingreso: $120k"></div>
                        <div class="chart-bar expense" style="height: 45%; width: 45%;" data-value="Egreso: $90k"></div>
                    </div>
                    <span class="chart-label">Ene</span>
                </div>
                <!-- Feb -->
                <div class="chart-bar-wrapper">
                    <div style="display: flex; gap: 4px; align-items: flex-end; height: 100%; width: 100%;">
                        <div class="chart-bar income" style="height: 70%; width: 45%;" data-value="Ingreso: $160k"></div>
                        <div class="chart-bar expense" style="height: 50%; width: 45%;" data-value="Egreso: $110k"></div>
                    </div>
                    <span class="chart-label">Feb</span>
                </div>
                <!-- Mar -->
                <div class="chart-bar-wrapper">
                    <div style="display: flex; gap: 4px; align-items: flex-end; height: 100%; width: 100%;">
                        <div class="chart-bar income" style="height: 85%; width: 45%;" data-value="Ingreso: $210k"></div>
                        <div class="chart-bar expense" style="height: 65%; width: 45%;" data-value="Egreso: $140k"></div>
                    </div>
                    <span class="chart-label">Mar</span>
                </div>
                <!-- Abr -->
                <div class="chart-bar-wrapper">
                    <div style="display: flex; gap: 4px; align-items: flex-end; height: 100%; width: 100%;">
                        <div class="chart-bar income" style="height: 55%; width: 45%;" data-value="Ingreso: $110k"></div>
                        <div class="chart-bar expense" style="height: 40%; width: 45%;" data-value="Egreso: $80k"></div>
                    </div>
                    <span class="chart-label">Abr</span>
                </div>
                <!-- May -->
                <div class="chart-bar-wrapper">
                    <div style="display: flex; gap: 4px; align-items: flex-end; height: 100%; width: 100%;">
                        <div class="chart-bar income" id="chart-rep-may-inc" style="height: 10%; width: 45%;" data-value="Ingreso: $0k"></div>
                        <div class="chart-bar expense" id="chart-rep-may-exp" style="height: 10%; width: 45%;" data-value="Egreso: $0k"></div>
                    </div>
                    <span class="chart-label">May</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Desglose por Conceptos -->
    <div class="finance-section-card">
        <h2><i class='bx bx-list-check'></i> Desglose Detallado de Conceptos Contables - Mayo 2026</h2>
        <div style="overflow-x: auto;">
            <table class="finance-table">
                <thead>
                    <tr>
                        <th>Categoría</th>
                        <th>Concepto Contable</th>
                        <th>Mes de Registro</th>
                        <th>Tipo Contable</th>
                        <th>Importe Total</th>
                    </tr>
                </thead>
                <tbody id="tabla-reporte-conceptos">
                    <!-- Conceptos calculados dinámicamente -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function renderReportes() {
        const colegiaturas = JSON.parse(localStorage.getItem('colegiaturas') || '[]');
        const nominas = JSON.parse(localStorage.getItem('nominas') || '[]');

        // Calcular totales
        let ingresosTotal = 0;
        colegiaturas.forEach(item => {
            if (item.estado === 'Pagado') {
                ingresosTotal += parseFloat(item.monto);
            }
        });

        let egresosTotal = 0;
        nominas.forEach(item => {
            if (item.estado === 'Dispersado') {
                egresosTotal += (parseFloat(item.horas) * parseFloat(item.tarifa));
            }
        });

        const totalFlujo = ingresosTotal + egresosTotal;
        let porcIngresos = 0;
        let porcEgresos = 0;

        if (totalFlujo > 0) {
            porcIngresos = Math.round((ingresosTotal / totalFlujo) * 100);
            porcEgresos = Math.round((egresosTotal / totalFlujo) * 100);
        }

        // 1. Renderizar Distribución de Recursos
        document.getElementById('dist-colegiaturas-porc').textContent = `${porcIngresos}% ($${ingresosTotal.toLocaleString('en-US', {minimumFractionDigits: 2})})`;
        document.getElementById('dist-colegiaturas-bar').style.width = `${porcIngresos}%`;

        document.getElementById('dist-nomina-porc').textContent = `${porcEgresos}% ($${egresosTotal.toLocaleString('en-US', {minimumFractionDigits: 2})})`;
        document.getElementById('dist-nomina-bar').style.width = `${porcEgresos}%`;

        // 2. Renderizar Historial Gráfico de Mayo
        const maxEscala = 250000;
        const porcIncMay = Math.min((ingresosTotal / maxEscala) * 100, 100);
        const porcExpMay = Math.min((egresosTotal / maxEscala) * 100, 100);

        const incBar = document.getElementById('chart-rep-may-inc');
        const expBar = document.getElementById('chart-rep-may-exp');

        incBar.style.height = `${Math.max(porcIncMay, 8)}%`;
        incBar.setAttribute('data-value', `Ingreso: $${Math.round(ingresosTotal/1000)}k`);

        expBar.style.height = `${Math.max(porcExpMay, 8)}%`;
        expBar.setAttribute('data-value', `Egreso: $${Math.round(egresosTotal/1000)}k`);

        // 3. Renderizar Desglose de Conceptos
        const tbody = document.getElementById('tabla-reporte-conceptos');
        const balanceNeto = ingresosTotal - egresosTotal;
        const balanceStatus = balanceNeto >= 0 ? 'Superávit' : 'Déficit';
        const balancePrefix = balanceNeto >= 0 ? '+' : '-';
        const balanceColor = balanceNeto >= 0 ? 'var(--finanzas-primary-dark)' : '#ef4444';

        tbody.innerHTML = `
            <tr>
                <td><strong>Colegiaturas</strong></td>
                <td>Mensualidad Regular Estudiantil (Cobros realizados)</td>
                <td>Mayo 2026</td>
                <td><span style="color: var(--finanzas-primary-dark); font-weight: 700;">Ingreso</span></td>
                <td><strong>$${ingresosTotal.toLocaleString('en-US', {minimumFractionDigits: 2})}</strong></td>
            </tr>
            <tr>
                <td><strong>Honorarios</strong></td>
                <td>Pago Nómina Catedráticos (Dispersados)</td>
                <td>Mayo 2026</td>
                <td><span style="color: var(--finanzas-secondary); font-weight: 700;">Egreso</span></td>
                <td><strong>-$${egresosTotal.toLocaleString('en-US', {minimumFractionDigits: 2})}</strong></td>
            </tr>
            <tr style="background: #e0e7ff; font-weight: 800; border-top: 2px solid var(--finanzas-primary-dark);">
                <td><strong>BALANCE FINAL</strong></td>
                <td>Resultado de Ejercicio Mensual (Mayo 2026)</td>
                <td>Mayo 2026</td>
                <td><span style="color: ${balanceColor};">${balanceStatus}</span></td>
                <td style="color: ${balanceColor}; font-size: 1.1rem;"><strong>${balancePrefix}$${Math.abs(balanceNeto).toLocaleString('en-US', {minimumFractionDigits: 2})}</strong></td>
            </tr>
        `;
    }

    function exportarExcel() {
        alert("Generando hoja de cálculo en Excel (.xlsx)...\nExtrayendo registros financieros del periodo de Mayo 2026...\n\nArchivo generado: reporte_control_escolar_finanzas_mayo.xlsx (Listo para descarga).");
    }

    function exportarPDF() {
        alert("Compilando reporte ejecutivo en PDF (.pdf)...\nConsolidando balance de ingresos, egresos y nóminas...\n\nArchivo generado: balance_general_control_escolar_mayo.pdf (Listo para descarga).");
    }

    // Inicializar render
    renderReportes();
</script>
