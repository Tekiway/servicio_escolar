<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Financiero - Sistema Control Escolar</title>
    
    <!-- Hojas de estilos centralizadas -->
    <link rel="stylesheet" href="../../styles/dashboard.css">
    <!-- Estilos específicos de Finanzas -->
    <link rel="stylesheet" href="../../styles/finanzas.css">
    
    <!-- Iconos Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <div class="dashboard-container">
        <!-- BARRA LATERAL (SIDEBAR) -->
        <aside class="sidebar finanzas-sidebar">
            <div class="logo">
                <i class='bx bxs-bank'></i>
                <span>CONTROL FINANCIERO</span>
            </div>
            
            <nav class="nav-menu">
                <p class="menu-label">Principal</p>
                <ul>
                    <li>
                        <a href="#" onclick="cargarModulo('Inicio')">
                            <i class='bx bxs-dashboard'></i> Dashboard
                        </a>
                    </li>
                </ul>

                <p class="menu-label">Operaciones</p>
                <ul>
                    <li>
                        <a href="#" onclick="cargarModulo('Colegiaturas')">
                            <i class='bx bxs-credit-card-front'></i> Colegiaturas
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="cargarModulo('Nomina')">
                            <i class='bx bxs-wallet'></i> Nómina Docentes
                        </a>
                    </li>
                </ul>

                <p class="menu-label">Analítica</p>
                <ul>
                    <li>
                        <a href="#" onclick="cargarModulo('Reportes')">
                            <i class='bx bxs-bar-chart-alt-2'></i> Ingresos y Egresos
                        </a>
                    </li>
                </ul>

                <p class="menu-label">Salida</p>
                <ul>
                    <li><a href="../../../index.php"><i class='bx bx-arrow-back'></i> Volver a Admin</a></li>
                </ul>
            </nav>
        </aside>

        <!-- CONTENIDO PRINCIPAL -->
        <main class="main-content">
            <!-- CABECERA SUPERIOR -->
            <header class="top-header finanzas-header">
                <div class="user-welcome">
                    <span>Bienvenido, Gestor Financiero <strong>Lic. Carlos Mendoza</strong></span>
                </div>
            </header>

            <!-- VISTA DINÁMICA -->
            <section id="vista-dinamica" class="content-body">
                <!-- El contenido se cargará aquí vía fetch AJAX -->
            </section>
        </main>
    </div>

    <!-- SCRIPT DE NAVEGACIÓN DINÁMICA -->
    <script>
        function cargarModulo(nombre) {
            const contenedor = document.getElementById('vista-dinamica');
            
            // Pasamos a minúsculas la primera letra del archivo
            const nombreArchivo = nombre.charAt(0).toLowerCase() + nombre.slice(1);
            const ruta = `./${nombreArchivo}.php`;

            fetch(ruta)
                .then(response => {
                    if (!response.ok) throw new Error('Módulo no disponible');
                    return response.text();
                })
                .then(html => {
                    contenedor.innerHTML = html;
                    
                    // Actualizar estado activo en la barra lateral
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
                        <div style="padding:40px; text-align:center; color: var(--finanzas-text-muted);">
                            <h2><i class='bx bx-error-circle' style="font-size: 3.5rem; color: var(--finanzas-danger);"></i></h2>
                            <h3 style="margin-top: 15px;">Módulo en construcción</h3>
                            <p>El archivo "${nombre}.php" no se encuentra en el directorio actual.</p>
                            <small>Ruta esperada: ${ruta}</small>
                        </div>`;
                });
        }

        // Cargar el Dashboard de Inicio por defecto al iniciar
        document.addEventListener('DOMContentLoaded', () => {
            cargarModulo('Inicio');
        });
    </script>
</body>
</html>
