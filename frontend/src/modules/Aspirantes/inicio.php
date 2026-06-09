<div class="animate__animated animate__fadeIn" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Banner de Admisión Premium -->
    <div class="welcome-banner" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); color: #ffffff; padding: 35px; border-radius: 16px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 10px 25px rgba(168, 85, 247, 0.15); position: relative; overflow: hidden;">
        <div style="z-index: 2; max-width: 70%;">
            <h1 style="font-size: 2.2rem; font-weight: 800; margin: 0 0 10px 0; font-family: 'Outfit', sans-serif; letter-spacing: -0.5px;">¡Proceso de Admisión 2026! 🚀</h1>
            <p style="margin: 0; font-size: 1.05rem; opacity: 0.9; line-height: 1.5;">Bienvenido a tu panel de control de ingreso. Sigue los pasos indicados abajo para completar tu trámite y asegurar tu lugar en el examen.</p>
            <div style="margin-top: 18px; background: rgba(255,255,255,0.15); display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 20px; font-size: 0.85rem; font-weight: 700; border: 1px solid rgba(255,255,255,0.25);">
                <i class='bx bxs-calendar-check' style="font-size: 1.1rem;"></i> Examen de Admisión Oficial: 25 de Junio, 2026 (9:00 AM)
            </div>
        </div>
        <div style="font-size: 7rem; opacity: 0.15; z-index: 1; transform: rotate(15deg); font-family: sans-serif; user-select: none;">🏫</div>
    </div>

    <!-- Stepper Visual de Admisión de 5 Pasos -->
    <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 30px; border-radius: 16px; backdrop-filter: blur(10px); box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
        <h3 style="margin: 0 0 30px 0; color: #1e293b; font-weight: 800; display: flex; align-items: center; gap: 10px; font-family: 'Outfit', sans-serif;">
            <i class='bx bxs-navigation' style="color: var(--primary); font-size: 1.5rem;"></i> Progreso de tu Proceso de Ingreso
        </h3>
        
        <div style="display: flex; justify-content: space-between; align-items: center; position: relative; padding: 10px 0;">
            <!-- Línea de fondo del stepper -->
            <div style="position: absolute; top: 38px; left: 8%; width: 84%; height: 5px; background: #e2e8f0; z-index: 1; border-radius: 4px;"></div>
            <!-- Línea de progreso activa -->
            <div id="step-progress-line" style="position: absolute; top: 38px; left: 8%; width: 0%; height: 5px; background: linear-gradient(135deg, var(--primary), var(--secondary)); z-index: 2; transition: width 0.4s ease; border-radius: 4px;"></div>

            <!-- Paso 1: Registro -->
            <div style="z-index: 3; text-align: center; width: 18%;">
                <div style="width: 52px; height: 52px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; display: inline-flex; align-items: center; justify-content: center; font-size: 1.4rem; font-weight: 800; border: 4px solid #fff; box-shadow: 0 4px 12px rgba(168, 85, 247, 0.2);"><i class='bx bx-user'></i></div>
                <span style="display: block; font-size: 0.85rem; font-weight: 700; color: #1e293b; margin-top: 10px;">1. Registro</span>
                <span style="font-size: 0.72rem; padding: 2px 10px; border-radius: 12px; background: rgba(5,150,105,0.1); color: #059669; font-weight: 700; display: inline-block; margin-top: 4px;"><i class='bx bx-check-double'></i> Listo</span>
            </div>

            <!-- Paso 2: Ficha -->
            <div style="z-index: 3; text-align: center; width: 18%;" id="step-2-container">
                <div id="step-2-circle" style="width: 52px; height: 52px; border-radius: 50%; background: #e2e8f0; color: #64748b; display: inline-flex; align-items: center; justify-content: center; font-size: 1.4rem; font-weight: 800; border: 4px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.03); transition: all 0.3s;"><i class='bx bx-file-blank'></i></div>
                <span style="display: block; font-size: 0.85rem; font-weight: 700; color: #64748b; margin-top: 10px;" id="step-2-label">2. Ficha</span>
                <span id="step-2-badge" style="font-size: 0.72rem; padding: 2px 10px; border-radius: 12px; background: #f1f5f9; color: #64748b; font-weight: 700; display: inline-block; margin-top: 4px;">Pendiente</span>
            </div>

            <!-- Paso 3: Documentos -->
            <div style="z-index: 3; text-align: center; width: 18%;" id="step-3-container">
                <div id="step-3-circle" style="width: 52px; height: 52px; border-radius: 50%; background: #e2e8f0; color: #64748b; display: inline-flex; align-items: center; justify-content: center; font-size: 1.4rem; font-weight: 800; border: 4px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.03); transition: all 0.3s;"><i class='bx bx-cloud-upload'></i></div>
                <span style="display: block; font-size: 0.85rem; font-weight: 700; color: #64748b; margin-top: 10px;" id="step-3-label">3. Documentos</span>
                <span id="step-3-badge" style="font-size: 0.72rem; padding: 2px 10px; border-radius: 12px; background: #f1f5f9; color: #64748b; font-weight: 700; display: inline-block; margin-top: 4px;">Bloqueado</span>
            </div>

            <!-- Paso 4: Pago -->
            <div style="z-index: 3; text-align: center; width: 18%;" id="step-4-container">
                <div id="step-4-circle" style="width: 52px; height: 52px; border-radius: 50%; background: #e2e8f0; color: #64748b; display: inline-flex; align-items: center; justify-content: center; font-size: 1.4rem; font-weight: 800; border: 4px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.03); transition: all 0.3s;"><i class='bx bx-credit-card'></i></div>
                <span style="display: block; font-size: 0.85rem; font-weight: 700; color: #64748b; margin-top: 10px;" id="step-4-label">4. Pago</span>
                <span id="step-4-badge" style="font-size: 0.72rem; padding: 2px 10px; border-radius: 12px; background: #f1f5f9; color: #64748b; font-weight: 700; display: inline-block; margin-top: 4px;">Bloqueado</span>
            </div>

            <!-- Paso 5: Examen -->
            <div style="z-index: 3; text-align: center; width: 18%;" id="step-5-container">
                <div id="step-5-circle" style="width: 52px; height: 52px; border-radius: 50%; background: #e2e8f0; color: #64748b; display: inline-flex; align-items: center; justify-content: center; font-size: 1.4rem; font-weight: 800; border: 4px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.03); transition: all 0.3s;"><i class='bx bx-graduation'></i></div>
                <span style="display: block; font-size: 0.85rem; font-weight: 700; color: #64748b; margin-top: 10px;" id="step-5-label">5. Examen / Sim</span>
                <span id="step-5-badge" style="font-size: 0.72rem; padding: 2px 10px; border-radius: 12px; background: #f1f5f9; color: #64748b; font-weight: 700; display: inline-block; margin-top: 4px;">Bloqueado</span>
            </div>
        </div>
    </div>

    <!-- Guía Dinámica Inteligente basada en Estado -->
    <div style="display: grid; grid-template-columns: 1.8fr 1.2fr; gap: 25px;">
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 25px; border-radius: 16px; backdrop-filter: blur(10px); display: flex; flex-direction: column; gap: 15px;">
            <h3 style="margin: 0; color: #1e293b; font-weight: 800; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 8px;">
                <i class='bx bx-info-circle' style="color: var(--primary); font-size: 1.4rem;"></i>
                Tu Siguiente Acción Requerida
            </h3>
            
            <div id="action-guidance-content" style="font-size: 0.95rem; color: #64748b; line-height: 1.6;">
                <!-- Se llena dinámicamente -->
            </div>
        </div>

        <!-- Tarjeta Rápida del Pase / Ficha -->
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 25px; border-radius: 16px; backdrop-filter: blur(10px); display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 4px 20px rgba(0,0,0,0.01);">
            <div>
                <h3 style="margin: 0 0 10px 0; color: #1e293b; font-weight: 800; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 8px;">
                    <i class='bx bxs-file-doc' style="color: var(--secondary); font-size: 1.3rem;"></i> 
                    Estatus de Ficha
                </h3>
                <p style="font-size: 0.9rem; color: #64748b; margin: 0; line-height: 1.5;" id="ficha-status-p">
                    Cargando información escolar...
                </p>
            </div>
            
            <button id="quick-action-btn" class="btn-finance-action" style="width: 100%; justify-content: center; background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white; margin-top: 20px; font-weight: bold; transition: all 0.3s;" onclick="cargarModulo('Ficha')">
                <i class='bx bxs-edit-location'></i> Tramitar Ficha
            </button>
        </div>
    </div>
</div>

<script>
    (function() {
        // Interfaz habilitada, esperando datos reales de la API.
        const guidance = document.getElementById('action-guidance-content');
        if (guidance) {
            guidance.innerHTML = `<p><strong>Proceso de Admisión</strong></p><p>Esperando la carga dinámica de tu progreso...</p>`;
        }
    })();
</script>
