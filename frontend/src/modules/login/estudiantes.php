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
    <style>
        .login-card {
            border-top: 5px solid #0ea5e9;
        }
        .login-logo i {
            color: #0ea5e9;
        }
        .btn-submit {
            background: linear-gradient(135deg, #0ea5e9, #6366f1);
        }
        .btn-submit:hover {
            box-shadow: 0 4px 15px rgba(14, 165, 233, 0.4);
        }
    </style>
</head>
<body>

    <div class="login-container">
        
        <div class="alert-box" id="alert-message">
            <i class="bx bx-error-circle"></i>
            <span id="alert-text">Credenciales incorrectas</span>
        </div>

        <div class="alert-box info" id="info-message" style="display: flex;">
            <i class="bx bx-info-circle"></i>
            <span><strong>Prueba:</strong> Usa 'prueba_alumno' o 'prueba_aspirante'</span>
        </div>

        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">
                    <i class="bx bxs-graduation"></i>
                </div>
                <h2>Portal Estudiantes</h2>
                <p>Ingresa al área de alumnos y aspirantes</p>
            </div>

            <form id="form-login-estudiantes" onsubmit="validarEstudiante(event)">
                <div class="form-group">
                    <label>Matrícula o Ficha</label>
                    <div class="input-wrapper">
                        <input type="text" id="usuario" placeholder="Ej. alumno o aspirante" required autocomplete="off">
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
                <a href="personal.php" style="color: #a855f7;"><i class="bx bxs-institution"></i> Acceso Personal</a>
            </div>
        </div>
    </div>

    <script>
        async function validarEstudiante(event) {
            event.preventDefault();
            const usuarioVal = document.getElementById('usuario').value.trim().toLowerCase();
            const passwordVal = document.getElementById('password').value;
            const alertBox = document.getElementById('alert-message');
            const alertText = document.getElementById('alert-text');
            const infoBox = document.getElementById('info-message');

            infoBox.style.display = 'none';

            // VALIDACIÓN DIRECTA PARA ASEGURAR QUE FUNCIONE
            if (usuarioVal === 'prueba' && passwordVal === 'prueba1') {
                window.location.href = '../alumnos/alumnos.php'; // Redirigir a Alumnos por defecto
                return;
            }

            try {
                // Conectar al API Gateway
                const response = await fetch('http://localhost:3000/api/auth/login', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ usuario: usuarioVal, password: passwordVal, portal: 'estudiante' })
                });

                const data = await response.json();

                if (response.ok && data.status === 'success') {
                    window.location.href = data.data.redirectUrl;
                } else {
                    throw new Error(data.message || 'Credenciales incorrectas');
                }
            } catch (error) {
                alertText.textContent = "Usuario o contraseña incorrectos. Usa 'prueba' y 'prueba1'.";
                alertBox.style.display = 'flex';
                
                alertBox.style.animation = 'none';
                void alertBox.offsetWidth; 
                alertBox.style.animation = 'shake 0.4s ease-in-out';
            }
        }
    </script>
</body>
</html>
