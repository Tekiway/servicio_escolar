<div class="animate__animated animate__fadeIn" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Encabezado -->
    <div class="module-header" style="margin-bottom: 5px;">
        <h2 style="color: #1e293b; font-size: 1.8rem; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i class='bx bxs-cloud-upload' style="color: var(--primary); font-size: 2rem;"></i> Expediente Digital del Estudiante
        </h2>
        <p style="color: #64748b;">Mantén al día tus documentos institucionales obligatorios (Seguro Social, Servicio Social y Residencias).</p>
    </div>

    <!-- Panel de Expediente Estudiantil -->
    <div id="docs-alumnos-container" style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 30px; border-radius: 16px; backdrop-filter: blur(10px); box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <h3 style="margin: 0; color: #1e293b; font-weight: 800; display: flex; align-items: center; gap: 8px;">
                <i class='bx bx-folder-open' style="color: var(--secondary); font-size: 1.4rem;"></i> Expediente de Servicios del Estudiante
            </h3>
            <span style="font-size: 0.8rem; padding: 4px 12px; border-radius: 20px; background: rgba(99, 102, 241, 0.1); color: var(--primary); font-weight: 800;" id="docs-alumnos-progress">
                Progreso: -- / --
            </span>
        </div>

        <div style="display: flex; flex-direction: column; gap: 20px;" id="docs-list-container">
            <!-- Documento 1 -->
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px dashed rgba(226,232,240,0.8); padding-bottom: 15px;">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="background: rgba(99,102,241,0.1); color: var(--primary); width: 45px; height: 45px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                        <i class='bx bxs-file-pdf'></i>
                    </div>
                    <div>
                        <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Acta de Nacimiento</strong>
                        <span style="font-size: 0.75rem; color: #64748b;">Formato PDF. Máximo 2MB.</span>
                    </div>
                </div>
                <div style="display: flex; gap: 15px; align-items: center;">
                    <span id="badge-stud-doc-1" style="font-size: 0.75rem; padding: 4px 10px; border-radius: 20px; background: #f1f5f9; color: #64748b; font-weight: 700;">Pendiente</span>
                    <input type="file" id="file-stud-doc-1" style="display:none;" onchange="simulateStudentUpload(1)">
                    <button class="btn-finance-action" style="padding: 8px 16px; font-size: 0.85rem;" id="btn-stud-upload-1" onclick="document.getElementById('file-stud-doc-1').click()"><i class='bx bx-upload'></i> Subir Archivo</button>
                </div>
            </div>

            <!-- Documento 2 -->
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px dashed rgba(226,232,240,0.8); padding-bottom: 15px;">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="background: rgba(14,165,233,0.1); color: var(--accent); width: 45px; height: 45px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                        <i class='bx bxs-file-image'></i>
                    </div>
                    <div>
                        <strong style="color: #1e293b; display: block; font-size: 0.95rem;">CURP Actualizado</strong>
                        <span style="font-size: 0.75rem; color: #64748b;">Formato PDF descargado de RENAPO.</span>
                    </div>
                </div>
                <div style="display: flex; gap: 15px; align-items: center;">
                    <span id="badge-stud-doc-2" style="font-size: 0.75rem; padding: 4px 10px; border-radius: 20px; background: #f1f5f9; color: #64748b; font-weight: 700;">Pendiente</span>
                    <input type="file" id="file-stud-doc-2" style="display:none;" onchange="simulateStudentUpload(2)">
                    <button class="btn-finance-action" style="padding: 8px 16px; font-size: 0.85rem;" id="btn-stud-upload-2" onclick="document.getElementById('file-stud-doc-2').click()"><i class='bx bx-upload'></i> Subir Archivo</button>
                </div>
            </div>

            <!-- Documento 3 -->
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px dashed rgba(226,232,240,0.8); padding-bottom: 15px;">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="background: rgba(168,85,247,0.1); color: var(--secondary); width: 45px; height: 45px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                        <i class='bx bxs-file-archive'></i>
                    </div>
                    <div>
                        <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Certificado de Bachillerato</strong>
                        <span style="font-size: 0.75rem; color: #64748b;">Escaneo legible en PDF a color.</span>
                    </div>
                </div>
                <div style="display: flex; gap: 15px; align-items: center;">
                    <span id="badge-stud-doc-3" style="font-size: 0.75rem; padding: 4px 10px; border-radius: 20px; background: #f1f5f9; color: #64748b; font-weight: 700;">Pendiente</span>
                    <input type="file" id="file-stud-doc-3" style="display:none;" onchange="simulateStudentUpload(3)">
                    <button class="btn-finance-action" style="padding: 8px 16px; font-size: 0.85rem;" id="btn-stud-upload-3" onclick="document.getElementById('file-stud-doc-3').click()"><i class='bx bx-upload'></i> Subir Archivo</button>
                </div>
            </div>

            <!-- Documento 4 -->
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="background: rgba(234,179,8,0.1); color: #ca8a04; width: 45px; height: 45px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">
                        <i class='bx bxs-file-blank'></i>
                    </div>
                    <div>
                        <strong style="color: #1e293b; display: block; font-size: 0.95rem;">Comprobante de Domicilio</strong>
                        <span style="font-size: 0.75rem; color: #64748b;">No mayor a 3 meses. (Luz, Agua, Teléfono)</span>
                    </div>
                </div>
                <div style="display: flex; gap: 15px; align-items: center;">
                    <span id="badge-stud-doc-4" style="font-size: 0.75rem; padding: 4px 10px; border-radius: 20px; background: #f1f5f9; color: #64748b; font-weight: 700;">Pendiente</span>
                    <input type="file" id="file-stud-doc-4" style="display:none;" onchange="simulateStudentUpload(4)">
                    <button class="btn-finance-action" style="padding: 8px 16px; font-size: 0.85rem;" id="btn-stud-upload-4" onclick="document.getElementById('file-stud-doc-4').click()"><i class='bx bx-upload'></i> Subir Archivo</button>
                </div>
            </div>
        </div>

        <!-- Botón de Envío y Guardado de Expediente -->
        <button id="btn-stud-submit" class="btn-finance-action" style="margin-top: 30px; width: 100%; justify-content: center; background: #94a3b8; border: none; color: white;" disabled onclick="guardarStudentExpediente()">
            <i class='bx bx-check-double'></i> GUARDAR Y ACTUALIZAR EXPEDIENTE DIGITAL
        </button>
    </div>
</div>

<script>
    (function() {
        const storedDocs = localStorage.getItem('alumno_documentos');
        if (storedDocs) {
            for (let i = 1; i <= 4; i++) {
                setStudentDocUploaded(i);
            }
            updateStudentProgress();
        }
    })();

    const studUploads = { 1: false, 2: false, 3: false, 4: false };

    function simulateStudentUpload(id) {
        const btn = document.getElementById(`btn-stud-upload-${id}`);
        const badge = document.getElementById(`badge-stud-doc-${id}`);

        btn.disabled = true;
        btn.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i> Subiendo...";
        badge.style.background = 'rgba(234,179,8,0.1)';
        badge.style.color = '#854d0e';
        badge.textContent = 'Procesando...';

        setTimeout(() => {
            setStudentDocUploaded(id);
            updateStudentProgress();
        }, 1500);
    }

    function setStudentDocUploaded(id) {
        studUploads[id] = true;
        const btn = document.getElementById(`btn-stud-upload-${id}`);
        const badge = document.getElementById(`badge-stud-doc-${id}`);

        btn.disabled = false;
        btn.style.background = '#e2e8f0';
        btn.style.color = '#475569';
        btn.style.border = '1px solid #cbd5e1';
        btn.innerHTML = "<i class='bx bx-check'></i> Reemplazar";
        
        badge.style.background = 'rgba(5,150,105,0.1)';
        badge.style.color = '#059669';
        badge.innerHTML = "<i class='bx bx-check-circle'></i> Validado";
    }

    function updateStudentProgress() {
        let count = 0;
        for (let key in studUploads) {
            if (studUploads[key]) count++;
        }

        const pText = document.getElementById('docs-alumnos-progress');
        pText.textContent = `Progreso: ${count} de 4 subidos`;

        const submitBtn = document.getElementById('btn-stud-submit');
        if (count === 4) {
            submitBtn.disabled = false;
            submitBtn.style.background = 'linear-gradient(135deg, var(--primary), var(--secondary))';
            submitBtn.style.cursor = 'pointer';
        } else {
            submitBtn.disabled = true;
            submitBtn.style.background = '#94a3b8';
        }
    }

    function guardarStudentExpediente() {
        localStorage.setItem('alumno_documentos', 'true');
        alert("¡Éxito!\nTu expediente digital ha sido actualizado correctamente.\n\nSiguiente paso: Pago de Colegiatura.");
        cargarModulo('Inicio');
    }
</script>
