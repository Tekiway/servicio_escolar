<div class="main-card-carga">
    <div class="header-carga">
        <div class="icon-carga-box" style="background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%); box-shadow: 0 8px 20px rgba(245,158,11,0.1);"><i class='bx bxs-user-plus' style="color:#d97706;"></i></div>
        <div class="info-carga" style="flex: 1;">
            <h2>Gestión Avanzada de Aspirantes</h2>
            <p>Filtra solicitudes masivas, revisa semáforos de documentos y admite grupos completos.</p>
        </div>
        <div>
            <button class="btn-primary" style="background: linear-gradient(135deg, #059669 0%, #047857 100%); padding: 10px 20px; border: none; border-radius: 10px; color: white; cursor: pointer; display: flex; align-items: center; gap: 8px; font-weight: 700; font-size: 0.9rem; box-shadow: 0 4px 15px rgba(5,150,105,0.3);" onclick="admitirMasivo()">
                <i class='bx bx-check-double'></i> Admitir Seleccionados
            </button>
        </div>
    </div>

    <div class="body-carga">
        
        <!-- ── TABS DE EMBUDO ── -->
        <div class="grupos-tabs" style="border-bottom: 2px solid #e2e8f0; margin-bottom: 20px; display: flex; gap: 15px;">
            <button class="tab-btn active" onclick="switchTabAspirantes('tab-revision', this)" style="padding: 10px; font-weight: 700; color: #d97706; border-bottom: 3px solid #d97706; background: transparent; border-top: none; border-left: none; border-right: none; cursor: pointer;">
                <i class='bx bx-folder-open'></i> 1. Revisión de Documentos
                <span style="background: #fef3c7; color: #b45309; padding: 2px 6px; border-radius: 10px; font-size: 0.75rem; margin-left: 5px;">45</span>
            </button>
            <button class="tab-btn" onclick="switchTabAspirantes('tab-examen', this)" style="padding: 10px; font-weight: 700; color: #64748b; border-bottom: 3px solid transparent; background: transparent; border-top: none; border-left: none; border-right: none; cursor: pointer;">
                <i class='bx bx-edit'></i> 2. Examen y Resultados
                <span style="background: #f1f5f9; color: #64748b; padding: 2px 6px; border-radius: 10px; font-size: 0.75rem; margin-left: 5px;">120</span>
            </button>
            <button class="tab-btn" onclick="switchTabAspirantes('tab-admitidos', this)" style="padding: 10px; font-weight: 700; color: #64748b; border-bottom: 3px solid transparent; background: transparent; border-top: none; border-left: none; border-right: none; cursor: pointer;">
                <i class='bx bx-check-shield'></i> 3. Admitidos Oficiales
            </button>
        </div>

        <div id="tab-revision" class="tab-content-aspirantes active">
            <!-- ── BARRA DE HERRAMIENTAS / FILTROS ── -->
            <div style="display: flex; gap: 15px; margin-bottom: 20px; flex-wrap: wrap;">
                <input type="text" placeholder="🔍 Buscar por Folio o Nombre..." style="padding: 10px 15px; border-radius: 10px; border: 1px solid #cbd5e1; flex: 1; min-width: 250px; background: #f8fafc; outline: none;">
                
                <select style="padding: 10px 15px; border-radius: 10px; border: 1px solid #cbd5e1; background: #f8fafc; outline: none;">
                    <option value="">Todas las Carreras</option>
                    <option>Ing. TICs</option>
                    <option>Administración</option>
                </select>
                
                <select style="padding: 10px 15px; border-radius: 10px; border: 1px solid #cbd5e1; background: #f8fafc; outline: none;">
                    <option value="">Estado de Documentos</option>
                    <option>✅ Todos Válidos</option>
                    <option>⚠️ Con Errores</option>
                    <option>⏳ Pendientes</option>
                </select>
            </div>

            <!-- ── TABLA MASIVA CON SEMÁFOROS ── -->
            <div class="table-container-responsive">
                <table class="tabla-sistema">
                    <thead>
                        <tr>
                            <th style="width: 40px;"><input type="checkbox" id="check-all" style="width: 18px; height: 18px; cursor: pointer;"></th>
                            <th>FOLIO</th>
                            <th>ASPIRANTE</th>
                            <th>CARRERA</th>
                            <th>SEMÁFORO DE ESTADO</th>
                            <th>ACCIÓN</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-aspirantes-body">
                        <!-- Llenado dinámicamente vía JS -->
                    </tbody>
                </table>
            </div>
        </div>

        <div id="tab-examen" class="tab-content-aspirantes" style="display: none;">
            <div style="display: flex; gap: 15px; margin-bottom: 20px; flex-wrap: wrap; justify-content: space-between;">
                <input type="text" placeholder="🔍 Buscar por Folio o Nombre..." style="padding: 10px 15px; border-radius: 10px; border: 1px solid #cbd5e1; flex: 1; max-width: 300px; background: #f8fafc; outline: none;">
                <button class="btn-primary" style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); padding: 10px 20px; border: none; border-radius: 10px; color: white; cursor: pointer; font-weight: 700;">
                    <i class='bx bx-save'></i> Guardar Calificaciones
                </button>
            </div>

            <div class="table-container-responsive">
                <table class="tabla-sistema">
                    <thead>
                        <tr>
                            <th>FOLIO</th>
                            <th>ASPIRANTE</th>
                            <th>CARRERA</th>
                            <th>RESULTADO EXAMEN (PTS)</th>
                            <th>ESTADO</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-examenes-body">
                    </tbody>
                </table>
            </div>
        </div>

        <div id="tab-admitidos" class="tab-content-aspirantes" style="display: none;">
            <div style="display: flex; gap: 15px; margin-bottom: 20px; flex-wrap: wrap; justify-content: space-between;">
                <input type="text" placeholder="🔍 Buscar por Folio o Nombre..." style="padding: 10px 15px; border-radius: 10px; border: 1px solid #cbd5e1; flex: 1; max-width: 300px; background: #f8fafc; outline: none;">
                <button class="btn-outline" style="background: white; border: 1px solid #cbd5e1; padding: 10px 20px; border-radius: 10px; color: #475569; cursor: pointer; font-weight: 700; display:flex; align-items:center; gap:5px;">
                    <i class='bx bxs-file-export'></i> Exportar a Excel
                </button>
            </div>

            <div class="table-container-responsive">
                <table class="tabla-sistema">
                    <thead>
                        <tr>
                            <th>FOLIO ORIGINAL</th>
                            <th>NUEVA MATRÍCULA</th>
                            <th>ALUMNO ADMITIDO</th>
                            <th>CARRERA</th>
                            <th>NOTIFICACIÓN</th>
                        </tr>
                    </thead>
                    <tbody id="tabla-admitidos-body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL DE EXPEDIENTE DEL ASPIRANTE ================= -->
<!-- (Mismo código del modal que ya hicimos) -->
<div id="modal-expediente" class="modal-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15,23,42,0.6); backdrop-filter: blur(4px); z-index: 1000; justify-content: center; align-items: center; padding: 20px;">
    <div class="modal-content" style="background: white; width: 100%; max-width: 900px; max-height: 90vh; border-radius: 20px; display: flex; flex-direction: column; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25);">
        
        <!-- Header del Modal -->
        <div style="padding: 20px 25px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; background: #f8fafc;">
            <div>
                <h3 style="margin: 0; color: #1e293b; font-size: 1.3rem;">Expediente de Admisión</h3>
                <p style="margin: 2px 0 0 0; color: #64748b; font-size: 0.85rem;">Folio: F-2026-901 | Aspirante: Carlos Mendoza Ruiz</p>
            </div>
            <button onclick="cerrarExpediente()" style="background: none; border: none; font-size: 1.5rem; color: #94a3b8; cursor: pointer;"><i class='bx bx-x'></i></button>
        </div>

        <!-- Cuerpo del Modal -->
        <div style="padding: 25px; overflow-y: auto; flex: 1;">
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
                <div style="background: #f8fafc; padding: 15px; border-radius: 12px; border: 1px solid #e2e8f0;">
                    <h4 style="margin: 0 0 15px 0; color: #334155; font-size: 0.95rem; display:flex; align-items:center; gap:5px;"><i class='bx bx-id-card' style="color:#d97706;"></i> Información General</h4>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; font-size: 0.85rem;">
                        <div><strong style="color:#64748b; display:block; font-size:0.75rem;">CARRERA SOLICITADA</strong><span>Administración</span></div>
                        <div><strong style="color:#64748b; display:block; font-size:0.75rem;">CURP</strong><span>MERC040510HDFRXXX0</span></div>
                    </div>
                </div>

                <div style="background: #f8fafc; padding: 15px; border-radius: 12px; border: 1px solid #e2e8f0;">
                    <h4 style="margin: 0 0 15px 0; color: #334155; font-size: 0.95rem; display:flex; align-items:center; gap:5px;"><i class='bx bx-building-house' style="color:#d97706;"></i> Historial Académico</h4>
                    <div style="display: grid; grid-template-columns: 1fr; gap: 10px; font-size: 0.85rem;">
                        <div><strong style="color:#64748b; display:block; font-size:0.75rem;">PREPARATORIA</strong><span>CBTIS 123</span></div>
                        <div><strong style="color:#64748b; display:block; font-size:0.75rem;">PROMEDIO GENERAL</strong><span style="color:#059669; font-weight:bold; font-size:1.1rem;">8.5</span></div>
                    </div>
                </div>
            </div>

            <h4 style="margin: 0 0 15px 0; color: #1e293b; font-size: 1.1rem; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px;">Expediente Digital</h4>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 25px;">
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px 15px; border: 1px solid #e2e8f0; border-radius: 10px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class='bx bxs-file-pdf' style="color: #ef4444; font-size: 1.5rem;"></i>
                        <div><strong style="display: block; font-size: 0.85rem; color: #334155;">Acta de Nacimiento</strong><a href="#" style="font-size: 0.75rem; color: #3b82f6;">Ver Documento</a></div>
                    </div>
                    <div style="display: flex; gap: 5px;" class="val-btns">
                        <button class="btn-val" onclick="validarDoc(this, 'ok')" style="padding:5px 10px; border:1px solid #a7f3d0; background:#ecfdf5; color:#059669; border-radius:6px;"><i class='bx bx-check'></i></button>
                        <button class="btn-val" onclick="validarDoc(this, 'error')" style="padding:5px 10px; border:1px solid #fecaca; background:#fef2f2; color:#dc2626; border-radius:6px;"><i class='bx bx-x'></i></button>
                    </div>
                </div>
            </div>

            <!-- Dictamen Final (Solo para casos Individuales) -->
            <div style="background: #f1f5f9; padding: 20px; border-radius: 12px; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h4 style="margin: 0; color: #1e293b; font-size: 1rem;">Decisión Individual</h4>
                </div>
                <div style="display: flex; gap: 10px;">
                    <button style="background: white; border: 1px solid #cbd5e1; color: #dc2626; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer;"><i class='bx bx-x-circle'></i> Rechazar</button>
                    <button style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border: none; color: white; padding: 10px 20px; border-radius: 8px; font-weight: 600; cursor: pointer;" onclick="simularAdmision()"><i class='bx bxs-graduation'></i> Admitir</button>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="./frontend/src/modules/Admin/js/aspirantesAdmin.js?v=3"></script>
