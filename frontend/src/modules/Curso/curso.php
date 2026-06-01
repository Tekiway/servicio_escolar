<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Horarios - Sistema Escolar</title>
    
    <link rel="stylesheet" href="../../styles/curso.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <div class="modulo-horarios animate-fade-in">
        <header class="header-seccion">
            <h2><i class='bx bxs-calendar-event'></i> Mi Horario Escolar</h2>
            <p id="ciclo-escolar">Ciclo: Enero - Junio 2026</p>
        </header>

        <!-- Filtros de Ciclo -->
        <div class="ciclo-card">
            <span class="ciclo-text">
                <i class='bx bxs-time-five'></i> Ciclo Activo: Enero - Junio 2026
            </span>
            <div class="badges-container">
                <span class="badge-semestre">Semestre: 4° Semestre</span>
                <span class="badge-grupo">Grupo: T4A</span>
            </div>
        </div>

        <div class="tabla-horario-container">
            <h3><i class='bx bxs-grid-alt'></i> Distribución Semanal de Aulas</h3>
            <div class="tabla-responsiva">
                <table class="horario-table">
                    <thead>
                        <tr>
                            <th>Hora</th>
                            <th>Lunes</th>
                            <th>Martes</th>
                            <th>Miércoles</th>
                            <th>Jueves</th>
                            <th>Viernes</th>
                        </tr>
                    </thead>
                    <tbody id="cuerpo-horario">
                        <tr>
                            <td style="font-weight: 700; color: #64748b;">07:00 - 08:30</td>
                            <td><strong style="color: var(--primary, #6366f1);">Programación Web</strong><span>Lab Redes 2</span></td>
                            <td>-</td>
                            <td><strong style="color: var(--primary, #6366f1);">Programación Web</strong><span>Lab Redes 2</span></td>
                            <td><strong style="color: var(--secondary, #a855f7);">Redes Computacionales</strong><span>Lab Redes 1</span></td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700; color: #64748b;">08:30 - 10:00</td>
                            <td>-</td>
                            <td><strong style="color: var(--secondary, #a855f7);">Redes Computacionales</strong><span>Lab Redes 1</span></td>
                            <td>-</td>
                            <td><strong style="color: var(--accent, #0ea5e9);">Bases de Datos II</strong><span>Lab Cómputo B</span></td>
                            <td><strong style="color: var(--primary, #6366f1);">Tutoría Académica</strong><span>Salón T4</span></td>
                        </tr>
                        <tr class="receso-row">
                            <td>10:00 - 10:30</td>
                            <td colspan="5">Receso / Break</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700; color: #64748b;">10:30 - 12:00</td>
                            <td><strong style="color: var(--accent, #0ea5e9);">Bases de Datos II</strong><span>Lab Cómputo B</span></td>
                            <td><strong style="color: var(--primary, #6366f1);">Sistemas Operativos</strong><span>Salón A8</span></td>
                            <td><strong style="color: var(--accent, #0ea5e9);">Bases de Datos II</strong><span>Lab Cómputo B</span></td>
                            <td>-</td>
                            <td><strong style="color: var(--primary, #6366f1);">Sistemas Operativos</strong><span>Salón A8</span></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 700; color: #64748b;">12:00 - 13:30</td>
                            <td>-</td>
                            <td><strong style="color: var(--secondary, #a855f7);">Ética Profesional</strong><span>Salón T4</span></td>
                            <td>-</td>
                            <td><strong style="color: var(--secondary, #a855f7);">Ética Profesional</strong><span>Salón T4</span></td>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>