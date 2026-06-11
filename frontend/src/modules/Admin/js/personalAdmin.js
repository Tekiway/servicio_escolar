function toggleSeccion(idCuerpo, idIcono) {
    const cuerpo = document.getElementById(idCuerpo);
    const icono  = document.getElementById(idIcono);
    if (!cuerpo) return;
    const visible = cuerpo.style.display === 'block';
    cuerpo.style.display = visible ? 'none' : 'block';
    if (icono) icono.style.transform = visible ? 'rotate(-90deg)' : 'rotate(0deg)';
}
