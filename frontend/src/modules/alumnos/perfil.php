<div class="animate__animated animate__fadeIn" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Encabezado -->
    <div class="module-header" style="margin-bottom: 5px;">
        <h2 style="color: #1e293b; font-size: 1.8rem; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i class='bx bxs-user-badge' style="color: var(--primary);"></i> Mi Perfil Escolar
        </h2>
        <p style="color: #64748b;">Administra y mantén al día tu información personal y académica oficial.</p>
    </div>

    <!-- Contenido del Perfil -->
    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 25px; align-items: start;">
        <!-- Avatar y Resumen Rápido -->
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 30px; border-radius: 16px; text-align: center; backdrop-filter: blur(10px); box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
            <div style="width: 110px; height: 110px; border-radius: 50%; background: linear-gradient(135deg, var(--primary), var(--secondary)); display: inline-flex; align-items: center; justify-content: center; color: #fff; font-size: 3.5rem; font-weight: 800; margin-bottom: 15px; border: 4px solid #fff; box-shadow: 0 4px 15px rgba(99, 102, 241, 0.2);">
                <i class='bx bxs-user'></i>
            </div>
            
            <h3 style="margin: 0 0 5px 0; color: #1e293b; font-weight: 800;" id="perfil-card-nombre">---</h3>
            <span style="font-size: 0.85rem; color: #64748b; font-weight: 700; display: block;" id="perfil-card-matricula">Matrícula: ---</span>
            
            <hr style="border: 0; border-top: 1px solid rgba(226, 232, 240, 0.8); margin: 20px 0;">
            
            <div style="text-align: left; font-size: 0.85rem; color: #64748b; display: flex; flex-direction: column; gap: 8px;">
                <span><strong>Estatus:</strong> <span style="color: #059669; font-weight: 700;">Activo</span></span>
                <span><strong>Periodo Ingreso:</strong> ---</span>
                <span><strong>Tipo Alumno:</strong> Regular</span>
            </div>
        </div>

        <!-- Ficha de Datos Oficiales (Formulario) -->
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 30px; border-radius: 16px; backdrop-filter: blur(10px); box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
            <h3 style="margin: 0 0 20px 0; color: #1e293b; font-weight: 800; display: flex; align-items: center; gap: 8px;">
                <i class='bx bxs-id-card' style="color: var(--secondary);"></i> Credencial Digital Escolar (Esquema BD)
            </h3>
            
            <form id="form-perfil-alumno" style="display: flex; flex-direction: column; gap: 15px;" onsubmit="guardarPerfilCambios(event)">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div style="display: flex; flex-direction: column; gap: 5px;">
                        <label style="font-size: 0.8rem; font-weight: 700; color: #64748b;">NOMBRE COMPLETO</label>
                        <input type="text" id="perfil-nombre" required style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none;">
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 5px;">
                        <label style="font-size: 0.8rem; font-weight: 700; color: #64748b;">MATRÍCULA ESCOLAR</label>
                        <input type="text" id="perfil-matricula" readonly style="padding: 10px 15px; border-radius: 8px; border: 1px solid #e2e8f0; background: #f8fafc; color: #94a3b8; outline: none;">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div style="display: flex; flex-direction: column; gap: 5px;">
                        <label style="font-size: 0.8rem; font-weight: 700; color: #64748b;">NOMBRE DE USUARIO</label>
                        <input type="text" id="perfil-username" required style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none;">
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 5px;">
                        <label style="font-size: 0.8rem; font-weight: 700; color: #64748b;">CORREO INSTITUCIONAL</label>
                        <input type="email" id="perfil-email" required style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none;">
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap: 5px;">
                    <label style="font-size: 0.8rem; font-weight: 700; color: #64748b;">PROGRAMA ACADÉMICO / CARRERA</label>
                    <input type="text" id="perfil-carrera" required style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none;">
                </div>

                <button class="btn-finance-action" type="submit" style="margin-top: 15px; justify-content: center; width: 100%; background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white;">
                    <i class='bx bx-save'></i> ACTUALIZAR CREDENCIAL Y FICHA
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    (function() {
        // Cargar datos
        const dbPerfil = localStorage.getItem('alumno_perfil');
        if (dbPerfil) {
            const data = JSON.parse(dbPerfil);
            document.getElementById('perfil-nombre').value = data.nombre;
            document.getElementById('perfil-matricula').value = data.matricula;
            document.getElementById('perfil-username').value = data.username;
            document.getElementById('perfil-email').value = data.email;
            document.getElementById('perfil-carrera').value = data.carrera;

            document.getElementById('perfil-card-nombre').textContent = data.nombre;
            document.getElementById('perfil-card-matricula').textContent = 'Matrícula: ' + data.matricula;
        }
    })();

    async function guardarPerfilCambios(event) {
        event.preventDefault();
        const nombre = document.getElementById('perfil-nombre').value;
        const matricula = document.getElementById('perfil-matricula').value;
        const username = document.getElementById('perfil-username').value;
        const email = document.getElementById('perfil-email').value;
        const carrera = document.getElementById('perfil-carrera').value;

        const payload = { nombre, username, email, carrera };

        try {
            const token = localStorage.getItem('token');
            const res = await fetch('http://localhost:3000/api/alumnos/mi-info', {
                method: 'PUT',
                headers: { 
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}` 
                },
                body: JSON.stringify(payload)
            });

            const dataRes = await res.json();
            if(res.ok) {
                const data = { nombre, matricula, username, email, carrera };
                localStorage.setItem('alumno_perfil', JSON.stringify(data));
                alert("Perfil actualizado correctamente en el servidor.");
            } else {
                throw new Error(dataRes.error || dataRes.message || 'Error al actualizar');
            }
        } catch(e) {
            alert("Error: " + e.message);
            return;
        }
        
        // Actualizar card
        document.getElementById('perfil-card-nombre').textContent = nombre;
        document.getElementById('student-header-name').textContent = nombre;

        alert("Credencial Escolar y Ficha de Datos actualizadas con éxito en la base de datos.");
    }
</script>
