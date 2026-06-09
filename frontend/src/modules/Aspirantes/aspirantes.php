<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Aspirantes - Sistema de Control Escolar</title>
    
    <link rel="stylesheet" href="../../styles/dashboard.css">
    <link rel="stylesheet" href="../../styles/curso.css">
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* Variables de diseño especializadas para Aspirantes (Purple/Cyan) */
        :root {
            --primary: #a855f7;
            --primary-dark: #9333ea;
            --secondary: #0ea5e9;
            --accent: #6366f1;
            --bg-glass: rgba(255, 255, 255, 0.7);
            --border-glass: rgba(255, 255, 255, 0.3);
        }
        
        .sidebar {
            background: linear-gradient(135deg, rgba(168, 85, 247, 0.05), rgba(14, 165, 233, 0.05));
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
            box-shadow: 0 4px 15px rgba(168, 85, 247, 0.25);
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
                <i class='bx bxs-user-plus'></i>
                <span>PORTAL ASPIRANTES</span>
            </div>
            
            <nav class="nav-menu">
                <p class="menu-label">Admisiones</p>
                <ul>
                    <li>
                        <a href="#" onclick="cargarModulo('Inicio')">
                            <i class='bx bxs-home-circle'></i> Panel Inicio
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="cargarModulo('Ficha')">
                            <i class='bx bxs-edit-location'></i> Trámite de Ficha
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="cargarModulo('Documentos')">
                            <i class='bx bxs-cloud-upload'></i> Carga de Documentos
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="cargarModulo('Pago')">
                            <i class='bx bxs-credit-card'></i> Formato y Pago
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="cargarModulo('Examen')">
                            <i class='bx bxs-graduation'></i> Examen y Simulador
                        </a>
                    </li>
                </ul>

                <p class="menu-label">Salida</p>
                <ul>
                    <li><a href="../../../../index.php"><i class='bx bx-arrow-back'></i> Volver a Admin</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="top-header">
                <div class="user-welcome">
                    <span>Bienvenido, <strong id="aspirante-header-name">Aspirante en Registro</strong></span>
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
            
            const ruta = `./${nombreArchivo}.php`;

            fetch(ruta)
                .then(response => {
                    if (!response.ok) throw new Error('Archivo no encontrado');
                    return response.text();
                })
                .then(html => {
                    contenedor.innerHTML = html;
                    
                    // Forzar ejecución de scripts inyectados para habilitar interactividad
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
                    
                    // Actualizar clase activa en el menú lateral
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
                        <div style="padding: 40px; text-align: center; color: #64748b;">
                            <i class='bx bx-error-alt' style="font-size: 3.5rem; color: #ef4444; margin-bottom: 15px;"></i>
                            <h2>El módulo de ${nombre} se encuentra en desarrollo</h2>
                            <p style="font-size: 0.9rem; margin-top: 5px;">Por favor, contacte al departamento de servicios escolares.</p>
                        </div>`;
                });
        }

        // Carga de inicio automático de forma robusta
        const initAspirante = () => {
            const storedAspirante = localStorage.getItem('aspirante_registro');
            if (storedAspirante) {
                const data = JSON.parse(storedAspirante);
                document.getElementById('aspirante-header-name').textContent = data.nombre;
            }
            cargarModulo('Inicio');
        };

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initAspirante);
        } else {
            initAspirante();
        }
    </script>
</body>
</html>
