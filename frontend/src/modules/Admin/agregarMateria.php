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
                    
                    <div class="section-divider"><span>1. Datos Básicos de la Materia</span></div>
                    
                    <div class="materia-row-2col">
                        <div class="materia-input-group">
                            <label>Clave de la materia</label>
                            <input type="text" name="clave_materia" placeholder="Ej. AED-1285" required>
                        </div>
                        <div class="materia-input-group">
                            <label>Nombre de la materia</label>
                            <input type="text" name="nombre_materia" placeholder="Ej. Estructura de Datos" required>
                        </div>
                    </div>

                    <div class="materia-input-group full-width">
                        <label>Descripción</label>
                        <textarea name="descripcion_materia" placeholder="Breve descripción de la materia..." rows="2"></textarea>
                    </div>

                    <div class="materia-row-2col" style="grid-template-columns: 1fr 1fr 1fr 1fr;">
                        <div class="materia-input-group">
                            <label>Créditos</label>
                            <input type="number" name="creditos" placeholder="Ej. 5" required min="1">
                        </div>
                        <div class="materia-input-group">
                            <label>Horas teóricas</label>
                            <input type="number" name="horas_teoricas" id="horas_teoricas" placeholder="Ej. 2" required min="0" oninput="calcularTotalHoras()">
                        </div>
                        <div class="materia-input-group">
                            <label>Horas prácticas</label>
                            <input type="number" name="horas_practicas" id="horas_practicas" placeholder="Ej. 3" required min="0" oninput="calcularTotalHoras()">
                        </div>
                        <div class="materia-input-group">
                            <label>Total de horas</label>
                            <input type="number" name="total_horas" id="total_horas" placeholder="Automático" readonly style="background: #f0f0f0; cursor: not-allowed;">
                        </div>
                    </div>

                    <div class="materia-row-2col">
                        <div class="materia-input-group">
                            <label>Clasificación académica</label>
                            <input type="text" name="clasificacion_academica" placeholder="Ej. Ciencias Básicas">
                        </div>
                        <div class="materia-input-group">
                            <label>Semestre</label>
                            <select name="semestre_materia" required>
                                <option value="" disabled selected>Seleccionar...</option>
                                <option value="1">1er Semestre</option>
                                <option value="2">2do Semestre</option>
                                <option value="3">3er Semestre</option>
                                <option value="4">4to Semestre</option>
                                <option value="5">5to Semestre</option>
                                <option value="6">6to Semestre</option>
                                <option value="7">7mo Semestre</option>
                                <option value="8">8vo Semestre</option>
                                <option value="9">9no Semestre</option>
                            </select>
                        </div>
                    </div>

                    <div class="materia-row-2col">
                        <div class="materia-input-group">
                            <label>Carrera o programa educativo</label>
                            <select name="carrera_materia" required>
                                <option value="" disabled selected>Seleccionar Carrera...</option>
                                <option value="Ingeniería en TICs">Ingeniería en TICs</option>
                                <option value="Administración">Administración</option>
                                <option value="Contaduría">Contaduría</option>
                                <option value="Gastronomía">Gastronomía</option>
                            </select>
                        </div>
                        <div class="materia-input-group">
                            <label>Área de conocimiento</label>
                            <input type="text" name="area_conocimiento" placeholder="Ej. Programación">
                        </div>
                    </div>

                    <div class="materia-row-2col">
                        <div class="materia-input-group">
                            <label>Tipo de materia</label>
                            <select name="tipo_materia" required>
                                <option value="" disabled selected>Seleccionar...</option>
                                <option value="Obligatoria">Obligatoria</option>
                                <option value="Optativa">Optativa</option>
                            </select>
                        </div>
                        <div class="materia-input-group">
                            <label>Modalidad</label>
                            <select name="modalidad" required>
                                <option value="" disabled selected>Seleccionar...</option>
                                <option value="Presencial">Presencial</option>
                                <option value="Virtual">Virtual</option>
                                <option value="Mixta">Mixta</option>
                            </select>
                        </div>
                    </div>

                    <div class="section-divider"><span>2. Estructura Académica</span></div>

                    <div class="materia-input-group full-width">
                        <label>Competencia general</label>
                        <textarea name="competencia_general" placeholder="Describe la competencia general..." rows="2"></textarea>
                    </div>

                    <div class="materia-input-group full-width">
                        <label>Competencias específicas</label>
                        <textarea name="competencias_especificas" placeholder="Describe las competencias específicas..." rows="2"></textarea>
                    </div>

                    <div class="materia-input-group full-width">
                        <label>Objetivo de la materia</label>
                        <textarea name="objetivo_materia" placeholder="Describe el objetivo principal..." rows="2"></textarea>
                    </div>

                    <div class="materia-input-group full-width">
                        <label>Prerrequisitos</label>
                        <input type="text" name="prerrequisitos" placeholder="Ej. Fundamentos de Programación">
                    </div>

                    <div class="section-divider"><span>Unidades de aprendizaje</span></div>
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                        <div class="materia-input-group" style="width: 200px;">
                            <label>Número de unidades</label>
                            <input type="number" id="num-unidades" placeholder="Ej. 6" min="1" style="padding: 8px; border: 1px solid #cbd5e1; border-radius: 6px;">
                        </div>
                        <button type="button" id="btn-agregar-unidad" class="btn-secundario" style="margin-top: 15px;">
                            <i class='bx bx-plus'></i> Agregar Unidad
                        </button>
                    </div>
                    <div id="unidades-container">
                    </div>

                    <div class="section-divider"><span>3. Control Administrativo</span></div>

                    <div class="materia-row-2col" style="grid-template-columns: 1fr 1fr 1fr;">
                        <div class="materia-input-group">
                            <label>Estado</label>
                            <select name="estado" required>
                                <option value="Activa">Activa</option>
                                <option value="Inactiva">Inactiva</option>
                            </select>
                        </div>
                        <div class="materia-input-group">
                            <label>Versión del programa</label>
                            <input type="text" name="version_programa" placeholder="Ej. 2024-1">
                        </div>
                        <div class="materia-input-group">
                            <label>Fecha de creación</label>
                            <input type="date" name="fecha_creacion" required>
                        </div>
                    </div>

                    <div class="materia-input-group full-width">
                        <label>Observaciones</label>
                        <textarea name="observaciones" placeholder="Cualquier observación adicional..." rows="2"></textarea>
                    </div>

                    <div class="materia-actions" style="margin-top: 20px;">
                        <button type="submit" class="btn-guardar-materia">
                            <i class='bx bx-save'></i>
                            Guardar Materia en Retícula
                        </button>
                    </div>
                </form>

                <script>
                    function calcularTotalHoras() {
                        const ht = parseInt(document.getElementById('horas_teoricas').value) || 0;
                        const hp = parseInt(document.getElementById('horas_practicas').value) || 0;
                        document.getElementById('total_horas').value = ht + hp;
                    }
                </script>
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
            <div class="body-materias table-body-materias">
                <div class="table-responsive">
                    <table class="materia-custom-table">
                        <thead>
                            <tr>
                                <th>Clave</th>
                                <th>Materia y Detalles</th>
                                <th>Carrera / Semestre</th>
                                <th>Estado</th>
                                <th style="text-align: center;">Acciones</th>
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