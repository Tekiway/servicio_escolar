<div class="main-card-grupos">
    <div class="header-grupos">
        <div class="icon-grupos-box"><i class='bx bx-calendar-event'></i></div>
        <div class="info-grupos">
            <h2>Gestión de Grupos y Horarios</h2>
            <p>Crea grupos académicos, asigna semestres y diseña los horarios de clase.</p>
        </div>
    </div>

    <div class="body-grupos">
        <div style="display:grid; grid-template-columns:1fr 2fr; gap:20px; margin-top:20px;">
            <!-- Formulario de Grupos -->
            <div class="panel-formulario" style="background:white; padding:20px; border-radius:12px; box-shadow:0 4px 6px rgba(0,0,0,0.05); border:1px solid #e2e8f0;">
                <h3 style="margin-top:0; color:#1e293b; margin-bottom:15px;"><i class='bx bx-plus-circle'></i> Registrar Grupo</h3>
                <form id="form-agregar-grupo">
                    <div style="margin-bottom:12px;">
                        <label style="font-size:0.85rem; font-weight:700; color:#475569; display:block; margin-bottom:5px;">Nombre del Grupo</label>
                        <input type="text" id="g-nombre" placeholder="Ej. 1A" required style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                    </div>
                    <div style="margin-bottom:12px;">
                        <label style="font-size:0.85rem; font-weight:700; color:#475569; display:block; margin-bottom:5px;">Carrera</label>
                        <select id="g-carrera" required style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                            <option value="">Selecciona Carrera...</option>
                            <option>Ingeniería en TICs</option>
                            <option>Administración</option>
                            <option>Contaduría</option>
                            <option>Gastronomía</option>
                        </select>
                    </div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-bottom:12px;">
                        <div>
                            <label style="font-size:0.85rem; font-weight:700; color:#475569; display:block; margin-bottom:5px;">Ciclo Escolar</label>
                            <input type="text" id="g-ciclo" placeholder="Ej. 2026-1" required style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                        </div>
                        <div>
                            <label style="font-size:0.85rem; font-weight:700; color:#475569; display:block; margin-bottom:5px;">Semestre</label>
                            <select id="g-semestre" required style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                                <option value="1ro">1ro</option>
                                <option value="2do">2do</option>
                                <option value="3ro">3ro</option>
                                <option value="4to">4to</option>
                            </select>
                        </div>
                    </div>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-bottom:20px;">
                        <div>
                            <label style="font-size:0.85rem; font-weight:700; color:#475569; display:block; margin-bottom:5px;">Turno</label>
                            <select id="g-turno" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                                <option>Matutino</option>
                                <option>Vespertino</option>
                                <option>Nocturno</option>
                                <option>Mixto</option>
                            </select>
                        </div>
                        <div>
                            <label style="font-size:0.85rem; font-weight:700; color:#475569; display:block; margin-bottom:5px;">Modalidad</label>
                            <select id="g-modalidad" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                                <option>Escolarizada</option>
                                <option>Mixta</option>
                                <option>En línea</option>
                            </select>
                        </div>
                    </div>
                    <div style="margin-bottom:20px;">
                        <label style="font-size:0.85rem; font-weight:700; color:#475569; display:block; margin-bottom:5px;">Capacidad (Alumnos)</label>
                        <input type="number" id="g-capacidad" value="30" required style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:8px;">
                    </div>
                    <button type="submit" id="btn-registrar-grupo" style="width:100%; background:#3b82f6; color:white; border:none; padding:12px; border-radius:8px; font-weight:bold; cursor:pointer;"><i class='bx bx-save'></i> Registrar Grupo</button>
                </form>
            </div>
            
            <!-- Tabla de Grupos -->
            <div class="panel-tabla" style="background:white; padding:20px; border-radius:12px; box-shadow:0 4px 6px rgba(0,0,0,0.05); border:1px solid #e2e8f0; max-height: 600px; overflow-y:auto;">
                <h3 style="margin-top:0; color:#1e293b; margin-bottom:15px; display:flex; justify-content:space-between;">
                    <span><i class='bx bx-list-ul'></i> Grupos Registrados</span>
                    <button onclick="cargarTablaGrupos()" style="background:none; border:none; color:#3b82f6; cursor:pointer; font-size:1.2rem;"><i class='bx bx-refresh'></i></button>
                </h3>
                <table style="width:100%; text-align:left; border-collapse:collapse;">
                    <thead>
                        <tr style="border-bottom:2px solid #e2e8f0; background:#f8fafc;">
                            <th style="padding:10px;">Grupo</th>
                            <th style="padding:10px;">Carrera / Ciclo</th>
                            <th style="padding:10px;">Turno / Moda</th>
                            <th style="padding:10px;">Capacidad</th>
                            <th style="padding:10px;">Estado</th>
                        </tr>
                    </thead>
                    <tbody id="lista-grupos-body">
                        <tr>
                            <td colspan="5" style="text-align:center; padding:20px;"><i class='bx bx-loader-alt bx-spin'></i> Cargando...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="./frontend/src/modules/Admin/js/grupos.js?v=2"></script>
