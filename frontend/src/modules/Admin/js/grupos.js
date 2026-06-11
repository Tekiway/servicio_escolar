/**
 * grupos.js — Interfaz visual para gestión de Grupos y Horarios.
 * Lógica base de la UI (tabs, colapsables) y simulación.
 */

// ─── TABS ──────────────────────────────────────────────────────────────────
function switchTab(tabId, btn) {
    // Ocultar todos los tabs
    document.querySelectorAll('.tab-content').forEach(t => t.style.display = 'none');
    // Quitar activo de todos los botones
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    
    // Mostrar tab actual
    document.getElementById(tabId).style.display = 'block';
    // Activar botón actual
    btn.classList.add('active');
}

// ─── COLAPSABLES ────────────────────────────────────────────────────────────
function toggleSeccion(idCuerpo, idIcono) {
    const cuerpo = document.getElementById(idCuerpo);
    const icono  = document.getElementById(idIcono);
    if (!cuerpo) return;
    const visible = cuerpo.style.display === 'block';
    cuerpo.style.display = visible ? 'none' : 'block';
    if (icono) icono.style.transform = visible ? 'rotate(-90deg)' : 'rotate(0deg)';
}

// ─── SIMULACIÓN DE INTERFAZ ──────────────────────────────────────────────────

// Listener para el selector de grupo en el tab de horarios
document.addEventListener('DOMContentLoaded', () => {
    const selectGrupo = document.getElementById('select-grupo-horario');
    if(selectGrupo){
        selectGrupo.addEventListener('change', (e) => {
            const panel = document.getElementById('panel-horario-editor');
            if(e.target.value) {
                panel.style.display = 'block';
            } else {
                panel.style.display = 'none';
            }
        });
    }
});

function simularAgregarClase() {
    const btn = document.querySelector('#form-agregar-clase .btn-primary');
    btn.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i> Guardando...";
    setTimeout(() => {
        alert("¡Clase agregada! (Simulación visual, backend de horarios aún no implementado)");
        btn.innerHTML = "<i class='bx bx-plus'></i> Agregar al Horario";
    }, 800);
}
