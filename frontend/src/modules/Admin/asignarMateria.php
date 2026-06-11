<div class="asignar-vertical-container">
    <div class="main-card-header">
        <i class='bx bx-calendar-plus'></i>
        <div>
            <h3>Asignar Materia y Horario</h3>
            <p>Construye el horario asignando materias a docentes en un grupo específico.</p>
        </div>
    </div>

    <!-- PASO 1: SELECCIONAR GRUPO Y MATERIA -->
    <div class="section-panel active" id="panel-1">
        <div class="section-title" onclick="togglePanel('panel-1')">
            <span class="step-num">1</span>
            <h4>Grupo y Materia Base</h4>
        </div>
        <div class="section-body">
            
            <!-- Nuevos Filtros -->
            <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:15px; margin-bottom:20px;">
                <div>
                    <label>Carrera</label>
                    <select class="modern-input-small">
                        <option value="" disabled selected>Selecciona Carrera...</option>
                        <option>Ingeniería en TICs</option>
                        <option>Administración</option>
                    </select>
                </div>
                <div>
                    <label>Semestre</label>
                    <select class="modern-input-small">
                        <option value="" disabled selected>Selecciona Semestre...</option>
                        <option value="1">1ro</option>
                        <option value="2">2do</option>
                        <option value="3">3ro</option>
                    </select>
                </div>
                <div>
                    <label>Grupo Creado</label>
                    <select class="modern-input-small">
                        <option value="" disabled selected>Selecciona Grupo...</option>
                        <option value="g1">1ro A - Matutino</option>
                        <option value="g2">1ro B - Vespertino</option>
                    </select>
                </div>
            </div>

            <div class="materias-selection-area">
                <p class="area-label">Materias del Semestre Seleccionado:</p>
                <div class="materias-flex-list">
                    <!-- Dinámico -->
                    <div class="materia-item" onclick="seleccionarMateria(this, 'Programación Web')">
                        <i class='bx bx-book'></i> Programación Web
                    </div>
                    <div class="materia-item" onclick="seleccionarMateria(this, 'Cálculo')">
                        <i class='bx bx-book'></i> Cálculo
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PASO 2: SELECCIONAR DOCENTE -->
    <div class="section-panel active" id="panel-2">
        <div class="section-title" onclick="togglePanel('panel-2')">
            <span class="step-num">2</span>
            <h4>Seleccionar Docente</h4>
        </div>
        <div class="section-body">
            <div class="search-box" style="margin-bottom:15px;">
                <input type="text" placeholder="Buscar docente por nombre o especialidad..." class="modern-input-small search-icon">
            </div>
            <div class="docentes-flex-list">
                <!-- Dinámico -->
                <div class="docente-item" onclick="seleccionarDocente(this, 'Juan Pérez')">
                    <img src="https://ui-avatars.com/api/?name=Juan+Perez&background=random" alt="Avatar">
                    <div class="docente-info">
                        <strong>Juan Pérez</strong>
                        <span>Especialidad: Sistemas</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PASO 3: CONFIGURAR HORARIO Y AULA -->
    <div class="section-panel active" id="panel-3">
        <div class="section-title" onclick="togglePanel('panel-3')">
            <span class="step-num">3</span>
            <h4>Días, Horas y Aula</h4>
        </div>
        <div class="section-body">
            <div class="summary-area" style="background:#f8fafc; border-left:4px solid #3b82f6; padding:15px; border-radius:8px; margin-bottom:20px;">
                <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:10px; font-size:0.9rem;">
                    <div><strong>Grupo:</strong> <span style="color:#3b82f6;">1ro A - TICs</span></div>
                    <div><strong>Materia:</strong> <span style="color:#3b82f6;" id="lbl-mat">Pendiente</span></div>
                    <div><strong>Docente:</strong> <span style="color:#3b82f6;" id="lbl-doc">Pendiente</span></div>
                </div>
            </div>

            <!-- Nuevo Grid exacto para Horarios -->
            <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:15px; margin-bottom:15px;">
                <div>
                    <label style="font-size:0.8rem; font-weight:700; color:#475569; display:block; margin-bottom:5px;">DÍA</label>
                    <select class="modern-input-small">
                        <option value="Lunes">Lunes</option>
                        <option value="Martes">Martes</option>
                        <option value="Miércoles">Miércoles</option>
                        <option value="Jueves">Jueves</option>
                        <option value="Viernes">Viernes</option>
                    </select>
                </div>
                <div>
                    <label style="font-size:0.8rem; font-weight:700; color:#475569; display:block; margin-bottom:5px;">AULA / LAB</label>
                    <input type="text" placeholder="Ej. Edificio B - Aula 10" class="modern-input-small">
                </div>
                <div>
                    <label style="font-size:0.8rem; font-weight:700; color:#475569; display:block; margin-bottom:5px;">TIPO DE SESIÓN</label>
                    <select class="modern-input-small">
                        <option value="Teoría">Teoría</option>
                        <option value="Práctica">Práctica / Lab</option>
                    </select>
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px; margin-bottom:20px;">
                <div>
                    <label style="font-size:0.8rem; font-weight:700; color:#475569; display:block; margin-bottom:5px;">HORA DE INICIO</label>
                    <input type="time" class="modern-input-small">
                </div>
                <div>
                    <label style="font-size:0.8rem; font-weight:700; color:#475569; display:block; margin-bottom:5px;">HORA DE FIN</label>
                    <input type="time" class="modern-input-small">
                </div>
            </div>

            <!-- Botón para agregar múltiples días a la misma materia -->
            <button class="btn-outline" style="background:transparent; border:2px dashed #cbd5e1; color:#64748b; padding:8px 15px; border-radius:8px; width:100%; margin-bottom:20px; cursor:pointer;">
                <i class='bx bx-plus'></i> Agregar otro día para esta misma materia
            </button>

            <div class="action-buttons-row">
                <button class="btn-cancel" onclick="reiniciarAsignacion()">Cancelar</button>
                <button class="btn-confirm-load" style="background:#3b82f6;" id="btn-confirm-asignacion" onclick="finalizarAsignacion()">
                    <i class='bx bx-check-double'></i> Confirmar Asignación en el Horario
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Simulación rápida para que el usuario lo pruebe visualmente
    function seleccionarMateria(el, nombre) {
        document.querySelectorAll('.materia-item').forEach(m => m.style.borderColor = '#e2e8f0');
        el.style.borderColor = '#3b82f6';
        document.getElementById('lbl-mat').textContent = nombre;
    }
    function seleccionarDocente(el, nombre) {
        document.querySelectorAll('.docente-item').forEach(d => d.style.borderColor = '#e2e8f0');
        el.style.borderColor = '#3b82f6';
        document.getElementById('lbl-doc').textContent = nombre;
    }
</script>
<script src="./frontend/src/modules/Admin/js/asignarMateria.js?v=2"></script>
