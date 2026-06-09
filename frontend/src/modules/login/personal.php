<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Personal - Sistema Control Escolar</title>
    <!-- Boxicons para Iconos -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <!-- Google Fonts Outfit -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;800&display=swap" rel="stylesheet">
    <!-- Estilos de Login Premium -->
    <link rel="stylesheet" href="../../styles/login.css">
</head>
<body>

    <div class="login-container">
        
        <div class="alert-box" id="alert-message">
            <i class="bx bx-error-circle"></i>
            <span id="alert-text">Credenciales incorrectas</span>
        </div>

        <div class="alert-box info" id="info-message" style="display: flex;">
            <i class="bx bx-info-circle"></i>
            <span><strong>Prueba:</strong> Usa 'admin' o 'docente'</span>
        </div>

        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">
                    <i class="bx bxs-institution"></i>
                </div>
                <h2>Acceso Personal</h2>
                <p>Ingresa al área administrativa o docente</p>
            </div>

            <form id="form-login-personal" onsubmit="validarPersonal(event)">
                <div class="form-group">
                    <label>Usuario o RFC</label>
                    <div class="input-wrapper">
                        <input type="text" id="usuario" placeholder="Ej. admin o docente" required autocomplete="off">
                        <i class="bx bx-user"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label>Contraseña</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" placeholder="••••••••" required>
                        <i class="bx bx-lock-alt"></i>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    Ingresar al Portal
                    <i class="bx bx-right-arrow-alt"></i>
                </button>
            </form>

            <div class="login-footer" style="display: flex; flex-direction: column; gap: 10px; align-items: center;">
                <a href="../alumnos/alumnos.php"><i class="bx bxs-graduation"></i> Portal de Estudiantes</a>
                <a href="../Aspirantes/aspirantes.php" style="color: #a855f7;"><i class="bx bxs-user-plus"></i> Portal de Aspirantes</a>
            </div>
        </div>
    </div>

    <!-- Módulo central de comunicación con el API Gateway -->
    <script src="../../js/apiGateway.js"></script>
    <script>
        const GATEWAY = 'http://localhost:3000/api';

        async function validarPersonal(event) {
            event.preventDefault();

            const usuario   = document.getElementById('usuario').value.trim();
            const password  = document.getElementById('password').value.trim();
            const alertBox  = document.getElementById('alert-message');
            const alertText = document.getElementById('alert-text');
            const infoBox   = document.getElementById('info-message');
            const btnSubmit = document.querySelector('.btn-submit');

            infoBox.style.display  = 'none';
            alertBox.style.display = 'none';
            btnSubmit.disabled     = true;
            btnSubmit.innerHTML    = "<i class='bx bx-loader-alt bx-spin'></i> Autenticando...";

            const mostrarError = (msg) => {
                alertText.textContent  = msg;
                alertBox.style.display = 'flex';
                alertBox.style.animation = 'none';
                void alertBox.offsetWidth;
                alertBox.style.animation = 'shake 0.4s ease-in-out';
                btnSubmit.disabled  = false;
                btnSubmit.innerHTML = "Ingresar al Portal <i class='bx bx-right-arrow-alt'></i>";
            };

            // 1. Intentar login mock centralizado (admin / directivo)
            try {
                const res = await fetch(`${GATEWAY}/auth/login`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ usuario, password, portal: 'personal' })
                });
                const data = await res.json();

                if (res.ok && data.status === 'success') {
                    localStorage.setItem('user_role', data.data.role);
                    window.location.href = data.data.redirectUrl;
                    return;
                }
            } catch (_) { /* Gateway sin respuesta, intentar directivo */ }

            // 2. Intentar login como directivo real
            try {
                const res = await fetch(`${GATEWAY}/directivos/login`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ username: usuario, email: usuario, password })
                });
                const data = await res.json();

                if (res.ok && data.token) {
                    localStorage.setItem('token',     data.token);
                    localStorage.setItem('user_role', 'directivo');
                    localStorage.setItem('user_data', JSON.stringify({ nombre: data.nombre, rol: 'directivo' }));
                    window.location.href = '../../../../index.php';
                    return;
                }
            } catch (_) { /* continuar */ }

            // 3. Intentar login como docente real
            try {
                const res = await fetch(`${GATEWAY}/docentes/login`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ username: usuario, email: usuario, password })
                });
                const data = await res.json();

                if (res.ok && data.token) {
                    localStorage.setItem('token',     data.token);
                    localStorage.setItem('user_role', 'docente');
                    localStorage.setItem('user_data', JSON.stringify(data.docente || {}));
                    window.location.href = '../Docente/docente.php';
                    return;
                }
            } catch (_) { /* continuar */ }

            mostrarError('Credenciales incorrectas. Verifica tu usuario y contraseña.');
        }
    </script>
</body>
</html>
