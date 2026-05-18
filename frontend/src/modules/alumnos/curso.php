<div class="animate__animated animate__fadeIn" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Encabezado -->
    <div class="module-header" style="margin-bottom: 5px;">
        <h2 style="color: #1e293b; font-size: 1.8rem; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i class='bx bxs-calendar-event' style="color: var(--primary);"></i> Mi Horario Escolar
        </h2>
        <p style="color: #64748b;">Consulta tu distribución de asignaturas para el periodo escolar vigente.</p>
    </div>

    <!-- Filtros de Ciclo -->
    <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 15px 25px; border-radius: 12px; display: flex; justify-content: space-between; align-items: center; backdrop-filter: blur(10px);">
        <span style="font-weight: 700; color: #1e293b;"><i class='bx bxs-time-five' style="color: var(--accent); margin-right: 4px; vertical-align: middle;"></i> Ciclo Activo: Enero - Junio 2026</span>
        <div style="display: flex; gap: 10px;">
            <span class="badge" style="padding: 6px 12px; background: rgba(99,102,241,0.1); color: var(--primary); border-radius: 20px; font-size: 0.8rem; font-weight: 700;">Semestre: 4° Semestre</span>
            <span class="badge" style="padding: 6px 12px; background: rgba(168,85,247,0.1); color: var(--secondary); border-radius: 20px; font-size: 0.8rem; font-weight: 700;">Grupo: T4A</span>
        </div>
    </div>

    <!-- Tabla del Horario Escolar -->
    <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 25px; border-radius: 16px; backdrop-filter: blur(10px); box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
        <h3 style="margin: 0 0 20px 0; color: #1e293b; font-weight: 800;"><i class='bx bxs-grid-alt' style="color: var(--primary);"></i> Distribución Semanal de Aulas</h3>
        <div style="overflow-x: auto;">
            <table class="finance-table" style="width: 100%;">
                <thead>
                    <tr>
                        <th style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: #fff;">Hora</th>
                        <th>Lunes</th>
                        <th>Martes</th>
                        <th>Miércoles</th>
                        <th>Jueves</th>
                        <th>Viernes</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-weight: 700; color: #64748b;">07:00 - 08:30</td>
                        <td><strong style="color: var(--primary);">Programación Web</strong><br><span style="font-size:0.75rem; color:#94a3b8;">Lab Redes 2</span></td>
                        <td>-</td>
                        <td><strong style="color: var(--primary);">Programación Web</strong><br><span style="font-size:0.75rem; color:#94a3b8;">Lab Redes 2</span></td>
                        <td><strong style="color: var(--secondary);">Redes Computacionales</strong><br><span style="font-size:0.75rem; color:#94a3b8;">Lab Redes 1</span></td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 700; color: #64748b;">08:30 - 10:00</td>
                        <td>-</td>
                        <td><strong style="color: var(--secondary);">Redes Computacionales</strong><br><span style="font-size:0.75rem; color:#94a3b8;">Lab Redes 1</span></td>
                        <td>-</td>
                        <td><strong style="color: var(--accent);">Bases de Datos II</strong><br><span style="font-size:0.75rem; color:#94a3b8;">Lab Cómputo B</span></td>
                        <td><strong style="color: var(--primary);">Tutoría Académica</strong><br><span style="font-size:0.75rem; color:#94a3b8;">Salón T4</span></td>
                    </tr>
                    <tr style="background: rgba(241, 245, 249, 0.4); text-align: center;">
                        <td style="font-weight: 700; color: #94a3b8;">10:00 - 10:30</td>
                        <td colspan="5" style="font-size: 0.75rem; font-weight: 800; color: #94a3b8; letter-spacing: 0.2em; text-transform: uppercase;">Receso / Break</td>
                    </tr>
                    <tr>
                        <td style="font-weight: 700; color: #64748b;">10:30 - 12:00</td>
                        <td><strong style="color: var(--accent);">Bases de Datos II</strong><br><span style="font-size:0.75rem; color:#94a3b8;">Lab Cómputo B</span></td>
                        <td><strong style="color: var(--primary);">Sistemas Operativos</strong><br><span style="font-size:0.75rem; color:#94a3b8;">Salón A8</span></td>
                        <td><strong style="color: var(--accent);">Bases de Datos II</strong><br><span style="font-size:0.75rem; color:#94a3b8;">Lab Cómputo B</span></td>
                        <td>-</td>
                        <td><strong style="color: var(--primary);">Sistemas Operativos</strong><br><span style="font-size:0.75rem; color:#94a3b8;">Salón A8</span></td>
                    </tr>
                    <tr>
                        <td style="font-weight: 700; color: #64748b;">12:00 - 13:30</td>
                        <td>-</td>
                        <td><strong style="color: var(--secondary);">Ética Profesional</strong><br><span style="font-size:0.75rem; color:#94a3b8;">Salón T4</span></td>
                        <td>-</td>
                        <td><strong style="color: var(--secondary);">Ética Profesional</strong><br><span style="font-size:0.75rem; color:#94a3b8;">Salón T4</span></td>
                        <td>-</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
