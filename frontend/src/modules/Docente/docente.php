<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Docente - Sistema Control Escolar</title>
    
    <!-- Compartiendo estilos base de admin para consistencia estructural -->
    <link rel="stylesheet" href="../../styles/dashboard.css">
    <!-- Estilos específicos del portal docente -->
    <link rel="stylesheet" href="../../styles/docente.css">
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #a855f7;
            --accent: #0ea5e9;
            --bg-glass: rgba(255, 255, 255, 0.7);
            --border-glass: rgba(255, 255, 255, 0.3);
        }
        
        .docente-sidebar {
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

        .nav-menu li.active a i, .nav-menu a.active i {
            color: #ffffff !important;
        }

        .top-header.docente-header {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border-glass);
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <aside class="sidebar docente-sidebar">
            <div class="logo">
                <i class='bx bxs-book-reader'></i>
                <span>PORTAL DOCENTE</span>
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
                    <li><a href="#" onclick="cargarModulo('Grupos')"><i class='bx bxs-group'></i> Grupos y Listas</a></li>
                    <li><a href="#" onclick="cargarModulo('Calificaciones')"><i class='bx bxs-edit-alt'></i> Calificaciones y Eval.</a></li>
                    <li><a href="#" onclick="cargarModulo('Tareas')"><i class='bx bxs-edit-location'></i> Actividades y Tareas</a></li>
                </ul>

                <p class="menu-label">Servicios y Reportes</p>
                <ul>
                    <li><a href="#" onclick="cargarModulo('Documentos')"><i class='bx bxs-file-blank'></i> Documentos Automáticos</a></li>
                    <li><a href="#" onclick="cargarModulo('Indicadores')"><i class='bx bxs-bar-chart-alt-2'></i> Indicadores Docente</a></li>
                    <li><a href="#" onclick="cargarModulo('Reportes')"><i class='bx bxs-cloud-download'></i> Reportes Académicos</a></li>
                </ul>

                <p class="menu-label">Salida</p>
                <ul>
                    <li id="btn-volver-admin" style="display: none;"><a href="../../../../index.php"><i class='bx bx-arrow-back'></i> Volver a Admin</a></li>
                    <li><a href="../login/personal.php" onclick="localStorage.clear()"><i class='bx bx-log-out'></i> Cerrar Sesión</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="top-header docente-header">
                <div class="user-welcome">
                    <span>Bienvenido, <strong>Profesor</strong></span>
                </div>
            </header>

            <section id="vista-dinamica" class="content-body">
                <!-- Contenido dinámico cargado por JS -->
            </section>
        </main>
    </div>

    <script>
        function cargarModulo(nombre) {
            const contenedor = document.getElementById('vista-dinamica');
            
            // Convertimos la primera letra a minúscula para la compatibilidad con Linux
            const nombreArchivo = nombre.charAt(0).toLowerCase() + nombre.slice(1);
            const ruta = `./${nombreArchivo}.php`;

            fetch(ruta)
                .then(response => {
                    if (!response.ok) throw new Error('Archivo no encontrado');
                    return response.text();
                })
                .then(html => {
                    contenedor.innerHTML = html;
                    
                    // Forzar ejecución de scripts inyectados para habilitar interactividad en el portal docente
                    const scripts = contenedor.querySelectorAll('script');
                    scripts.forEach(script => {
                        const nuevoScript = document.createElement('script');
                        if (script.src) {
                            nuevoScript.src = script.src;
                        } else {
                            nuevoScript.textContent = script.textContent;
                        }
                        document.body.appendChild(nuevoScript);
                        nuevoScript.remove(); // Mantener limpio el DOM
                    });
                    
                    // Actualizar clase activa en el menú
                    const links = document.querySelectorAll('.nav-menu li');
                    links.forEach(li => li.classList.remove('active'));
                    const linksA = document.querySelectorAll('.nav-menu a');
                    linksA.forEach(a => a.classList.remove('active'));
                    
                    const activeLink = Array.from(document.querySelectorAll('.nav-menu a')).find(a => 
                        a.getAttribute('onclick')?.includes(`'${nombre}'`)
                    );
                    if (activeLink) {
                        activeLink.classList.add('active');
                        activeLink.parentElement.classList.add('active');
                    }
                })
                .catch(err => {
                    contenedor.innerHTML = `
                        <div style="padding:40px; text-align:center; color: #64748b;">
                            <h2><i class='bx bx-error-circle' style="font-size: 3rem; color: #ef4444;"></i></h2>
                            <h3>Módulo no disponible</h3>
                            <p>El módulo "${nombre}" está en construcción o no fue encontrado.</p>
                            <small style="color: #94a3b8;">Ruta esperada: ${ruta}</small>
                        </div>`;
                });
        }

        // Cargar 'Inicio' por defecto de forma robusta
        const initDocente = () => {
            const role = localStorage.getItem('user_role');
            if (role === 'admin' || role === 'directivo') {
                const btn = document.getElementById('btn-volver-admin');
                if (btn) btn.style.display = 'block';
            }

            const storedPerfil = localStorage.getItem('user_data');
            if (storedPerfil) {
                const data = JSON.parse(storedPerfil);
                const userName = document.querySelector('.user-welcome strong');
                if (userName) userName.textContent = 'Bienvenido ' + (data.username || data.nombre);
            }

            cargarModulo('Inicio');
        };

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initDocente);
        } else {
            initDocente();
        }
    </script>
    <script src="../../js/apiGateway.js"></script>
</body>
</html>
