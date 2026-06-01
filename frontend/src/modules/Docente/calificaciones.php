<div class="animate__animated animate__fadeIn">
    <div class="module-header" style="margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2 style="color: var(--text-primary); font-size: 1.8rem; font-weight: 800;">
                <i class='bx bxs-edit-alt' style="color: var(--docente-primary);"></i> Registro de Calificaciones
            </h2>
            <p style="color: var(--text-secondary);">Selecciona un grupo para comenzar la evaluación.</p>
        </div>
        <div class="header-actions">
            <select class="custom-select" style="padding: 12px 20px; border-radius: 12px; border: 1px solid #e2e8f0; outline: none; font-weight: 600;">
                <option>Seleccionar Clase...</option>
                <option selected>Matemáticas Avanzadas I (402-A)</option>
                <option>Cálculo Diferencial (201-B)</option>
                <option>Álgebra Lineal (105-C)</option>
            </select>
        </div>
    </div>

    <div class="grades-container" style="background: white; border-radius: 25px; padding: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); border: 1px solid rgba(0,0,0,0.05);">
        <table style="width: 100%; border-collapse: separate; border-spacing: 0 10px;">
            <thead>
                <tr style="color: var(--text-secondary); text-align: left;">
                    <th style="padding: 15px; font-weight: 700; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px;">Matrícula</th>
                    <th style="padding: 15px; font-weight: 700; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px;">Alumno</th>
                    <th style="padding: 15px; font-weight: 700; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px;">P1 (20%)</th>
                    <th style="padding: 15px; font-weight: 700; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px;">P2 (20%)</th>
                    <th style="padding: 15px; font-weight: 700; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px;">P3 (30%)</th>
                    <th style="padding: 15px; font-weight: 700; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px;">EF (30%)</th>
                    <th style="padding: 15px; font-weight: 700; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px;">Final</th>
                </tr>
            </thead>
            <tbody>
                <!-- Fila de ejemplo 1 -->
                <tr style="background: #f8fafc; transition: transform 0.2s;">
                    <td style="padding: 15px; border-radius: 15px 0 0 15px; font-weight: 700;">20210045</td>
                    <td style="padding: 15px;">Mendoza Ruiz Carlos</td>
                    <td style="padding: 15px;"><input type="number" value="9.5" style="width: 60px; padding: 8px; border-radius: 8px; border: 1px solid #cbd5e1; text-align: center;"></td>
                    <td style="padding: 15px;"><input type="number" value="8.0" style="width: 60px; padding: 8px; border-radius: 8px; border: 1px solid #cbd5e1; text-align: center;"></td>
                    <td style="padding: 15px;"><input type="number" value="" placeholder="-" style="width: 60px; padding: 8px; border-radius: 8px; border: 1px solid #cbd5e1; text-align: center;"></td>
                    <td style="padding: 15px;"><input type="number" value="" placeholder="-" style="width: 60px; padding: 8px; border-radius: 8px; border: 1px solid #cbd5e1; text-align: center;"></td>
                    <td style="padding: 15px; border-radius: 0 15px 15px 0;"><span style="font-weight: 800; color: var(--docente-primary);">N/A</span></td>
                </tr>

                <!-- Fila de ejemplo 2 -->
                <tr style="background: #ffffff; border: 1px solid #f1f5f9;">
                    <td style="padding: 15px; border-radius: 15px 0 0 15px; font-weight: 700;">20210122</td>
                    <td style="padding: 15px;">Sánchez Ortiz Elena</td>
                    <td style="padding: 15px;"><input type="number" value="10.0" style="width: 60px; padding: 8px; border-radius: 8px; border: 1px solid #cbd5e1; text-align: center;"></td>
                    <td style="padding: 15px;"><input type="number" value="9.5" style="width: 60px; padding: 8px; border-radius: 8px; border: 1px solid #cbd5e1; text-align: center;"></td>
                    <td style="padding: 15px;"><input type="number" value="" placeholder="-" style="width: 60px; padding: 8px; border-radius: 8px; border: 1px solid #cbd5e1; text-align: center;"></td>
                    <td style="padding: 15px;"><input type="number" value="" placeholder="-" style="width: 60px; padding: 8px; border-radius: 8px; border: 1px solid #cbd5e1; text-align: center;"></td>
                    <td style="padding: 15px; border-radius: 0 15px 15px 0;"><span style="font-weight: 800; color: var(--docente-primary);">N/A</span></td>
                </tr>
            </tbody>
        </table>

        <div style="margin-top: 30px; display: flex; justify-content: flex-end; gap: 15px;">
            <button style="padding: 12px 30px; border-radius: 15px; border: none; background: #e2e8f0; color: #475569; font-weight: 700; cursor: pointer;">Cancelar</button>
            <button style="padding: 12px 30px; border-radius: 15px; border: none; background: var(--docente-primary); color: white; font-weight: 700; cursor: pointer; box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);">Guardar Cambios</button>
        </div>
    </div>
</div>
