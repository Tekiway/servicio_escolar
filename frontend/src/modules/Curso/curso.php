<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Horarios - Sistema Escolar</title>
    
    <link rel="stylesheet" href="../../styles/curso.css">
</head>
<body>

    <div class="modulo-horarios">
        <header class="header-seccion">
            <h2>Mi Horario Escolar</h2>
            <p id="ciclo-escolar">Ciclo: Enero - Junio 2026</p>
        </header>

        <div class="tabla-responsiva">
            <table>
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
                        <td>07:00 - 08:00</td>
                        <td>Programación Web</td>
                        <td>Redes I</td>
                        <td>Programación Web</td>
                        <td>Arquitectura</td>
                        <td>Tutoría</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../Curso/curso.js"></script>
</body>
</html>