<div class="main-card-carga">
    <div class="header-carga">
        <div class="icon-carga-box" style="background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); box-shadow: 0 8px 20px rgba(59,130,246,0.1);"><i class='bx bxs-user-detail' style="color:#2563eb;"></i></div>
        <div class="info-carga">
            <h2>Gestión de Alumnos</h2>
            <p>Inscripción directa, asignación de grupos y credenciales de acceso al portal estudiantil.</p>
        </div>
    </div>

    <div class="body-carga">
        <!-- SECCIÓN: REGISTRO -->
        <div class="section-container">
            <div class="section-title" onclick="toggleSeccion('form-reg-alumno', 'ico-reg-al')">
                <div class="header-left">
                    <i id="ico-reg-al" class='bx bx-chevron-down'></i>
                    <i class='bx bx-user-plus' style="color: #2563eb;"></i>
                    <span>Inscribir Nuevo Alumno</span>
                </div>
            </div>
            <div id="form-reg-alumno" class="seccion-colapsable">
                <form class="form-carga-grid">
                    <div class="carga-row-3col">
                        <div class="carga-input-group"><label>NOMBRE(S) *</label><input type="text" placeholder="Ej. Ana"></div>
                        <div class="carga-input-group"><label>APELLIDO PATERNO *</label><input type="text" placeholder="Ej. López"></div>
                        <div class="carga-input-group"><label>APELLIDO MATERNO</label><input type="text" placeholder="Ej. Díaz"></div>
                    </div>
                    <div class="carga-row-3col">
                        <div class="carga-input-group"><label>CURP *</label><input type="text" placeholder="18 caracteres"></div>
                        <div class="carga-input-group"><label>SEXO</label><select><option>Femenino</option><option>Masculino</option></select></div>
                        <div class="carga-input-group"><label>TELÉFONO</label><input type="text" placeholder="10 dígitos"></div>
                    </div>
                    <div class="carga-row-3col">
                        <div class="carga-input-group"><label>MATRÍCULA *</label><input type="text" placeholder="Ej. AL-2026-001"></div>
                        <div class="carga-input-group"><label>CORREO INSTITUCIONAL *</label><input type="email" placeholder="ana.lopez@escuela.edu.mx"></div>
                        <div class="carga-input-group"><label>USUARIO (LOGIN) *</label><input type="text" placeholder="Usuario para el portal"></div>
                    </div>
                    <div class="carga-row-3col">
                        <div class="carga-input-group"><label>CARRERA *</label><select><option>Ing. en TICs</option><option>Administración</option></select></div>
                        <div class="carga-input-group"><label>SEMESTRE</label><select><option>1ro</option><option>2do</option></select></div>
                        <div class="carga-input-group"><label>GRUPO ASIGNADO</label><select><option>Sin asignar</option><option>1ro A</option></select></div>
                    </div>
                    <div class="carga-row-2col">
                        <div class="carga-input-group"><label>CONTRASEÑA INICIAL *</label><input type="password" placeholder="Mínimo 6 caracteres"></div>
                    </div>
                    <div class="carga-actions">
                        <button type="button" onclick="registrarAlumnoManual()" class="btn-registrar-docente" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);"><i class='bx bx-save'></i> Inscribir Alumno</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- SECCIÓN: TABLA -->
        <div class="section-container" style="margin-top: 25px;">
            <div class="section-title">
                <div class="header-left"><i class='bx bx-list-ul' style="color: #2563eb;"></i><span>Alumnos Inscritos</span></div>
            </div>
            <div class="table-container-responsive">
                <table class="tabla-sistema">
                    <thead>
                        <tr>
                            <th>NOMBRE</th>
                            <th>MATRÍCULA / CORREO</th>
                            <th>CARRERA</th>
                            <th>SEM. / GRUPO</th>
                            <th>ESTATUS</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Ana López Díaz</b><br><small>CURP: LODA040101MDFXXX0</small></td>
                            <td>AL-2026-001<br><small>ana.lopez@escuela.edu.mx</small></td>
                            <td>Ing. en TICs</td>
                            <td>1ro<br><small>Grupo A</small></td>
                            <td><span style="background:#d1fae5;color:#065f46;padding:3px 10px;border-radius:20px;font-size:0.78rem;font-weight:700;">Activo</span></td>
                            <td>
                                <div class="acciones-group-flex">
                                    <button class="btn-action-view" title="Editar"><i class='bx bx-edit-alt'></i></button>
                                    <button class="btn-action-view" style="background:rgba(245,158,11,.15);color:#d97706;" title="Reset Password"><i class='bx bx-lock-open-alt'></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Editar Accesos -->
    <div id="modal-editar-acceso-alumno" class="modal-expediente" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; justify-content:center; align-items:center;">
        <div class="modal-content" style="background:white; padding:30px; border-radius:15px; width:400px; max-width:90%;">
            <h3 style="margin-top:0; color:#1e293b; display:flex; align-items:center; gap:10px;"><i class='bx bx-lock-open-alt' style="color:#d97706;"></i> Editar Credenciales</h3>
            <p style="color:#64748b; font-size:0.9rem; margin-bottom:20px;">Actualiza el usuario de login o la contraseña de este alumno.</p>
            
            <input type="hidden" id="edit-id-alumno">
            
            <div class="carga-input-group" style="margin-bottom:15px;">
                <label>NUEVO USUARIO (LOGIN)</label>
                <input type="text" id="edit-user-alumno" placeholder="Escribe el nuevo usuario..." style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
            </div>
            
            <div class="carga-input-group" style="margin-bottom:25px;">
                <label>NUEVA CONTRASEÑA</label>
                <input type="text" id="edit-pass-alumno" placeholder="Dejar en blanco para no cambiarla" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
            </div>
            
            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <button onclick="document.getElementById('modal-editar-acceso-alumno').style.display='none'" class="btn-outline" style="padding:8px 15px; border-radius:8px; border:1px solid #cbd5e1; background:white; cursor:pointer;">Cancelar</button>
                <button onclick="guardarNuevosAccesosAlumno()" class="btn-primary" style="padding:8px 15px; border-radius:8px; background:#2563eb; color:white; border:none; cursor:pointer;">Guardar Cambios</button>
            </div>
        </div>
    </div>
    <!-- Modal Editar Datos Alumno -->
    <div id="modal-editar-datos-alumno" class="modal-expediente" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; justify-content:center; align-items:center;">
        <div class="modal-content" style="background:white; padding:30px; border-radius:15px; width:600px; max-width:90%;">
            <h3 style="margin-top:0; color:#1e293b; display:flex; align-items:center; gap:10px;"><i class='bx bx-edit' style="color:#2563eb;"></i> Editar Alumno</h3>
            
            <input type="hidden" id="edit-id-datos-alumno">
            
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px; margin-bottom:15px; max-height: 400px; overflow-y: auto; padding-right:10px;">
                <div class="carga-input-group">
                    <label>NOMBRE</label>
                    <input type="text" id="edit-nombre-alumno" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                </div>
                
                <div class="carga-input-group">
                    <label>APELLIDOS</label>
                    <input type="text" id="edit-apellidos-alumno" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                </div>

                <div class="carga-input-group">
                    <label>CURP</label>
                    <input type="text" id="edit-curp-alumno" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                </div>

                <div class="carga-input-group">
                    <label>SEXO</label>
                    <select id="edit-sexo-alumno" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                        <option>Masculino</option><option>Femenino</option><option>Otro</option>
                    </select>
                </div>

                <div class="carga-input-group">
                    <label>TELÉFONO</label>
                    <input type="text" id="edit-telefono-alumno" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                </div>

                <div class="carga-input-group">
                    <label>MATRÍCULA</label>
                    <input type="text" id="edit-matricula-alumno" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                </div>

                <div class="carga-input-group">
                    <label>CORREO INSTITUCIONAL</label>
                    <input type="email" id="edit-email-alumno" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                </div>

                <div class="carga-input-group">
                    <label>USUARIO (LOGIN)</label>
                    <input type="text" id="edit-username-alumno" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                </div>

                <div class="carga-input-group">
                    <label>CARRERA</label>
                    <select id="edit-carrera-alumno" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                        <option>Ing. Sistemas</option><option>Lic. Administración</option><option>Lic. Derecho</option>
                    </select>
                </div>

                <div class="carga-input-group">
                    <label>SEMESTRE</label>
                    <select id="edit-semestre-alumno" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                        <option>1ro</option><option>2do</option><option>3ro</option><option>4to</option>
                    </select>
                </div>

                <div class="carga-input-group">
                    <label>GRUPO</label>
                    <input type="text" id="edit-grupo-alumno" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                </div>

                <div class="carga-input-group">
                    <label>ESTATUS</label>
                    <select id="edit-status-alumno" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                        <option>Activo</option><option>Inactivo</option><option>Baja</option><option>Egresado</option>
                    </select>
                </div>
            </div>
            
            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <button onclick="document.getElementById('modal-editar-datos-alumno').style.display='none'" class="btn-outline" style="padding:8px 15px; border-radius:8px; border:1px solid #cbd5e1; background:white; cursor:pointer;">Cancelar</button>
                <button onclick="guardarDatosAlumno()" class="btn-primary" style="padding:8px 15px; border-radius:8px; background:#2563eb; color:white; border:none; cursor:pointer;">Guardar</button>
            </div>
        </div>
    </div>
</div>
<script src="./frontend/src/modules/Admin/js/alumnosAdmin.js?v=3"></script>
