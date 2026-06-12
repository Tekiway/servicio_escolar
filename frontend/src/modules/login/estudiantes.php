<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Estudiantes - Sistema Control Escolar</title>
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
            <span><strong>Prueba:</strong> Usa credenciales reales de alumno (usuario o email + contrasena)</span>
        </div>

        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">
                    <i class="bx bxs-graduation"></i>
                </div>
                <h2>Portal Estudiantes</h2>
                <p>Alumnos inscritos y Aspirantes de nuevo ingreso</p>
            </div>

            <form id="form-login-estudiantes" onsubmit="validarEstudiante(event)">


                <div class="form-group">
                    <label>Matrícula o Ficha</label>
                    <div class="input-wrapper">
                        <input type="text" id="usuario" placeholder="Ej. prueba" required autocomplete="off">
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
                <a href="personal.php" style="color: var(--primary); font-size: 0.95rem;"><i class="bx bxs-institution"></i> Acceso Personal (Directivos, RRHH, Docentes)</a>
            </div>
        </div>
    </div>

    <!-- Módulo central de comunicación con el API Gateway -->
    <script src="../../js/apiGateway.js"></script>
    <script>
        async function validarEstudiante(event) {
            event.preventDefault();
            const usuarioVal = document.getElementById('usuario').value.trim().toLowerCase();
            const passwordVal = document.getElementById('password').value;
            const alertBox = document.getElementById('alert-message');
            const alertText = document.getElementById('alert-text');
            const infoBox = document.getElementById('info-message');

            infoBox.style.display = 'none';

            try {
                // Conectar al API Gateway
                const response = await fetch(`${API.BASE_URL}/alumnos/login`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email: usuarioVal, username: usuarioVal, password: passwordVal })
                });

                const data = await response.json();

                if (response.ok && data.token) {
                    localStorage.setItem('user_role', 'alumno');
                    localStorage.setItem('token', data.token);
                    if (data.alumno) localStorage.setItem('user_data', JSON.stringify(data.alumno));
                    window.location.href = '../alumnos/alumnos.php';
                } else {
                    throw new Error(data.error || data.message || 'Credenciales incorrectas');
                }
            } catch (error) {
                if(error instanceof TypeError) {
                    alertText.textContent = "Error de conexión con el servidor. El API Gateway está apagado.";
                } else {
                    alertText.textContent = error.message || "Usuario o contraseña incorrectos.";
                }
                alertBox.style.display = 'flex';
                
                alertBox.style.animation = 'none';
                void alertBox.offsetWidth; 
                alertBox.style.animation = 'shake 0.4s ease-in-out';
            }
        }
    </script>
</body>
</html>
