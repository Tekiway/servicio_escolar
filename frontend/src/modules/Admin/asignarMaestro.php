<div class="asignar-vertical-container">
    <div class="main-card-header">
        <i class='bx bxs-user-check'></i>
        <div>
            <h3>Nueva Asignación de Materia a Docente</h3>
            <p>Sigue los pasos para vincular una materia con un maestro.</p>
        </div>
    </div>

    <div class="section-panel">
        <div class="section-title">
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
                    <div class="item-selection selected">
                        <strong>Estructura de Datos</strong>
                        <small>Semestre 3 • 4 Créditos</small>
                    </div>
                    <div class="item-selection">
                        <strong>Bases de Datos</strong>
                        <small>Semestre 3 • 4 Créditos</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="section-divider">

    <div class="section-panel">
        <div class="section-title">
            <span class="step-num">2</span>
            <h4>Seleccionar Docente</h4>
        </div>
        <div class="section-body">
            <div class="search-box">
                <input type="text" placeholder="Buscar docente por nombre..." class="modern-input-small search-icon">
            </div>
            <div class="docentes-flex-list">
                <div class="user-card selected">
                    <div class="user-img"><i class='bx bxs-user-circle'></i></div>
                    <div class="user-info">
                        <p class="u-name">Heber Castañeda</p>
                        <p class="u-email">heber@instituto.edu.mx</p>
                        <span class="badge load-low">Carga baja</span>
                    </div>
                    <div class="check-icon"><i class='bx bxs-check-circle'></i></div>
                </div>
                <div class="user-card">
                    <div class="user-img"><i class='bx bxs-user-circle'></i></div>
                    <div class="user-info">
                        <p class="u-name">Sindy Ximena</p>
                        <p class="u-email">sindy@instituto.edu.mx</p>
                        <span class="badge load-full">Tiempo completo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="section-divider">

    <div class="section-panel config-section">
        <div class="section-title">
            <span class="step-num">3</span>
            <h4>Confirmar y Configurar</h4>
        </div>
        <div class="section-body">
            <div class="summary-area">
                <div class="summary-item"><strong>Materia:</strong> Estructura de Datos (TICs)</div>
                <div class="summary-item"><strong>Docente:</strong> Heber Castañeda</div>
            </div>
            <div class="form-grid-3cols">
                <input type="text" placeholder="Grupo (Ej: T6A)" class="modern-input-small">
                <input type="text" placeholder="Aula (Ej: Lab 1)" class="modern-input-small">
                <input type="text" placeholder="Horario (Ej: Lun 7-9)" class="modern-input-small">
            </div>
            <div class="action-buttons-row">
                <button class="btn-cancel">Cancelar</button>
                <button class="btn-confirm-load">Finalizar Asignación</button>
            </div>
        </div>
    </div>
</div>