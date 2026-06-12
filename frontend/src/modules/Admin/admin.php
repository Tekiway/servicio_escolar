<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrativo - Sistema Control Escolar</title>
    <link rel="icon" href="data:,">
    <link rel="stylesheet" href="../../styles/adminInicio.css">
    <link rel="stylesheet" href="../../styles/carreras.css">
    <link rel="stylesheet" href="../../styles/dashboard.css">
    <link rel="stylesheet" href="../../styles/carga.css">
    <link rel="stylesheet" href="../../styles/formulariosAdmin.css">
    <link rel="stylesheet" href="../../styles/agregarMateria.css">
    <link rel="stylesheet" href="../../styles/asignarMateria.css">
    <link rel="stylesheet" href="../../styles/grupos.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../../js/apiGateway.js?v=3"></script>
    <style>
        .show { display: block !important; }
        #dropdown-perfil a:hover { background: #f1f5f9; }
    </style>
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
                    <li><a href="#" onclick="cargarModulo('Carreras')"><i class='bx bxs-graduation'></i> Gestionar Carreras</a></li>
                    <li><a href="#" onclick="cargarModulo('Grupos')"><i class='bx bx-calendar-event'></i> Grupos y Horarios</a></li>
                    <li><a href="#" onclick="cargarModulo('AgregarMateria')"><i class='bx bxs-book-add'></i> Agregar Materia</a></li>
                    <li><a href="#" onclick="cargarModulo('AsignarMateria')"><i class='bx bxs-user-check'></i> Asignar a Materia</a></li>
                </ul>

                <p class="menu-label">Gestión de Usuarios</p>
                <ul>
                    <li><a href="#" onclick="cargarModulo('AspirantesAdmin')"><i class='bx bxs-user-plus'></i> Gestión de Aspirantes</a></li>
                    <li><a href="#" onclick="cargarModulo('AlumnosAdmin')"><i class='bx bxs-user-detail'></i> Gestión de Alumnos</a></li>
                    <li><a href="#" onclick="cargarModulo('Carga')"><i class='bx bxs-user-rectangle'></i> Gestión de Docentes</a></li>
                    <li><a href="#" onclick="cargarModulo('FinanzasAdmin')"><i class='bx bxs-bank'></i> Gestión de Finanzas</a></li>
                </ul>
                                    
                <p class="menu-label">Sesión</p>
                <ul>
                    <li><a href="#" onclick="cerrarSesion()"><i class='bx bx-log-out'></i> Cerrar Sesión</a></li>
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
                    <div class="user-profile" style="position:relative; cursor:pointer;" onclick="document.getElementById('dropdown-perfil').classList.toggle('show')">
                        <img src="https://ui-avatars.com/api/?name=Admin+TICs&background=6366f1&color=fff&rounded=true" alt="Perfil" id="admin-avatar">
                        <div class="user-info">
                            <span class="user-name" id="admin-name">Administrador</span>
                            <span class="user-role" id="admin-role">Control Total</span>
                        </div>
                        <i class='bx bx-chevron-down profile-dropdown-icon'></i>
                        
                        <!-- Dropdown flotante -->
                        <div id="dropdown-perfil" style="display:none; position:absolute; top:50px; right:0; background:white; border-radius:8px; box-shadow:0 4px 15px rgba(0,0,0,0.1); width:200px; padding:10px; z-index:100;">
                            <a href="#" onclick="abrirModalAdminCredenciales()" style="display:flex; align-items:center; gap:10px; padding:10px; color:#1e293b; text-decoration:none; border-radius:5px;"><i class='bx bx-key'></i> Cambiar Credenciales</a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Modal Editar Credenciales Admin -->
            <div id="modal-admin-credenciales" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(15, 23, 42, 0.7); z-index:9999; justify-content:center; align-items:center; backdrop-filter: blur(5px);">
                <div class="modal-content" style="background:#ffffff; padding:40px; border-radius:24px; width:420px; max-width:90%; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);">
                    <div style="text-align: center; margin-bottom: 30px;">
                        <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px auto; box-shadow: 0 8px 16px rgba(99, 102, 241, 0.2);">
                            <i class='bx bx-shield-quarter' style="font-size: 36px; color: #4f46e5;"></i>
                        </div>
                        <h3 style="margin:0; color:#0f172a; font-size: 1.6rem; font-weight: 800;">Seguridad de Cuenta</h3>
                        <p style="color:#64748b; font-size:0.95rem; margin-top:8px;">Actualiza tus credenciales de administrador.</p>
                    </div>
                    
                    <div style="margin-bottom:20px;">
                        <label style="display:block; font-size:0.85rem; font-weight:700; color:#475569; margin-bottom:8px; letter-spacing: 0.5px;">USUARIO (LOGIN)</label>
                        <div style="position: relative;">
                            <i class='bx bx-user' style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 1.2rem;"></i>
                            <input type="text" id="admin-edit-user" placeholder="Escribe el nuevo usuario..." style="width:100%; padding:14px 15px 14px 45px; border:2px solid #e2e8f0; border-radius:12px; font-size: 1rem; color: #1e293b; transition: all 0.3s; outline: none; box-sizing: border-box;">
                        </div>
                    </div>
                    
                    <div style="margin-bottom:30px;">
                        <label style="display:block; font-size:0.85rem; font-weight:700; color:#475569; margin-bottom:8px; letter-spacing: 0.5px;">NUEVA CONTRASEÑA</label>
                        <div style="position: relative;">
                            <i class='bx bx-lock-alt' style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 1.2rem;"></i>
                            <input type="password" id="admin-edit-pass" placeholder="Dejar en blanco para no cambiarla" style="width:100%; padding:14px 15px 14px 45px; border:2px solid #e2e8f0; border-radius:12px; font-size: 1rem; color: #1e293b; transition: all 0.3s; outline: none; box-sizing: border-box;">
                        </div>
                    </div>
                    
                    <div style="display:flex; justify-content:space-between; gap:15px;">
                        <button onclick="document.getElementById('modal-admin-credenciales').style.display='none'" style="flex: 1; padding:12px; border-radius:12px; border:2px solid #e2e8f0; background:white; color: #64748b; font-weight: 700; cursor:pointer; transition: all 0.2s;">Cancelar</button>
                        <button onclick="guardarAdminCredenciales(event)" style="flex: 1; padding:12px; border-radius:12px; background:linear-gradient(135deg, #4f46e5 0%, #4338ca 100%); color:white; font-weight: 700; border:none; cursor:pointer; box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); transition: all 0.2s;">Guardar Cambios</button>
                    </div>
                </div>
            </div>

            <section id="vista-dinamica" class="content-body"></section>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const storedPerfil = localStorage.getItem('user_data');
            if (storedPerfil) {
                const data = JSON.parse(storedPerfil);
                const nombreAMostrar = data.username || data.nombre || 'Administrador';
                document.getElementById('admin-name').textContent = 'Bienvenido ' + nombreAMostrar;
                document.getElementById('admin-role').textContent = data.cargo || 'Control Total';
                document.getElementById('admin-avatar').src = `https://ui-avatars.com/api/?name=${encodeURIComponent(nombreAMostrar)}&background=6366f1&color=fff&rounded=true`;
            }
        });

        // Cerrar dropdown al hacer clic fuera
        window.onclick = function(event) {
            if (!event.target.closest('.user-profile')) {
                const dropdowns = document.getElementsByClassName("show");
                for (let i = 0; i < dropdowns.length; i++) {
                    dropdowns[i].classList.remove('show');
                }
            }
        }

        function abrirModalAdminCredenciales() {
            document.getElementById('dropdown-perfil').classList.remove('show');
            const storedPerfil = localStorage.getItem('user_data');
            if (storedPerfil) {
                const data = JSON.parse(storedPerfil);
                document.getElementById('admin-edit-user').value = data.username || '';
            }
            document.getElementById('admin-edit-pass').value = '';
            document.getElementById('modal-admin-credenciales').style.display = 'flex';
        }

        async function guardarAdminCredenciales() {
            const btn = event.target;
            const textOriginal = btn.textContent;
            btn.textContent = 'Guardando...';
            btn.disabled = true;

            const newUsername = document.getElementById('admin-edit-user').value.trim();
            const newPassword = document.getElementById('admin-edit-pass').value.trim();
            
            const storedPerfil = localStorage.getItem('user_data');
            if (!storedPerfil) return alert('No hay sesión activa');
            
            const data = JSON.parse(storedPerfil);
            
            try {
                const targetId = data._id || data.id;
                // Actualizar credenciales en la API
                if(window.API && window.API.Directivos) {
                    await window.API.Directivos.actualizarCredenciales(targetId, newUsername, newPassword);
                } else {
                    await fetch(`http://localhost:3000/api/directivos/${targetId}/credenciales`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': `Bearer ${localStorage.getItem('token')}`
                        },
                        body: JSON.stringify({ username: newUsername, password: newPassword })
                    });
                }
                
                // Actualizar localStorage
                data.username = newUsername;
                localStorage.setItem('user_data', JSON.stringify(data));
                
                alert('Credenciales actualizadas correctamente. Los cambios se aplicarán en el próximo inicio de sesión.');
                document.getElementById('modal-admin-credenciales').style.display = 'none';
            } catch (err) {
                alert('Error al actualizar: ' + err.message);
            } finally {
                btn.textContent = textOriginal;
                btn.disabled = false;
            }
        }

        function cerrarSesion() {
            if(window.API && window.API.Auth) {
                window.API.Auth.logout();
            } else {
                localStorage.removeItem('token');
                localStorage.removeItem('user_role');
                localStorage.removeItem('user_data');
            }
            window.location.href = '../login/personal.php';
        }

        function cargarModulo(nombre) {
            const contenedor = document.getElementById('vista-dinamica');
            
            // Guardar el módulo actual para persistencia al recargar
            localStorage.setItem('moduloActual_Admin', nombre);
            
            // Ruta relativa al archivo actual (funciona en LAMPP y Docker)
            const nombreArchivo = nombre.charAt(0).toLowerCase() + nombre.slice(1);
            const ruta = `${nombreArchivo}.php`;

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

                    // Remover script dinámico anterior si existe
                    const scriptExistente = document.getElementById('script-modulo');
                    if (scriptExistente) scriptExistente.remove();

                    // Cargar el script correspondiente al módulo de forma dinámica
                    const nuevoScript = document.createElement('script');
                    nuevoScript.id = 'script-modulo';
                    // Ruta relativa al archivo actual
                    nuevoScript.src = `js/${nombreArchivo}.js?v=${new Date().getTime()}`;
                    nuevoScript.onerror = () => {
                        console.log(`Módulo ${nombre} cargado sin archivo JS específico.`);
                        nuevoScript.remove();
                    };
                    document.body.appendChild(nuevoScript);
                })
                .catch(err => {
                    contenedor.innerHTML = `
                        <div style="padding:20px; color: #64748b;">
                            <h3>Error de Carga</h3>
                            <p>No se encontró "${nombreArchivo}.php" en frontend/src/modules/Admin/</p>
                            <small>Ruta intentada: ${ruta}</small>
                        </div>`;
                });
        }

        // Cargar el inicio o el último módulo visitado de forma robusta
        const moduloGuardado = localStorage.getItem('moduloActual_Admin') || 'Inicio';
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => {
                cargarModulo(moduloGuardado); 
            });
        } else {
            cargarModulo(moduloGuardado);
        }
    </script>
</body>
</html>