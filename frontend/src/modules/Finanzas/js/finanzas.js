/**
 * finanzas.js
 * Módulo de Finanzas — Gestión de colegiaturas y cobros.
 * Conectado al API Gateway → /api/finanzas
 * Requiere: apiGateway.js (window.API)
 */

// ─── Bootstrap ────────────────────────────────────────────────────────────────

document.addEventListener('DOMContentLoaded', () => {
    console.log('[Finanzas] Módulo inicializado.');
    _registrarEventos();
});

// ─── Helpers ──────────────────────────────────────────────────────────────────

function _toast(msg, tipo = 'success') {
    const colores = { success: '#059669', error: '#dc2626', info: '#6366f1' };
    const el = Object.assign(document.createElement('div'), {
        textContent: msg,
        style: [
            'position:fixed;top:20px;right:20px;z-index:9999',
            'padding:12px 22px;border-radius:10px;color:#fff;font-weight:700',
            `background:${colores[tipo] || colores.info}`,
            'box-shadow:0 4px 20px rgba(0,0,0,.15);transition:opacity .4s'
        ].join(';')
    });
    document.body.appendChild(el);
    setTimeout(() => { el.style.opacity = '0'; setTimeout(() => el.remove(), 400); }, 3500);
}

// ─── Registrar eventos ────────────────────────────────────────────────────────

function _registrarEventos() {
    // Formulario de nuevo cobro
    const formCobro = document.getElementById('form-nuevo-cobro');
    if (formCobro) formCobro.addEventListener('submit', crearCobro);

    // Buscar estado de cuenta por alumno
    const formBuscar = document.getElementById('form-buscar-cuenta');
    if (formBuscar) formBuscar.addEventListener('submit', buscarCuentaAlumno);
}

// ─── Crear cobro ──────────────────────────────────────────────────────────────

async function crearCobro(event) {
    event.preventDefault();
    const form = event.target;
    const btn  = form.querySelector('[type="submit"]');
    const orig = btn.innerHTML;

    btn.disabled  = true;
    btn.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i> Registrando...";

    const datos = {
        studentId:   form.querySelector('#cobro-alumno-id')?.value.trim(),
        amount:      parseFloat(form.querySelector('#cobro-monto')?.value) || 0,
        description: form.querySelector('#cobro-descripcion')?.value.trim(),
        period:      form.querySelector('#cobro-periodo')?.value.trim()
    };

    try {
        await API.Finanzas.crearCobro(datos);
        _toast('Cobro registrado exitosamente.');
        form.reset();
    } catch (err) {
        _toast(err.message, 'error');
    } finally {
        btn.disabled  = false;
        btn.innerHTML = orig;
    }
}

// ─── Pagar colegiatura ────────────────────────────────────────────────────────

async function pagarColegiatura(colegiaturaId, btnEl) {
    if (!confirm('¿Confirmar el pago de esta colegiatura?')) return;

    const orig = btnEl.innerHTML;
    btnEl.disabled  = true;
    btnEl.innerHTML = "<i class='bx bx-loader-alt bx-spin'></i>";

    try {
        await API.Finanzas.pagarColegiatura(colegiaturaId);
        _toast('¡Pago registrado correctamente!');
        // Recargar tabla si existe
        const studentId = document.getElementById('buscar-alumno-id')?.value;
        if (studentId) buscarCuentaAlumno(null, studentId);
    } catch (err) {
        _toast(err.message, 'error');
        btnEl.disabled  = false;
        btnEl.innerHTML = orig;
    }
}

// ─── Buscar estado de cuenta de alumno ───────────────────────────────────────

async function buscarCuentaAlumno(event, studentIdDirecto = null) {
    if (event) event.preventDefault();

    const studentId = studentIdDirecto ||
        document.getElementById('buscar-alumno-id')?.value.trim();

    if (!studentId) return;

    const contenedor = document.getElementById('cuenta-resultado');
    if (!contenedor) return;

    contenedor.innerHTML = `<p style="text-align:center;"><i class='bx bx-loader-alt bx-spin'></i> Buscando...</p>`;

    try {
        const data       = await API.Finanzas.estadoCuentaAlumno(studentId);
        const colegiaturas = data?.tuitions || data?.data || [];

        if (!colegiaturas.length) {
            contenedor.innerHTML = `<p style="color:#94a3b8;text-align:center;">Sin colegiaturas registradas.</p>`;
            return;
        }

        contenedor.innerHTML = colegiaturas.map(c => `
            <div style="display:flex;justify-content:space-between;align-items:center;
                        padding:12px 16px;background:#f8fafc;border-radius:10px;
                        border:1px solid #e2e8f0;margin-bottom:10px;">
                <div>
                    <strong>${c.description || c.period || 'Colegiatura'}</strong>
                    <span style="display:block;font-size:0.8rem;color:#64748b;">
                        Periodo: ${c.period || '—'} · Monto: $${c.amount?.toFixed(2) || '0.00'}
                    </span>
                </div>
                <div style="display:flex;align-items:center;gap:10px;">
                    <span style="padding:4px 12px;border-radius:20px;font-size:0.75rem;font-weight:700;
                        background:${c.paid ? 'rgba(5,150,105,.1)' : 'rgba(220,38,38,.1)'};
                        color:${c.paid ? '#059669' : '#dc2626'};">
                        ${c.paid ? '✓ LIQUIDADO' : 'PENDIENTE'}
                    </span>
                    ${!c.paid ? `
                        <button onclick="pagarColegiatura('${c._id}', this)"
                            style="padding:6px 14px;background:#6366f1;color:#fff;
                                   border:none;border-radius:8px;cursor:pointer;font-weight:700;">
                            Pagar
                        </button>` : ''}
                </div>
            </div>
        `).join('');
    } catch (err) {
        contenedor.innerHTML = `<p style="color:#dc2626;text-align:center;"><i class='bx bx-error'></i> ${err.message}</p>`;
    }
}
