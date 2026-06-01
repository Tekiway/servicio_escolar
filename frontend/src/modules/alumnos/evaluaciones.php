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
            <span class="badge" style="padding: 6px 15px; background: linear-gradient(135deg, var(--primary), var(--secondary)); color: #fff; border-radius: 20px; font-size: 1rem; font-weight: 800;" id="eval-promedio-badge">9.46</span>
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
                    <!-- Filas cargadas dinámicamente -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    (function() {
        const storedEval = localStorage.getItem('alumno_evaluacion_docente');
        if (!storedEval) {
            const container = document.querySelector('.animate__animated');
            container.innerHTML = `
                <div class="module-header" style="margin-bottom: 5px;">
                    <h2 style="color: #1e293b; font-size: 1.8rem; font-weight: 800; display: flex; align-items: center; gap: 8px;">
                        <i class='bx bxs-spreadsheet' style="color: var(--primary);"></i> Mi Boleta de Calificaciones
                    </h2>
                    <p style="color: #64748b;">Monitorea tus resultados y evaluaciones académicas por cada unidad de aprendizaje.</p>
                </div>

                <div style="background: #fff; border: 1px solid rgba(0,0,0,0.05); padding: 50px 30px; text-align: center; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.02); max-width: 650px; margin: 30px auto; display: flex; flex-direction: column; align-items: center; gap: 15px;">
                    <div style="width: 80px; height: 80px; border-radius: 50%; background: rgba(239, 68, 68, 0.1); color: #ef4444; display: flex; align-items: center; justify-content: center; font-size: 3rem; margin-bottom: 5px;">
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 800; color: #1e293b; font-family: 'Outfit', sans-serif; margin: 0;">Boleta Bloqueada Temporalmente</h3>
                    <p style="color: #64748b; line-height: 1.6; font-size: 0.95rem; margin: 0; max-width: 500px;">
                        Estimado alumno, por disposición oficial debes completar la <strong>Evaluación Docente Semestral Obligatoria</strong> de tus profesores antes de poder consultar tus calificaciones parciales y finales.
                    </p>
                    <button class="btn-finance-action" style="margin-top: 10px; background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white; display: inline-flex;" onclick="cargarModulo('Examen')">
                        <i class='bx bxs-face' style="font-size: 1.15rem;"></i> Responder Evaluación Docente
                    </button>
                </div>
            `;
            return;
        }

        // Inicializar materias y calificaciones en localStorage si no existen
        let dbMaterias = localStorage.getItem('alumno_materias');
        if (!dbMaterias) {
            dbMaterias = JSON.stringify([
                {
                    nombre: 'Programación Web I',
                    periodo: 'Ene-Jun 2026',
                    unidades: [
                        { numero: 1, calificacion: 9.5 },
                        { numero: 2, calificacion: 9.8 },
                        { numero: 3, calificacion: 10.0 }
                    ]
                },
                {
                    nombre: 'Redes de Computadoras I',
                    periodo: 'Ene-Jun 2026',
                    unidades: [
                        { numero: 1, calificacion: 8.5 },
                        { numero: 2, calificacion: 9.0 },
                        { numero: 3, calificacion: 9.2 }
                    ]
                },
                {
                    nombre: 'Bases de Datos Avanzadas II',
                    periodo: 'Ene-Jun 2026',
                    unidades: [
                        { numero: 1, calificacion: 9.0 },
                        { numero: 2, calificacion: 9.5 },
                        { numero: 3, calificacion: 9.8 }
                    ]
                },
                {
                    nombre: 'Sistemas Operativos',
                    periodo: 'Ene-Jun 2026',
                    unidades: [
                        { numero: 1, calificacion: 9.2 },
                        { numero: 2, calificacion: 9.0 },
                        { numero: 3, calificacion: 9.6 }
                    ]
                },
                {
                    nombre: 'Ética y Responsabilidad Social',
                    periodo: 'Ene-Jun 2026',
                    unidades: [
                        { numero: 1, calificacion: 10.0 },
                        { numero: 2, calificacion: 10.0 },
                        { numero: 3, calificacion: 10.0 }
                    ]
                }
            ]);
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
