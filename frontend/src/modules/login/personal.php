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

    <script>
        function validarPersonal(event) {
            event.preventDefault();
            const usuarioVal = document.getElementById('usuario').value.trim().toLowerCase();
            const alertBox = document.getElementById('alert-message');
            const alertText = document.getElementById('alert-text');
            const infoBox = document.getElementById('info-message');

            infoBox.style.display = 'none';

            // Validaciones mock inteligentes y fallback de redirección
            if (usuarioVal === 'admin') {
                // Redirigir a Panel de Administrador en frontend/index.php
                window.location.href = '../../../index.php';
            } else if (usuarioVal === 'docente') {
                // Redirigir a Portal Docente
                window.location.href = '../Docente/docente.php';
            } else {
                // Mostrar alerta animada de error
                alertText.textContent = "Usuario de prueba no válido. Usa 'admin' o 'docente'.";
                alertBox.style.display = 'flex';
                
                // Reiniciar animación shake si se vuelve a fallar
                alertBox.style.animation = 'none';
                void alertBox.offsetWidth; // Trigger reflow
                alertBox.style.animation = 'shake 0.4s ease-in-out';
            }
        }
    </script>
</body>
</html>
