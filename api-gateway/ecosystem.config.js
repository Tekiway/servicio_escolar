module.exports = {
    apps: [
        {
            name: 'api-gateway',
            script: 'server.js',
            cwd: '/opt/lampp/htdocs/servicio_escolar/api-gateway',
            instances: 1,
            autorestart: true,       // Reinicia si crashea
            watch: false,            // No watch en producción
            max_memory_restart: '200M',
            env: {
                NODE_ENV: 'production',
                PORT: 3000,
                JWT_SECRET: 'secreto_escolar_2026',
                DOCENTE_SERVICE_URL:   'http://localhost:3002',
                ALUMNO_SERVICE_URL:    'http://localhost:3001',
                DIRECTIVO_SERVICE_URL: 'http://localhost:3003',
                FINANZAS_SERVICE_URL:  'http://localhost:3004',
                ASPIRANTE_SERVICE_URL: 'http://localhost:3005'
            }
        }
    ]
};
