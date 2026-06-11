# 🚀 API Gateway - Sistema de Control Escolar

Este directorio contiene la **API Gateway Central**, el corazón de la arquitectura de microservicios del Sistema de Control Escolar. Actúa como el único punto de entrada (Single Point of Entry) para todas las peticiones que provienen del Frontend (tanto del panel de administrador como de los portales de alumnos, docentes y finanzas) y las redirige al microservicio correspondiente.

---

## 🏗️ Arquitectura Actual

El API Gateway está construido en **Node.js con Express** y enruta el tráfico hacia 5 microservicios diferentes. 

### Rutas Activas (Endpoints)
Todas las peticiones deben iniciar con el prefijo `/api/`.

| Ruta Base | Descripción del Módulo | URL Interna (Microservicio) |
| :--- | :--- | :--- |
| `/api/auth` | Autenticación centralizada y manejo de roles. | Lógica interna del Gateway / Múltiples MS |
| `/api/docentes` | Gestión de maestros, horarios y materias. | `DOCENTE_SERVICE_URL` |
| `/api/alumnos` | Estudiantes, calificaciones y expedientes. | `ALUMNO_SERVICE_URL` |
| `/api/directivos` | Administración general y credenciales. | `DIRECTIVO_SERVICE_URL` |
| `/api/finanzas` | Colegiaturas, pagos y becas. | `FINANZAS_SERVICE_URL` |
| `/api/aspirantes` | Proceso de admisión e inscripciones. | `ASPIRANTE_SERVICE_URL` |

*(Las URLs internas se configuran en el archivo `.env` para garantizar que la arquitectura sea escalable tanto en local como en contenedores Docker).*

---

## 📦 Dependencias Principales

*   **Express** (`express`): Framework central para levantar el servidor y manejar las rutas HTTP.
*   **Dotenv** (`dotenv`): Carga dinámica de variables de entorno (URLs y Puertos).
*   **PM2 / Nodemon** (`pm2` / `nodemon`): Gestores de procesos para asegurar la alta disponibilidad.
*   *Nota: El sistema incluye un manejador nativo para CORS, por lo que acepta peticiones desde cualquier origen (Frontend en PHP/JS).*

---

## 🛠️ Instrucciones de Ejecución

Existen tres formas de poner en marcha el API Gateway, dependiendo de tu entorno de desarrollo. Para cualquiera de los métodos, asegúrate de haber ejecutado previamente `npm install` en esta carpeta.

### Método 1: Desarrollo Local (Recomendado para programar)
Este método utiliza `nodemon` para reiniciar automáticamente el servidor cada vez que detecta un cambio en el código fuente.
```bash
# 1. Entrar a la carpeta del gateway
cd /opt/lampp/htdocs/servicio_escolar/api-gateway/

# 2. Iniciar en modo desarrollo
npm run dev
```

### Método 2: Producción con PM2 (Persistente)
Si necesitas que el servidor se mantenga activo indefinidamente (incluso si se cierra la terminal o crashea un proceso), utiliza PM2 con el archivo de configuración incluido `ecosystem.config.js`:
```bash
# Iniciar usando PM2
pm2 start ecosystem.config.js

# Para ver los logs del sistema en tiempo real
pm2 logs api-gateway
```

### Método 3: Ejecución Clásica
El método estándar utilizando directamente Node:
```bash
npm start
```

---

## ⚠️ Manejo de Errores Críticos (Crash Prevent)

El servidor cuenta con protección en la raíz (`server.js`) para evitar que caiga el ecosistema si un microservicio deja de responder de repente:
*   `uncaughtException`: Atrapa errores de código no manejados.
*   `unhandledRejection`: Atrapa promesas o conexiones asíncronas caídas.
Ambos eventos se registran en la consola, pero **no detendrán el API Gateway**, permitiendo que el resto de los módulos sigan trabajando.
