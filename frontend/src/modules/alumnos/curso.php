<div class="modulo-horarios animate-fade-in" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Encabezado -->
    <div class="header-seccion" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
        <div>
            <h2 style="color: #1e293b; font-size: 1.8rem; font-weight: 800; display: flex; align-items: center; gap: 8px; margin: 0;">
                <i class='bx bxs-calendar-event' style="color: var(--primary);"></i> Mi Horario Escolar
            </h2>
            <p style="color: #64748b; margin: 5px 0 0 0;">Consulta tu distribución de asignaturas, aulas y docentes para el periodo escolar vigente.</p>
        </div>
        <button class="btn-finance-action" onclick="descargarHorarioPDF()" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white; display: inline-flex; align-items: center; gap: 8px;">
            <i class='bx bxs-file-pdf' style="font-size: 1.2rem;"></i> Descargar Horario PDF
        </button>
    </div>

    <!-- Filtros de Ciclo -->
    <div class="ciclo-card" style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 15px 25px; border-radius: 16px; display: flex; justify-content: space-between; align-items: center; backdrop-filter: blur(10px); box-shadow: 0 4px 20px rgba(0,0,0,0.02); flex-wrap: wrap; gap: 15px;">
        <span class="ciclo-text" style="font-weight: 700; color: #1e293b; display: flex; align-items: center; gap: 8px;">
            <i class='bx bxs-time-five' style="color: var(--accent); font-size: 1.2rem;"></i> Ciclo Activo: Enero - Junio 2026
        </span>
        <div class="badges-container" style="display: flex; gap: 10px;">
            <span class="badge-semestre" style="padding: 6px 12px; background: rgba(99,102,241,0.1); color: var(--primary); border-radius: 20px; font-size: 0.8rem; font-weight: 700;">Semestre: 4° Semestre</span>
            <span class="badge-grupo" style="padding: 6px 12px; background: rgba(168,85,247,0.1); color: var(--secondary); border-radius: 20px; font-size: 0.8rem; font-weight: 700;">Grupo: T4A</span>
        </div>
    </div>

    <!-- Layout a dos columnas: Tabla de Horario (Izquierda) y Detalle de Profesores/Asignaturas (Derecha) -->
    <div style="display: grid; grid-template-columns: 2fr 1.2fr; gap: 25px; align-items: start;">
        
        <!-- Tabla del Horario Escolar -->
        <div class="tabla-horario-container" style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 25px; border-radius: 16px; backdrop-filter: blur(10px); box-shadow: 0 8px 32px rgba(31, 38, 135, 0.04);">
            <h3 style="margin: 0 0 20px 0; color: #1e293b; font-weight: 800; display: flex; align-items: center; gap: 8px;">
                <i class='bx bxs-grid-alt' style="color: var(--primary);"></i> Distribución Semanal de Clases
            </h3>
            <div class="tabla-responsiva" style="width: 100%; overflow-x: auto; border-radius: 12px; border: 1px solid rgba(226, 232, 240, 0.8);">
                <table class="horario-table" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="background: linear-gradient(135deg, var(--primary), var(--primary)); color: #fff; padding: 14px 16px; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; text-align: left;">Hora</th>
                            <th style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: #fff; padding: 14px 16px; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; text-align: left;">Lunes</th>
                            <th style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: #fff; padding: 14px 16px; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; text-align: left;">Martes</th>
                            <th style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: #fff; padding: 14px 16px; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; text-align: left;">Miércoles</th>
                            <th style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: #fff; padding: 14px 16px; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; text-align: left;">Jueves</th>
                            <th style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: #fff; padding: 14px 16px; font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; text-align: left;">Viernes</th>
                        </tr>
                    </thead>
                    <tbody>
                            <!-- Datos dinámicos -->
                        </tbody>
                </table>
            </div>
        </div>

        <!-- Detalle de Asignaturas y Docentes -->
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 25px; border-radius: 16px; backdrop-filter: blur(10px); box-shadow: 0 8px 32px rgba(31, 38, 135, 0.04); display: flex; flex-direction: column; gap: 15px;">
            <h3 style="margin: 0; color: #1e293b; font-weight: 800; display: flex; align-items: center; gap: 8px;">
                <i class='bx bxs-user-detail' style="color: var(--secondary);"></i> Plantilla Académica
            </h3>
            <p style="color: #64748b; font-size: 0.85rem; margin: 0 0 5px 0;">Docentes asignados y reporte de tu asistencia acumulada.</p>
            
            <div style="display: flex; flex-direction: column; gap: 12px; max-height: 380px; overflow-y: auto; padding-right: 5px;" class="custom-scroll">
                <!-- Datos dinámicos -->
                </div>

                <!-- Datos dinámicos -->
                </div>

                <!-- Datos dinámicos -->
                </div>

                <!-- Datos dinámicos -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function descargarHorarioPDF() {
        alert("Generando y descargando el PDF de tu Horario Escolar Oficial...\nCódigo de descarga: SCHEDULE-2026-T4A.pdf");
    }
</script>
