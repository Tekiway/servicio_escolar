<div class="main-card-carga">
    <div class="header-carga">
        <div class="icon-carga-box" style="background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%); box-shadow: 0 8px 20px rgba(219,39,119,0.1);"><i class='bx bxs-briefcase' style="color:#db2777;"></i></div>
        <div class="info-carga">
            <h2>Gestión Administrativa</h2>
            <p>Registro de personal de finanzas, control escolar, directivos y sus accesos al sistema.</p>
        </div>
    </div>

    <div class="body-carga">
        <div class="section-container">
            <div class="section-title" onclick="toggleSeccion('form-reg-personal', 'ico-reg-pers')">
                <div class="header-left">
                    <i id="ico-reg-pers" class='bx bx-chevron-down'></i>
                    <i class='bx bx-user-plus' style="color: #db2777;"></i>
                    <span>Nuevo Administrativo</span>
                </div>
            </div>
            <div id="form-reg-personal" class="seccion-colapsable">
                <form class="form-carga-grid">
                    <div class="carga-row-3col">
                        <div class="carga-input-group"><label>NOMBRE COMPLETO *</label><input type="text" placeholder="Ej. Roberto Torres"></div>
                        <div class="carga-input-group"><label>NO. EMPLEADO *</label><input type="text" placeholder="Ej. ADM-001"></div>
                        <div class="carga-input-group"><label>TELÉFONO</label><input type="text" placeholder="10 dígitos"></div>
                    </div>
                    <div class="carga-row-3col">
                        <div class="carga-input-group"><label>DEPARTAMENTO *</label><select><option>Finanzas / Caja</option><option>Servicios Escolares</option><option>Dirección</option></select></div>
                        <div class="carga-input-group"><label>PUESTO / CARGO *</label><input type="text" placeholder="Ej. Cajero Principal"></div>
                        <div class="carga-input-group"><label>CORREO INSTITUCIONAL *</label><input type="email" placeholder="roberto.t@escuela.edu.mx"></div>
                    </div>
                    <div class="carga-row-2col">
                        <div class="carga-input-group"><label>CONTRASEÑA INICIAL *</label><input type="password" placeholder="Mínimo 6 caracteres"></div>
                    </div>
                    <div class="carga-actions">
                        <button type="button" class="btn-registrar-docente" style="background: linear-gradient(135deg, #db2777 0%, #be185d 100%);"><i class='bx bx-save'></i> Registrar Personal</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="section-container" style="margin-top: 25px;">
            <div class="section-title">
                <div class="header-left"><i class='bx bx-list-ul' style="color: #db2777;"></i><span>Personal Activo</span></div>
            </div>
            <div class="table-container-responsive">
                <table class="tabla-sistema">
                    <thead>
                        <tr>
                            <th>NOMBRE</th>
                            <th>CONTACTO / NO. EMP.</th>
                            <th>DEPARTAMENTO</th>
                            <th>PUESTO</th>
                            <th>ESTATUS</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>Roberto Torres</b></td>
                            <td>ADM-001<br><small>roberto.t@escuela.edu.mx</small></td>
                            <td>Finanzas / Caja</td>
                            <td>Cajero Principal</td>
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
<script src="./frontend/src/modules/Admin/js/personalAdmin.js?v=1"></script>
