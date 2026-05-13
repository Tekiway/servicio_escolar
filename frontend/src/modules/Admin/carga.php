<div class="main-card-carga">
    <div class="header-carga">
        <div class="icon-carga-box">
            <i class='bx bx-cog'></i>
        </div>
        <div class="info-carga">
            <h2>Gestión de Carga Académica</h2>
            <p>Administración de docentes, planes de estudio y datos institucionales.</p>
        </div>
    </div>

    <div class="body-carga">
        <div class="sub-card-registro">
            <div class="sub-card-header">
                <i class='bx bx-user-plus'></i>
                <span>Registro de Docentes</span>
            </div>

            <form id="form-registrar-docente" class="form-carga-grid">
                <div class="carga-input-group full-width">
                    <label>Nombre completo del Docente</label>
                    <input type="text" name="nombre_docente" placeholder="Ej. Juan Pérez García" required>
                </div>

                <div class="carga-row-2col">
                    <div class="carga-input-group">
                        <label>Número de Empleado / RFC</label>
                        <input type="text" name="rfc_docente" placeholder="RFC o Clave" required>
                    </div>

                    <div class="carga-input-group">
                        <label>Seleccionar Carrera</label>
                        <select name="carrera_docente" required>
                            <option value="" disabled selected>Seleccionar Carrera...</option>
                            </select>
                    </div>
                </div>

                <div class="carga-actions">
                    <button type="submit" class="btn-registrar-docente">
                        <i class='bx bx-user-check'></i>
                        Registrar Docente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>