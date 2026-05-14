<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrativo - Nakumi</title>
    <link rel="stylesheet" href="./src/styles/adminInicio.css">
    <link rel="stylesheet" href="./src/styles/dashboard.css">
    <link rel="stylesheet" href="./src/styles/carga.css">
    <link rel="stylesheet" href="./src/styles/formulariosAdmin.css">
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
                        <li><a href="#" onclick="cargarModulo('Carga')"><i class='bx bxs-layout'></i> Carga Base</a></li>
                        <li><a href="#" onclick="cargarModulo('AgregarMateria')"><i class='bx bxs-book-add'></i> Agregar Materia</a></li>
                        <li><a href="#" onclick="cargarModulo('AsignarMaestro')"><i class='bx bxs-user-check'></i> Asignar a Maestro</a></li>
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

    <script>
        function cargarModulo(nombre) {
            const contenedor = document.getElementById('vista-dinamica');
            
            // Ruta corregida a la carpeta general Admin
            const ruta = `./src/modules/Admin/${nombre}.php`; 

            fetch(ruta)
                .then(response => {
                    if (!response.ok) throw new Error('No se encontró el archivo');
                    return response.text();
                })
                .then(html => {
                    contenedor.innerHTML = html;
                })
                .catch(err => {
                    contenedor.innerHTML = `
                        <div style="padding:20px; color: #64748b;">
                            <h3>Error de Carga</h3>
                            <p>No se encontró "${nombre}.php" en src/modules/Admin/</p>
                        </div>`;
                });
        }

// Cargar el inicio automáticamente al abrir admin.html
document.addEventListener('DOMContentLoaded', () => {
    cargarModulo('Inicio'); 
});
    </script>
</body>
</html>