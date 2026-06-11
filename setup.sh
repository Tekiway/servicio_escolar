#!/bin/bash
# ============================================================
# setup.sh - Ejecutar UNA SOLA VEZ en cada computadora nueva
# Instala PM2, instala el git hook y habilita Docker Desktop
# ============================================================

PROJECT_DIR="$(git rev-parse --show-toplevel)"

echo "🚀 Configurando entorno de desarrollo..."
echo ""

# ── 1. Verificar Node.js ──────────────────────────────────────
if ! command -v node &> /dev/null; then
    echo "❌ Node.js no está instalado. Instálalo primero."
    exit 1
fi

echo "✅ Node.js $(node --version) detectado."

# ── 2. Instalar PM2 globalmente ───────────────────────────────
echo "📦 Instalando PM2..."
npm install -g pm2
echo "   ✅ PM2 instalado."

# ── 3. Instalar dependencias del API Gateway ──────────────────
echo "📦 Instalando dependencias del API Gateway..."
cd "$PROJECT_DIR/api-gateway" || exit 1
npm install
echo "   ✅ Dependencias instaladas."

# ── 4. Arrancar API Gateway con PM2 ──────────────────────────
echo "🚀 Arrancando API Gateway con PM2..."
pm2 start ecosystem.config.js
pm2 save
echo "   ✅ API Gateway corriendo en el puerto 3000."

# ── 5. Configurar PM2 para que arranque con el sistema ────────
echo "🔧 Configurando inicio automático de PM2..."
pm2 startup | tail -1 | bash 2>/dev/null || echo "   ⚠️  Ejecuta manualmente el comando que muestra 'pm2 startup'"
echo "   ✅ PM2 configurado para arrancar al encender la PC."

# ── 6. Habilitar Docker Desktop ───────────────────────────────
echo "🐳 Habilitando Docker Desktop en el inicio..."
systemctl --user enable docker-desktop 2>/dev/null && \
    echo "   ✅ Docker Desktop habilitado." || \
    echo "   ⚠️  Docker Desktop ya estaba habilitado o no está instalado."

# ── 7. Instalar git hook post-merge ──────────────────────────
echo "🔗 Instalando git hook post-merge..."
cd "$PROJECT_DIR" || exit 1
HOOK_FILE=".git/hooks/post-merge"
chmod +x "$HOOK_FILE"
echo "   ✅ Git hook instalado."

echo ""
echo "════════════════════════════════════════"
echo "✅ Configuración completada."
echo "   - API Gateway: CORRIENDO en puerto 3000 (PM2)"
echo "   - PM2 arrancará solo al encender la PC"
echo "   - Docker Desktop arrancará solo al iniciar sesión"
echo "   - Tras cada 'git pull': todo se actualiza automáticamente"
echo "════════════════════════════════════════"
echo ""
