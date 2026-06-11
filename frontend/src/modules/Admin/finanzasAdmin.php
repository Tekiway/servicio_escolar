<div class="main-card-carga">
    <div class="header-carga">
        <div class="icon-carga-box" style="background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%); box-shadow: 0 8px 20px rgba(34,197,94,0.1);"><i class='bx bxs-bank' style="color:#16a34a;"></i></div>
        <div class="info-carga">
            <h2>Gestión de Finanzas</h2>
            <p>Registro de personal contable, cajeros y control de sus accesos al Portal Financiero.</p>
        </div>
    </div>

    <div class="body-carga">
        <div class="section-container">
            <div class="section-title" onclick="toggleSeccion('form-reg-personal', 'ico-reg-pers')">
                <div class="header-left">
                    <i id="ico-reg-pers" class='bx bx-chevron-down'></i>
                    <i class='bx bx-user-plus' style="color: #16a34a;"></i>
                    <span>Nuevo Empleado de Finanzas</span>
                </div>
            </div>
            <div id="form-reg-personal" class="seccion-colapsable">
                <form class="form-carga-grid">
                    <div class="carga-row-3col">
                        <div class="carga-input-group"><label>NOMBRE COMPLETO *</label><input type="text" placeholder="Ej. Roberto Torres"></div>
                        <div class="carga-input-group"><label>NO. EMPLEADO *</label><input type="text" placeholder="Ej. FIN-001"></div>
                        <div class="carga-input-group"><label>TELÉFONO</label><input type="text" placeholder="10 dígitos"></div>
                    </div>
                    <div class="carga-row-3col">
                        <div class="carga-input-group"><label>PUESTO / CARGO *</label><input type="text" placeholder="Ej. Analista Financiero"></div>
                        <div class="carga-input-group"><label>CORREO INSTITUCIONAL *</label><input type="email" placeholder="roberto.t@escuela.edu.mx"></div>
                    </div>
                    <div class="carga-row-2col">
                        <div class="carga-input-group"><label>USUARIO (LOGIN) *</label><input type="text" placeholder="Ej. FIN001"></div>
                        <div class="carga-input-group"><label>CONTRASEÑA INICIAL *</label><input type="password" placeholder="Mínimo 6 caracteres"></div>
                    </div>
                    <div class="carga-actions">
                        <button type="button" onclick="registrarPersonalFinanzas()" class="btn-registrar-docente" style="background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);"><i class='bx bx-save'></i> Registrar Personal</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="section-container" style="margin-top: 25px;">
            <div class="section-title">
                <div class="header-left"><i class='bx bx-list-ul' style="color: #16a34a;"></i><span>Personal Financiero Activo</span></div>
            </div>
            <div class="table-container-responsive">
                <table class="tabla-sistema">
                    <thead>
                        <tr>
                            <th>NOMBRE</th>
                            <th>CONTACTO / NO. EMP.</th>
                            <th>NIVEL DE ACCESO</th>
                            <th>PUESTO</th>
                            <th>ESTATUS</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-finanzas-body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Editar Accesos Finanzas -->
    <div id="modal-editar-acceso-finanzas" class="modal-expediente" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; justify-content:center; align-items:center;">
        <div class="modal-content" style="background:white; padding:30px; border-radius:15px; width:400px; max-width:90%;">
            <h3 style="margin-top:0; color:#1e293b; display:flex; align-items:center; gap:10px;"><i class='bx bx-lock-open-alt' style="color:#d97706;"></i> Editar Credenciales</h3>
            <p style="color:#64748b; font-size:0.9rem; margin-bottom:20px;">Actualiza el usuario de login o la contraseña de este empleado.</p>
            
            <input type="hidden" id="edit-id-finanzas">
            
            <div class="carga-input-group" style="margin-bottom:15px;">
                <label>NUEVO USUARIO (LOGIN)</label>
                <input type="text" id="edit-user-finanzas" placeholder="Escribe el nuevo usuario..." style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
            </div>
            
            <div class="carga-input-group" style="margin-bottom:25px;">
                <label>NUEVA CONTRASEÑA</label>
                <input type="text" id="edit-pass-finanzas" placeholder="Dejar en blanco para no cambiarla" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
            </div>
            
            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <button onclick="document.getElementById('modal-editar-acceso-finanzas').style.display='none'" class="btn-outline" style="padding:8px 15px; border-radius:8px; border:1px solid #cbd5e1; background:white; cursor:pointer;">Cancelar</button>
                <button onclick="guardarNuevosAccesosFinanzas()" class="btn-primary" style="padding:8px 15px; border-radius:8px; background:#16a34a; color:white; border:none; cursor:pointer;">Guardar Cambios</button>
            </div>
        </div>
    </div>
    <!-- Modal Editar Datos Finanzas -->
    <div id="modal-editar-datos-finanzas" class="modal-expediente" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; justify-content:center; align-items:center;">
        <div class="modal-content" style="background:white; padding:30px; border-radius:15px; width:600px; max-width:90%;">
            <h3 style="margin-top:0; color:#1e293b; display:flex; align-items:center; gap:10px;"><i class='bx bx-edit' style="color:#16a34a;"></i> Editar Datos Personales</h3>
            
            <input type="hidden" id="edit-id-datos-finanzas">
            
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px; margin-bottom:15px; max-height: 400px; overflow-y: auto; padding-right:10px;">
                <div class="carga-input-group">
                    <label>NOMBRE(S)</label>
                    <input type="text" id="edit-nombre-finanzas" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                </div>
                
                <div class="carga-input-group">
                    <label>APELLIDOS</label>
                    <input type="text" id="edit-apellidos-finanzas" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                </div>

                <div class="carga-input-group">
                    <label>NÚMERO EMPLEADO</label>
                    <input type="text" id="edit-num-empleado-finanzas" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                </div>

                <div class="carga-input-group">
                    <label>TELÉFONO</label>
                    <input type="text" id="edit-telefono-finanzas" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                </div>

                <div class="carga-input-group">
                    <label>CARGO</label>
                    <input type="text" id="edit-cargo-finanzas" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                </div>
                
                <div class="carga-input-group">
                    <label>CORREO INSTITUCIONAL</label>
                    <input type="email" id="edit-email-finanzas" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                </div>

                <div class="carga-input-group">
                    <label>USUARIO (LOGIN)</label>
                    <input type="text" id="edit-username-finanzas" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                </div>
            </div>
            
            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <button onclick="document.getElementById('modal-editar-datos-finanzas').style.display='none'" class="btn-outline" style="padding:8px 15px; border-radius:8px; border:1px solid #cbd5e1; background:white; cursor:pointer;">Cancelar</button>
                <button onclick="guardarDatosFinanzas()" class="btn-primary" style="padding:8px 15px; border-radius:8px; background:#16a34a; color:white; border:none; cursor:pointer;">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>
<script src="./frontend/src/modules/Admin/js/finanzasAdmin.js?v=4"></script>
