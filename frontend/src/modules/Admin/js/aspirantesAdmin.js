// Control del Modal de Expediente
function abrirExpediente(id) {
    const modal = document.getElementById('modal-expediente');
    if(modal) {
        modal.style.display = 'flex';
        const content = modal.querySelector('.modal-content');
        content.style.transform = 'scale(0.95)';
        content.style.opacity = '0';
        setTimeout(() => {
            content.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
            content.style.transform = 'scale(1)';
            content.style.opacity = '1';
        }, 10);
    }
}

function cerrarExpediente() {
    const modal = document.getElementById('modal-expediente');
    if(modal) {
        modal.style.display = 'none';
    }
}

// Funciones para cargar datos del Backend
async function cargarAspirantes() {
    try {
        const aspirantes = await window.API.Aspirantes.listar();
        
        const revisionBody = document.getElementById('tabla-aspirantes-body');
        const examenesBody = document.getElementById('tabla-examenes-body');
        const admitidosBody = document.getElementById('tabla-admitidos-body');
        
        revisionBody.innerHTML = '';
        examenesBody.innerHTML = '';
        admitidosBody.innerHTML = '';

        let conteoRevision = 0;
        let conteoExamen = 0;

        aspirantes.forEach(asp => {
            const folio = asp._id.substring(asp._id.length - 6).toUpperCase();
            
            if(asp.status === 'REGISTRADO' || asp.status === 'RECHAZADO') {
                conteoRevision++;
                revisionBody.innerHTML += `
                    <tr>
                        <td><input type="checkbox" class="check-aspirante" value="${asp._id}" style="width: 18px; height: 18px; cursor: pointer;"></td>
                        <td><b>F-${folio}</b></td>
                        <td><b>${asp.firstName} ${asp.lastName}</b><br><small>Promedio: ${asp.promedio}</small></td>
                        <td>${asp.targetGrade}</td>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <div title="Documentos" style="display:flex; flex-direction:column; align-items:center; gap:3px;">
                                    <i class='bx bxs-folder' style="color:#059669; font-size:1.2rem;"></i>
                                    <span style="width:20px; height:6px; background:#059669; border-radius:4px;"></span>
                                </div>
                                <div title="Pago Ficha" style="display:flex; flex-direction:column; align-items:center; gap:3px;">
                                    <i class='bx bxs-credit-card' style="color:#059669; font-size:1.2rem;"></i>
                                    <span style="width:20px; height:6px; background:#059669; border-radius:4px;"></span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <button class="btn-action-view" style="background:#e0f2fe; color:#0284c7; border: 1px solid #bae6fd;" title="Revisar Expediente" onclick="abrirExpediente('${asp._id}')">
                                <i class='bx bx-search-alt-2'></i> Expediente
                            </button>
                        </td>
                    </tr>
                `;
            } 
            else if (asp.status === 'APROBADO' || asp.status === 'ACEPTADO') {
                conteoExamen++;
                examenesBody.innerHTML += `
                    <tr>
                        <td><b>F-${folio}</b></td>
                        <td><b>${asp.firstName} ${asp.lastName}</b></td>
                        <td>${asp.targetGrade}</td>
                        <td>
                            <input type="number" id="score-${asp._id}" placeholder="0 - 100" value="${asp.testScore || ''}" style="width: 100px; padding: 8px; border: 1px solid #cbd5e1; border-radius: 8px; text-align: center; outline: none;">
                        </td>
                        <td>
                            <button onclick="guardarExamen('${asp._id}')" class="btn-primary" style="background: #10b981; color: white; border: none; padding: 5px 10px; border-radius: 5px; cursor:pointer;">Guardar y Admitir</button>
                        </td>
                    </tr>
                `;
            }
            else if (asp.status === 'TRANSFERIDO') {
                admitidosBody.innerHTML += `
                    <tr style="background: #f0fdf4;">
                        <td><span style="color:#64748b; font-size:0.85rem;">F-${folio}</span></td>
                        <td><b style="color:#059669; font-size:1.1rem;">${asp.studentMatricula || 'N/A'}</b></td>
                        <td><b>${asp.firstName} ${asp.lastName}</b><br><small>${asp.email}</small></td>
                        <td>${asp.targetGrade}</td>
                        <td>
                            <span style="display:flex; align-items:center; gap:5px; color:#0284c7; font-size:0.85rem; font-weight:bold;">
                                <i class='bx bxs-envelope'></i> Correo Enviado
                            </span>
                        </td>
                    </tr>
                `;
            }
        });

        if(conteoRevision === 0) revisionBody.innerHTML = '<tr><td colspan="6" style="text-align:center; color:#94a3b8; padding: 20px;">No hay aspirantes pendientes</td></tr>';
        if(conteoExamen === 0) examenesBody.innerHTML = '<tr><td colspan="5" style="text-align:center; color:#94a3b8; padding: 20px;">No hay aspirantes para examen</td></tr>';
        if(admitidosBody.innerHTML === '') admitidosBody.innerHTML = '<tr><td colspan="5" style="text-align:center; color:#94a3b8; padding: 20px;">No hay admitidos oficiales aún</td></tr>';

    } catch (error) {
        console.error("Error al cargar aspirantes:", error);
    }
}

async function guardarExamen(id) {
    const score = document.getElementById(`score-${id}`).value;
    if(!score) return alert('Ingresa un puntaje');
    
    try {
        await window.API.Aspirantes.subirExamen(id, score);
        await window.API.Aspirantes.aceptar(id, 'SIN ASIGNAR'); // Aceptamos directamente tras el examen
        alert('✅ Examen guardado y Aspirante Admitido Oficialmente.');
        cargarAspirantes();
    } catch(err) {
        alert('Error: ' + err.message);
    }
}

// Validación de Documentos dentro del Modal
function validarDoc(btn, type) {
    const container = btn.parentElement;
    if(type === 'ok') {
        container.innerHTML = `<span style="color: #059669; font-weight: bold; font-size: 0.85rem; display: flex; align-items: center; gap: 5px; padding: 5px 10px; background: #ecfdf5; border-radius: 6px;"><i class='bx bx-check-double'></i> Validado</span>`;
    } else {
        container.innerHTML = `<span style="color: #dc2626; font-weight: bold; font-size: 0.85rem; display: flex; align-items: center; gap: 5px; padding: 5px 10px; background: #fef2f2; border-radius: 6px;"><i class='bx bx-message-alt-error'></i> Rechazado</span>`;
        alert("✉️ Correo Automático Enviado al Aspirante:\n'Estimado aspirante, tu documento presenta un error. Por favor, súbelo nuevamente.'");
    }
}

// Control de Checkboxes usando delegación
document.addEventListener('change', function(e) {
    if(e.target && e.target.id === 'check-all') {
        const checkboxes = document.querySelectorAll('.check-aspirante');
        checkboxes.forEach(cb => {
            if(!cb.disabled) cb.checked = e.target.checked;
        });
    }
});

// Admisión Masiva
function admitirMasivo() {
    alert("Función conectada. (Lógica masiva pendiente en el backend)");
}

window.abrirExpediente = abrirExpediente;
window.cerrarExpediente = cerrarExpediente;
window.validarDoc = validarDoc;
window.admitirMasivo = admitirMasivo;
window.switchTabAspirantes = switchTabAspirantes;
window.guardarExamen = guardarExamen;

function switchTabAspirantes(tabId, btn) {
    document.querySelectorAll('.tab-content-aspirantes').forEach(t => t.style.display = 'none');
    document.querySelectorAll('.grupos-tabs .tab-btn').forEach(b => {
        b.style.color = '#64748b';
        b.style.borderBottom = '3px solid transparent';
    });
    document.getElementById(tabId).style.display = 'block';
    btn.style.color = '#d97706';
    btn.style.borderBottom = '3px solid #d97706';
}

// Cargar al inicio
cargarAspirantes();
