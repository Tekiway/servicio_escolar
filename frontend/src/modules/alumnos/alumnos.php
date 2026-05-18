<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Estudiantil - Sistema de Control Escolar</title>
    
    <link rel="stylesheet" href="../../styles/dashboard.css">
    <link rel="stylesheet" href="../../styles/curso.css">
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* Variables globales alineadas con el sistema administrativo (Indigo, Purple, Cyan) */
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #a855f7;
            --accent: #0ea5e9;
            --bg-glass: rgba(255, 255, 255, 0.7);
            --border-glass: rgba(255, 255, 255, 0.3);
        }
        
        .sidebar {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(168, 85, 247, 0.05));
            border-right: 1px solid var(--border-glass);
            backdrop-filter: blur(10px);
        }

        .logo i {
            color: var(--primary);
        }

        .nav-menu li.active a, .nav-menu a.active {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #ffffff !important;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.25);
        }

        .top-header {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-glass);
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="logo">
                <i class='bx bxs-graduation'></i>
                <span>PORTAL ESTUDIANTIL</span>
            </div>
            
            <nav class="nav-menu">
                <p class="menu-label">Principal</p>
                <ul>
                    <li>
                        <a href="#" onclick="cargarModulo('Inicio')">
                            <i class='bx bxs-home-circle'></i> Inicio
                        </a>
                    </li>
                </ul>

                <p class="menu-label">Gestión Académica</p>
                <ul>
                    <li><a href="#" onclick="cargarModulo('Curso')"><i class='bx bxs-calendar-event'></i> Mi Horario</a></li>
                    <li><a href="#" onclick="cargarModulo('Perfil')"><i class='bx bxs-user-badge'></i> Mi Perfil</a></li>
                    <li><a href="#" onclick="cargarModulo('Evaluaciones')"><i class='bx bxs-spreadsheet'></i> Calificaciones</a></li>
                </ul>

                <p class="menu-label">Servicios</p>
                <ul>
                    <li><a href="#" onclick="cargarModulo('Boletos')"><i class='bx bxs-credit-card-front'></i> Mis Boletos</a></li>
                </ul>

                <p class="menu-label">Salida</p>
                <ul>
                    <li><a href="../../../index.php"><i class='bx bx-arrow-back'></i> Volver a Admin</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="top-header">
                <div class="user-welcome">
                    <span>Bienvenido, <strong id="student-header-name">Heber Castañeda Flores</strong></span>
                </div>
            </header>

            <section id="vista-dinamica" class="content-body">
                <!-- Se carga dinámicamente -->
            </section>
        </main>
    </div>

    <script>
        function cargarModulo(nombre) {
            const contenedor = document.getElementById('vista-dinamica');
            const nombreArchivo = nombre.charAt(0).toLowerCase() + nombre.slice(1);
            
            // Los submódulos se consolidan en la misma carpeta local /alumnos/
            const ruta = `./${nombreArchivo}.php`;

            fetch(ruta)
                .then(response => {
                    if (!response.ok) throw new Error('Archivo no encontrado');
                    return response.text();
                })
                .then(html => {
                    contenedor.innerHTML = html;
                    
                    // Actualizar clase activa en el menú lateral
                    const links = document.querySelectorAll('.nav-menu li');
                    links.forEach(li => li.classList.remove('active'));
                    const linksA = document.querySelectorAll('.nav-menu a');
                    linksA.forEach(a => a.classList.remove('active'));
                    
                    const queryName = (nombre === 'Curso') ? 'Curso' : nombre;
                    const activeLink = Array.from(document.querySelectorAll('.nav-menu a')).find(a => 
                        a.getAttribute('onclick')?.includes(`'${nombre}'`) || 
                        a.getAttribute('onclick')?.includes(`'${queryName}'`)
                    );
                    if (activeLink) {
                        activeLink.classList.add('active');
                        activeLink.parentElement.classList.add('active');
                    }
                })
                .catch(err => {
                    contenedor.innerHTML = `
                        <div style="padding: 40px; text-align: center; color: #64748b;">
                            <i class='bx bx-error-alt' style="font-size: 3.5rem; color: #ef4444; margin-bottom: 15px;"></i>
                            <h2>El módulo de ${nombre} se encuentra en desarrollo</h2>
                            <p style="font-size: 0.9rem; margin-top: 5px;">Por favor, inténtelo de nuevo más tarde o consulte con soporte del plantel.</p>
                        </div>`;
                });
        }

        // Carga de inicio automático de forma robusta
        const initAlumno = () => {
            // Actualizar nombre dinámico desde perfil si está almacenado
            const storedPerfil = localStorage.getItem('alumno_perfil');
            if (storedPerfil) {
                const data = JSON.parse(storedPerfil);
                document.getElementById('student-header-name').textContent = data.nombre;
            }
            
            cargarModulo('Inicio');
        };

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initAlumno);
        } else {
            initAlumno();
        }
    </script>
</body>
</html>