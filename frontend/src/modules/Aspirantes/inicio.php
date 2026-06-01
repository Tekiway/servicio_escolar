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
        const storedFicha = localStorage.getItem('aspirante_ficha');
        const storedDocs = localStorage.getItem('aspirante_documentos');
        const storedPago = localStorage.getItem('aspirante_pago');
        const storedScore = localStorage.getItem('aspirante_examen_score');

        const stepProgress = document.getElementById('step-progress-line');
        const guidance = document.getElementById('action-guidance-content');
        const quickFichaP = document.getElementById('ficha-status-p');
        const quickBtn = document.getElementById('quick-action-btn');

        // Función para activar un paso del stepper
        const activateStep = (num, labelText) => {
            const circle = document.getElementById(`step-${num}-circle`);
            const label = document.getElementById(`step-${num}-label`);
            const badge = document.getElementById(`step-${num}-badge`);

            circle.style.background = 'linear-gradient(135deg, var(--primary), var(--secondary))';
            circle.style.color = '#ffffff';
            circle.style.boxShadow = '0 4px 12px rgba(168, 85, 247, 0.2)';
            label.style.color = '#1e293b';
            badge.style.background = 'rgba(5,150,105,0.1)';
            badge.style.color = '#059669';
            badge.innerHTML = `<i class='bx bx-check'></i> ${labelText}`;
        };

        // Función para habilitar un paso pendiente (desbloqueado pero no terminado)
        const unlockStep = (num, badgeText) => {
            const circle = document.getElementById(`step-${num}-circle`);
            const label = document.getElementById(`step-${num}-label`);
            const badge = document.getElementById(`step-${num}-badge`);

            circle.style.background = '#fef08a'; // Amarillo claro
            circle.style.color = '#854d0e';
            circle.style.boxShadow = '0 4px 10px rgba(234, 179, 8, 0.15)';
            label.style.color = '#1e293b';
            badge.style.background = 'rgba(234, 179, 8, 0.1)';
            badge.style.color = '#854d0e';
            badge.textContent = badgeText;
        };

        let currentStage = 1; // 1: Ficha, 2: Documentos, 3: Pago, 4: Examen/Sim, 5: Completado

        // Evaluar Estados
        if (storedFicha) {
            activateStep(2, "Completado");
            currentStage = 2; // Avanza a documentos
        }

        if (storedFicha && storedDocs) {
            activateStep(3, "Subidos");
            currentStage = 3; // Avanza a pago
        }

        if (storedFicha && storedDocs && storedPago) {
            activateStep(4, "Aprobado");
            currentStage = 4; // Avanza a examen
        }

        if (storedFicha && storedDocs && storedPago && storedScore) {
            activateStep(5, "Finalizado");
            currentStage = 5; // Proceso completamente terminado!
        }

        // Actualizar línea de progreso
        if (currentStage === 1) {
            stepProgress.style.width = '0%';
            unlockStep(2, "Hacer Trámite");
        } else if (currentStage === 2) {
            stepProgress.style.width = '25%';
            unlockStep(3, "Subir Archivos");
        } else if (currentStage === 3) {
            stepProgress.style.width = '50%';
            unlockStep(4, "Pagar Ficha");
        } else if (currentStage === 4) {
            stepProgress.style.width = '75%';
            unlockStep(5, "Tomar Examen");
        } else if (currentStage === 5) {
            stepProgress.style.width = '100%';
        }

        // Renderizar flujo inteligente de acciones en base a currentStage
        if (currentStage === 1) {
            guidance.innerHTML = `
                <p>El primer paso obligatorio para iniciar tu proceso de ingreso es el <strong>Trámite de Ficha de Examen</strong>.</p>
                <p>Debes presionar el botón lateral o el botón de la derecha para ingresar tus datos escolares de procedencia (Preparatoria, Promedio) y elegir la carrera universitaria que deseas cursar en nuestro plantel.</p>
                <div style="background: rgba(168, 85, 247, 0.05); padding: 12px; border-radius: 8px; border-left: 4px solid var(--primary); font-size: 0.88rem; margin-top: 10px;">
                    <i class='bx bx-bulb' style='color: var(--primary);'></i> <strong>Tip:</strong> Ten a la mano tu CURP oficial para poder realizar este registro rápidamente.
                </div>
            `;
            quickFichaP.textContent = "Aún no has ingresado tus datos escolares. Completa tu ficha para recibir tu Folio de Examen.";
            quickBtn.innerHTML = "<i class='bx bxs-edit-location'></i> Tramitar Ficha Ahora";
            quickBtn.setAttribute("onclick", "cargarModulo('Ficha')");
        } 
        else if (currentStage === 2) {
            const data = JSON.parse(storedFicha);
            guidance.innerHTML = `
                <p>¡Excelente! Has completado tu <strong>Ficha de Ingreso</strong> para la carrera de <strong>${data.carrera}</strong> con el Folio #2026-F-8821.</p>
                <p>El siguiente paso es la <strong>Carga de Documentos</strong>. Sube tus archivos oficiales en formato digital (PDF o Imagen) para ser validados por el área de control escolar:</p>
                <ul style="padding-left: 20px; margin: 10px 0; font-size: 0.9rem; display: flex; flex-direction: column; gap: 6px;">
                    <li><i class='bx bx-check-circle' style='color:#059669;'></i> Acta de Nacimiento</li>
                    <li><i class='bx bx-check-circle' style='color:#059669;'></i> Certificado Oficial de Preparatoria</li>
                    <li><i class='bx bx-check-circle' style='color:#059669;'></i> CURP Impresa Reciente</li>
                    <li><i class='bx bx-check-circle' style='color:#059669;'></i> Fotografía Infantil Reciente</li>
                </ul>
            `;
            quickFichaP.innerHTML = `Ficha tramitada para:<br><strong>${data.carrera}</strong>.<br><span style="color:#059669; font-weight:700;"><i class='bx bx-check'></i> Folio Generado</span>`;
            quickBtn.innerHTML = "<i class='bx bxs-cloud-upload'></i> Subir Documentos";
            quickBtn.setAttribute("onclick", "cargarModulo('Documentos')");
        }
        else if (currentStage === 3) {
            guidance.innerHTML = `
                <p>¡Tus documentos han sido cargados y validados correctamente en el sistema escolar! ✔</p>
                <p>Ahora debes realizar el <strong>Pago del Examen de Admisión</strong> por un monto total de <strong>$850.00 MXN</strong>.</p>
                <p>Tienes dos formas de realizarlo de manera segura:</p>
                <ul style="padding-left: 20px; margin: 10px 0; font-size: 0.9rem;">
                    <li><strong>Pago Express con Tarjeta:</strong> Paga en línea directamente y obtén tu boleto de examen aprobado en 1 minuto.</li>
                    <li><strong>Formato en Ventanilla Bancaria:</strong> Descarga tu referencia referenciada para acudir a ventanilla bancaria (BBVA/Banamex).</li>
                </ul>
            `;
            quickFichaP.innerHTML = `Documentos: <strong style="color:#059669;">Aprobados</strong><br>Pago Ficha: <strong style="color:#ef4444;">Pendiente</strong>`;
            quickBtn.innerHTML = "<i class='bx bxs-credit-card'></i> Realizar Pago";
            quickBtn.setAttribute("onclick", "cargarModulo('Pago')");
        }
        else if (currentStage === 4) {
            guidance.innerHTML = `
                <p><strong>¡Tu Pago ha sido Acreditado de forma exitosa! 💳</strong> El banco reporta saldo cubierto.</p>
                <p>¡Estás oficialmente habilitado para tomar tu Examen de Admisión! Has desbloqueado las siguientes herramientas:</p>
                <ul style="padding-left: 20px; margin: 10px 0; font-size: 0.9rem; display: flex; flex-direction: column; gap: 6px;">
                    <li><strong>Pase de Entrada al Aula:</strong> Contiene tu sede asignada (Edificio C, Aula 302).</li>
                    <li><strong>Temario y Guía de Examen:</strong> Accede a los módulos de estudio recomendados.</li>
                    <li><strong>Simulador de Examen Completo:</strong> Toma el test de preparación lógica interactivo para medir tus habilidades.</li>
                </ul>
            `;
            quickFichaP.innerHTML = `Estatus Pago: <strong style="color:#059669;">Acreditado</strong><br>Sede: <strong>Edificio C - Aula 302</strong>`;
            quickBtn.innerHTML = "<i class='bx bxs-graduation'></i> Ir al Simulador";
            quickBtn.setAttribute("onclick", "cargarModulo('Examen')");
        }
        else if (currentStage === 5) {
            const scorePercent = parseFloat(storedScore) * 20; // 5 preguntas = 20% c/u
            const statusColor = scorePercent >= 60 ? '#059669' : '#d97706';
            const statusText = scorePercent >= 60 ? 'ADMITIDO (Lugar Asegurado)' : 'EN LISTA DE ESPERA';

            guidance.innerHTML = `
                <p><strong>¡Felicidades! Has completado exitosamente todo tu proceso de admisión 2026. 🎉</strong></p>
                <p>Completaste tu simulador de evaluación obteniendo una calificación de <strong>${scorePercent}% de respuestas correctas</strong>.</p>
                <div style="background: rgba(5, 150, 105, 0.05); padding: 15px; border-radius: 10px; border-left: 5px solid ${statusColor}; margin-top: 10px;">
                    <h4 style="margin: 0 0 5px 0; color: ${statusColor}; font-weight: 800; font-family: 'Outfit', sans-serif;">Resultado del Proceso:</h4>
                    <p style="margin: 0; font-size: 1.05rem; font-weight: 800; color: ${statusColor};">${statusText}</p>
                    <p style="margin: 5px 0 0 0; font-size: 0.85rem; color: #64748b;">Tu pase de inscripción oficial ha sido enviado a tu correo registrado. ¡Bienvenido a nuestra comunidad universitaria!</p>
                </div>
            `;
            quickFichaP.innerHTML = `Resultado Examen: <strong style="color:${statusColor};">${scorePercent}%</strong><br>Estatus: <strong style="color:${statusColor};">${scorePercent >= 60 ? 'Admitido' : 'En Espera'}</strong>`;
            quickBtn.innerHTML = "<i class='bx bxs-award'></i> Ver Resultados";
            quickBtn.setAttribute("onclick", "cargarModulo('Examen')");
        }
    })();
</script>
