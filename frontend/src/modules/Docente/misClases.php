<div class="animate__animated animate__fadeIn">
    <div class="module-header" style="margin-bottom: 30px;">
        <h2 style="color: var(--text-primary); font-size: 1.8rem; font-weight: 800;">
            <i class='bx bxs-chalkboard' style="color: var(--docente-primary);"></i> Mis Clases Asignadas
        </h2>
        <p style="color: var(--text-secondary);">Ciclo Escolar: - | Periodo: -</p>
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
        <!-- JS: Inyectar tarjetas de clases aquí -->
    </div>
</div>
