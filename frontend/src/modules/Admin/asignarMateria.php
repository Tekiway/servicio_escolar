<div class="asignar-vertical-container">
    <div class="main-card-header">
        <i class='bx bxs-user-check'></i>
        <div>
            <h3>Nueva Asignación de Materia a Docente</h3>
            <p>Sigue los pasos para vincular una materia con un maestro.</p>
        </div>
    </div>

    <!-- PASO 1 -->
    <div class="section-panel active" id="panel-1">
        <div class="section-title" onclick="togglePanel('panel-1')">
            <span class="step-num">1</span>
            <h4>Seleccionar Materia Base</h4>
        </div>
        <div class="section-body">
            <div class="form-grid-2cols">
                <div>
                    <label>Carrera</label>
                    <select class="modern-input-small">
                        <option>Ingeniería en TICs</option>
                    </select>
                </div>
                <div>
                    <label>Periodo Académico</label>
                    <select class="modern-input-small">
                        <option>2024 - 2 (Actual)</option>
                    </select>
                </div>
            </div>
            <div class="materias-selection-area">
                <p class="area-label">Materias Disponibles:</p>
                <div class="materias-flex-list">
                    <!-- Dinámico: JS llena esto -->
                </div>
            </div>
        </div>
    </div>

    <!-- PASO 2 -->
    <div class="section-panel active" id="panel-2">
        <div class="section-title" onclick="togglePanel('panel-2')">
            <span class="step-num">2</span>
            <h4>Seleccionar Docente</h4>
        </div>
        <div class="section-body">
            <div class="search-box">
                <input type="text" placeholder="Buscar docente por nombre..." class="modern-input-small search-icon">
            </div>
            <div class="docentes-flex-list">
                <!-- Dinámico: JS llena esto -->
            </div>
        </div>
    </div>

    <!-- PASO 3 -->
    <div class="section-panel active" id="panel-3">
        <div class="section-title" onclick="togglePanel('panel-3')">
            <span class="step-num">3</span>
            <h4>Confirmar y Configurar</h4>
        </div>
        <div class="section-body">
            <div class="summary-area">
                <div class="summary-item"><strong>Materia:</strong> Estructura de Datos</div>
                <div class="summary-item"><strong>Docente:</strong> Heber Castañeda</div>
            </div>
            <div class="form-grid-3cols">
                <input type="text" id="asignar-grupo" placeholder="Ej. A" class="modern-input-small">
                <input type="text" id="asignar-aula" placeholder="Ej. Aula 101" class="modern-input-small">
                <input type="text" id="asignar-horario" placeholder="Ej. L-V 08:00 - 09:00" class="modern-input-small">
            </div>
            <div class="action-buttons-row">
                <button class="btn-cancel" onclick="reiniciarAsignacion()">Cancelar</button>
                <button class="btn-confirm-load" id="btn-confirm-asignacion" onclick="finalizarAsignacion()">Finalizar Asignación</button>
            </div>
        </div>
    </div>
</div>
<script src="./frontend/src/modules/Admin/js/asignarMateria.js?v=1"></script>


