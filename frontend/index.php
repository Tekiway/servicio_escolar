<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrativo - Sistema Control Escolar</title>
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
                <span>ADMINISTRACIÓN</span>
            </div>
            
            <nav class="nav-menu">
                <p class="menu-label">Control Académico</p>
                    <ul>
                        <li><a href="#" onclick="cargarModulo('Inicio')"><i class='bx bxs-dashboard'></i> Panel Inicio</a></li>
                        <li><a href="#" onclick="cargarModulo('Carga')"><i class='bx bxs-layout'></i> Carga Base</a></li>
                        <li><a href="#" onclick="cargarModulo('AgregarMateria')"><i class='bx bxs-book-add'></i> Agregar Materia</a></li>
                        <li><a href="#" onclick="cargarModulo('AsignarMateria')"><i class='bx bxs-user-check'></i> Asignar a Materia</a></li>
                    </ul>
                                    
                <p class="menu-label">Portales del Sistema</p>
                <ul>
                    <li><a href="./src/modules/alumnos/alumnos.php"><i class='bx bxs-graduation'></i> Portal Alumnos</a></li>
                    <li><a href="./src/modules/Aspirantes/aspirantes.php"><i class='bx bxs-user-plus'></i> Portal Aspirantes</a></li>
                    <li><a href="./src/modules/Docente/docente.php"><i class='bx bxs-user-rectangle'></i> Portal Docente</a></li>
                    <li><a href="./src/modules/Finanzas/finanzas.php"><i class='bx bxs-bank'></i> Portal Finanzas</a></li>
                </ul>
                                    
                <p class="menu-label">Sesión</p>
                <ul>
                    <li><a href="./src/modules/login/personal.php"><i class='bx bx-log-out'></i> Cerrar Sesión</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="top-header">
                <div class="header-actions">
                    <button class="icon-btn" aria-label="Notificaciones">
                        <i class='bx bx-bell'></i>
                        <span class="badge">3</span>
                    </button>
                    <div class="user-profile">
                        <img src="https://ui-avatars.com/api/?name=Admin+TICs&background=6366f1&color=fff&rounded=true" alt="Perfil">
                        <div class="user-info">
                            <span class="user-name">Admin TICs</span>
                            <span class="user-role">Modo Maestro</span>
                        </div>
                        <i class='bx bx-chevron-down profile-dropdown-icon'></i>
                    </div>
                </div>
            </header>

            <section id="vista-dinamica" class="content-body"></section>
        </main>
    </div>

    <script>
        function cargarModulo(nombre) {
            const contenedor = document.getElementById('vista-dinamica');
            
            // Ruta corregida a la carpeta general Admin
            const nombreArchivo = nombre.charAt(0).toLowerCase() + nombre.slice(1);
            const ruta = `./src/modules/Admin/${nombreArchivo}.php`; 

            fetch(ruta)
                .then(response => {
                    if (!response.ok) throw new Error('No se encontró el archivo');
                    return response.text();
                })
                .then(html => {
                    contenedor.innerHTML = html;
                    
                    // Actualizar clase activa en el menú
                    const links = document.querySelectorAll('.nav-menu li');
                    links.forEach(li => li.classList.remove('active'));
                    const linksA = document.querySelectorAll('.nav-menu a');
                    linksA.forEach(a => a.classList.remove('active'));
                    
                    const activeLink = Array.from(document.querySelectorAll('.nav-menu a')).find(a => a.getAttribute('onclick')?.includes(`'${nombre}'`));
                    if (activeLink) {
                        activeLink.classList.add('active');
                        activeLink.parentElement.classList.add('active');
                    }
                })
                .catch(err => {
                    contenedor.innerHTML = `
                        <div style="padding:20px; color: #64748b;">
                            <h3>Error de Carga</h3>
                            <p>No se encontró "${nombre}.php" en src/modules/Admin/</p>
                        </div>`;
                });
        }

        // Cargar el inicio de forma robusta evitando condiciones de carrera
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => {
                cargarModulo('Inicio'); 
            });
        } else {
            cargarModulo('Inicio');
        }
    </script>
</body>
</html>