<div class="container-materias-wrapper">
    <!-- agregarMateria.php -->
    <div class="main-card-materias">
        <div class="header-materias accordion-header active" data-target="form-registro">
            <div class="icon-materia-box">
                <i class='bx bxs-book-add'></i>
            </div>
            <div class="info-materia">
                <h2>Configurar Nueva Materia</h2>
                <p>Haz clic para desplegar el formulario de registro.</p>
            </div>
            <i class='bx bx-chevron-down arrow-icon'></i>
        </div>

        <div id="form-registro" class="accordion-content open">
            <div class="body-materias">
                <form id="form-agregar-materia" class="form-materias-grid">
                    
                    <div class="section-divider"><span>1. Datos de Ubicación</span></div>
                    <div class="materia-row-2col">
                        <div class="materia-input-group">
                            <label>Seleccionar Carrera</label>
                            <select name="carrera_materia" required>
                                <option value="" disabled selected>Seleccionar Carrera...</option>
                                <option value="TICs">TICs</option>
                            </select>
                        </div>
                        <div class="materia-input-group">
                            <label>Seleccionar Semestre</label>
                            <select name="semestre_materia" required>
                                <option value="" disabled selected>Seleccionar...</option>
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

                    <div class="section-divider"><span>2. Configuración Académica</span></div>
                    <div class="materia-input-group full-width">
                        <label>Objetivo General de la Asignatura</label>
                        <textarea name="objetivo_general" placeholder="Describe el propósito principal de la materia..." rows="3"></textarea>
                    </div>
                    <div class="materia-input-group full-width">
                        <label>Características / Competencias</label>
                        <input type="text" name="caracteristicas" placeholder="Ej. Horas teóricas, Horas prácticas, Competencias previas...">
                    </div>

                    <div class="section-divider"><span>3. Unidades Temáticas</span></div>
                    <div id="unidades-container">
                        </div>
                    <button type="button" id="btn-agregar-unidad" class="btn-secundario">
                        <i class='bx bx-plus'></i> Agregar Unidad
                    </button>

                    <div class="materia-actions">
                        <button type="submit" class="btn-guardar-materia">
                            <i class='bx bx-save'></i>
                            Guardar Materia en Retícula
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="main-card-materias table-card-mt">
        <div class="header-materias accordion-header" data-target="tabla-registros">
            <div class="icon-materia-box table-icon">
                <i class='bx bx-list-ul'></i>
            </div>
            <div class="info-materia">
                <h2>Materias Registradas</h2>
                <p>Visualiza y gestiona las materias que ya están en la retícula.</p>
            </div>
            <i class='bx bx-chevron-down arrow-icon'></i>
        </div>

        <div id="tabla-registros" class="accordion-content">
            <div class="body-materias">
                <div class="table-responsive">
                    <table class="materia-custom-table">
                        <thead>
                            <tr>
                                <th>Clave</th>
                                <th>Materia</th>
                                <th>Carrera</th>
                                <th>Semestre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="lista-materias-body">
                            <tr>
                                <td>AED-1285</td>
                                <td>Estructura de Datos</td>
                                <td>TICs</td>
                                <td>2do</td>
                                <td>
                                    <button class="btn-edit"><i class='bx bx-edit-alt'></i></button>
                                    <button class="btn-delete"><i class='bx bx-trash'></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>