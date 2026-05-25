
<div class="modulo-carreras">
    <header class="carreras-header">
        <div class="icon-graduacion-wrapper">
            <i class='bx bxs-graduation'></i>
        </div>
        <h1>Gestión de Carreras Universitarias</h1>
        <p>Administración de programas académicos y oferta educativa institucional.</p>
    </header>

    <div class="carreras-card section-panel active" id="carrera1">
        <div class="carreras-card-header" onclick="togglePanel('carrera1')" style="cursor: pointer;">
            <div class="toggle-icon-custom"></div> 
            <span>REGISTRAR NUEVA CARRERA</span>
        </div>
        
        <div class="carreras-card-body section-body">
            <form id="form-registrar-carrera">
                <input type="hidden" name="id_carrera_edit" id="id_carrera_edit">

                <div class="form-grid-2cols">
                    <div class="input-field">
                        <label>NOMBRE OFICIAL DE LA CARRERA</label>
                        <input type="text" name="nombre_carrera" placeholder="Ej. Ingeniería en TICs" required>
                    </div>
                    <div class="input-field">
                        <label>MODALIDAD DE ESTUDIO</label>
                        <select name="modalidad" required>
                            <option value="" disabled selected>Seleccionar modalidad...</option>
                            <option value="Escolarizada">Escolarizada</option>
                            <option value="Mixta">Mixta</option>
                        </select>
                    </div>

                    <div class="input-field">
                        <label>CLAVE OFICIAL (SEP/TECNM)</label>
                        <input type="text" name="clave_carrera" placeholder="Ej. ITIC-2010-225" required>
                    </div>
                    <div class="input-field">
                        <label>DURACIÓN (NÚMERO DE SEMESTRES)</label>
                        <input type="number" name="duracion" placeholder="Ej. 9" min="1" max="15" required>
                    </div>

                    <div class="input-field">
                        <label>ESTADO DE LA CARRERA</label>
                        <select name="estado_carrera" required>
                            <option value="Activa">Activa</option>
                            <option value="En Liquidación">En Liquidación</option>
                        </select>
                    </div>

                    <div class="input-field field-full">
                        <label>OBJETIVO DE LA CARRERA</label>
                        <textarea name="objetivo_carrera" placeholder="Describe el propósito principal..." rows="3"></textarea>
                    </div>

                    <div class="input-field">
                        <label>PERFIL DE INGRESO</label>
                        <textarea name="perfil_ingreso" placeholder="Habilidades deseadas..." rows="4"></textarea>
                    </div>
                    <div class="input-field">
                        <label>PERFIL DE EGRESO</label>
                        <textarea name="perfil_egreso" placeholder="Competencias obtenidas..." rows="4"></textarea>
                    </div>
                </div>

                <div class="carreras-form-actions">
                    <button type="submit" class="btn-guardar-carrera">
                        <i class='bx bx-save'></i> GUARDAR CARRERA EN SISTEMA
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="carreras-card section-panel active" id="panelCarrerasLista" style="margin-top: 30px;">
        <div class="carreras-card-header" onclick="togglePanel('panelCarrerasLista')" style="cursor: pointer;">
            <div class="toggle-icon-custom"></div> 
            <span>CARRERAS REGISTRADAS (VISTA TÉCNICA)</span>
        </div>
        
        <div class="carreras-card-body section-body">
            <div class="table-container-responsive">
                <table class="tabla-docentes">
                    <thead>
                        <tr>
                            <th>Carrera</th>
                            <th>Clave</th>
                            <th>Modalidad</th>
                            <th>Duración</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-carreras-body">
                        <tr>
                            <td><b>Ingeniería en TICs</b></td>
                            <td>ITIC-2010-225</td>
                            <td>Escolarizada</td>
                            <td>9 Sem.</td>
                            <td><span class="status-pill active">Activa</span></td>
                            <td>
                                <div class="acciones-group">
                                    <button class="btn-action-view" onclick="abrirModalCarrera({
                                        id: '1',
                                        nombre: 'Ingeniería en TICs',
                                        clave: 'ITIC-2010-225',
                                        modalidad: 'Escolarizada',
                                        duracion: '9',
                                        estado: 'Activa',
                                        objetivo: 'Formar profesionales...',
                                        ingreso: 'Habilidades lógicas...',
                                        egreso: 'Competencias...',
                                    })">
                                        <i class='bx bxs-file-find'></i> Detalles
                                    </button>

                                    <button type="button" class="btn-action-delete" title="Eliminar Carrera" 
                                        onclick="eliminarCarrera('1', 'Ingeniería en TICs')">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="modalCarrera">
        <div class="modal-card">
            <form id="form-editar-modal"> <div class="modal-header">
                    <div class="modal-header-title">
                        <i class='bx bxs-school'></i>
                        <div>
                            <h2 id="modal-nombre-text"></h2>
                            <input type="text" id="modal-nombre-input" name="nombre_carrera" class="modal-input-edit" style="display:none; font-size: 1.2rem; width: 100%;">
                            <small>Detalles Académicos Completos</small>
                        </div>
                    </div>
                    <button type="button" class="modal-close" onclick="cerrarModalCarrera()">
                        <i class='bx bx-x'></i>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="modal-id-carrera" name="id_carrera_edit">
                    
                    <div class="modal-tabs">
                        <button type="button" class="tab-btn active" onclick="switchTab('tab-general')">General</button>
                        <button type="button" class="tab-btn" onclick="switchTab('tab-academico')">Académico</button>
                    </div>

                    <div class="tab-content active" id="tab-general">
                        <div class="detail-grid">
                            <div class="detail-item">
                                <label>Clave:</label> 
                                <span id="modal-clave-text"></span>
                                <input type="text" id="modal-clave-input" name="clave_carrera" class="modal-input-edit" style="display:none;">
                            </div>
                            <div class="detail-item">
                                <label>Modalidad:</label> 
                                <span id="modal-modalidad-text"></span>
                                <select id="modal-modalidad-input" name="modalidad" class="modal-input-edit" style="display:none;">
                                    <option value="Escolarizada">Escolarizada</option>
                                    <option value="Mixta">Mixta</option>
                                </select>
                            </div>
                            <div class="detail-item">
                                <label>Duración:</label> 
                                <span id="modal-duracion-text"></span>
                                <input type="number" id="modal-duracion-input" name="duracion" class="modal-input-edit" style="display:none;">
                            </div>
                            <div class="detail-item">
                                <label>Estatus:</label> 
                                <span class="status-pill active" id="modal-estado-text"></span>
                                <select id="modal-estado-input" name="estado_carrera" class="modal-input-edit" style="display:none;">
                                    <option value="Activa">Activa</option>
                                    <option value="En Liquidación">En Liquidación</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" id="tab-academico">
                        <div class="detail-block">
                            <label>OBJETIVO GENERAL:</label>
                            <p id="modal-objetivo-text"></p>
                            <textarea id="modal-objetivo-input" name="objetivo_carrera" class="modal-input-edit" style="display:none;" rows="3"></textarea>
                        </div>
                        <div class="detail-block">
                            <label>PERFIL DE INGRESO:</label>
                            <p id="modal-ingreso-text"></p>
                            <textarea id="modal-ingreso-input" name="perfil_ingreso" class="modal-input-edit" style="display:none;" rows="3"></textarea>
                        </div>
                        <div class="detail-block">
                            <label>PERFIL DE EGRESO:</label>
                            <p id="modal-egreso-text"></p>
                            <textarea id="modal-egreso-input" name="perfil_egreso" class="modal-input-edit" style="display:none;" rows="3"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="btn-editar-modal" class="btn-action-view" 
                        onclick="prepararEdicionDesdeModal();">
                        <i class='bx bx-edit-alt'></i> Editar Todo
                    </button>
                    
                    <button type="button" id="btn-guardar-modal" class="btn-action-view" 
                        style="display:none; color:white; background:#22c55e; border-color:#22c55e; margin-right:10px;" 
                        onclick="enviarEdicionModal();">
                        <i class='bx bx-check-double'></i> Guardar Cambios
                    </button>

                    <button type="button" class="btn-action-view" onclick="cerrarModalCarrera()">
                        <i class='bx bx-check'></i> Aceptar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>