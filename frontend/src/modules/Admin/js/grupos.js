document.addEventListener('DOMContentLoaded', () => {
    cargarTablaGrupos();

    const form = document.getElementById('form-agregar-grupo');
    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const btn = document.getElementById('btn-registrar-grupo');
            const origText = btn.innerHTML;
            btn.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i> Procesando...";
            btn.disabled = true;

            const payload = {
                nombre: document.getElementById('g-nombre').value,
                carrera: document.getElementById('g-carrera').value,
                cicloEscolar: document.getElementById('g-ciclo').value,
                semestre: document.getElementById('g-semestre').value,
                turno: document.getElementById('g-turno').value,
                modalidad: document.getElementById('g-modalidad').value,
                capacidad: parseInt(document.getElementById('g-capacidad').value) || 30
            };

            try {
                // El endpoint es a través del Gateway /api/academico/grupos
                const res = await fetch('http://localhost:3000/api/academico/grupos', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    },
                    body: JSON.stringify(payload)
                });
                
                const data = await res.json();
                if (res.ok) {
                    alert('✅ Grupo registrado correctamente');
                    form.reset();
                    cargarTablaGrupos();
                } else {
                    alert('⚠️ Error: ' + (data.error || 'No se pudo registrar. Verifica que no exista un grupo igual.'));
                }
            } catch (err) {
                alert('❌ Error de conexión: ' + err.message);
            } finally {
                btn.innerHTML = origText;
                btn.disabled = false;
            }
        });
    }
});

async function cargarTablaGrupos() {
    const tbody = document.getElementById('lista-grupos-body');
    if (!tbody) return;

    tbody.innerHTML = '<tr><td colspan="5" style="text-align:center; padding:20px;"><i class="bx bx-loader-alt bx-spin"></i> Cargando grupos...</td></tr>';
    
    try {
        const res = await fetch('http://localhost:3000/api/academico/grupos', {
            headers: { 'Authorization': `Bearer ${localStorage.getItem('token')}` }
        });
        
        const json = await res.json();
        
        if (!res.ok || json.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5" style="text-align:center; padding:20px; color:#64748b;">No hay grupos registrados.</td></tr>';
            return;
        }

        let html = '';
        json.forEach(g => {
            html += `
            <tr style="border-bottom:1px solid #e2e8f0;">
                <td style="padding:10px;"><strong>${g.nombre}</strong><br><small>${g.semestre}</small></td>
                <td style="padding:10px;">${g.carrera}<br><small>${g.cicloEscolar}</small></td>
                <td style="padding:10px;">${g.turno}<br><small>${g.modalidad}</small></td>
                <td style="padding:10px;">${g.capacidad} max</td>
                <td style="padding:10px;">
                    <span style="padding:4px 8px; border-radius:20px; font-size:0.75rem; font-weight:700; background: ${g.estatus === 'Activo' ? '#dcfce7' : '#fee2e2'}; color: ${g.estatus === 'Activo' ? '#16a34a' : '#dc2626'};">
                        ${g.estatus || 'Activo'}
                    </span>
                </td>
            </tr>`;
        });
        tbody.innerHTML = html;
    } catch (err) {
        tbody.innerHTML = '<tr><td colspan="5" style="text-align:center; color:red;">Error al cargar los grupos.</td></tr>';
    }
}
