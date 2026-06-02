<div class="animate__animated animate__fadeIn" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Banner de Bienvenida -->
    <div class="welcome-banner" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: #ffffff; padding: 30px; border-radius: 16px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 10px 25px rgba(99, 102, 241, 0.15); position: relative; overflow: hidden;">
        <div style="z-index: 2;">
            <h1 style="font-size: 2rem; font-weight: 800; margin: 0 0 10px 0;">¡Hola, <span id="dash-student-name">Heber Castañeda</span>! 👋</h1>
            <p style="margin: 0; font-size: 1rem; opacity: 0.9;">Bienvenido a tu portal de control escolar. Tienes todas tus actividades al corriente para este periodo.</p>
            <div style="margin-top: 15px; background: rgba(255,255,255,0.15); display: inline-block; padding: 6px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 700; border: 1px solid rgba(255,255,255,0.25);">
                <i class='bx bxs-check-shield' style="vertical-align: middle; margin-right: 4px;"></i> Alumno Regular - Inscrito
            </div>
        </div>
        <div style="font-size: 6rem; opacity: 0.15; z-index: 1; transform: rotate(15deg); font-family: sans-serif;">🏫</div>
    </div>

    <!-- Malla de Estadísticas Académicas -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px;">
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); border-left: 5px solid var(--primary); padding: 20px; border-radius: 12px; display: flex; align-items: center; gap: 15px; backdrop-filter: blur(10px);">
            <div style="background: rgba(99,102,241,0.1); color: var(--primary); padding: 12px; border-radius: 10px; font-size: 1.8rem;"><i class='bx bx-book-open'></i></div>
            <div>
                <span style="font-size: 0.8rem; color: #64748b; font-weight: 700; display: block; text-transform: uppercase;">Materias Activas</span>
                <span style="font-size: 1.6rem; font-weight: 800; color: #1e293b;" id="dash-stat-materias">6 Materias</span>
            </div>
        </div>

        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); border-left: 5px solid var(--secondary); padding: 20px; border-radius: 12px; display: flex; align-items: center; gap: 15px; backdrop-filter: blur(10px);">
            <div style="background: rgba(168,85,247,0.1); color: var(--secondary); padding: 12px; border-radius: 10px; font-size: 1.8rem;"><i class='bx bx-star'></i></div>
            <div>
                <span style="font-size: 0.8rem; color: #64748b; font-weight: 700; display: block; text-transform: uppercase;">Promedio General</span>
                <span style="font-size: 1.6rem; font-weight: 800; color: #1e293b;" id="dash-stat-promedio">9.46 / 10</span>
            </div>
        </div>

        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); border-left: 5px solid var(--accent); padding: 20px; border-radius: 12px; display: flex; align-items: center; gap: 15px; backdrop-filter: blur(10px);">
            <div style="background: rgba(14,165,233,0.1); color: var(--accent); padding: 12px; border-radius: 10px; font-size: 1.8rem;"><i class='bx bx-award'></i></div>
            <div>
                <span style="font-size: 0.8rem; color: #64748b; font-weight: 700; display: block; text-transform: uppercase;">Créditos Cursados</span>
                <span style="font-size: 1.6rem; font-weight: 800; color: #1e293b;">48 Créditos</span>
            </div>
        </div>
    </div>

    <!-- Sección de Avisos y Agenda -->
    <div style="display: grid; grid-template-columns: 2fr 1.2fr; gap: 25px;">
        <!-- Avisos Importantes -->
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 25px; border-radius: 16px; backdrop-filter: blur(10px);">
            <h3 style="margin: 0 0 20px 0; color: #1e293b; display: flex; align-items: center; gap: 8px; font-weight: 800;">
                <i class='bx bxs-megaphone' style="color: var(--primary);"></i> Anuncios Oficiales del Plantel
            </h3>
            
            <div style="display: flex; flex-direction: column; gap: 15px;">
                <!-- Aviso 1 -->
                <div style="background: rgba(255,255,255,0.4); border: 1px solid rgba(226, 232, 240, 0.8); padding: 15px; border-radius: 12px; display: flex; gap: 15px; transition: transform 0.2s;" onmouseenter="this.style.transform='translateX(4px)'" onmouseleave="this.style.transform='translateX(0)'">
                    <div style="background: rgba(99,102,241,0.1); color: var(--primary); padding: 10px; border-radius: 8px; font-size: 1.5rem; display: flex; align-items: center;"><i class='bx bxs-calendar'></i></div>
                    <div>
                        <h4 style="margin: 0 0 5px 0; color: #1e293b; font-weight: 700;">Evaluaciones del Segundo Parcial</h4>
                        <p style="margin: 0; font-size: 0.85rem; color: #64748b;">El periodo de captura de calificaciones del segundo parcial estará abierto del 20 al 25 de Mayo de 2026. Favor de revisar su portal.</p>
                        <span style="font-size: 0.75rem; color: #94a3b8; display: block; margin-top: 5px;">Publicado: 15 de Mayo, 2026</span>
                    </div>
                </div>

                <!-- Aviso 2 -->
                <div style="background: rgba(255,255,255,0.4); border: 1px solid rgba(226, 232, 240, 0.8); padding: 15px; border-radius: 12px; display: flex; gap: 15px; transition: transform 0.2s;" onmouseenter="this.style.transform='translateX(4px)'" onmouseleave="this.style.transform='translateX(0)'">
                    <div style="background: rgba(14,165,233,0.1); color: var(--accent); padding: 10px; border-radius: 8px; font-size: 1.5rem; display: flex; align-items: center;"><i class='bx bxs-shield-plus'></i></div>
                    <div>
                        <h4 style="margin: 0 0 5px 0; color: #1e293b; font-weight: 700;">Campaña de Vacunación Anual</h4>
                        <p style="margin: 0; font-size: 0.85rem; color: #64748b;">Se invita a la comunidad estudiantil a participar en la jornada de salud en la explanada de Rectoría de 09:00 a 14:00 hrs.</p>
                        <span style="font-size: 0.75rem; color: #94a3b8; display: block; margin-top: 5px;">Publicado: 12 de Mayo, 2026</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estado de Cobros Rápidos -->
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 25px; border-radius: 16px; backdrop-filter: blur(10px); display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <h3 style="margin: 0 0 15px 0; color: #1e293b; display: flex; align-items: center; gap: 8px; font-weight: 800;">
                    <i class='bx bxs-credit-card' style="color: var(--secondary);"></i> Colegiatura Activa
                </h3>
                <p style="font-size: 0.85rem; color: #64748b; margin: 0 0 20px 0;">Estado de pago mensual de tus servicios educativos.</p>
                
                <div style="background: rgba(255,255,255,0.5); padding: 15px; border-radius: 12px; text-align: center; border: 1px solid rgba(226, 232, 240, 0.8); margin-bottom: 20px;">
                    <span style="font-size: 0.8rem; color: #64748b; font-weight: 700; display: block;">Periodo Mayo 2026</span>
                    <span style="font-size: 1.8rem; font-weight: 800; color: #059669; display: block; margin: 5px 0;">$3,500.00</span>
                    <span class="badge success" style="display: inline-block; padding: 4px 10px; background: rgba(5,150,105,0.1); color: #059669; border-radius: 20px; font-size: 0.75rem; font-weight: 700;"><i class='bx bxs-check-circle'></i> LIQUIDADO</span>
                </div>
            </div>
            
            <button class="btn-finance-action" style="width: 100%; justify-content: center; background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white;" onclick="cargarModulo('Pago')">
                <i class='bx bxs-credit-card'></i> Gestionar Pago en Línea
            </button>
        </div>
    </div>
</div>

<script>
    (function() {
        // Inicializar datos del estudiante
        let dbPerfil = localStorage.getItem('alumno_perfil');
        if (!dbPerfil) {
            dbPerfil = JSON.stringify({
                nombre: 'Heber Castañeda Flores',
                matricula: '2026001',
                email: 'heber.flores@control.edu.mx',
                username: 'heber.castaneda',
                carrera: 'Ingeniería en Tecnologías de la Información'
            });
            localStorage.setItem('alumno_perfil', dbPerfil);
        }
        const data = JSON.parse(dbPerfil);
        
        // Poner nombre
        document.getElementById('dash-student-name').textContent = data.nombre.split(' ')[0] + ' ' + (data.nombre.split(' ')[1] || '');

        // Cargar materias guardadas para reportar contador real
        const dbMaterias = localStorage.getItem('alumno_materias');
        if (dbMaterias) {
            const list = JSON.parse(dbMaterias);
            document.getElementById('dash-stat-materias').textContent = list.length + ' Materias';
            
            // Promedio dinámico real
            let sumTotal = 0;
            let countUnits = 0;
            list.forEach(m => {
                m.unidades.forEach(u => {
                    sumTotal += parseFloat(u.calificacion);
                    countUnits++;
                });
            });
            if (countUnits > 0) {
                const prom = (sumTotal / countUnits).toFixed(2);
                document.getElementById('dash-stat-promedio').textContent = prom + ' / 10';
            }
        }
    })();
</script>
