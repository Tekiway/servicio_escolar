<div class="animate__animated animate__fadeIn" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Encabezado -->
    <div class="module-header" style="margin-bottom: 5px;">
        <h2 style="color: #1e293b; font-size: 1.8rem; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i class='bx bxs-spreadsheet' style="color: var(--primary);"></i> Mi Boleta de Calificaciones
        </h2>
        <p style="color: #64748b;">Monitorea tus resultados y evaluaciones académicas por cada unidad de aprendizaje.</p>
    </div>

    <!-- Panel de Promedio Consolidado -->
    <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 20px 25px; border-radius: 12px; display: flex; justify-content: space-between; align-items: center; backdrop-filter: blur(10px);">
        <span style="font-weight: 700; color: #1e293b;"><i class='bx bxs-star-half' style="color: var(--secondary); margin-right: 4px; vertical-align: middle;"></i> Estatus del Ciclo Escolar Activo</span>
        <div style="display: flex; align-items: center; gap: 15px;">
            <span style="font-size: 0.9rem; color: #64748b;">Promedio Semestral Consolidado:</span>
            <span class="badge" style="padding: 6px 15px; background: linear-gradient(135deg, var(--primary), var(--secondary)); color: #fff; border-radius: 20px; font-size: 1rem; font-weight: 800;" id="eval-promedio-badge">0.00</span>
        </div>
    </div>

    <!-- Tabla Detallada de Asignaturas y Unidades -->
    <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 25px; border-radius: 16px; backdrop-filter: blur(10px); box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
        <h3 style="margin: 0 0 20px 0; color: #1e293b; font-weight: 800;"><i class='bx bxs-book-content' style="color: var(--primary);"></i> Calificaciones Desglosadas por Unidad</h3>
        <div style="overflow-x: auto;">
            <table class="finance-table" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Asignatura / Materia</th>
                        <th>Periodo</th>
                        <th style="text-align: center;">Unidad 1</th>
                        <th style="text-align: center;">Unidad 2</th>
                        <th style="text-align: center;">Unidad 3</th>
                        <th style="text-align: center;">Promedio Final</th>
                        <th style="text-align: center;">Estatus</th>
                    </tr>
                </thead>
                <tbody id="tabla-calificaciones-rows">
                            <!-- Datos dinámicos -->
                        </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    (function() {
        // El bloqueo ha sido removido. La boleta se muestra siempre.

        // Inicializar materias y calificaciones en localStorage si no existen
        let dbMaterias = localStorage.getItem('alumno_materias');
        if (!dbMaterias) {
            dbMaterias = JSON.stringify([]);
            localStorage.setItem('alumno_materias', dbMaterias);
        }

        const list = JSON.parse(dbMaterias);
        const tbody = document.getElementById('tabla-calificaciones-rows');
        
        let html = '';
        let sumGlobal = 0;
        let countUnits = 0;

        list.forEach(item => {
            let u1 = item.unidades[0] ? parseFloat(item.unidades[0].calificacion) : 0;
            let u2 = item.unidades[1] ? parseFloat(item.unidades[1].calificacion) : 0;
            let u3 = item.unidades[2] ? parseFloat(item.unidades[2].calificacion) : 0;

            let promMateria = ((u1 + u2 + u3) / 3);
            sumGlobal += (u1 + u2 + u3);
            countUnits += 3;

            const isAprobado = promMateria >= 7.0;
            const badgeClass = isAprobado ? 'badge success' : 'badge danger';
            const iconClass = isAprobado ? 'bx bxs-check-circle' : 'bx bxs-x-circle';
            const statusLabel = isAprobado ? 'Aprobada' : 'Reprobada';

            html += `
                <tr>
                    <td><strong>${item.nombre}</strong></td>
                    <td style="color: #64748b; font-size: 0.85rem;">${item.periodo}</td>
                    <td style="text-align: center; font-weight: 700; color: #1e293b;">${u1.toFixed(1)}</td>
                    <td style="text-align: center; font-weight: 700; color: #1e293b;">${u2.toFixed(1)}</td>
                    <td style="text-align: center; font-weight: 700; color: #1e293b;">${u3.toFixed(1)}</td>
                    <td style="text-align: center; font-weight: 800; color: var(--primary-dark); font-size: 1rem;">${promMateria.toFixed(2)}</td>
                    <td style="text-align: center;"><span class="${badgeClass}"><i class='${iconClass}'></i> ${statusLabel}</span></td>
                </tr>`;
        });

        tbody.innerHTML = html;

        if (countUnits > 0) {
            const promFinal = (sumGlobal / countUnits).toFixed(2);
            document.getElementById('eval-promedio-badge').textContent = promFinal;
        }
    })();
</script>
