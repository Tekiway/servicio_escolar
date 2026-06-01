<div class="animate__animated animate__fadeIn" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Banner de Admisión -->
    <div class="welcome-banner" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: #ffffff; padding: 30px; border-radius: 16px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 10px 25px rgba(168, 85, 247, 0.15); position: relative; overflow: hidden;">
        <div style="z-index: 2;">
            <h1 style="font-size: 2rem; font-weight: 800; margin: 0 0 10px 0;">¡Proceso de Admisión 2026! 🚀</h1>
            <p style="margin: 0; font-size: 1rem; opacity: 0.9;">Monitorea tus trámites de nuevo ingreso. Completa tu ficha para obtener tu fecha de examen.</p>
            <div style="margin-top: 15px; background: rgba(255,255,255,0.15); display: inline-block; padding: 6px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 700; border: 1px solid rgba(255,255,255,0.25);">
                <i class='bx bxs-calendar-check' style="vertical-align: middle; margin-right: 4px;"></i> Examen de Admisión: 25 de Junio, 2026
            </div>
        </div>
        <div style="font-size: 6rem; opacity: 0.15; z-index: 1; transform: rotate(15deg); font-family: sans-serif;">🎯</div>
    </div>

    <!-- Stepper Visual de Admisión -->
    <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 25px; border-radius: 16px; backdrop-filter: blur(10px); box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
        <h3 style="margin: 0 0 25px 0; color: #1e293b; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i class='bx bxs-navigation' style="color: var(--primary);"></i> Progreso de tu Proceso de Ingreso
        </h3>
        
        <div style="display: flex; justify-content: space-between; align-items: center; position: relative; padding: 10px 0;">
            <!-- Línea de fondo del stepper -->
            <div style="position: absolute; top: 38px; left: 5%; width: 90%; height: 4px; background: #e2e8f0; z-index: 1;"></div>
            <!-- Línea de progreso activa -->
            <div id="step-progress-line" style="position: absolute; top: 38px; left: 5%; width: 33%; height: 4px; background: linear-gradient(135deg, var(--primary), var(--secondary)); z-index: 2; transition: width 0.4s ease;"></div>

            <!-- Paso 1 -->
            <div style="z-index: 3; text-align: center; width: 20%;">
                <div style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; display: inline-flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 800; border: 4px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1);"><i class='bx bx-user'></i></div>
                <span style="display: block; font-size: 0.8rem; font-weight: 700; color: #1e293b; margin-top: 10px;">1. Registro</span>
                <span class="badge success" style="font-size: 0.7rem; padding: 2px 8px; border-radius: 10px; background: rgba(5,150,105,0.1); color: #059669; font-weight: 700;">Completo</span>
            </div>

            <!-- Paso 2 -->
            <div style="z-index: 3; text-align: center; width: 20%;">
                <div id="step-2-circle" style="width: 50px; height: 50px; border-radius: 50%; background: #e2e8f0; color: #64748b; display: inline-flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 800; border: 4px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.05); transition: background 0.4s;"><i class='bx bx-credit-card'></i></div>
                <span style="display: block; font-size: 0.8rem; font-weight: 700; color: #64748b; margin-top: 10px;" id="step-2-label">2. Ficha y Pago</span>
                <span class="badge" id="step-2-badge" style="font-size: 0.7rem; padding: 2px 8px; border-radius: 10px; background: #f1f5f9; color: #64748b; font-weight: 700;">Pendiente</span>
            </div>

            <!-- Paso 3 -->
            <div style="z-index: 3; text-align: center; width: 20%;">
                <div style="width: 50px; height: 50px; border-radius: 50%; background: #e2e8f0; color: #64748b; display: inline-flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 800; border: 4px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.05);"><i class='bx bx-edit'></i></div>
                <span style="display: block; font-size: 0.8rem; font-weight: 700; color: #64748b; margin-top: 10px;">3. Examen</span>
                <span class="badge" style="font-size: 0.7rem; padding: 2px 8px; border-radius: 10px; background: #f1f5f9; color: #64748b; font-weight: 700;">Bloqueado</span>
            </div>

            <!-- Paso 4 -->
            <div style="z-index: 3; text-align: center; width: 20%;">
                <div style="width: 50px; height: 50px; border-radius: 50%; background: #e2e8f0; color: #64748b; display: inline-flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 800; border: 4px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.05);"><i class='bx bx-trophy'></i></div>
                <span style="display: block; font-size: 0.8rem; font-weight: 700; color: #64748b; margin-top: 10px;">4. Resultados</span>
                <span class="badge" style="font-size: 0.7rem; padding: 2px 8px; border-radius: 10px; background: #f1f5f9; color: #64748b; font-weight: 700;">Bloqueado</span>
            </div>
        </div>
    </div>

    <!-- Guía Informativa -->
    <div style="display: grid; grid-template-columns: 2fr 1.2fr; gap: 25px;">
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 25px; border-radius: 16px; backdrop-filter: blur(10px);">
            <h3 style="margin: 0 0 15px 0; color: #1e293b; font-weight: 800;"><i class='bx bx-info-circle' style="color: var(--primary);"></i> Siguientes Pasos Obligatorios</h3>
            <ul style="padding-left: 20px; font-size: 0.9rem; color: #64748b; display: flex; flex-direction: column; gap: 12px; margin: 0;">
                <li><strong>Trámite de Ficha:</strong> Completa tu formulario de admisión en la pestaña lateral izquierda y selecciona tu carrera deseada.</li>
                <li><strong>Pago en Ventanilla / Banco:</strong> Descarga el formato de pago referenciado por un monto de `$850.00` y liquídalo para activar tu boleto de examen.</li>
                <li><strong>Guía de Examen:</strong> Una vez validado tu pago, podrás descargar el PDF oficial de la guía de estudio desde este mismo portal.</li>
            </ul>
        </div>

        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 25px; border-radius: 16px; backdrop-filter: blur(10px); display: flex; flex-direction: column; justify-content: space-between;">
            <div>
                <h3 style="margin: 0 0 15px 0; color: #1e293b; font-weight: 800; display: flex; align-items: center; gap: 8px;"><i class='bx bxs-file-doc' style="color: var(--secondary);"></i> Formato de Ficha</h3>
                <p style="font-size: 0.85rem; color: #64748b; margin-top: 5px;" id="ficha-status-p">Completa el formulario en el menú lateral para generar tu Pase Oficial.</p>
            </div>
            
            <button class="btn-finance-action" style="width: 100%; justify-content: center; background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white;" onclick="cargarModulo('Ficha')">
                <i class='bx bxs-edit-location'></i> Tramitar Ficha Ahora
            </button>
        </div>
    </div>
</div>

<script>
    (function() {
        // Cargar estatus dinámico si ya tramitó su ficha
        const storedFicha = localStorage.getItem('aspirante_ficha');
        if (storedFicha) {
            const data = JSON.parse(storedFicha);
            
            // Actualizar header del portal
            document.getElementById('aspirante-header-name').textContent = data.nombre;

            // Actualizar stepper
            document.getElementById('step-progress-line').style.width = '66%';
            
            const circle = document.getElementById('step-2-circle');
            circle.style.background = 'linear-gradient(135deg, var(--primary), var(--secondary))';
            circle.style.color = '#fff';
            
            const label = document.getElementById('step-2-label');
            label.style.color = '#1e293b';
            
            const badge = document.getElementById('step-2-badge');
            badge.style.background = 'rgba(5,150,105,0.1)';
            badge.style.color = '#059669';
            badge.textContent = 'Ficha Generada';

            // Actualizar tarjeta rápida de formato
            document.getElementById('ficha-status-p').innerHTML = `Ficha tramitada para la carrera de:<br><strong>${data.carrera}</strong>.<br><br><span style="color:#059669; font-weight:700;"><i class='bx bx-check'></i> Listo para descargar</span>`;
        }
    })();
</script>
