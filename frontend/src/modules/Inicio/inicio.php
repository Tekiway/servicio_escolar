<link rel="stylesheet" href="./src/styles/Dashboard.css">
<link rel="stylesheet" href="./src/styles/Inicio.css">

<div class="inicio-container">
    <div class="welcome-banner">
        <div class="welcome-text">
            <h1>¡Hola de nuevo, Heber! 👋</h1>
            <p>Es un buen día para revisar tus pendientes académicos de TICs.</p>
        </div>
        <div class="welcome-stats">
            <div class="stat-item">
                <span class="stat-value">9.5</span>
                <span class="stat-label">Promedio General</span>
            </div>
        </div>
    </div>

    <div class="quick-cards">
        <div class="card clickable" onclick="cargarModulo('Horarios')">
            <div class="card-icon blue"><i class='bx bxs-calendar'></i></div>
            <h3>Horario</h3>
            <p>Próxima clase: 09:00 AM</p>
        </div>

        <div class="card clickable" onclick="cargarModulo('Evaluaciones')">
            <div class="card-icon purple"><i class='bx bxs-graduation'></i></div>
            <h3>Calificaciones</h3>
            <p>2 nuevas notas subidas</p>
        </div>

        <div class="card clickable" onclick="cargarModulo('Boletos')">
            <div class="card-icon green"><i class='bx bxs-wallet'></i></div>
            <h3>Pagos</h3>
            <p>Sin adeudos pendientes</p>
        </div>
    </div>

    <div class="news-section">
        <h3>Avisos Recientes</h3>
        <div class="news-item">
            <span class="news-date">24 Abr</span>
            <p>Inscripciones abiertas para el concurso de Programación 2026.</p>
        </div>
        <div class="news-item">
            <span class="news-date">20 Abr</span>
            <p>Mantenimiento programado de la plataformas.</p>
        </div>
    </div>
</div>