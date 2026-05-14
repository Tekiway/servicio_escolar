<div class="modulo-carreras">
    <header class="carreras-header">
        <div class="icon-graduacion-wrapper">
            <i class='bx bxs-graduation'></i>
        </div>
        <h1>Gestión de Carreras Universitarias</h1>
        <p>Administración de programas académicos y oferta educativa institucional.</p>
    </header>

    <div class="carreras-card">
        <div class="carreras-card-header">
            <i class='bx bx-plus-circle'></i> 
            <span>REGISTRAR NUEVA CARRERA</span>
        </div>
        
        <div class="carreras-card-body">
            <form id="form-registrar-carrera">
                
                <div class="form-grid-2cols">
                    
                    <div class="input-field field-full">
                        <label>NOMBRE OFICIAL DE LA CARRERA</label>
                        <input type="text" name="nombre_carrera" placeholder="Ej. Ingeniería en TICs" required>
                    </div>

                    <div class="input-field">
                        <label>CLAVE OFICIAL (SEP/TECNM)</label>
                        <input type="text" name="clave_carrera" placeholder="Ej. ITIC-2010-225" required>
                    </div>

                    <div class="input-field">
                        <label>MODALIDAD DE ESTUDIO</label>
                        <select name="modalidad" required>
                            <option value="" disabled selected>Seleccionar modalidad...</option>
                            <option value="Escolarizada">Escolarizada</option>
                            <option value="Mixta">Mixta</option>
                        </select>
                    </div>
                </div> <div class="carreras-form-actions">
                    <button type="submit" class="btn-guardar-carrera">
                        <i class='bx bx-save'></i> GUARDAR CARRERA EN SISTEMA
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>