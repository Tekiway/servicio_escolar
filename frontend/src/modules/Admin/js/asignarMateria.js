// asignarMateria.js

window.togglePanel = function(panelId) {
    const panel = document.getElementById(panelId);
    
    if (!panel) {
        console.error("No se encontró el panel: " + panelId);
        return;
    }

    panel.classList.toggle('active');
    
    console.log("Cambiando estado de: " + panelId);
};