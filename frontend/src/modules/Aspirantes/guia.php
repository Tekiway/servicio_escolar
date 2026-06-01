<div class="animate__animated animate__fadeIn" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Encabezado -->
    <div class="module-header" style="margin-bottom: 5px;">
        <h2 style="color: #1e293b; font-size: 1.8rem; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i class='bx bxs-book-open' style="color: var(--primary);"></i> Guía de Estudio y Examen Simulacro
        </h2>
        <p style="color: #64748b;">Descarga la guía oficial y pon a prueba tus conocimientos antes del examen real.</p>
    </div>

    <!-- Si NO ha tramitado la ficha o pago -->
    <div id="guia-bloqueado" style="display: none; background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 40px; border-radius: 16px; text-align: center; backdrop-filter: blur(10px);">
        <i class='bx bxs-lock-alt' style="font-size: 4rem; color: #94a3b8; margin-bottom: 15px;"></i>
        <h3 style="color: #1e293b; font-weight: 800; margin: 0 0 10px 0;">Acceso Restringido</h3>
        <p style="color: #64748b; max-width: 500px; margin: 0 auto 20px auto; font-size: 0.9rem;" id="guia-mensaje-bloqueo">
            Debes completar tu trámite de ficha y haber validado tu pago de admisión para poder acceder a las guías oficiales y exámenes simulacro.
        </p>
        <button class="btn-finance-action" id="btn-guia-redireccion" onclick="cargarModulo('Ficha')" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white; margin: 0 auto;">
            Ir a Trámite de Ficha <i class='bx bx-right-arrow-alt'></i>
        </button>
    </div>

    <!-- Contenido de Guía Activo -->
    <div id="guia-activo" style="display: grid; grid-template-columns: 1.2fr 1.8fr; gap: 25px;">
        
        <!-- Columna Izquierda: Recursos y Guías -->
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 25px; border-radius: 16px; backdrop-filter: blur(10px); display: flex; flex-direction: column; gap: 20px;">
            <h3 style="margin: 0; color: #1e293b; font-weight: 800;">Recursos Descargables</h3>
            
            <div style="background: #fff; border: 1px solid #e2e8f0; padding: 18px; border-radius: 12px; display: flex; gap: 15px; align-items: flex-start; transition: transform 0.2s; cursor: pointer;" onclick="descargarGuia('EXANI')">
                <i class='bx bxs-file-pdf' style="font-size: 2.8rem; color: #ef4444; flex-shrink: 0;"></i>
                <div>
                    <h4 style="margin: 0 0 3px 0; color: #1e293b; font-weight: 700; font-size: 0.95rem;">Guía Temario EXANI-II</h4>
                    <p style="margin: 0; font-size: 0.8rem; color: #64748b;">Temario oficial de matemáticas, comprensión lectora, redacción y ciencias experimentales.</p>
                </div>
            </div>

            <div style="background: #fff; border: 1px solid #e2e8f0; padding: 18px; border-radius: 12px; display: flex; gap: 15px; align-items: flex-start; transition: transform 0.2s; cursor: pointer;" onclick="descargarGuia('TICS')">
                <i class='bx bxs-file-pdf' style="font-size: 2.8rem; color: #a855f7; flex-shrink: 0;"></i>
                <div>
                    <h4 style="margin: 0 0 3px 0; color: #1e293b; font-weight: 700; font-size: 0.95rem;">Módulo Específico: TI</h4>
                    <p style="margin: 0; font-size: 0.8rem; color: #64748b;">Guía especializada para aspirantes a Ingeniería en Sistemas y TICs con lógica matemática y fundamentos de programación.</p>
                </div>
            </div>

            <div style="background: rgba(14, 165, 233, 0.05); border: 1px solid rgba(14, 165, 233, 0.15); padding: 15px; border-radius: 12px; display: flex; flex-direction: column; gap: 8px;">
                <span style="font-weight: 700; color: var(--secondary); font-size: 0.8rem;"><i class='bx bxs-help-circle'></i> ESTRUCTURA EXAMEN</span>
                <p style="margin: 0; font-size: 0.8rem; color: #475569; line-height: 1.4;">
                    El examen real consta de <strong>120 preguntas</strong> de opción múltiple con un tiempo límite de <strong>3 horas</strong>. Te sugerimos repasar la lógica algebraica.
                </p>
            </div>
        </div>

        <!-- Columna Derecha: Examen Simulacro -->
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 25px; border-radius: 16px; backdrop-filter: blur(10px); display: flex; flex-direction: column; gap: 20px;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h3 style="margin: 0; color: #1e293b; font-weight: 800;">Simulador Rápido (Lógica y Mate)</h3>
                <span class="badge" style="background: rgba(168, 85, 247, 0.1); color: var(--primary); font-weight: 700; padding: 4px 10px; border-radius: 20px; font-size: 0.8rem;">3 Preguntas</span>
            </div>

            <!-- Quiz Formulario -->
            <form id="form-examen-simulacro" onsubmit="calificarExamen(event)" style="display: flex; flex-direction: column; gap: 20px;">
                
                <!-- Pregunta 1 -->
                <div style="background: #fff; border: 1px solid #e2e8f0; padding: 15px; border-radius: 12px; display: flex; flex-direction: column; gap: 10px;">
                    <span style="font-weight: 700; color: #1e293b; font-size: 0.9rem;">1. Si 3x + 7 = 22, ¿cuál es el valor de x?</span>
                    <div style="display: flex; flex-direction: column; gap: 8px; font-size: 0.85rem; color: #475569; padding-left: 5px;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="radio" name="q1" value="A" required> A) 3
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="radio" name="q1" value="B"> B) 5
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="radio" name="q1" value="C"> C) 6
                        </label>
                    </div>
                </div>

                <!-- Pregunta 2 -->
                <div style="background: #fff; border: 1px solid #e2e8f0; padding: 15px; border-radius: 12px; display: flex; flex-direction: column; gap: 10px;">
                    <span style="font-weight: 700; color: #1e293b; font-size: 0.9rem;">2. ¿Cuál es el siguiente número en la serie: 2, 6, 12, 20, ...?</span>
                    <div style="display: flex; flex-direction: column; gap: 8px; font-size: 0.85rem; color: #475569; padding-left: 5px;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="radio" name="q2" value="A" required> A) 26
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="radio" name="q2" value="B"> B) 30
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="radio" name="q2" value="C"> C) 32
                        </label>
                    </div>
                </div>

                <!-- Pregunta 3 -->
                <div style="background: #fff; border: 1px solid #e2e8f0; padding: 15px; border-radius: 12px; display: flex; flex-direction: column; gap: 10px;">
                    <span style="font-weight: 700; color: #1e293b; font-size: 0.9rem;">3. ¿Qué término define la unidad básica de almacenamiento de datos?</span>
                    <div style="display: flex; flex-direction: column; gap: 8px; font-size: 0.85rem; color: #475569; padding-left: 5px;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="radio" name="q3" value="A" required> A) Bit
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="radio" name="q3" value="B"> B) Byte
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                            <input type="radio" name="q3" value="C"> C) Hertz
                        </label>
                    </div>
                </div>

                <button class="btn-finance-action" type="submit" style="justify-content: center; background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white;">
                    <i class='bx bx-check-double'></i> EVALUAR RESPUESTAS
                </button>
            </form>

            <!-- Resultados del Examen Simulacro -->
            <div id="resultado-examen-simulacro" style="display: none; flex-direction: column; align-items: center; gap: 15px; text-align: center; background: rgba(168, 85, 247, 0.03); border: 1px dashed rgba(168, 85, 247, 0.25); padding: 25px; border-radius: 16px;">
                <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; font-weight: 900; box-shadow: 0 4px 15px rgba(168, 85, 247, 0.2);" id="resultado-puntaje-circulo">
                    3/3
                </div>
                <div>
                    <h4 style="color: #1e293b; font-size: 1.15rem; font-weight: 800; margin: 0 0 5px 0;" id="resultado-titulo">¡Excelente Desempeño!</h4>
                    <p style="color: #64748b; font-size: 0.85rem; max-width: 350px; margin: 0;" id="resultado-retro">
                        Has respondido correctamente todas las preguntas de lógica y matemáticas. Estás muy bien preparado para el examen.
                    </p>
                </div>
                
                <button class="btn-finance-action secondary" onclick="reiniciarSimulacro()">
                    <i class='bx bx-reset'></i> Intentar de Nuevo
                </button>
            </div>

        </div>
    </div>
</div>

<script>
    (function() {
        const storedFicha = localStorage.getItem('aspirante_ficha');
        const storedPago = localStorage.getItem('aspirante_pago');

        if (!storedFicha) {
            document.getElementById('guia-bloqueado').style.display = 'block';
            document.getElementById('btn-guia-redireccion').setAttribute('onclick', "cargarModulo('Ficha')");
            document.getElementById('btn-guia-redireccion').innerHTML = "Ir a Trámite de Ficha <i class='bx bx-right-arrow-alt'></i>";
            document.getElementById('guia-activo').style.display = 'none';
            return;
        }

        if (!storedPago) {
            document.getElementById('guia-bloqueado').style.display = 'block';
            document.getElementById('guia-mensaje-bloqueo').innerHTML = "Debes completar y reportar tu <strong>Pago de Admisión</strong> en ventanilla para desbloquear el acceso a las guías oficiales y simuladores.";
            document.getElementById('btn-guia-redireccion').setAttribute('onclick', "cargarModulo('Pago')");
            document.getElementById('btn-guia-redireccion').innerHTML = "Ir a Pago de Ficha <i class='bx bx-right-arrow-alt'></i>";
            document.getElementById('guia-activo').style.display = 'none';
            return;
        }

        // Mostrar sección de guías activa
        document.getElementById('guia-bloqueado').style.display = 'none';
        document.getElementById('guia-activo').style.display = 'grid';

        // Cargar examen simulacro guardado
        const storedSimulacro = localStorage.getItem('aspirante_simulacro');
        if (storedSimulacro) {
            mostrarResultadosSimulacro(parseInt(storedSimulacro));
        }
    })();

    function calificarExamen(event) {
        event.preventDefault();
        const r1 = document.querySelector('input[name="q1"]:checked').value;
        const r2 = document.querySelector('input[name="q2"]:checked').value;
        const r3 = document.querySelector('input[name="q3"]:checked').value;

        let aciertos = 0;
        if (r1 === 'B') aciertos++; // 3x = 15 => x = 5
        if (r2 === 'B') aciertos++; // 2(+4)=6(+6)=12(+8)=20(+10)=30
        if (r3 === 'A') aciertos++; // Bit es la unidad básica, Byte es unidad de medida (8 bits)

        localStorage.setItem('aspirante_simulacro', aciertos.toString());
        mostrarResultadosSimulacro(aciertos);
    }

    function mostrarResultadosSimulacro(aciertos) {
        const circulo = document.getElementById('resultado-puntaje-circulo');
        const titulo = document.getElementById('resultado-titulo');
        const retro = document.getElementById('resultado-retro');

        circulo.textContent = `${aciertos}/3`;

        if (aciertos === 3) {
            titulo.textContent = "¡Excelente Desempeño! 🎯";
            retro.textContent = "Has respondido correctamente todas las preguntas. Tu habilidad lógica y conocimientos generales de TI son de un nivel superior.";
            circulo.style.background = "linear-gradient(135deg, #10b981, #059669)";
        } else if (aciertos === 2) {
            titulo.textContent = "¡Muy Buen Esfuerzo! 👍";
            retro.textContent = "Obtuviste 2 respuestas correctas. Repasa la lógica binaria y operaciones básicas de álgebra en tu temario oficial.";
            circulo.style.background = "linear-gradient(135deg, #f59e0b, #d97706)";
        } else {
            titulo.textContent = "Necesitas Repasar 📚";
            retro.textContent = "Obtuviste una puntuación baja. Te recomendamos descargar el temario completo de lógica y realizar las guías de estudio sugeridas.";
            circulo.style.background = "linear-gradient(135deg, #ef4444, #dc2626)";
        }

        document.getElementById('form-examen-simulacro').style.display = 'none';
        document.getElementById('resultado-examen-simulacro').style.display = 'flex';
    }

    function reiniciarSimulacro() {
        localStorage.removeItem('aspirante_simulacro');
        document.getElementById('resultado-examen-simulacro').style.display = 'none';
        document.getElementById('form-examen-simulacro').style.display = 'flex';
        document.getElementById('form-examen-simulacro').reset();
    }

    function descargarGuia(tipo) {
        alert(`Iniciando descarga de guía temática [${tipo}] en formato PDF...\n\nArchivo guardado exitosamente en descargas.`);
    }
</script>
