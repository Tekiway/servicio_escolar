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
                        <tr>
                            <td style="font-weight: 700; color: #64748b; padding: 16px; border-bottom: 1px solid rgba(226, 232, 240, 0.5);">07:00 - 08:30</td>
                            <td style="padding: 16px; border-bottom: 1px solid rgba(226, 232, 240, 0.5);"><strong style="color: var(--primary);">Programación Web</strong><span style="font-size: 0.75rem; color: #94a3b8; display: block;">Lab Redes 2</span></td>
                            <td style="padding: 16px; border-bottom: 1px solid rgba(226, 232, 240, 0.5); color: #94a3b8; text-align: center;">-</td>
                            <td style="padding: 16px; border-bottom: 1px solid rgba(226, 232, 240, 0.5);"><strong style="color: var(--primary);">Programación Web</strong><span style="font-size: 0.75rem; color: #94a3b8; display: block;">Lab Redes 2</span></td>
                            <td style="padding: 16px; border-bottom: 1px solid rgba(226, 232, 240, 0.5);"><strong style="color: var(--secondary);">Redes Comput.</strong><span style="font-size: 0.75rem; color: #94a3b8; display: block;">Lab Redes 1</span></td>
                            <td style="padding: 16px; border-bottom: 1px solid rgba(226, 232, 240, 0.5); color: #94a3b8; text-align: center;">-</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700; color: #64748b; padding: 16px; border-bottom: 1px solid rgba(226, 232, 240, 0.5);">08:30 - 10:00</td>
                            <td style="padding: 16px; border-bottom: 1px solid rgba(226, 232, 240, 0.5); color: #94a3b8; text-align: center;">-</td>
                            <td style="padding: 16px; border-bottom: 1px solid rgba(226, 232, 240, 0.5);"><strong style="color: var(--secondary);">Redes Comput.</strong><span style="font-size: 0.75rem; color: #94a3b8; display: block;">Lab Redes 1</span></td>
                            <td style="padding: 16px; border-bottom: 1px solid rgba(226, 232, 240, 0.5); color: #94a3b8; text-align: center;">-</td>
                            <td style="padding: 16px; border-bottom: 1px solid rgba(226, 232, 240, 0.5);"><strong style="color: var(--accent);">Bases de Datos II</strong><span style="font-size: 0.75rem; color: #94a3b8; display: block;">Lab Cómputo B</span></td>
                            <td style="padding: 16px; border-bottom: 1px solid rgba(226, 232, 240, 0.5);"><strong style="color: var(--primary);">Tutoría Acad.</strong><span style="font-size: 0.75rem; color: #94a3b8; display: block;">Salón T4</span></td>
                        </tr>
                        <tr style="background: rgba(241, 245, 249, 0.4); text-align: center;">
                            <td style="padding: 12px; font-size: 0.75rem; font-weight: 800; color: #94a3b8; letter-spacing: 0.2em; text-transform: uppercase;">10:00 - 10:30</td>
                            <td colspan="5" style="padding: 12px; font-size: 0.75rem; font-weight: 800; color: #94a3b8; letter-spacing: 0.2em; text-transform: uppercase;">Receso / Break</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700; color: #64748b; padding: 16px; border-bottom: 1px solid rgba(226, 232, 240, 0.5);">10:30 - 12:00</td>
                            <td style="padding: 16px; border-bottom: 1px solid rgba(226, 232, 240, 0.5);"><strong style="color: var(--accent);">Bases de Datos II</strong><span style="font-size: 0.75rem; color: #94a3b8; display: block;">Lab Cómputo B</span></td>
                            <td style="padding: 16px; border-bottom: 1px solid rgba(226, 232, 240, 0.5);"><strong style="color: var(--primary);">Sistemas Operat.</strong><span style="font-size: 0.75rem; color: #94a3b8; display: block;">Salón A8</span></td>
                            <td style="padding: 16px; border-bottom: 1px solid rgba(226, 232, 240, 0.5);"><strong style="color: var(--accent);">Bases de Datos II</strong><span style="font-size: 0.75rem; color: #94a3b8; display: block;">Lab Cómputo B</span></td>
                            <td style="padding: 16px; border-bottom: 1px solid rgba(226, 232, 240, 0.5); color: #94a3b8; text-align: center;">-</td>
                            <td style="padding: 16px; border-bottom: 1px solid rgba(226, 232, 240, 0.5);"><strong style="color: var(--primary);">Sistemas Operat.</strong><span style="font-size: 0.75rem; color: #94a3b8; display: block;">Salón A8</span></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700; color: #64748b; padding: 16px; border-bottom: none;">12:00 - 13:30</td>
                            <td style="padding: 16px; border-bottom: none; color: #94a3b8; text-align: center;">-</td>
                            <td style="padding: 16px; border-bottom: none;"><strong style="color: var(--secondary);">Ética Prof.</strong><span style="font-size: 0.75rem; color: #94a3b8; display: block;">Salón T4</span></td>
                            <td style="padding: 16px; border-bottom: none; color: #94a3b8; text-align: center;">-</td>
                            <td style="padding: 16px; border-bottom: none;"><strong style="color: var(--secondary);">Ética Prof.</strong><span style="font-size: 0.75rem; color: #94a3b8; display: block;">Salón T4</span></td>
                            <td style="padding: 16px; border-bottom: none; color: #94a3b8; text-align: center;">-</td>
                        </tr>
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
                <!-- Materia 1 -->
                <div style="background: rgba(255, 255, 255, 0.5); border: 1px solid rgba(226, 232, 240, 0.8); padding: 12px 15px; border-radius: 12px; display: flex; flex-direction: column; gap: 8px;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <strong style="color: #1e293b; font-size: 0.9rem; display: block;">Programación Web I</strong>
                            <span style="font-size: 0.8rem; color: #64748b;">Ing. Ricardo Ramos</span>
                        </div>
                        <span style="font-size: 0.75rem; background: rgba(5,150,105,0.1); color: #059669; padding: 3px 8px; border-radius: 20px; font-weight: 700;">98% Asist.</span>
                    </div>
                    <div style="background: #e2e8f0; height: 6px; border-radius: 3px; overflow: hidden; width: 100%;">
                        <div style="background: #059669; width: 98%; height: 100%;"></div>
                    </div>
                </div>

                <!-- Materia 2 -->
                <div style="background: rgba(255, 255, 255, 0.5); border: 1px solid rgba(226, 232, 240, 0.8); padding: 12px 15px; border-radius: 12px; display: flex; flex-direction: column; gap: 8px;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <strong style="color: #1e293b; font-size: 0.9rem; display: block;">Redes de Computadoras</strong>
                            <span style="font-size: 0.8rem; color: #64748b;">Mtra. Patricia Garmendia</span>
                        </div>
                        <span style="font-size: 0.75rem; background: rgba(5,150,105,0.1); color: #059669; padding: 3px 8px; border-radius: 20px; font-weight: 700;">94% Asist.</span>
                    </div>
                    <div style="background: #e2e8f0; height: 6px; border-radius: 3px; overflow: hidden; width: 100%;">
                        <div style="background: #059669; width: 94%; height: 100%;"></div>
                    </div>
                </div>

                <!-- Materia 3 -->
                <div style="background: rgba(255, 255, 255, 0.5); border: 1px solid rgba(226, 232, 240, 0.8); padding: 12px 15px; border-radius: 12px; display: flex; flex-direction: column; gap: 8px;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <strong style="color: #1e293b; font-size: 0.9rem; display: block;">Bases de Datos II</strong>
                            <span style="font-size: 0.8rem; color: #64748b;">Dr. Manuel Ocampo</span>
                        </div>
                        <span style="font-size: 0.75rem; background: rgba(5,150,105,0.1); color: #059669; padding: 3px 8px; border-radius: 20px; font-weight: 700;">92% Asist.</span>
                    </div>
                    <div style="background: #e2e8f0; height: 6px; border-radius: 3px; overflow: hidden; width: 100%;">
                        <div style="background: #059669; width: 92%; height: 100%;"></div>
                    </div>
                </div>

                <!-- Materia 4 -->
                <div style="background: rgba(255, 255, 255, 0.5); border: 1px solid rgba(226, 232, 240, 0.8); padding: 12px 15px; border-radius: 12px; display: flex; flex-direction: column; gap: 8px;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <strong style="color: #1e293b; font-size: 0.9rem; display: block;">Sistemas Operativos</strong>
                            <span style="font-size: 0.8rem; color: #64748b;">Ing. Joaquín Alavez</span>
                        </div>
                        <span style="font-size: 0.75rem; background: rgba(245,158,11,0.1); color: #d97706; padding: 3px 8px; border-radius: 20px; font-weight: 700;">85% Asist.</span>
                    </div>
                    <div style="background: #e2e8f0; height: 6px; border-radius: 3px; overflow: hidden; width: 100%;">
                        <div style="background: #d97706; width: 85%; height: 100%;"></div>
                    </div>
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
