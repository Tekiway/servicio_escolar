<div class="main-card-carga">
    <div class="header-carga">
        <div class="icon-carga-box"><i class='bx bx-cog'></i></div>
        <div class="info-carga">
            <h2>Gestión de Docentes</h2>
            <p>Registro completo, credenciales de acceso y administración del personal docente.</p>
        </div>
    </div>

    <div class="body-carga">

        <!-- ── SECCIÓN: REGISTRO DE DOCENTE ── -->
        <div class="section-container">
            <div class="section-title" onclick="toggleSeccion('form-reg', 'ico-reg')">
                <div class="header-left">
                    <i id="ico-reg" class='bx bx-chevron-down'></i>
                    <i class='bx bx-user-plus' style="color: #a855f7;"></i>
                    <span>Registro de Nuevo Docente</span>
                </div>
            </div>
            <div id="form-reg" class="seccion-colapsable">
                <form id="form-registrar-docente" class="form-carga-grid">

                    <!-- Fila 1: Nombre completo (3 columnas) -->
                    <div class="carga-row-3col">
                        <div class="carga-input-group">
                            <label>NOMBRE(S) <span style="color:#dc2626">*</span></label>
                            <input type="text" id="reg-nombre" placeholder="Ej. Juan Carlos" required>
                        </div>
                        <div class="carga-input-group">
                            <label>APELLIDO PATERNO <span style="color:#dc2626">*</span></label>
                            <input type="text" id="reg-apellido-paterno" placeholder="Ej. Pérez" required>
                        </div>
                        <div class="carga-input-group">
                            <label>APELLIDO MATERNO</label>
                            <input type="text" id="reg-apellido-materno" placeholder="Ej. García">
                        </div>
                    </div>

                    <!-- Fila 2: Email + Username -->
                    <div class="carga-row-2col">
                        <div class="carga-input-group">
                            <label>CORREO ELECTRÓNICO <span style="color:#dc2626">*</span></label>
                            <input type="email" id="reg-email" placeholder="juan.perez@escuela.edu.mx" required>
                        </div>
                        <div class="carga-input-group">
                            <label>USUARIO (LOGIN) <span style="color:#dc2626">*</span></label>
                            <input type="text" id="reg-username" placeholder="Ej. docjuan" required>
                        </div>
                    </div>

                    <!-- Fila 3: No. Empleado + Contraseña -->
                    <div class="carga-row-2col">
                        <div class="carga-input-group">
                            <label>NÚMERO DE EMPLEADO <span style="color:#dc2626">*</span></label>
                            <input type="text" id="reg-numero-empleado" placeholder="Ej. DOC-2026-001" required>
                        </div>
                        <div class="carga-input-group">
                            <label>CONTRASEÑA INICIAL <span style="color:#dc2626">*</span></label>
                            <div style="position:relative;">
                                <input type="password" id="reg-password" placeholder="Mínimo 6 caracteres" required
                                       style="padding-right:40px; width:100%; box-sizing:border-box;">
                                <i class='bx bx-show' id="toggle-pass-ico"
                                   onclick="toggleVerPass()"
                                   style="position:absolute;right:12px;top:50%;transform:translateY(-50%);cursor:pointer;color:#94a3b8;font-size:1.2rem;"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Fila 4: Especialidad + Formación Profesional + Carrera -->
                    <div class="carga-row-3col">
                        <div class="carga-input-group">
                            <label>ESPECIALIDAD QUE IMPARTE <span style="color:#dc2626">*</span></label>
                            <input type="text" id="reg-especialidad" placeholder="Ej. Matemáticas, Programación..." required>
                        </div>
                        <div class="carga-input-group">
                            <label>FORMACIÓN PROFESIONAL</label>
                            <input type="text" id="reg-formacion" list="lista-formaciones"
                                   placeholder="Ej. Ing. en Sistemas, Contador Público...">
                            <datalist id="lista-formaciones">
                                <option value="Ingeniero en Sistemas"></option>
                                <option value="Ingeniero en TICs"></option>
                                <option value="Ingeniero Industrial"></option>
                                <option value="Ingeniero Civil"></option>
                                <option value="Licenciado en Administración"></option>
                                <option value="Contador Público"></option>
                                <option value="Licenciado en Contaduría"></option>
                                <option value="Licenciado en Derecho"></option>
                                <option value="Licenciado en Gastronomía"></option>
                                <option value="Licenciado en Pedagogía"></option>
                                <option value="Maestro en Ciencias"></option>
                                <option value="Doctor en Ciencias"></option>
                            </datalist>
                        </div>
                        <div class="carga-input-group">
                            <label>CARRERA ASIGNADA <span style="color:#dc2626">*</span></label>
                            <select id="reg-carrera" required>
                                <option value="" disabled selected>Seleccionar Carrera...</option>
                                <option value="Ingeniería en TICs">Ingeniería en TICs</option>
                                <option value="Administración">Administración</option>
                                <option value="Contaduría">Contaduría</option>
                                <option value="Gastronomía">Gastronomía</option>
                            </select>
                        </div>
                    </div>

                    <!-- Fila 5: Grado + Contrato + Turno -->
                    <div class="carga-row-3col">
                        <div class="carga-input-group">
                            <label>GRADO ACADÉMICO</label>
                            <select id="reg-grado">
                                <option value="Licenciatura">Licenciatura</option>
                                <option value="Técnico Superior">Técnico Superior</option>
                                <option value="Maestría">Maestría</option>
                                <option value="Doctorado">Doctorado</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="carga-input-group">
                            <label>TIPO DE CONTRATO</label>
                            <select id="reg-contrato">
                                <option value="Tiempo Completo">Tiempo Completo</option>
                                <option value="Medio Tiempo">Medio Tiempo</option>
                                <option value="Por Horas">Por Horas</option>
                                <option value="Honorarios">Honorarios</option>
                            </select>
                        </div>
                        <div class="carga-input-group">
                            <label>TURNO</label>
                            <select id="reg-turno">
                                <option value="Matutino">Matutino</option>
                                <option value="Vespertino">Vespertino</option>
                                <option value="Nocturno">Nocturno</option>
                                <option value="Mixto">Mixto</option>
                            </select>
                        </div>
                    </div>

                    <!-- Fila 6: Teléfono + Fecha de Ingreso -->
                    <div class="carga-row-2col">
                        <div class="carga-input-group">
                            <label>TELÉFONO</label>
                            <input type="tel" id="reg-telefono" placeholder="Ej. 5512345678">
                        </div>
                        <div class="carga-input-group">
                            <label>FECHA DE INGRESO</label>
                            <input type="date" id="reg-fecha-ingreso">
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
                    <span>Docentes Registrados</span>
                </div>
                <button onclick="event.stopPropagation(); cargarTablaDocentes()" class="btn-refresh-tabla" title="Actualizar tabla">
                    <i class='bx bx-refresh'></i>
                </button>
            </div>
            <div id="tabla-doc" class="seccion-colapsable">
                <div class="table-container-responsive">
                    <table class="tabla-sistema">
                        <thead>
                            <tr>
                                <th>NOMBRE COMPLETO</th>
                                <th>EMAIL</th>
                                <th>USUARIO</th>
                                <th>CONTRASEÑA</th>
                                <th>NO. EMPLEADO</th>
                                <th>ESPECIALIDAD</th>
                                <th>CONTRATO / TURNO</th>
                                <th>ESTATUS</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody id="tabla-docentes-body">
                            <tr>
                                <td colspan="7" style="text-align:center; padding:20px; color:#94a3b8;">
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

<!-- ── MODAL: EDITAR DOCENTE ── -->
<div id="modal-editar-docente" class="modal-overlay">
    <div class="modal-content" style="max-width:650px; width:95%;">
        <div class="modal-header">
            <div class="header-left-content">
                <i class='bx bxs-user-detail' style="font-size: 2.2rem; color: #a855f7;"></i>
                <div class="header-texts">
                    <input type="text" id="edit-header-nombre" class="modal-title-input" value="">
                    <p>Edición de datos del Docente</p>
                </div>
            </div>
            <span class="close-x" onclick="cerrarModalEditar()">&times;</span>
        </div>
        <div class="modal-body" style="max-height: 500px; overflow-y: auto; padding-right:10px;">
            <input type="hidden" id="edit-id">

            <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:14px;">
                <div class="modal-form-row">
                    <label style="display:block; font-size:0.8rem; font-weight:700; color:#64748b; margin-bottom:5px;">Nombre(s)</label>
                    <input type="text" id="edit-nombre" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                </div>
                <div class="modal-form-row">
                    <label style="display:block; font-size:0.8rem; font-weight:700; color:#64748b; margin-bottom:5px;">Apellido Paterno</label>
                    <input type="text" id="edit-ap-paterno" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                </div>
                <div class="modal-form-row">
                    <label style="display:block; font-size:0.8rem; font-weight:700; color:#64748b; margin-bottom:5px;">Apellido Materno</label>
                    <input type="text" id="edit-ap-materno" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-top:14px;">
                <div class="modal-form-row">
                    <label style="display:block; font-size:0.8rem; font-weight:700; color:#64748b; margin-bottom:5px;">Email</label>
                    <input type="email" id="edit-email" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                </div>
                <div class="modal-form-row">
                    <label style="display:block; font-size:0.8rem; font-weight:700; color:#64748b; margin-bottom:5px;">Teléfono</label>
                    <input type="tel" id="edit-telefono" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-top:14px;">
                <div class="modal-form-row">
                    <label style="display:block; font-size:0.8rem; font-weight:700; color:#64748b; margin-bottom:5px;">No. Empleado</label>
                    <input type="text" id="edit-rfc" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                </div>
                <div class="modal-form-row">
                    <label style="display:block; font-size:0.8rem; font-weight:700; color:#64748b; margin-bottom:5px;">Especialidad que Imparte</label>
                    <input type="text" id="edit-especialidad" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-top:14px;">
                <div class="modal-form-row">
                    <label style="display:block; font-size:0.8rem; font-weight:700; color:#64748b; margin-bottom:5px;">Formación Profesional</label>
                    <input type="text" id="edit-formacion" list="lista-formaciones-edit"
                           placeholder="Ej. Ing. en Sistemas, Contador Público..." style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                    <datalist id="lista-formaciones-edit">
                        <option value="Ingeniero en Sistemas"></option>
                        <option value="Ingeniero en TICs"></option>
                        <option value="Ingeniero Industrial"></option>
                        <option value="Ingeniero Civil"></option>
                        <option value="Licenciado en Administración"></option>
                        <option value="Contador Público"></option>
                        <option value="Licenciado en Contaduría"></option>
                        <option value="Licenciado en Derecho"></option>
                        <option value="Licenciado en Gastronomía"></option>
                        <option value="Licenciado en Pedagogía"></option>
                        <option value="Maestro en Ciencias"></option>
                        <option value="Doctor en Ciencias"></option>
                    </datalist>
                </div>
                <div class="modal-form-row">
                    <label style="display:block; font-size:0.8rem; font-weight:700; color:#64748b; margin-bottom:5px;">Carrera Asignada</label>
                    <select id="edit-carrera" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                        <option value="Ingeniería en TICs">Ingeniería en TICs</option>
                        <option value="Administración">Administración</option>
                        <option value="Contaduría">Contaduría</option>
                        <option value="Gastronomía">Gastronomía</option>
                    </select>
                </div>
            </div>
            
            <div style="display:grid; grid-template-columns:1fr 1fr 1fr 1fr; gap:14px; margin-top:14px;">
                <div class="modal-form-row">
                    <label style="display:block; font-size:0.8rem; font-weight:700; color:#64748b; margin-bottom:5px;">Grado Académico</label>
                    <select id="edit-grado" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                        <option value="Licenciatura">Licenciatura</option>
                        <option value="Técnico Superior">Técnico Superior</option>
                        <option value="Maestría">Maestría</option>
                        <option value="Doctorado">Doctorado</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>
                <div class="modal-form-row">
                    <label style="display:block; font-size:0.8rem; font-weight:700; color:#64748b; margin-bottom:5px;">Tipo de Contrato</label>
                    <select id="edit-contrato" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                        <option value="Tiempo Completo">Tiempo Completo</option>
                        <option value="Medio Tiempo">Medio Tiempo</option>
                        <option value="Por Horas">Por Horas</option>
                        <option value="Honorarios">Honorarios</option>
                    </select>
                </div>
                <div class="modal-form-row">
                    <label style="display:block; font-size:0.8rem; font-weight:700; color:#64748b; margin-bottom:5px;">Turno</label>
                    <select id="edit-turno" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                        <option value="Matutino">Matutino</option>
                        <option value="Vespertino">Vespertino</option>
                        <option value="Nocturno">Nocturno</option>
                        <option value="Mixto">Mixto</option>
                    </select>
                </div>
                <div class="modal-form-row">
                    <label style="display:block; font-size:0.8rem; font-weight:700; color:#64748b; margin-bottom:5px;">Estatus</label>
                    <select id="edit-estatus" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                        <option value="Permiso">Permiso</option>
                    </select>
                </div>
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

<!-- ── MODAL: RESET CONTRASEÑA ── -->
<div id="modal-reset-pass" class="modal-overlay">
    <div class="modal-content" style="max-width:420px; width:95%;">
        <div class="modal-header">
            <div class="header-left-content">
                <i class='bx bx-lock-open-alt' style="font-size:2rem; color:#f59e0b;"></i>
                <div class="header-texts">
                    <h3 id="reset-pass-titulo" style="margin:0; font-size:1.1rem;">Restablecer Contraseña</h3>
                    <p>El docente podrá usar esta nueva contraseña</p>
                </div>
            </div>
            <span class="close-x" onclick="cerrarModalReset()">&times;</span>
        </div>
        <div class="modal-body">
            <input type="hidden" id="reset-docente-id">
            
            <div class="modal-form-row" style="margin-bottom:15px;">
                <label>NUEVO USUARIO (LOGIN)</label>
                <input type="text" id="reset-nuevo-username" placeholder="Nuevo usuario" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
            </div>

            <div class="modal-form-row">
                <label>NUEVA CONTRASEÑA</label>
                <div style="position:relative;">
                    <input type="password" id="reset-nueva-pass" placeholder="Dejar en blanco para no cambiar"
                           style="padding-right:40px; width:100%; box-sizing:border-box;">
                    <i class='bx bx-show' onclick="toggleVerPassReset()"
                       id="toggle-reset-ico"
                       style="position:absolute;right:12px;top:50%;transform:translateY(-50%);cursor:pointer;color:#94a3b8;font-size:1.2rem;"></i>
                </div>
            </div>
            <p id="reset-error" style="display:none; color:#dc2626; font-size:0.85rem; margin-top:8px;"></p>
        </div>
        <div class="modal-footer">
            <button id="btn-confirmar-reset" class="btn-guardar-cambios" style="background:linear-gradient(135deg,#f59e0b,#d97706);" onclick="confirmarResetPassword()">
                <i class='bx bx-lock-open-alt'></i> Restablecer Contraseña
            </button>
            <button class="btn-aceptar-modal" onclick="cerrarModalReset()">
                <i class='bx bx-x'></i> Cancelar
            </button>
        </div>
    </div>
</div>
