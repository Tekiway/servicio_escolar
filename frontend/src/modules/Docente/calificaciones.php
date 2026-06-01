<div class="animate__animated animate__fadeIn" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Encabezado -->
    <div class="module-header" style="margin-bottom: 5px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
        <div>
            <h2 style="color: #1e293b; font-size: 1.8rem; font-weight: 800; display: flex; align-items: center; gap: 8px; margin: 0;">
                <i class='bx bxs-edit-alt' style="color: var(--primary);"></i> Calificaciones y Evaluaciones
            </h2>
            <p style="color: #64748b; margin: 5px 0 0 0;">Captura notas del parcial, define rubros de evaluación ponderados y calcula promedios en tiempo real.</p>
        </div>
        <div>
            <select id="eval-clase-select" onchange="cambiarClaseCalificaciones()" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; font-weight: 600; color: #475569;">
                <option value="T4A">Programación Web I (T4A)</option>
                <option value="T6B">Bases de Datos Avanzadas II (T6B)</option>
            </select>
        </div>
    </div>

    <!-- Ponderación de Rubros Personalizados -->
    <div style="background: white; border: 1px solid #e2e8f0; border-radius: 16px; padding: 20px; box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
        <h3 style="margin: 0 0 15px 0; font-size: 1rem; font-weight: 800; color: #1e293b; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 6px;">
            <i class='bx bxs-cog' style="color: var(--secondary);"></i> CONFIGURACIÓN DE RUBROS Y PONDERACIÓN
        </h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 15px;">
            <div style="display: flex; flex-direction: column; gap: 5px; background: #f8fafc; padding: 10px 15px; border-radius: 10px; border: 1px solid #e2e8f0;">
                <label style="font-size: 0.72rem; font-weight: bold; color: #64748b;">TAREAS Y TRABAJOS</label>
                <div style="display: flex; align-items: center; gap: 5px;">
                    <input type="number" id="rubro-tareas" value="30" oninput="validarRubros()" style="width: 70px; padding: 6px; border-radius: 6px; border: 1px solid #cbd5e1; font-weight: 800; text-align: center;">
                    <span style="font-weight: 700; color: #475569;">%</span>
                </div>
            </div>
            <div style="display: flex; flex-direction: column; gap: 5px; background: #f8fafc; padding: 10px 15px; border-radius: 10px; border: 1px solid #e2e8f0;">
                <label style="font-size: 0.72rem; font-weight: bold; color: #64748b;">EXAMEN PARCIAL</label>
                <div style="display: flex; align-items: center; gap: 5px;">
                    <input type="number" id="rubro-examen" value="40" oninput="validarRubros()" style="width: 70px; padding: 6px; border-radius: 6px; border: 1px solid #cbd5e1; font-weight: 800; text-align: center;">
                    <span style="font-weight: 700; color: #475569;">%</span>
                </div>
            </div>
            <div style="display: flex; flex-direction: column; gap: 5px; background: #f8fafc; padding: 10px 15px; border-radius: 10px; border: 1px solid #e2e8f0;">
                <label style="font-size: 0.72rem; font-weight: bold; color: #64748b;">PROYECTO INTEGRADOR</label>
                <div style="display: flex; align-items: center; gap: 5px;">
                    <input type="number" id="rubro-proyecto" value="30" oninput="validarRubros()" style="width: 70px; padding: 6px; border-radius: 6px; border: 1px solid #cbd5e1; font-weight: 800; text-align: center;">
                    <span style="font-weight: 700; color: #475569;">%</span>
                </div>
            </div>
            <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; border: 2px dashed #cbd5e1; border-radius: 10px; padding: 10px;">
                <span style="font-size: 0.72rem; font-weight: bold; color: #64748b;">TOTAL ACUMULADO</span>
                <strong id="rubros-total-badge" style="font-size: 1.25rem; color: #059669;">100%</strong>
            </div>
        </div>
        <p id="rubros-alert" style="color: #ef4444; font-size: 0.75rem; font-weight: 700; margin: 10px 0 0 0; display: none;">
            <i class='bx bx-error-alt'></i> La suma de las ponderaciones debe ser exactamente 100% para realizar cálculos correctos.
        </p>
    </div>

    <!-- Panel de Captura y Calificaciones -->
    <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); border-radius: 16px; padding: 25px; backdrop-filter: blur(10px); box-shadow: 0 8px 32px rgba(31, 38, 135, 0.04);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
            <h3 style="margin: 0; color: #1e293b; font-weight: 800; display: flex; align-items: center; gap: 8px;">
                <i class='bx bx-table' style="color: var(--primary);"></i> Cuadro de Notas de Alumnos
            </h3>
            <div style="display: flex; gap: 10px;">
                <button class="btn-finance-action" onclick="exportarActaCalificaciones()" style="background: #e2e8f0; color: #475569; border: none; font-size: 0.82rem; font-weight: 700;">
                    <i class='bx bxs-file-pdf'></i> Exportar Acta
                </button>
                <button class="btn-finance-action" onclick="guardarCalificacionesBD()" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white; font-size: 0.82rem; font-weight: 700;">
                    <i class='bx bxs-save'></i> Guardar Parcial
                </button>
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 2px solid #e2e8f0;">
                        <th style="padding: 12px 10px; font-size: 0.78rem; font-weight: 700; color: #64748b; text-transform: uppercase;">Matrícula</th>
                        <th style="padding: 12px 10px; font-size: 0.78rem; font-weight: 700; color: #64748b; text-transform: uppercase;">Nombre del Alumno</th>
                        <th style="padding: 12px 10px; font-size: 0.78rem; font-weight: 700; color: #64748b; text-transform: uppercase; text-align: center; width: 110px;">Tareas</th>
                        <th style="padding: 12px 10px; font-size: 0.78rem; font-weight: 700; color: #64748b; text-transform: uppercase; text-align: center; width: 110px;">Examen</th>
                        <th style="padding: 12px 10px; font-size: 0.78rem; font-weight: 700; color: #64748b; text-transform: uppercase; text-align: center; width: 110px;">Proyecto</th>
                        <th style="padding: 12px 10px; font-size: 0.78rem; font-weight: 700; color: #64748b; text-transform: uppercase; text-align: center; width: 120px;">Promedio Final</th>
                        <th style="padding: 12px 10px; font-size: 0.78rem; font-weight: 700; color: #64748b; text-transform: uppercase; text-align: center; width: 100px;">Estatus</th>
                    </tr>
                </thead>
                <tbody id="calif-tabla-rows">
                    <!-- Filas inyectadas por JS -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const alumnosCalificacionesData = {
        "T4A": [
            { matricula: "2026001", nombre: "Heber Castañeda Flores", tareas: 9.5, examen: 9.0, proyecto: 10.0 },
            { matricula: "2026002", nombre: "Brenda González Ortiz", tareas: 9.0, examen: 8.8, proyecto: 9.5 },
            { matricula: "2026003", nombre: "Carlos Domínguez Rojas", tareas: 7.5, examen: 7.0, proyecto: 8.0 },
            { matricula: "2026004", nombre: "Diana Peralta Mendiola", tareas: 10.0, examen: 9.5, proyecto: 10.0 },
            { matricula: "2026005", nombre: "Esteban Cruz Velasco", tareas: 8.5, examen: 8.0, proyecto: 9.0 },
            { matricula: "2026006", nombre: "Fabiola Juárez Montes", tareas: 6.5, examen: 6.8, proyecto: 7.0 }
        ],
        "T6B": [
            { matricula: "2024101", nombre: "Alejandro Mendoza López", tareas: 8.8, examen: 8.5, proyecto: 9.2 },
            { matricula: "2024102", nombre: "Beatriz Solís Medina", tareas: 9.2, examen: 9.0, proyecto: 9.2 },
            { matricula: "2024103", nombre: "Guillermo Pineda Pérez", tareas: 8.0, examen: 7.8, proyecto: 8.5 },
            { matricula: "2024104", nombre: "Irene Vázquez Ramos", tareas: 6.0, examen: 5.5, proyecto: 6.5 }
        ]
    };

    function cambiarClaseCalificaciones() {
        renderTablaCalificaciones();
    }

    function renderTablaCalificaciones() {
        const clase = document.getElementById('eval-clase-select').value;
        const alumnos = alumnosCalificacionesData[clase];
        const tbody = document.getElementById('calif-tabla-rows');
        tbody.innerHTML = '';

        alumnos.forEach((al, index) => {
            const tr = document.createElement('tr');
            tr.style.cssText = "border-bottom: 1px solid rgba(226, 232, 240, 0.5);";
            
            tr.innerHTML = `
                <td style="padding: 12px 10px; font-weight: 700; color: #475569;">${al.matricula}</td>
                <td style="padding: 12px 10px; font-weight: 600; color: #1e293b;">${al.nombre}</td>
                <td style="padding: 12px 10px; text-align: center;">
                    <input type="number" min="0" max="10" step="0.1" id="tareas-${index}" value="${al.tareas}" oninput="calcularPromedioFila(${index})" style="width: 75px; padding: 6px; border-radius: 6px; border: 1px solid #cbd5e1; text-align: center; font-weight: 700;">
                </td>
                <td style="padding: 12px 10px; text-align: center;">
                    <input type="number" min="0" max="10" step="0.1" id="examen-${index}" value="${al.examen}" oninput="calcularPromedioFila(${index})" style="width: 75px; padding: 6px; border-radius: 6px; border: 1px solid #cbd5e1; text-align: center; font-weight: 700;">
                </td>
                <td style="padding: 12px 10px; text-align: center;">
                    <input type="number" min="0" max="10" step="0.1" id="proyecto-${index}" value="${al.proyecto}" oninput="calcularPromedioFila(${index})" style="width: 75px; padding: 6px; border-radius: 6px; border: 1px solid #cbd5e1; text-align: center; font-weight: 700;">
                </td>
                <td style="padding: 12px 10px; text-align: center;">
                    <strong id="final-${index}" style="font-size: 1rem; color: var(--primary-dark);">0.00</strong>
                </td>
                <td style="padding: 12px 10px; text-align: center;" id="estatus-${index}">
                    <!-- Badge de aprobado/reprobado -->
                </td>
            `;

            tbody.appendChild(tr);
            calcularPromedioFila(index);
        });
    }

    function validarRubros() {
        const tareasPct = parseFloat(document.getElementById('rubro-tareas').value) || 0;
        const examenPct = parseFloat(document.getElementById('rubro-examen').value) || 0;
        const proyectoPct = parseFloat(document.getElementById('rubro-proyecto').value) || 0;

        const total = tareasPct + examenPct + proyectoPct;
        const totalBadge = document.getElementById('rubros-total-badge');
        const alertBox = document.getElementById('rubros-alert');

        totalBadge.textContent = total + '%';

        if (total === 100) {
            totalBadge.style.color = '#059669';
            alertBox.style.display = 'none';
            // Recalcular todo
            recalcularTodosLosPromedios();
        } else {
            totalBadge.style.color = '#ef4444';
            alertBox.style.display = 'block';
        }
    }

    function calcularPromedioFila(index) {
        const tareasPct = (parseFloat(document.getElementById('rubro-tareas').value) || 0) / 100;
        const examenPct = (parseFloat(document.getElementById('rubro-examen').value) || 0) / 100;
        const proyectoPct = (parseFloat(document.getElementById('rubro-proyecto').value) || 0) / 100;

        const tareasNota = parseFloat(document.getElementById(`tareas-${index}`).value) || 0;
        const examenNota = parseFloat(document.getElementById(`examen-${index}`).value) || 0;
        const proyectoNota = parseFloat(document.getElementById(`proyecto-${index}`).value) || 0;

        const promFinal = (tareasNota * tareasPct) + (examenNota * examenPct) + (proyectoNota * proyectoPct);
        const finalBadge = document.getElementById(`final-${index}`);
        finalBadge.textContent = promFinal.toFixed(2);

        const estatusCell = document.getElementById(`estatus-${index}`);
        if (promFinal >= 7.0) {
            estatusCell.innerHTML = `<span style="padding: 3px 8px; border-radius: 20px; font-size: 0.72rem; font-weight: 700; background: rgba(5,150,105,0.1); color: #059669;">Aprobado</span>`;
        } else {
            estatusCell.innerHTML = `<span style="padding: 3px 8px; border-radius: 20px; font-size: 0.72rem; font-weight: 700; background: rgba(239,68,68,0.1); color: #ef4444;">Reprobado</span>`;
        }
    }

    function recalcularTodosLosPromedios() {
        const clase = document.getElementById('eval-clase-select').value;
        const alumnos = alumnosCalificacionesData[clase];
        alumnos.forEach((al, index) => {
            calcularPromedioFila(index);
        });
    }

    function guardarCalificacionesBD() {
        alert("¡Éxito!\nCalificaciones guardadas y promedios actualizados en el sistema de base de datos.");
    }

    function exportarActaCalificaciones() {
        const clase = document.getElementById('eval-clase-select').value;
        alert(`Generando Acta de Calificaciones Oficial en formato PDF para el grupo ${clase}...\nArchivo descargado: ACTA-2026-${clase}.pdf`);
    }

    // Inicializar
    renderTablaCalificaciones();
</script>
