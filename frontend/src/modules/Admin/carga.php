<div class="main-card-carga">
    <div class="header-carga">
        <div class="icon-carga-box"><i class='bx bx-cog'></i></div>
        <div class="info-carga">
            <h2>Gestión de Carga Académica</h2>
            <p>Administración de docentes, planes de estudio y datos institucionales.</p>
        </div>
    </div>

    <div class="body-carga">
        <div class="section-container">
            <div class="section-title" onclick="toggleSeccion('form-reg', 'ico-reg')">
                <div class="header-left">
                    <i id="ico-reg" class='bx bx-chevron-down'></i>
                    <i class='bx bx-user-plus' style="color: #a855f7;"></i>
                    <span>Registro de Docentes</span>
                </div>
            </div>
            <div id="form-reg" class="seccion-colapsable">
                <form id="form-registrar-docente" class="form-carga-grid">
                    <div class="carga-input-group">
                        <label>NOMBRE COMPLETO DEL DOCENTE</label>
                        <input type="text" name="nombre_docente" placeholder="Ej. Juan Pérez García" required>
                    </div>
                    <div class="carga-row-2col">
                        <div class="carga-input-group">
                            <label>NÚMERO DE EMPLEADO / RFC</label>
                            <input type="text" name="rfc_docente" placeholder="RFC o Clave" required>
                        </div>
                        <div class="carga-input-group">
                            <label>SELECCIONAR CARRERA</label>
                            <select name="id_carrera" required>
                                <option value="" disabled selected>Seleccionar Carrera...</option>
                                <option value="1">Ingeniería en TICs</option>
                            </select>
                        </div>
                    </div>
                    <div class="carga-actions">
                        <button type="submit" class="btn-registrar-docente">
                            <i class='bx bx-save'></i> Registrar Docente
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="section-container" style="margin-top: 25px;">
            <div class="section-title" onclick="toggleSeccion('tabla-doc', 'ico-tab')">
                <div class="header-left">
                    <i id="ico-tab" class='bx bx-chevron-down'></i>
                    <i class='bx bx-list-ul' style="color: #a855f7;"></i>
                    <span>Docentes en el Sistema</span>
                </div>
            </div>
            <div id="tabla-doc" class="seccion-colapsable">
                <div class="table-container-responsive">
                    <table class="tabla-sistema">
                        <thead>
                            <tr>
                                <th>NOMBRE DEL DOCENTE</th>
                                <th>RFC / CLAVE</th>
                                <th>CARRERA ASIGNADA</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><b>Juan Pérez García</b></td>
                                <td>RFC12345678</td>
                                <td>Ingeniería en TICs</td>
                                <td class="acciones-celda-fija">
                                    <div class="acciones-group-flex">
                                        <button class="btn-action-view" onclick="abrirModalEditar({id:'1', nombre:'Juan Pérez García', rfc:'RFC12345678', carrera:'1'})">
                                            <i class='bx bx-edit-alt'></i>
                                        </button>
                                        <button class="btn-action-delete" onclick="eliminarDocente('1', 'Juan Pérez García')">
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
    </div>
</div>

<div id="modal-editar-docente" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <div class="header-left-content">
                <i class='bx bxs-user-detail' style="font-size: 2.2rem; color: #a855f7;"></i>
                <div class="header-texts">
                    <input type="text" id="edit-header-nombre" class="modal-title-input" value="">
                    <p>Edición de Información del Docente</p>
                </div>
            </div>
            <span class="close-x" onclick="cerrarModalEditar()">&times;</span>
        </div>
        <div class="modal-body">
            <input type="hidden" id="edit-id">
            <div class="modal-form-row">
                <label>Nombre Completo</label>
                <input type="text" id="edit-nombre">
            </div>
            <div class="modal-form-row">
                <label>RFC / No. Empleado</label>
                <input type="text" id="edit-rfc">
            </div>
            <div class="modal-form-row">
                <label>Carrera Asignada</label>
                <select id="edit-carrera">
                    <option value="1">Ingeniería en TICs</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn-guardar-cambios" onclick="guardarCambios()">
                <i class='bx bx-check-double'></i> Guardar Cambios
            </button>
            <button class="btn-aceptar-modal" onclick="cerrarModalEditar()">
                <i class='bx bx-check'></i> Aceptar
            </button>
        </div>
    </div>
</div>