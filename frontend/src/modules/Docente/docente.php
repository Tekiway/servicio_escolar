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

                <p class="menu-label">Académico</p>
                <ul>
                    <li><a href="#" onclick="cargarModulo('MisClases')"><i class='bx bxs-chalkboard'></i> Mis Clases</a></li>
                    <li><a href="#" onclick="cargarModulo('Calificaciones')"><i class='bx bxs-edit-alt'></i> Subir Calificaciones</a></li>
                    <li><a href="#" onclick="cargarModulo('Asistencias')"><i class='bx bxs-user-check'></i> Pase de Lista</a></li>
                </ul>

                <p class="menu-label">Salida</p>
                <ul>
                    <li><a href="../../../index.php"><i class='bx bx-arrow-back'></i> Volver a Admin</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="top-header docente-header">
                <div class="user-welcome">
                    <span>Bienvenido, Profesor <strong>Juan Pérez</strong></span>
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
                        <div style="padding:40px; text-align:center; color: #64748b;">
                            <h2><i class='bx bx-error-circle' style="font-size: 3rem;"></i></h2>
                            <h3>Módulo no disponible</h3>
                            <p>El módulo "${nombre}" está en construcción o no fue encontrado.</p>
                            <small>Ruta esperada: ${ruta}</small>
                        </div>`;
                });
        }

        // Cargar 'Inicio' por defecto de forma robusta
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
