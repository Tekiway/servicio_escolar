<div class="animate__animated animate__fadeIn">
    <div class="module-header" style="margin-bottom: 30px;">
        <h2 style="color: var(--text-primary); font-size: 1.8rem; font-weight: 800;">
            <i class='bx bxs-chalkboard' style="color: var(--docente-primary);"></i> Mis Clases Asignadas
        </h2>
        <p style="color: var(--text-secondary);">Ciclo Escolar: 2024-2025 | Periodo: Otoño</p>
    </div>

    <style>
        .classes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
        }
        .class-card {
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            border: 1px solid rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        .class-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(99, 102, 241, 0.1);
        }
        .class-header {
            padding: 25px;
            background: linear-gradient(135deg, var(--docente-primary) 0%, var(--docente-accent) 100%);
            color: white;
        }
        .class-header h3 {
            margin: 0;
            font-size: 1.3rem;
            font-weight: 700;
        }
        .class-header span {
            font-size: 0.85rem;
            opacity: 0.9;
        }
        .class-body {
            padding: 25px;
        }
        .class-info {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 15px;
            color: var(--text-secondary);
        }
        .class-info i {
            font-size: 1.2rem;
            color: var(--docente-primary);
        }
        .class-footer {
            padding: 20px 25px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
        }
        .btn-view {
            padding: 10px 20px;
            border-radius: 12px;
            background: #f8fafc;
            color: var(--docente-primary);
            font-weight: 700;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .btn-view:hover {
            background: var(--docente-primary);
            color: white;
        }
    </style>

    <div class="classes-grid">
        <!-- Clase 1 -->
        <div class="class-card">
            <div class="class-header">
                <h3>Matemáticas Avanzadas I</h3>
                <span>ID: MAT-101 | Semestre: 4°</span>
            </div>
            <div class="class-body">
                <div class="class-info">
                    <i class='bx bxs-user-account'></i>
                    <span>Grupo: <strong>402-A</strong></span>
                </div>
                <div class="class-info">
                    <i class='bx bxs-time'></i>
                    <span>Lunes, Miércoles | 08:00 - 10:00</span>
                </div>
                <div class="class-info">
                    <i class='bx bxs-map'></i>
                    <span>Edificio B - Salón 105</span>
                </div>
            </div>
            <div class="class-footer">
                <span style="color: var(--text-secondary); font-size: 0.9rem;">32 Alumnos</span>
                <a href="#" class="btn-view">Gestionar</a>
            </div>
        </div>

        <!-- Clase 2 -->
        <div class="class-card">
            <div class="class-header" style="background: linear-gradient(135deg, var(--docente-secondary) 0%, #d8b4fe 100%);">
                <h3>Cálculo Diferencial</h3>
                <span>ID: CAL-202 | Semestre: 2°</span>
            </div>
            <div class="class-body">
                <div class="class-info">
                    <i class='bx bxs-user-account'></i>
                    <span>Grupo: <strong>201-B</strong></span>
                </div>
                <div class="class-info">
                    <i class='bx bxs-time'></i>
                    <span>Martes, Jueves | 10:30 - 12:30</span>
                </div>
                <div class="class-info">
                    <i class='bx bxs-map'></i>
                    <span>Edificio A - Salón 202</span>
                </div>
            </div>
            <div class="class-footer">
                <span style="color: var(--text-secondary); font-size: 0.9rem;">28 Alumnos</span>
                <a href="#" class="btn-view">Gestionar</a>
            </div>
        </div>

        <!-- Clase 3 -->
        <div class="class-card">
            <div class="class-header" style="background: linear-gradient(135deg, var(--docente-accent) 0%, #7dd3fc 100%);">
                <h3>Álgebra Lineal</h3>
                <span>ID: ALG-303 | Semestre: 1°</span>
            </div>
            <div class="class-body">
                <div class="class-info">
                    <i class='bx bxs-user-account'></i>
                    <span>Grupo: <strong>105-C</strong></span>
                </div>
                <div class="class-info">
                    <i class='bx bxs-time'></i>
                    <span>Viernes | 07:00 - 11:00</span>
                </div>
                <div class="class-info">
                    <i class='bx bxs-map'></i>
                    <span>Edificio C - Auditorio</span>
                </div>
            </div>
            <div class="class-footer">
                <span style="color: var(--text-secondary); font-size: 0.9rem;">45 Alumnos</span>
                <a href="#" class="btn-view">Gestionar</a>
            </div>
        </div>
    </div>
</div>
