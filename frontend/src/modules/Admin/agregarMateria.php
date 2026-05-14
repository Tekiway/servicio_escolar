<div class="admin-card">
    <div class="card-head">
        <i class='bx bxs-book-bookmark'></i>
        <h3>Configurar Nueva Materia</h3>
    </div>
    <p style="margin-bottom: 20px; color: #64748b;">Selecciona la ubicación en la retícula antes de registrar.</p>
    
    <form class="admin-form">
        <div class="form-row">
            <select id="carrera-materia" required>
                <option value="">Seleccionar Carrera...</option>
                <option value="TICs">Ingeniería en TICs</option>
                <option value="Industrial">Ingeniería Industrial</option>
            </select>
            
            <select id="semestre-materia" required>
                <option value="">Seleccionar Semestre...</option>
                <option value="1">1er Semestre</option>
                <option value="2">2do Semestre</option>
                <option value="3">3er Semestre</option>
            </select>
        </div>

        <input type="text" placeholder="Nombre de la Materia (Ej. Estructura de Datos)">
        <div class="form-row">
            <input type="text" placeholder="Clave de Materia">
            <input type="number" placeholder="Créditos">
        </div>

        <button type="button" class="btn-primary">Guardar en Retícula</button>
    </form>
</div>