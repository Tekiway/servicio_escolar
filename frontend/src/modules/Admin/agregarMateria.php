<div class="main-card-materias">
    <div class="header-materias">
        <div class="icon-materia-box">
            <i class='bx bxs-book-add'></i>
        </div>
        <div class="info-materia">
            <h2>Configurar Nueva Materia</h2>
            <p>Selecciona la ubicación en la retícula y los detalles académicos.</p>
        </div>
    </div>

    <div class="body-materias">
        <form id="form-agregar-materia" class="form-materias-grid">
            
            <div class="materia-row-2col">
                <div class="materia-input-group">
                    <label>Seleccionar Carrera</label>
                    <select name="carrera_materia" required>
                        <option value="" disabled selected>Seleccionar Carrera...</option>
                        </select>
                </div>
                <div class="materia-input-group">
                    <label>Seleccionar Semestre</label>
                    <select name="semestre_materia" required>
                        <option value="" disabled selected>Seleccionar Semestre...</option>
                        <option value="1">1er Semestre</option>
                        <option value="2">2do Semestre</option>
                    </select>
                </div>
            </div>

            <div class="materia-input-group full-width">
                <label>Nombre de la Materia</label>
                <input type="text" name="nombre_materia" placeholder="Ej. Estructura de Datos" required>
            </div>

            <div class="materia-row-2col">
                <div class="materia-input-group">
                    <label>Clave de Materia</label>
                    <input type="text" name="clave_materia" placeholder="Ej. AED-1285" required>
                </div>
                <div class="materia-input-group">
                    <label>Créditos</label>
                    <input type="number" name="creditos" placeholder="Ej. 5" required>
                </div>
            </div>

            <div class="materia-actions">
                <button type="submit" class="btn-guardar-materia">
                    <i class='bx bx-plus-circle'></i>
                    Guardar en Retícula
                </button>
            </div>
        </form>
    </div>
</div>