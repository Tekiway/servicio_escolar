<div class="carga-container">
    <div class="header-admin">
        <h1>⚙️ Gestión de Carga Académica</h1>
        <p>Administración de docentes, planes de estudio y datos institucionales.</p>
    </div>

    <div class="admin-grid">
        
        <div class="admin-card">
            <div class="card-head">
                <i class='bx bxs-user-plus'></i>
                <h3>Registro de Docentes</h3>
            </div>
            <form class="admin-form">
                <input type="text" placeholder="Nombre completo del Docente">
                <input type="text" placeholder="Número de Empleado / RFC">
                <select>
                    <option value="">Seleccionar Carrera...</option>
                    <option value="tic">Ing. en TICs</option>
                    <option value="ind">Ing. Industrial</option>
                </select>
                <button type="button" class="btn-primary">Registrar Docente</button>
            </form>
        </div>

        <div class="admin-card">
            <div class="card-head">
                <i class='bx bxs-layer'></i>
                <h3>Alta de Retículas</h3>
            </div>
            <form class="admin-form">
                <input type="text" placeholder="Nombre del Plan de Estudios">
                <input type="number" placeholder="Total de Créditos">
                <input type="text" placeholder="Clave de la Carrera">
                <button type="button" class="btn-purple">Crear Retícula</button>
            </form>
        </div>

        <div class="admin-card full-width">
            <div class="card-head">
                <i class='bx bxs-school'></i>
                <h3>Datos de la Institución</h3>
            </div>
            <div class="form-row">
                <input type="text" placeholder="Nombre de la Escuela / Plantel">
                <input type="text" placeholder="Clave de Centro de Trabajo (CCT)">
                <input type="text" placeholder="Dirección Completa">
                <button type="button" class="btn-success">Actualizar Datos</button>
            </div>
        </div>

    </div>
</div>