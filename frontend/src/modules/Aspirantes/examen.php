<div class="animate__animated animate__fadeIn" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Encabezado -->
    <div class="module-header" style="margin-bottom: 5px;">
        <h2 style="color: #1e293b; font-size: 1.8rem; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i class='bx bxs-graduation' style="color: var(--primary); font-size: 2rem;"></i> Examen de Admisión y Simulador Lógico
        </h2>
        <p style="color: #64748b;">Consulta tu sede de examen asignada, descarga temarios y realiza tu simulador de evaluación interactivo.</p>
    </div>

    <!-- Panel de Examen General -->
    <div id="examen-container" style="display: grid; grid-template-columns: 1fr 1.3fr; gap: 25px; align-items: start;">
        
        <!-- Columna Izquierda: Pase de Entrada y Guías -->
        <div style="display: flex; flex-direction: column; gap: 25px;">
            <!-- Pase de Entrada -->
            <div style="background: white; border: 1px solid #e2e8f0; border-radius: 16px; padding: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.02); position: relative; overflow: hidden;">
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: linear-gradient(90deg, var(--primary), var(--secondary));"></div>
                
                <h3 style="margin: 0 0 15px 0; font-size: 1.15rem; font-weight: 800; color: #1e293b; font-family: 'Outfit', sans-serif;">PASE DE EXAMEN OFICIAL</h3>
                
                <div style="display: flex; flex-direction: column; gap: 10px; font-size: 0.88rem; color: #475569;">
                    <span><strong>Aspirante:</strong> <span id="pase-nombre">---</span></span>
                    <span><strong>Folio:</strong> ---</span>
                    <span><strong>---:</strong> <span id="pase-carrera">---</span></span>
                    <span><strong>Fecha:</strong> ---</span>
                    <span><strong>Horario:</strong> ---</span>
                    <span><strong>Sede:</strong> ---</span>
                </div>

                <div style="margin-top: 20px; border-top: 1px dashed #e2e8f0; padding-top: 15px; text-align: center;">
                    <div style="background: #e2e8f0; height: 40px; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-family: monospace; letter-spacing: 4px; font-size: 0.85rem; color:#475569;">
                        ||||| | ||||| ||| |||
                    </div>
                    <small style="font-size: 0.65rem; color: #94a3b8; display: block; margin-top: 5px;">CÓDIGO DE ACCESO EXAMEN</small>
                </div>
            </div>

            <!-- Guías de Estudio -->
            <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); border-radius: 16px; padding: 25px; backdrop-filter: blur(10px);">
                <h3 style="margin: 0 0 15px 0; font-size: 1.15rem; font-weight: 800; color: #1e293b; font-family: 'Outfit', sans-serif;">Temarios y Guías</h3>
                <p style="font-size: 0.85rem; color: #64748b; line-height: 1.5; margin-bottom: 15px;">Descarga el material oficial de estudio para prepararte en áreas lógicas y matemáticas.</p>
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <button class="btn-finance-action secondary" style="font-size: 0.85rem; width: 100%; justify-content: center;" onclick="alert('Descargando Guía Ceneval EXANI-II Oficial...')">
                        <i class='bx bxs-file-pdf'></i> Guía de Estudio EXANI-II
                    </button>
                    <button class="btn-finance-action secondary" style="font-size: 0.85rem; width: 100%; justify-content: center;" onclick="alert('Descargando Guía Lógica-Matemática...')">
                        <i class='bx bxs-file-pdf'></i> Temario Lógico-Matemático
                    </button>
                </div>
            </div>
        </div>

        <!-- Columna Derecha: Simulador Lógico de Examen -->
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); border-radius: 16px; padding: 30px; backdrop-filter: blur(10px); box-shadow: 0 4px 20px rgba(0,0,0,0.02); min-height: 380px; display: flex; flex-direction: column; justify-content: space-between;" id="quiz-box">
            <!-- Pantalla Inicial -->
            <div id="quiz-start-screen" style="display: flex; flex-direction: column; justify-content: space-between; height: 100%; flex: 1;">
                <div>
                    <h3 style="margin: 0 0 15px 0; font-size: 1.3rem; font-weight: 800; color: #1e293b; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 6px;">
                        <i class='bx bx-brain' style="color:var(--primary); font-size:1.5rem;"></i> Simulador Lógico
                    </h3>
                    <p style="font-size: 0.92rem; color: #64748b; line-height: 1.6;">
                        Mide tus conocimientos con este simulador interactivo de habilidades lógicas de 5 preguntas. Tu puntaje se guardará en tu expediente digital escolar.
                    </p>
                    <div style="background: rgba(168, 85, 247, 0.04); border: 1px solid rgba(168,85,247,0.1); padding: 15px; border-radius: 10px; margin-top: 15px; font-size: 0.88rem; color:#475569; line-height: 1.5;">
                        <strong>Condiciones:</strong><br>
                        • 5 reactivos de opción múltiple.<br>
                        • Puntaje de pase: 3 respuestas correctas (60%).
                    </div>
                </div>
                
                <button class="btn-finance-action" style="margin-top: 25px; background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white; width: 100%; justify-content: center;" onclick="startQuiz()">
                    <i class='bx bx-play-circle' style="font-size: 1.1rem;"></i> INICIAR SIMULADOR AHORA
                </button>
            </div>

            <!-- Reactivo Activo -->
            <div id="quiz-question-screen" style="display: none; flex-direction: column; justify-content: space-between; height: 100%; flex: 1;">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                        <span id="quiz-question-num" style="font-size: 0.8rem; font-weight: bold; color: var(--primary);">PREGUNTA 1 DE 5</span>
                        <div style="background: #e2e8f0; width: 80px; height: 6px; border-radius: 3px; overflow: hidden;">
                            <div id="quiz-progress-bar" style="background: var(--primary); width: 20%; height: 100%; transition: width 0.3s;"></div>
                        </div>
                    </div>
                    
                    <h3 id="quiz-question-text" style="font-size: 1.05rem; font-weight: 800; color: #1e293b; line-height: 1.5; margin: 0 0 20px 0;">¿Cuál es la pregunta?</h3>
                    
                    <div style="display: flex; flex-direction: column; gap: 10px;" id="quiz-options-container">
                        <!-- Las opciones se inyectan en JS -->
                    </div>
                </div>

                <button class="btn-finance-action" style="margin-top: 25px; background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white; width: 100%; justify-content: center;" id="quiz-next-btn" onclick="nextQuestion()" disabled>
                    Siguiente Pregunta <i class='bx bx-right-arrow-alt'></i>
                </button>
            </div>

            <!-- Resultados -->
            <div id="quiz-result-screen" style="display: none; flex-direction: column; align-items: center; text-align: center; justify-content: center; height: 100%; flex: 1; padding: 10px 0;">
                <div id="quiz-result-icon-box" style="width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 3rem; margin-bottom: 15px;">
                    <i class='bx bx-check'></i>
                </div>
                
                <h3 id="quiz-result-title" style="font-size: 1.4rem; font-weight: 800; color: #1e293b; margin: 0 0 5px 0;">Título</h3>
                <p id="quiz-result-score" style="font-size: 1.05rem; color: #475569; font-weight: bold; margin: 0 0 15px 0;">Calificación: 4/5 (80%)</p>
                <p id="quiz-result-desc" style="font-size: 0.9rem; color: #64748b; line-height: 1.6; max-width: 320px; margin: 0 0 25px 0;">Descripción del resultado.</p>
                
                <div style="display: flex; gap: 10px; width: 100%;">
                    <button class="btn-finance-action" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white; flex: 1; justify-content: center;" onclick="cargarModulo('Inicio')">
                        <i class='bx bx-home'></i> Ir a Inicio
                    </button>
                    <button class="btn-finance-action secondary" style="flex: 1; justify-content: center;" onclick="resetQuiz()">
                        <i class='bx bx-reset'></i> Repetir Test
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    (function() {
        // Bloqueos removidos. La interfaz se muestra siempre.
    })();

    // Cuestionario Lógico
    const quizQuestions = [];

    let currentQuestionIdx = 0;
    let correctAnswersCount = 0;
    let selectedOptionIdx = null;

    function startQuiz() {
        document.getElementById('quiz-start-screen').style.display = 'none';
        document.getElementById('quiz-question-screen').style.display = 'flex';
        loadQuestion();
    }

    function loadQuestion() {
        if(quizQuestions.length === 0) {
            alert("No hay preguntas cargadas en el simulador.");
            document.getElementById('quiz-question-screen').style.display = 'none';
            document.getElementById('quiz-start-screen').style.display = 'flex';
            return;
        }
        const qData = quizQuestions[currentQuestionIdx];
        
        document.getElementById('quiz-question-num').textContent = `PREGUNTA ${currentQuestionIdx + 1} DE 5`;
        document.getElementById('quiz-progress-bar').style.width = `${(currentQuestionIdx + 1) * 20}%`;
        document.getElementById('quiz-question-text').textContent = qData.q;

        const optionsContainer = document.getElementById('quiz-options-container');
        optionsContainer.innerHTML = '';
        selectedOptionIdx = null;
        document.getElementById('quiz-next-btn').disabled = true;

        qData.options.forEach((opt, idx) => {
            const btn = document.createElement('div');
            btn.className = 'quiz-option-item';
            btn.style.cssText = "padding: 12px 18px; border: 1px solid #cbd5e1; border-radius: 10px; cursor: pointer; font-size: 0.9rem; font-weight: 600; color: #475569; background: white; transition: all 0.2s;";
            btn.innerHTML = opt.text;
            btn.onclick = () => selectOption(idx, btn);
            optionsContainer.appendChild(btn);
        });
    }

    function selectOption(idx, element) {
        selectedOptionIdx = idx;
        const options = document.querySelectorAll('#quiz-options-container > div');
        options.forEach(opt => {
            opt.style.background = 'white';
            opt.style.color = '#475569';
            opt.style.borderColor = '#cbd5e1';
        });

        element.style.background = 'rgba(168, 85, 247, 0.08)';
        element.style.color = 'var(--primary)';
        element.style.borderColor = 'var(--primary)';

        document.getElementById('quiz-next-btn').disabled = false;
    }

    function nextQuestion() {
        const qData = quizQuestions[currentQuestionIdx];
        if (qData.options[selectedOptionIdx].correct) {
            correctAnswersCount++;
        }

        currentQuestionIdx++;

        if (currentQuestionIdx < 5) {
            loadQuestion();
        } else {
            // Guardar resultado
            localStorage.setItem('aspirante_examen_score', correctAnswersCount);
            showQuizResults(correctAnswersCount);
        }
    }

    function showQuizResults(score) {
        document.getElementById('quiz-start-screen').style.display = 'none';
        document.getElementById('quiz-question-screen').style.display = 'none';
        
        const resBox = document.getElementById('quiz-result-screen');
        const iconBox = document.getElementById('quiz-result-icon-box');
        const title = document.getElementById('quiz-result-title');
        const scoreText = document.getElementById('quiz-result-score');
        const desc = document.getElementById('quiz-result-desc');

        const pct = score * 20;
        scoreText.textContent = `Puntuación: ${score} / 5 (${pct}%)`;

        if (score >= 3) {
            iconBox.style.background = 'rgba(5, 150, 105, 0.1)';
            iconBox.style.color = '#059669';
            iconBox.innerHTML = "<i class='bx bx-check-circle'></i>";
            title.textContent = "¡Aprobado / Admitido!";
            title.style.color = '#059669';
            desc.innerHTML = "¡Felicidades! Has superado con éxito el Simulador Lógico-Matemático. Tienes un lugar asegurado para el período de nuevo ingreso.";
        } else {
            iconBox.style.background = 'rgba(217, 119, 6, 0.1)';
            iconBox.style.color = '#d97706';
            iconBox.innerHTML = "<i class='bx bx-info-circle'></i>";
            title.textContent = "Lista de Espera";
            title.style.color = '#d97706';
            desc.innerHTML = "Has obtenido un puntaje por debajo del 60% requerido. Quedas registrado temporalmente en Lista de Espera.";
        }

        resBox.style.display = 'flex';
    }

    function resetQuiz() {
        if (confirm("¿Seguro que deseas repetir el simulador? Se borrará el puntaje anterior.")) {
            localStorage.removeItem('aspirante_examen_score');
            currentQuestionIdx = 0;
            correctAnswersCount = 0;
            
            document.getElementById('quiz-result-screen').style.display = 'none';
            document.getElementById('quiz-question-screen').style.display = 'none';
            document.getElementById('quiz-start-screen').style.display = 'flex';
        }
    }
</script>
