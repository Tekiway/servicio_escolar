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
                    <div class="carga-row-2col">
                        <div class="carga-input-group"><label>MATRÍCULA *</label><input type="text" placeholder="Ej. AL-2026-001"></div>
                        <div class="carga-input-group"><label>CORREO INSTITUCIONAL *</label><input type="email" placeholder="ana.lopez@escuela.edu.mx"></div>
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
                        <button type="button" class="btn-registrar-docente" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);"><i class='bx bx-save'></i> Inscribir Alumno</button>
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
</div>
<script src="./frontend/src/modules/Admin/js/alumnosAdmin.js?v=1"></script>
