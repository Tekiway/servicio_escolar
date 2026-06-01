<div class="animate__animated animate__fadeIn" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Encabezado -->
    <div class="module-header" style="margin-bottom: 5px;">
        <h2 style="color: #1e293b; font-size: 1.8rem; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i class='bx bxs-edit-location' style="color: var(--primary);"></i> Trámite de Ficha de Examen
        </h2>
        <p style="color: #64748b;">Ingresa tus datos escolares de procedencia para generar tu ficha oficial de ingreso.</p>
    </div>

    <!-- Ficha Generada (Si ya existe) -->
    <div id="ficha-resultado-container" style="display: none; background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 30px; border-radius: 16px; backdrop-filter: blur(10px); box-shadow: 0 10px 25px rgba(0,0,0,0.02);">
        <div style="border: 2px dashed var(--primary); padding: 25px; border-radius: 12px; background: rgba(255,255,255,0.4); text-align: center; position: relative;">
            <div style="position: absolute; top: 15px; right: 15px; background: rgba(5,150,105,0.1); color: #059669; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 700;">
                <i class='bx bxs-check-circle'></i> REGISTRO EXITOSO
            </div>
            
            <i class='bx bxs-badge-check' style="font-size: 4rem; color: var(--primary); margin-bottom: 15px;"></i>
            <h3 style="margin: 0 0 5px 0; font-size: 1.5rem; font-weight: 800; color: #1e293b;">FICHA DE INGRESO OFICIAL</h3>
            <span style="font-size: 0.9rem; color: #64748b; font-weight: 700; display: block;" id="res-folio">Folio Ficha: #2026-F-8821</span>
            
            <hr style="border: 0; border-top: 1px dashed rgba(99, 102, 241, 0.4); margin: 20px 0;">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; text-align: left; font-size: 0.9rem; color: #64748b; max-width: 500px; margin: 0 auto;">
                <span><strong>Nombre:</strong> <span id="res-nombre">Juan Pérez</span></span>
                <span><strong>CURP:</strong> <span id="res-curp">PERJ990101HDF</span></span>
                <span><strong>Procedencia:</strong> <span id="res-prepa">CBTIS 13</span></span>
                <span><strong>Promedio Prepa:</strong> <span id="res-promedio">9.2</span></span>
                <span style="grid-column: span 2;"><strong>Carrera Elegida:</strong> <span id="res-carrera" style="color: var(--primary-dark); font-weight: 700;">Ingeniería en TICs</span></span>
            </div>

            <div style="background: #fff; border: 1px solid #e2e8f0; width: 140px; height: 140px; margin: 25px auto 15px auto; border-radius: 8px; display: flex; align-items: center; justify-content: center; padding: 10px;">
                <i class='bx bx-qr' style="font-size: 7.5rem; color: #1e293b;"></i>
            </div>
            <span style="font-size: 0.75rem; color: #94a3b8; letter-spacing: 0.25em;">* ESCANEAR EN CONTROL DE ACCESO *</span>
            
            <div style="display: flex; gap: 15px; justify-content: center; margin-top: 25px;">
                <button class="btn-finance-action secondary" onclick="descargarFichaPDF()"><i class='bx bxs-file-pdf'></i> Descargar Ficha PDF</button>
                <button class="btn-finance-action" onclick="rehacerFicha()"><i class='bx bx-reset'></i> Corregir Datos</button>
            </div>
        </div>
    </div>

    <!-- Formulario para Tramitar Ficha -->
    <div id="ficha-formulario-container" style="background: var(--bg-glass); border: 1px solid var(--border-glass); padding: 30px; border-radius: 16px; backdrop-filter: blur(10px); box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
        <h3 style="margin: 0 0 20px 0; color: #1e293b; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i class='bx bxs-edit' style="color: var(--secondary);"></i> Registro y Selección de Carrera
        </h3>
        
        <form id="form-registro-ficha" style="display: flex; flex-direction: column; gap: 15px;" onsubmit="registrarFichaExitosa(event)">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div style="display: flex; flex-direction: column; gap: 5px;">
                    <label style="font-size: 0.8rem; font-weight: 700; color: #64748b;">NOMBRE COMPLETO</label>
                    <input type="text" id="ficha-nombre" required placeholder="Ej. Diana Karen Santos Reyes" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none;">
                </div>
                <div style="display: flex; flex-direction: column; gap: 5px;">
                    <label style="font-size: 0.8rem; font-weight: 700; color: #64748b;">CURP</label>
                    <input type="text" id="ficha-curp" required placeholder="Ej. SARD010203HDF" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none; text-transform: uppercase;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 15px;">
                <div style="display: flex; flex-direction: column; gap: 5px;">
                    <label style="font-size: 0.8rem; font-weight: 700; color: #64748b;">PREPARATORIA DE PROCEDENCIA</label>
                    <input type="text" id="ficha-prepa" required placeholder="Ej. CBTIS N° 13, Colegio de Bachilleres" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none;">
                </div>
                <div style="display: flex; flex-direction: column; gap: 5px;">
                    <label style="font-size: 0.8rem; font-weight: 700; color: #64748b;">PROMEDIO GENERAL PREPA</label>
                    <input type="number" id="ficha-promedio" step="0.1" min="6.0" max="10.0" required placeholder="Ej. 9.2" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none;">
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 5px;">
                <label style="font-size: 0.8rem; font-weight: 700; color: #64748b;">CARRERA / INGENIERÍA DESEADA</label>
                <select id="ficha-carrera" style="padding: 10px 15px; border-radius: 8px; border: 1px solid #cbd5e1; outline: none;">
                    <option value="Ingeniería en Tecnologías de la Información y Comunicaciones">Ingeniería en Tecnologías de la Información y Comunicaciones</option>
                    <option value="Ingeniería en Sistemas Computacionales">Ingeniería en Sistemas Computacionales</option>
                    <option value="Licenciatura en Administración de Empresas">Licenciatura en Administración de Empresas</option>
                    <option value="Licenciatura en Diseño y Animación Digital">Licenciatura en Diseño y Animación Digital</option>
                </select>
            </div>

            <button class="btn-finance-action" type="submit" style="margin-top: 15px; justify-content: center; width: 100%; background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white;">
                <i class='bx bx-check-double'></i> ENVIAR SOLICITUD Y GENERAR FICHA
            </button>
        </form>
    </div>
</div>

<script>
    (function() {
        const storedFicha = localStorage.getItem('aspirante_ficha');
        if (storedFicha) {
            mostrarFichaGenerada(JSON.parse(storedFicha));
        }
    })();

    function mostrarFichaGenerada(data) {
        document.getElementById('res-nombre').textContent = data.nombre;
        document.getElementById('res-curp').textContent = data.curp.toUpperCase();
        document.getElementById('res-prepa').textContent = data.prepa;
        document.getElementById('res-promedio').textContent = parseFloat(data.promedio).toFixed(1);
        document.getElementById('res-carrera').textContent = data.carrera;

        document.getElementById('ficha-formulario-container').style.display = 'none';
        document.getElementById('ficha-resultado-container').style.display = 'block';
    }

    function registrarFichaExitosa(event) {
        event.preventDefault();
        const nombre = document.getElementById('ficha-nombre').value;
        const curp = document.getElementById('ficha-curp').value;
        const prepa = document.getElementById('ficha-prepa').value;
        const promedio = document.getElementById('ficha-promedio').value;
        const carrera = document.getElementById('ficha-carrera').value;

        const data = { nombre, curp, prepa, promedio, carrera };
        localStorage.setItem('aspirante_ficha', JSON.stringify(data));
        
        // Registrar en general para sincronizar
        localStorage.setItem('aspirante_registro', JSON.stringify({ nombre }));
        document.getElementById('aspirante-header-name').textContent = nombre;

        alert("Solicitud procesada con éxito.\nSe ha generado su folio oficial de ficha.");
        mostrarFichaGenerada(data);
    }

    function rehacerFicha() {
        if(confirm("¿Seguro que deseas rehacer tu trámite de ficha? Esto eliminará el folio anterior.")) {
            localStorage.removeItem('aspirante_ficha');
            document.getElementById('ficha-resultado-container').style.display = 'none';
            document.getElementById('ficha-formulario-container').style.display = 'block';
        }
    }

    function descargarFichaPDF() {
        alert("Generando y descargando formato PDF de Ficha de Admisión...\n\nDocumento: Ficha_Examen_Ingreso_2026.pdf (Listo para impresión).");
    }
</script>
