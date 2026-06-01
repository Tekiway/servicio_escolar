<div class="animate__animated animate__fadeIn" style="display: flex; flex-direction: column; gap: 25px;">
    <!-- Encabezado -->
    <div class="module-header" style="margin-bottom: 5px;">
        <h2 style="color: #1e293b; font-size: 1.8rem; font-weight: 800; display: flex; align-items: center; gap: 8px;">
            <i class='bx bxs-credit-card-front' style="color: var(--primary);"></i> Mis Boletos y Pases Oficiales
        </h2>
        <p style="color: #64748b;">Administra y descarga tus boletos de eventos, congresos y rifas institucionales activas.</p>
    </div>

    <!-- Malla de Boletos -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 25px;">
        <!-- Boleto 1: Congreso TICs -->
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); border-radius: 16px; backdrop-filter: blur(10px); overflow: hidden; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 10px 25px rgba(0,0,0,0.02); transition: transform 0.2s;" onmouseenter="this.style.transform='translateY(-4px)'" onmouseleave="this.style.transform='translateY(0)'">
            <div style="background: linear-gradient(135deg, var(--primary), var(--secondary)); padding: 20px; color: #fff; position: relative;">
                <span style="font-size: 0.7rem; font-weight: 800; letter-spacing: 0.15em; text-transform: uppercase; background: rgba(255,255,255,0.2); padding: 4px 10px; border-radius: 20px; display: inline-block;">CONGRESO ACADÉMICO</span>
                <h3 style="margin: 10px 0 5px 0; font-size: 1.25rem; font-weight: 800;">4° Congreso de Inteligencia Artificial y TICs</h3>
                <span style="font-size: 0.8rem; opacity: 0.9;"><i class='bx bx-calendar-event'></i> 28 de Mayo, 2026 | 09:00 hrs</span>
                <div style="position: absolute; right: 20px; top: 20px; font-size: 2.5rem; opacity: 0.2;"><i class='bx bxs-network-chart'></i></div>
            </div>
            
            <div style="padding: 20px; display: flex; flex-direction: column; gap: 15px;">
                <div style="display: flex; justify-content: space-between; font-size: 0.85rem; color: #64748b;">
                    <span><strong>Lugar:</strong> Explanada del Auditorio A</span>
                    <span><strong>Asiento:</strong> General</span>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 0.85rem; color: #64748b;">
                    <span><strong>Titular:</strong> Heber Castañeda Flores</span>
                    <span><strong>Código:</strong> #TIC-8821</span>
                </div>
                
                <button class="btn-finance-action" style="width: 100%; justify-content: center; background: linear-gradient(135deg, var(--primary), var(--secondary)); border: none; color: white;" onclick="abrirPaseModal('Congreso de IA y TICs', '#TIC-8821')">
                    <i class='bx bx-qr-scan'></i> MOSTRAR ACCESO / QR
                </button>
            </div>
        </div>

        <!-- Boleto 2: Rifa Universitaria -->
        <div style="background: var(--bg-glass); border: 1px solid var(--border-glass); border-radius: 16px; backdrop-filter: blur(10px); overflow: hidden; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 10px 25px rgba(0,0,0,0.02); transition: transform 0.2s;" onmouseenter="this.style.transform='translateY(-4px)'" onmouseleave="this.style.transform='translateY(0)'">
            <div style="background: linear-gradient(135deg, var(--secondary), var(--accent)); padding: 20px; color: #fff; position: relative;">
                <span style="font-size: 0.7rem; font-weight: 800; letter-spacing: 0.15em; text-transform: uppercase; background: rgba(255,255,255,0.2); padding: 4px 10px; border-radius: 20px; display: inline-block;">EVENTO CON CAUSA</span>
                <h3 style="margin: 10px 0 5px 0; font-size: 1.25rem; font-weight: 800;">Gran Rifa Universitaria Pro-Becas 2026</h3>
                <span style="font-size: 0.8rem; opacity: 0.9;"><i class='bx bx-award'></i> Sorteo: 15 de Junio, 2026</span>
                <div style="position: absolute; right: 20px; top: 20px; font-size: 2.5rem; opacity: 0.2;"><i class='bx bxs-coupon'></i></div>
            </div>
            
            <div style="padding: 20px; display: flex; flex-direction: column; gap: 15px;">
                <div style="display: flex; justify-content: space-between; font-size: 0.85rem; color: #64748b;">
                    <span><strong>Premio Mayor:</strong> MacBook Pro M3</span>
                    <span><strong>Costo:</strong> $150.00</span>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 0.85rem; color: #64748b;">
                    <span><strong>N° Boleto:</strong> 04821</span>
                    <span><strong>Código:</strong> #RIF-9021</span>
                </div>
                
                <button class="btn-finance-action" style="width: 100%; justify-content: center; background: linear-gradient(135deg, var(--secondary), var(--accent)); border: none; color: white;" onclick="abrirPaseModal('Gran Rifa Pro-Becas', '#RIF-9021')">
                    <i class='bx bx-qr-scan'></i> VER TICKET COMPLETO
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL DE ACCESO / QR -->
    <div id="modal-qr-pase" style="display: none; position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.4); backdrop-filter: blur(5px); z-index: 1000; align-items: center; justify-content: center;">
        <div class="finance-section-card" style="max-width: 400px; width: 90%; position: relative; margin-bottom: 0; text-align: center; padding: 35px 25px;">
            <i class='bx bx-x' style="position: absolute; top: 20px; right: 20px; font-size: 2rem; cursor: pointer; color: var(--finanzas-text-muted);" onclick="cerrarPaseModal()"></i>
            
            <div style="margin-bottom: 15px;">
                <span style="font-size: 0.75rem; font-weight: 800; letter-spacing: 0.15em; color: var(--primary); text-transform: uppercase;" id="modal-event-type">CONGRESO ACADÉMICO</span>
                <h3 style="margin: 5px 0; font-size: 1.4rem; font-weight: 800; color: #1e293b;" id="modal-event-title">4° Congreso de IA y TICs</h3>
            </div>
            
            <!-- Simulador de QR -->
            <div style="background: #fff; border: 1px solid #e2e8f0; width: 220px; height: 220px; margin: 20px auto; border-radius: 12px; display: flex; align-items: center; justify-content: center; padding: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); position: relative;">
                <!-- Un ícono de QR de Boxicons muy nítido -->
                <i class='bx bx-qr' style="font-size: 10.5rem; color: #1e293b;"></i>
                <div style="position: absolute; width: 30px; height: 30px; background: #fff; border-radius: 6px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    <i class='bx bxs-graduation' style="color: var(--primary); font-size: 1.2rem;"></i>
                </div>
            </div>

            <div style="font-size: 0.85rem; color: #64748b; margin-top: 15px;">
                <span style="display: block;"><strong>Titular:</strong> Heber Castañeda Flores</span>
                <span style="display: block; margin-top: 4px;" id="modal-event-code">ID Acceso: #TIC-8821</span>
                <span class="badge success" style="display: inline-block; margin-top: 10px; padding: 4px 10px; background: rgba(5,150,105,0.1); color: #059669; border-radius: 20px; font-weight: 700; font-size: 0.75rem;"><i class='bx bxs-check-shield'></i> PASE VÁLIDO</span>
            </div>
        </div>
    </div>
</div>

<script>
    function abrirPaseModal(titulo, codigo) {
        document.getElementById('modal-event-title').textContent = titulo;
        document.getElementById('modal-event-code').innerHTML = '<strong>ID Acceso:</strong> ' + codigo;
        
        const typeField = document.getElementById('modal-event-type');
        if (codigo.includes('RIF')) {
            typeField.textContent = 'EVENTO CON CAUSA';
            typeField.style.color = 'var(--secondary)';
        } else {
            typeField.textContent = 'CONGRESO ACADÉMICO';
            typeField.style.color = 'var(--primary)';
        }

        document.getElementById('modal-qr-pase').style.display = 'flex';
    }

    function cerrarPaseModal() {
        document.getElementById('modal-qr-pase').style.display = 'none';
    }
</script>
