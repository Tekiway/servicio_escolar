<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escolar</title>
    
    <link rel="stylesheet" href="./src/styles/Dashboard.css">
    <link rel="stylesheet" href="./src/styles/curso.css">
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="logo">
                <i class='bx bxs-shield-quarter'></i>
                <span>SISTEMA ESCOLAR</span>
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

                <p class="menu-label">Gestión</p>
                <ul>
                    <li><a href="#" onclick="cargarModulo('Cursos')"><i class='bx bxs-calendar-event'></i> Cursos</a></li>
                    <li><a href="#" onclick="cargarModulo('Perfil')"><i class='bx bxs-user-badge'></i> Perfil</a></li>
                    <li><a href="#" onclick="cargarModulo('Evaluaciones')"><i class='bx bxs-spreadsheet'></i> Calificaciones</a></li>
                </ul>

                <p class="menu-label">Servicios</p>
                <ul>
                    <li><a href="#" onclick="cargarModulo('Ficha')"><i class='bx bxs-edit-location'></i> Trámite Ficha</a></li>
                    <li><a href="#" onclick="cargarModulo('Boletos')"><i class='bx bxs-credit-card-front'></i> Boletos</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <header class="top-header">
                <div class="user-welcome">
                    <span>Bienvenido, <strong>Heber Castañeda</strong></span>
                </div>
            </header>

            <section id="vista-dinamica" class="content-body">
                <div class="hero-card">
                    <h1>Panel de Control Estudiantil</h1>
                    <p>Selecciona una opción del menú para gestionar tus actividades escolares.</p>
                </div>
            </section>
        </main>
    </div>

    <script>

        function cargarModulo(nombre) {
            const contenedor = document.getElementById('vista-dinamica');
            
            // IMPORTANTE: Revisa que la ruta coincida con tus carpetas
            const ruta = `./src/modules/${nombre}/${nombre}.php`;

            fetch(ruta)
                .then(response => {
                    if (!response.ok) throw new Error('Archivo no encontrado');
                    return response.text();
                })
                .then(html => {
                    contenedor.innerHTML = html;
                })
                .catch(err => {
                    // Esto es lo que ves ahora porque la ruta falla
                    contenedor.innerHTML = `
                        <div style="padding:40px; text-align:center;">
                            <h2>Opps! El módulo ${nombre} aún no existe</h2>
                            <p>Crea el archivo en: src/modules/${nombre}/${nombre}.php</p>
                        </div>`;
                });
}

        // Esto hace que "Inicio" se cargue solito al abrir la página
        document.addEventListener('DOMContentLoaded', () => {
            cargarModulo('Inicio');
        });
        
        function cargarModulo(nombre) {
            const contenedor = document.getElementById('vista-dinamica');
            
            // Ruta hacia el archivo del módulo (ej: src/modules/Horarios/Horario.php)
            // Nota: Si usas .php necesitas correrlo en un servidor como XAMPP
            const ruta = `./src/modules/${nombre}/${nombre}.php`;

            fetch(ruta)
                .then(response => response.text())
                .then(html => {
                    contenedor.innerHTML = html;
                })
                .catch(err => {
                    contenedor.innerHTML = "<h2>Error al cargar el módulo</h2>";
                    console.error(err);
                });
        }
    </script>
</body>
</html>