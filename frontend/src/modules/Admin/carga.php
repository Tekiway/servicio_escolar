<div class="main-card-carga">
    <div class="header-carga">
        <div class="icon-carga-box"><i class='bx bx-cog'></i></div>
        <div class="info-carga">
            <h2>Gestión de Carga Académica</h2>
            <p>Administración de docentes, planes de estudio y datos institucionales.</p>
        </div>
    </div>

    <div class="body-carga">

        <!-- ── SECCIÓN: REGISTRO DE DOCENTE ── -->
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

                    <!-- Fila 1: Nombre -->
                    <div class="carga-input-group">
                        <label>NOMBRE COMPLETO DEL DOCENTE</label>
                        <input type="text" id="reg-nombre" name="nombre_docente"
                               placeholder="Ej. Juan Pérez García" required>
                    </div>

                    <!-- Fila 2: Email + Username -->
                    <div class="carga-row-2col">
                        <div class="carga-input-group">
                            <label>CORREO ELECTRÓNICO</label>
                            <input type="email" id="reg-email" name="email_docente"
                                   placeholder="Ej. juan.perez@escuela.edu.mx" required>
                        </div>
                        <div class="carga-input-group">
                            <label>USUARIO (username)</label>
                            <input type="text" id="reg-username" name="username_docente"
                                   placeholder="Ej. juan.perez">
                        </div>
                    </div>

                    <!-- Fila 3: RFC + Contraseña -->
                    <div class="carga-row-2col">
                        <div class="carga-input-group">
                            <label>NÚMERO DE EMPLEADO / RFC</label>
                            <input type="text" id="reg-numero-empleado" name="rfc_docente"
                                   placeholder="RFC o Clave de empleado" required>
                        </div>
                        <div class="carga-input-group">
                            <label>CONTRASEÑA INICIAL</label>
                            <input type="password" id="reg-password" name="password_docente"
                                   placeholder="Contraseña de acceso" required>
                        </div>
                    </div>

                    <!-- Fila 4: Especialidad + Carrera -->
                    <div class="carga-row-2col">
                        <div class="carga-input-group">
                            <label>ESPECIALIDAD / ÁREA</label>
                            <input type="text" id="reg-especialidad" name="especialidad_docente"
                                   placeholder="Ej. Matemáticas, Programación...">
                        </div>
                        <div class="carga-input-group">
                            <label>CARRERA ASIGNADA</label>
                            <select id="reg-carrera" name="id_carrera" required>
                                <option value="" disabled selected>Seleccionar Carrera...</option>
                                <option value="Ingeniería en TICs">Ingeniería en TICs</option>
                                <option value="Administración">Administración</option>
                                <option value="Contaduría">Contaduría</option>
                                <option value="Gastronomía">Gastronomía</option>
                            </select>
                        </div>
                    </div>

                    <!-- Feedback de error -->
                    <div id="reg-error" style="display:none; color:#dc2626; font-size:0.85rem;
                         padding:10px 14px; background:rgba(220,38,38,.08);
                         border-radius:8px; border-left:4px solid #dc2626;">
                    </div>

                    <div class="carga-actions">
                        <button type="submit" id="btn-registrar-docente" class="btn-registrar-docente">
                            <i class='bx bx-save'></i> Registrar Docente
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- ── SECCIÓN: TABLA DE DOCENTES ── -->
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
                                <th>EMAIL</th>
                                <th>USUARIO</th>
                                <th>RFC / CLAVE</th>
                                <th>ESPECIALIDAD</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-docentes-body">
                            <tr>
                                <td colspan="6" style="text-align:center; padding:20px; color:#94a3b8;">
                                    <i class='bx bx-loader-alt bx-spin'></i> Cargando docentes...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div><!-- /body-carga -->
</div><!-- /main-card-carga -->

<!-- ── MODAL EDITAR DOCENTE ── -->
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
                <label>Email</label>
                <input type="email" id="edit-email">
            </div>
            <div class="modal-form-row">
                <label>RFC / No. Empleado</label>
                <input type="text" id="edit-rfc">
            </div>
            <div class="modal-form-row">
                <label>Especialidad / Carrera Asignada</label>
                <input type="text" id="edit-carrera">
            </div>
        </div>
        <div class="modal-footer">
            <button id="btn-guardar-edicion" class="btn-guardar-cambios" onclick="guardarCambios()">
                <i class='bx bx-check-double'></i> Guardar Cambios
            </button>
            <button class="btn-aceptar-modal" onclick="cerrarModalEditar()">
                <i class='bx bx-x'></i> Cancelar
            </button>
        </div>
    </div>
</div>
