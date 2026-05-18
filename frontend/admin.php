<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrativo </title>
    <link rel="stylesheet" href="./src/styles/adminInicio.css">
    <link rel="stylesheet" href="./src/styles/carreras.css">
    <link rel="stylesheet" href="./src/styles/dashboard.css">
    <link rel="stylesheet" href="./src/styles/carga.css">
    <link rel="stylesheet" href="./src/styles/formulariosAdmin.css">
    <link rel="stylesheet" href="./src/styles/agregarMateria.css">
    <link rel="stylesheet" href="./src/styles/asignarMateria.css"> 
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
                        <li><a href="#" onclick="cargarModulo('AsignarMateria')"><i class='bx bxs-user-check'></i> Asignar a Materia</a></li>
                        
                    </ul>
                                    
                <p class="menu-label">Salir</p>
                <ul>
                    <li><a href="index.html"><i class='bx bx-log-out'></i> Volver a Alumnos</a></li>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script src="./src/js/navegacion.js"></script>

    <script src="./src/modules/Admin/js/asignarMateria.js"></script>
    <script src="./src/modules/Admin/js/carreras.js"></script>
    <script src="./src/modules/Admin/js/carga.js"></script>
    <script src="./src/modules/Admin/js/agregarMateria.js"></script>
</body>
</html>