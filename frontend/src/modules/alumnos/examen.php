<div class="animate__animated animate__fadeIn" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Encabezado -->
    <div class="module-header" style="margin-bottom: 5px;">
        <h2 style="color: #1e293b; font-size: 1.8rem; font-weight: 800; display: flex; align-items: center; gap: 8px; margin: 0;">
            <i class='bx bxs-face' style="color: var(--primary); font-size: 2rem;"></i> Evaluación Docente Semestral
        </h2>
        <p style="color: #64748b; margin: 5px 0 0 0;">Retroalimenta el desempeño pedagógico de tus profesores de forma 100% anónima y obligatoria.</p>
    </div>

    <!-- Contenedor General de la Evaluación -->
    <div id="evaluacion-docente-container" style="display: grid; grid-template-columns: 1fr 1.4fr; gap: 25px; align-items: start;">
        
        <!-- Columna Izquierda: Información de Progreso General -->
        <div style="background: white; border: 1px solid #e2e8f0; border-radius: 16px; padding: 25px; box-shadow: 0 4px 20px rgba(0,0,0,0.02); display: flex; flex-direction: column; gap: 20px;">
            <h3 style="margin: 0; font-size: 1.1rem; font-weight: 800; color: #1e293b; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 6px;">
                <i class='bx bxs-pie-chart-alt-2' style="color: var(--primary);"></i> PROGRESO GLOBAL
            </h3>
            
            <div style="background: rgba(99, 102, 241, 0.05); padding: 15px; border-radius: 12px; font-size: 0.88rem; color:#475569; line-height: 1.6; border-left: 4px solid var(--primary);">
                <strong>¿Por qué es obligatoria?</strong><br>
                La evaluación es un requisito indispensable para liberar tu boleta de calificaciones finales y tu kárdex del periodo escolar actual.
            </div>

            <!-- Progreso visual de docentes evaluados -->
            <div style="display: flex; flex-direction: column; gap: 8px;">
                <div style="display: flex; justify-content: space-between; font-size: 0.85rem; font-weight: 700; color: #475569;">
                    <span>Profesores Evaluados:</span>
                    <span id="eval-progress-ratio">0 de 4</span>
                </div>
                <div style="background: #e2e8f0; height: 10px; border-radius: 5px; overflow: hidden; width: 100%;">
                    <div id="eval-progress-bar-global" style="background: linear-gradient(90deg, var(--primary), var(--secondary)); width: 0%; height: 100%; transition: width 0.4s ease;"></div>
                </div>
            </div>

            <div style="border-top: 1px solid #e2e8f0; padding-top: 15px;" id="eval-status-info">
                <!-- Se llena dinámicamente -->
            </div>
        </div>

        <!-- Columna Derecha: Panel del Cuestionario -->
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); border-radius: 16px; padding: 30px; backdrop-filter: blur(10px); box-shadow: 0 8px 32px rgba(31, 38, 135, 0.04); min-height: 420px; display: flex; flex-direction: column; justify-content: space-between;" id="eval-quiz-box">
            
            <!-- Vista 1: Pantalla de Bienvenida / Iniciar Cuestionario -->
            <div id="eval-start-screen" style="display: flex; flex-direction: column; justify-content: space-between; height: 100%; flex: 1;">
                <div>
                    <h3 style="margin: 0 0 15px 0; font-size: 1.3rem; font-weight: 800; color: #1e293b; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 8px;">
                        <i class='bx bx-edit' style="color:var(--primary); font-size:1.5rem;"></i> Cuestionario de Desempeño Docente
                    </h3>
                    <p style="font-size: 0.92rem; color: #64748b; line-height: 1.6; margin-bottom: 20px;">
                        Comenzarás una evaluación secuencial para calificar objetivamente el desempeño pedagógico de tus <strong>4 profesores titulares</strong> de este periodo.
                    </p>
                    
                    <div style="background: rgba(255,255,255,0.4); border: 1px solid rgba(226,232,240,0.8); padding: 15px; border-radius: 12px;">
                        <span style="font-size: 0.8rem; font-weight: bold; color: #64748b; display: block; margin-bottom: 10px; text-transform: uppercase;">Docentes a evaluar en esta sesión:</span>
                        <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 8px; font-size: 0.85rem; color: #475569;">
                            <li style="display: flex; align-items: center; gap: 6px;"><i class='bx bxs-circle' style="font-size: 0.5rem; color: var(--primary);"></i> Ing. Ricardo Ramos (Programación Web)</li>
                            <li style="display: flex; align-items: center; gap: 6px;"><i class='bx bxs-circle' style="font-size: 0.5rem; color: var(--secondary);"></i> Mtra. Patricia Garmendia (Redes de Computadoras)</li>
                            <li style="display: flex; align-items: center; gap: 6px;"><i class='bx bxs-circle' style="font-size: 0.5rem; color: var(--accent);"></i> Dr. Manuel Ocampo (Bases de Datos II)</li>
                            <li style="display: flex; align-items: center; gap: 6px;"><i class='bx bxs-circle' style="font-size: 0.5rem; color: #f59e0b;"></i> Ing. Joaquín Alavez (Sistemas Operativos)</li>
                        </ul>
                    </div>
                </div>
                
                <button class="btn-finance-action" style="margin-top: 30px; background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white; width: 100%; justify-content: center; font-weight: 800; padding: 12px;" onclick="startEval()">
                    <i class='bx bx-play-circle' style="font-size: 1.25rem;"></i> INICIAR EVALUACIÓN AHORA
                </button>
            </div>

            <!-- Vista 2: Cuestionario de Preguntas Activas -->
            <div id="eval-question-screen" style="display: none; flex-direction: column; justify-content: space-between; height: 100%; flex: 1;">
                <div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <span id="eval-question-num" style="font-size: 0.8rem; font-weight: bold; color: var(--primary); text-transform: uppercase; letter-spacing: 0.5px;">REACTIVO 1 DE 5</span>
                        <div style="background: #e2e8f0; width: 100px; height: 6px; border-radius: 3px; overflow: hidden;">
                            <div id="eval-question-progress-bar" style="background: var(--primary); width: 20%; height: 100%; transition: width 0.3s;"></div>
                        </div>
                    </div>
                    
                    <!-- Datos del Profesor Actual en la cabecera del Cuestionario -->
                    <div style="display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 20px; padding: 12px 15px; border-radius: 12px; background: rgba(255,255,255,0.4); border: 1px solid rgba(226,232,240,0.6);">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <img id="eval-teacher-active-avatar" src="" style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid var(--primary);">
                            <div>
                                <strong id="eval-teacher-active-name" style="color: #1e293b; font-size: 0.9rem; display: block;">Docente</strong>
                                <span id="eval-teacher-active-subject" style="color: #64748b; font-size: 0.75rem;">Materia</span>
                            </div>
                        </div>
                        <span id="eval-teacher-active-counter" style="font-size: 0.75rem; background: rgba(99,102,241,0.1); color: var(--primary); padding: 4px 10px; border-radius: 20px; font-weight: 700;">Profesor 1 de 4</span>
                    </div>

                    <h3 id="eval-question-text" style="font-size: 1.05rem; font-weight: 800; color: #1e293b; line-height: 1.5; margin: 0 0 20px 0;">¿El docente realiza la clase de forma puntual y asiste con regularidad?</h3>
                    
                    <div style="display: flex; flex-direction: column; gap: 10px;" id="eval-options-container">
                        <!-- Las opciones de respuesta se inyectan en JS -->
                    </div>
                </div>

                <button class="btn-finance-action" style="margin-top: 25px; background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white; width: 100%; justify-content: center;" id="eval-next-btn" onclick="nextEvalQuestion()" disabled>
                    Siguiente Pregunta <i class='bx bx-right-arrow-alt'></i>
                </button>
            </div>

            <!-- Vista 3: Pantalla de Transición de Éxito / Siguiente Docente -->
            <div id="eval-transition-screen" style="display: none; flex-direction: column; align-items: center; text-align: center; justify-content: center; height: 100%; flex: 1; padding: 20px 0;">
                <div style="width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 3rem; margin-bottom: 15px; background: rgba(5, 150, 105, 0.1); color: #059669;">
                    <i class='bx bx-check-circle'></i>
                </div>
                <h3 style="font-size: 1.3rem; font-weight: 800; color: #1e293b; margin: 0 0 8px 0;">¡Profesor Evaluado con Éxito!</h3>
                <p id="eval-transition-text" style="font-size: 0.9rem; color: #64748b; line-height: 1.6; max-width: 380px; margin: 0 0 20px 0;">Guardando retroalimentación anónima...</p>
                <div style="display: flex; align-items: center; gap: 8px; color: var(--primary); font-weight: 700; font-size: 0.85rem;">
                    <i class='bx bx-loader-alt bx-spin' style="font-size: 1.2rem;"></i> Cargando siguiente docente...
                </div>
            </div>

            <!-- Vista 4: Proceso Total Completado / Liberado -->
            <div id="eval-result-screen" style="display: none; flex-direction: column; align-items: center; text-align: center; justify-content: center; height: 100%; flex: 1; padding: 20px 0;">
                <div style="width: 75px; height: 75px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 3.5rem; margin-bottom: 15px; background: rgba(5, 150, 105, 0.1); color: #059669; border: 3px solid #059669;">
                    <i class='bx bxs-check-shield'></i>
                </div>
                
                <h3 style="font-size: 1.5rem; font-weight: 800; color: #1e293b; margin: 0 0 8px 0;">Evaluación Completada</h3>
                <p style="font-size: 0.92rem; color: #64748b; line-height: 1.6; max-width: 360px; margin: 0 0 25px 0;">Felicidades. Has evaluado a todos tus docentes del periodo semestral. Tu consulta de boleta de calificaciones ha sido desbloqueada con éxito.</p>
                
                <button class="btn-finance-action" style="background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white; width: 100%; justify-content: center;" onclick="cargarModulo('Evaluaciones')">
                    <i class='bx bxs-spreadsheet' style="font-size: 1.1rem;"></i> Consultar Mis Calificaciones (Boleta)
                </button>
            </div>

        </div>

    </div>
</div>

<script>
    // Plantilla inicial de docentes
    const plantillaDocentes = [
        { id: 1, name: "Ing. Ricardo Ramos", subject: "Programación Web I", avatar: "https://ui-avatars.com/api/?name=Ricardo+Ramos&background=6366f1&color=fff&rounded=true" },
        { id: 2, name: "Mtra. Patricia Garmendia", subject: "Redes de Computadoras I", avatar: "https://ui-avatars.com/api/?name=Patricia+Garmendia&background=a855f7&color=fff&rounded=true" },
        { id: 3, name: "Dr. Manuel Ocampo", subject: "Bases de Datos II", avatar: "https://ui-avatars.com/api/?name=Manuel+Ocampo&background=0ea5e9&color=fff&rounded=true" },
        { id: 4, name: "Ing. Joaquín Alavez", subject: "Sistemas Operativos", avatar: "https://ui-avatars.com/api/?name=Joaquin+Alavez&background=f59e0b&color=fff&rounded=true" }
    ];

    const evalQuestions = [
        "1. ¿El docente asiste con regularidad y puntualidad a impartir las clases asignadas?",
        "2. ¿El profesor expone los temas con claridad y muestra un dominio profundo de la materia?",
        "3. ¿El docente fomenta el respeto mutuo, la sana convivencia y la participación activa del grupo?",
        "4. ¿Los métodos de evaluación (exámenes, proyectos) corresponden a los temas enseñados en clase?",
        "5. ¿El profesor se muestra accesible para resolver dudas fuera del horario de clase si es necesario?"
    ];

    let currentQuestionIdx = 0;
    let selectedOptionIdx = null;
    let activeTeacherIndex = 0; // Índice en plantillaDocentes del docente actual
    let evaluacionesEstado = {};

    function initEvaluaciones() {
        const storedEstado = localStorage.getItem('alumno_evaluaciones_por_docente');
        if (storedEstado) {
            evaluacionesEstado = JSON.parse(storedEstado);
        } else {
            // Inicializar todos como pendientes
            plantillaDocentes.forEach(d => {
                evaluacionesEstado[d.id] = false;
            });
            localStorage.setItem('alumno_evaluaciones_por_docente', JSON.stringify(evaluacionesEstado));
        }

        renderProgresoGlobal();
    }

    function renderProgresoGlobal() {
        let total = plantillaDocentes.length;
        let completados = 0;

        for (let id in evaluacionesEstado) {
            if (evaluacionesEstado[id]) completados++;
        }

        const ratioText = document.getElementById('eval-progress-ratio');
        const progressBar = document.getElementById('eval-progress-bar-global');
        const infoBox = document.getElementById('eval-status-info');

        ratioText.textContent = `${completados} de ${total}`;
        const pct = (completados / total) * 100;
        progressBar.style.width = `${pct}%`;

        if (completados === total) {
            localStorage.setItem('alumno_evaluacion_docente', 'true');
            infoBox.innerHTML = `
                <div style="display: flex; gap: 10px; align-items: center; color: #059669; font-weight: 700; font-size: 0.9rem;">
                    <i class='bx bxs-check-circle' style="font-size:1.3rem;"></i> LIBERADO / COMPLETADO
                </div>
                <p style="font-size: 0.8rem; color: #64748b; margin-top: 5px;">Tu comprobante de evaluación de este periodo está activo. Puedes acceder al Kárdex de materias libremente.</p>
            `;
            
            // Si está todo completo, mostrar la pantalla final directamente
            document.getElementById('eval-start-screen').style.display = 'none';
            document.getElementById('eval-question-screen').style.display = 'none';
            document.getElementById('eval-transition-screen').style.display = 'none';
            document.getElementById('eval-result-screen').style.display = 'flex';
        } else {
            localStorage.removeItem('alumno_evaluacion_docente');
            infoBox.innerHTML = `
                <div style="display: flex; gap: 10px; align-items: center; color: #ef4444; font-weight: 700; font-size: 0.9rem;">
                    <i class='bx bxs-error-circle' style="font-size:1.3rem;"></i> EVALUACIÓN EN PROCESO
                </div>
                <p style="font-size: 0.8rem; color: #64748b; margin-top: 5px;">Completa la evaluación secuencial de tus 4 profesores para desbloquear tu boleta escolar.</p>
            `;
            document.getElementById('eval-result-screen').style.display = 'none';
            
            // Encontrar el primer docente no evaluado
            activeTeacherIndex = plantillaDocentes.findIndex(d => !evaluacionesEstado[d.id]);
            if (activeTeacherIndex === -1) activeTeacherIndex = 0;

            document.getElementById('eval-start-screen').style.display = 'flex';
            document.getElementById('eval-question-screen').style.display = 'none';
            document.getElementById('eval-transition-screen').style.display = 'none';
        }
    }

    // Función principal invocada al hacer click en el botón "INICIAR EVALUACIÓN AHORA"
    function startEval() {
        document.getElementById('eval-start-screen').style.display = 'none';
        document.getElementById('eval-question-screen').style.display = 'flex';
        
        currentQuestionIdx = 0;
        loadTeacherCuestionario();
    }

    function loadTeacherCuestionario() {
        const docente = plantillaDocentes[activeTeacherIndex];

        document.getElementById('eval-teacher-active-avatar').src = docente.avatar;
        document.getElementById('eval-teacher-active-name').textContent = docente.name;
        document.getElementById('eval-teacher-active-subject').textContent = docente.subject;
        document.getElementById('eval-teacher-active-counter').textContent = `Profesor ${activeTeacherIndex + 1} de 4`;

        loadEvalQuestion();
    }

    function loadEvalQuestion() {
        document.getElementById('eval-question-num').textContent = `REACTIVO ${currentQuestionIdx + 1} DE 5`;
        document.getElementById('eval-question-progress-bar').style.width = `${(currentQuestionIdx + 1) * 20}%`;
        document.getElementById('eval-question-text').textContent = evalQuestions[currentQuestionIdx];

        const optionsContainer = document.getElementById('eval-options-container');
        optionsContainer.innerHTML = '';
        selectedOptionIdx = null;
        document.getElementById('eval-next-btn').disabled = true;

        const options = [
            "Totalmente de Acuerdo",
            "De Acuerdo",
            "Neutral / Indiferente",
            "En Desacuerdo",
            "Totalmente en Desacuerdo"
        ];

        options.forEach((optText, idx) => {
            const btn = document.createElement('div');
            btn.style.cssText = "padding: 12px 18px; border: 1px solid #cbd5e1; border-radius: 10px; cursor: pointer; font-size: 0.9rem; font-weight: 600; color: #475569; background: white; transition: all 0.2s;";
            btn.innerHTML = optText;
            btn.onclick = () => selectEvalOption(idx, btn);
            optionsContainer.appendChild(btn);
        });
    }

    function selectEvalOption(idx, element) {
        selectedOptionIdx = idx;
        const options = document.querySelectorAll('#eval-options-container > div');
        options.forEach(opt => {
            opt.style.background = 'white';
            opt.style.color = '#475569';
            opt.style.borderColor = '#cbd5e1';
        });

        element.style.background = 'rgba(99, 102, 241, 0.08)';
        element.style.color = 'var(--primary)';
        element.style.borderColor = 'var(--primary)';

        document.getElementById('eval-next-btn').disabled = false;
    }

    function nextEvalQuestion() {
        currentQuestionIdx++;

        if (currentQuestionIdx < 5) {
            loadEvalQuestion();
        } else {
            // Guardar evaluacion del docente actual
            const docente = plantillaDocentes[activeTeacherIndex];
            evaluacionesEstado[docente.id] = true;
            localStorage.setItem('alumno_evaluaciones_por_docente', JSON.stringify(evaluacionesEstado));
            
            // Actualizar barra de progreso de la izquierda
            renderProgresoGlobal();

            // Ocultar pantalla de preguntas
            document.getElementById('eval-question-screen').style.display = 'none';

            // Comprobar si hay más docentes por evaluar
            const siguienteDocentePendiente = plantillaDocentes.findIndex(d => !evaluacionesEstado[d.id]);
            
            if (siguienteDocentePendiente !== -1) {
                // Hay más docentes, transición rápida animada
                document.getElementById('eval-transition-text').innerHTML = `Has enviado la retroalimentación de <strong>${docente.name}</strong> con éxito.`;
                document.getElementById('eval-transition-screen').style.display = 'flex';
                
                setTimeout(() => {
                    document.getElementById('eval-transition-screen').style.display = 'none';
                    document.getElementById('eval-question-screen').style.display = 'flex';
                    
                    activeTeacherIndex = siguienteDocentePendiente;
                    currentQuestionIdx = 0;
                    loadTeacherCuestionario();
                }, 1800);
            } else {
                // Todos evaluados, liberar y mostrar pantalla final exitosa
                localStorage.setItem('alumno_evaluacion_docente', 'true');
                renderProgresoGlobal(); // Forzar render de estado liberado
                
                document.getElementById('eval-result-screen').style.display = 'flex';
            }
        }
    }

    // Arrancar la inicialización de forma segura
    initEvaluaciones();
</script>
