<?php
header("Location: ../../../index.php");
exit;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrativo </title>
    <link rel="stylesheet" href="../../styles/adminInicio.css">
    <link rel="stylesheet" href="../../styles/carreras.css">
    <link rel="stylesheet" href="../../styles/dashboard.css">
    <link rel="stylesheet" href="../../styles/carga.css">
    <link rel="stylesheet" href="../../styles/formulariosAdmin.css">
    <link rel="stylesheet" href="../../styles/agregarMateria.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="logo">
                <i class='bx bxs-cog'></i>
                <span>SISTEMA ESCOLAR</span>
            </div>
            
            <nav class="nav-menu">
                <p class="menu-label">Control Académico</p>
                    <ul>
                        
                        <li><a href="#" onclick="cargarModulo('Inicio')"><i class='bx bxs-dashboard'></i> Panel Inicio</a></li>
                        <li><a href="#" onclick="cargarModulo('Carreras')"><i class='bx bxs-graduation'></i> Gestión de Carreras</a></li>
                        <li><a href="#" onclick="cargarModulo('Carga')"><i class='bx bxs-layout'></i> Registro de Docentes</a></li>
                        <li><a href="#" onclick="cargarModulo('AgregarMateria')"><i class='bx bxs-book-add'></i> Agregar Materia</a></li>
                        <li><a href="#" onclick="cargarModulo('AsignarMaestro')"><i class='bx bxs-user-check'></i> Asignar a Maestro</a></li>
                        
                    </ul>
                                    
                <p class="menu-label">Portales del Sistema</p>
                <ul>
                    <li><a href="../alumnos/alumnos.php"><i class='bx bxs-graduation'></i> Portal Alumnos</a></li>
                    <li><a href="../Aspirantes/aspirantes.php"><i class='bx bxs-user-plus'></i> Portal Aspirantes</a></li>
                    <li><a href="../Docente/docente.php"><i class='bx bxs-user-rectangle'></i> Portal Docente</a></li>
                    <li><a href="../Finanzas/finanzas.php"><i class='bx bxs-bank'></i> Portal Finanzas</a></li>
                </ul>
                                    
                <p class="menu-label">Sesión</p>
                <ul>
                    <li><a href="../login/personal.php"><i class='bx bx-log-out'></i> Cerrar Sesión</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="top-header">
                <div class="user-welcome">Modo: <strong>Administrador TICs</strong></div>
            </header>

            <section id="vista-dinamica" class="content-body"></section>
        </main>
    </div>

    <script src="../../js/navegacion.js"></script>
</body>
</html>