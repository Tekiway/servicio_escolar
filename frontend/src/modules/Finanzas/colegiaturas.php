<div class="animate__animated animate__fadeIn">
    <!-- Encabezado de Sección -->
    <div class="module-header" style="margin-bottom: 30px;">
        <h2 style="color: var(--finanzas-text-main); font-size: 1.8rem; font-weight: 800;">
            <i class='bx bxs-credit-card-front' style="color: var(--finanzas-primary-dark);"></i> Control de Colegiaturas y Cobranza
        </h2>
        <p style="color: var(--finanzas-text-muted);">Administración del estado de pago de los alumnos inscritos.</p>
    </div>

    <!-- Barra de acciones, búsqueda y filtrado -->
    <div class="table-actions-bar">
        <div class="search-wrapper">
            <i class='bx bx-search-alt'></i>
            <input type="text" id="busqueda-alumno" placeholder="Buscar por Nombre, Matrícula..." onkeyup="filtrarTablaColegiaturas()">
        </div>
        
        <div style="display: flex; gap: 10px;">
            <button class="btn-finance-action secondary" onclick="filtrarEstado('Todos')">Ver Todos</button>
            <button class="btn-finance-action secondary" onclick="filtrarEstado('Atrasado')" style="border-color: #ef4444; color: #dc2626;">Atrasados</button>
            <button class="btn-finance-action" onclick="abrirModalCobro()">
                <i class='bx bx-plus'></i> Registrar Pago Recibido
            </button>
        </div>
    </div>

    <!-- Tabla de Colegiaturas -->
    <div class="finance-section-card">
        <h2><i class='bx bxs-user-check'></i> Estatus de Colegiaturas - Semestre Actual</h2>
        <div style="overflow-x: auto;">
            <table class="finance-table">
                <thead>
                    <tr>
                        <th>Matrícula</th>
                        <th>Alumno</th>
                        <th>Carrera / Semestre</th>
                        <th>Mes Pagado</th>
                        <th>Monto Mensual</th>
                        <th>Estatus de Pago</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody id="tabla-colegiaturas-rows">
                    <!-- Filas cargadas dinámicamente -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL POPUP PARA REGISTRAR PAGO -->
    <div id="modal-cobro" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.4); backdrop-filter: blur(5px); z-index: 1000; align-items: center; justify-content: center;">
        <div class="finance-section-card" style="max-width: 500px; width: 90%; position: relative; margin-bottom: 0;">
            <i class='bx bx-x' style="position: absolute; top: 20px; right: 20px; font-size: 2rem; cursor: pointer; color: var(--finanzas-text-muted);" onclick="cerrarModalCobro()"></i>
            <h2><i class='bx bxs-wallet-alt'></i> Registrar Cobro</h2>
            
            <form id="form-colegiatura-pago" style="display: flex; flex-direction: column; gap: 15px; margin-top: 15px;" onsubmit="registrarCobroExitoso(event)">
                <div style="display: flex; flex-direction: column; gap: 5px;">
                    <label style="font-size: 0.8rem; font-weight: 700; color: var(--finanzas-text-muted);">MATRÍCULA DEL ALUMNO</label>
                    <input type="text" id="form-matricula" required placeholder="Ej. 2026001, 2026002" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none;" onblur="autocompletarPorMatricula()">
                </div>
                
                <div style="display: flex; flex-direction: column; gap: 5px;">
                    <label style="font-size: 0.8rem; font-weight: 700; color: var(--finanzas-text-muted);">NOMBRE DEL ESTUDIANTE</label>
                    <input type="text" id="form-nombre" required readonly placeholder="Autocompletado al ingresar matrícula" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #e2e8f0; background: #f8fafc; outline: none;">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div style="display: flex; flex-direction: column; gap: 5px;">
                        <label style="font-size: 0.8rem; font-weight: 700; color: var(--finanzas-text-muted);">MES A REGISTRAR</label>
                        <select id="form-mes" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1;">
                            <option value="Mayo 2026">Mayo 2026</option>
                            <option value="Junio 2026">Junio 2026</option>
                            <option value="Julio 2026">Julio 2026</option>
                        </select>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 5px;">
                        <label style="font-size: 0.8rem; font-weight: 700; color: var(--finanzas-text-muted);">MONTO PAGADO</label>
                        <input type="number" id="form-monto" required value="3500" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1;">
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap: 5px;">
                    <label style="font-size: 0.8rem; font-weight: 700; color: var(--finanzas-text-muted);">ESTATUS DE PAGO</label>
                    <select id="form-estatus" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1;">
                        <option value="Pagado">Al Corriente / Pagado</option>
                        <option value="Atrasado">Con Atraso</option>
                        <option value="Pendiente">Próximo a Vencer</option>
                    </select>
                </div>

                <button class="btn-finance-action" type="submit" style="margin-top: 15px; justify-content: center; width: 100%;">
                    <i class='bx bx-check-double'></i> APLICAR PAGO AL SISTEMA
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function renderColegiaturas() {
        const list = JSON.parse(localStorage.getItem('colegiaturas') || '[]');
        const tbody = document.getElementById('tabla-colegiaturas-rows');
        
        if (list.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="7" style="text-align: center; color: var(--finanzas-text-muted); padding: 40px 10px;">
                        <i class='bx bx-receipt' style="font-size: 3rem; display: block; margin-bottom: 12px; color: #cbd5e1;"></i>
                        <span style="font-size: 0.95rem; font-weight: 600; display: block;">No hay registros de colegiaturas capturados.</span>
                        <span style="font-size: 0.85rem; color: #94a3b8; display: block; margin-top: 4px;">Usa el botón "Registrar Pago Recibido" para agregar el primer registro.</span>
                    </td>
                </tr>`;
            return;
        }

        let html = '';
        list.forEach((item, index) => {
            const badgeClass = item.estado === 'Atrasado' ? 'badge danger' : (item.estado === 'Pendiente' ? 'badge warning' : 'badge success');
            const iconClass = item.estado === 'Atrasado' ? 'bx bxs-error-circle' : (item.estado === 'Pendiente' ? 'bx bxs-info-circle' : 'bx bxs-check-circle');
            const statusLabel = item.estado === 'Atrasado' ? `Atraso (${item.mes})` : (item.estado === 'Pendiente' ? 'Próximo a Vencer' : 'Al Corriente');

            html += `
                <tr class="fila-colegiatura" data-estado="${item.estado}">
                    <td><strong>${item.matricula}</strong></td>
                    <td>${item.nombre}</td>
                    <td>${item.carrera || 'Ingeniería en TICs'}</td>
                    <td>${item.mes}</td>
                    <td>$${parseFloat(item.monto).toLocaleString('en-US', {minimumFractionDigits: 2})}</td>
                    <td><span class="${badgeClass}"><i class='${iconClass}'></i> ${statusLabel}</span></td>
                    <td>
                        <button class="btn-finance-action secondary" style="padding: 6px 12px; font-size: 0.8rem;" onclick="imprimirRecibo('${item.matricula}', '${item.nombre}', '${item.mes}', '${item.monto}')">
                            <i class='bx bx-receipt'></i> Recibo
                        </button>
                    </td>
                </tr>`;
        });
        tbody.innerHTML = html;
    }

    function filtrarTablaColegiaturas() {
        const input = document.getElementById('busqueda-alumno').value.toLowerCase();
        const filas = document.querySelectorAll('.fila-colegiatura');
        
        filas.forEach(fila => {
            const texto = fila.textContent.toLowerCase();
            if (texto.includes(input)) {
                fila.style.display = '';
            } else {
                fila.style.display = 'none';
            }
        });
    }

    function filtrarEstado(estado) {
        const filas = document.querySelectorAll('.fila-colegiatura');
        filas.forEach(fila => {
            if (estado === 'Todos' || fila.getAttribute('data-estado') === estado) {
                fila.style.display = '';
            } else {
                fila.style.display = 'none';
            }
        });
    }

    function abrirModalCobro() {
        document.getElementById('form-matricula').value = '';
        document.getElementById('form-nombre').value = '';
        document.getElementById('form-matricula').readOnly = false;
        document.getElementById('modal-cobro').style.display = 'flex';
    }

    function cerrarModalCobro() {
        document.getElementById('modal-cobro').style.display = 'none';
    }

    function autocompletarPorMatricula() {
        const matricula = document.getElementById('form-matricula').value;
        const nombreField = document.getElementById('form-nombre');
        
        if(matricula === '2026001') {
            nombreField.value = 'Heber Castañeda Flores';
        } else if(matricula === '2026002') {
            nombreField.value = 'Diana Karen Santos Reyes';
        } else if(matricula === '2026003') {
            nombreField.value = 'Miguel Torres Salazar';
        } else if(matricula === '2026004') {
            nombreField.value = 'Sofía Galván Ochoa';
        } else if(matricula.trim() !== '') {
            nombreField.value = 'Estudiante Genérico / Externo';
        }
    }

    function registrarCobroExitoso(event) {
        event.preventDefault();
        const matricula = document.getElementById('form-matricula').value;
        const nombre = document.getElementById('form-nombre').value;
        const mes = document.getElementById('form-mes').value;
        const monto = document.getElementById('form-monto').value;
        const estado = document.getElementById('form-estatus').value;

        const list = JSON.parse(localStorage.getItem('colegiaturas') || '[]');
        list.unshift({
            matricula,
            nombre,
            carrera: 'Ingeniería en TICs | 4° Semestre',
            mes,
            monto,
            estado
        });
        localStorage.setItem('colegiaturas', JSON.stringify(list));

        alert("Pago registrado y cargado exitosamente al balance mensual del Sistema.");
        cerrarModalCobro();
        renderColegiaturas();
    }

    function imprimirRecibo(matricula, nombre, mes, monto) {
        alert("Generando Recibo Oficial de Pago...\n\nMatrícula: " + matricula + "\nAlumno: " + nombre + "\nPeriodo: " + mes + "\nMonto: $" + parseFloat(monto).toLocaleString('en-US', {minimumFractionDigits: 2}) + " MN\n\nRecibo de Pago firmado digitalmente por el Sistema de Control Escolar.");
    }

    // Inicializar render
    renderColegiaturas();
</script>
