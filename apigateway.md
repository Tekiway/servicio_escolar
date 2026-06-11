# API Gateway - Requisitos Funcionales

Este documento describe exclusivamente lo que el **API Gateway** necesita para funcionar correctamente dentro del ecosistema de microservicios.

---

## 1. Requisitos de Entorno (Environment)
Para que el API Gateway arranque y encamine las peticiones, requiere de forma estricta un archivo `.env` en su directorio raíz con la configuración de las URLs de cada microservicio:

```env
PORT=3000
DOCENTE_SERVICE_URL=http://localhost:3002
ALUMNO_SERVICE_URL=http://localhost:3001
DIRECTIVO_SERVICE_URL=http://localhost:3004
FINANZAS_SERVICE_URL=http://localhost:3005
ASPIRANTE_SERVICE_URL=http://localhost:3006
```

## 2. Dependencias del Sistema
El Gateway depende del entorno **Node.js** para ejecutarse. Los siguientes paquetes NPM son obligatorios para su funcionamiento:

*   **`express`**: El motor principal del servidor HTTP.
*   **`dotenv`**: Para leer las variables del archivo `.env`.
*   **`http-proxy-middleware`**: (Si se utiliza para redireccionar peticiones complejas a los microservicios).
*   **`cors`**: Necesario si el Frontend se encuentra en un puerto distinto al 3000.

Estas dependencias se instalan ejecutando:
```bash
npm install
```

## 3. Condiciones de Red
*   El puerto principal del Gateway (por defecto **3000**) debe estar **libre y expuesto**.
*   Los microservicios (Docentes, Alumnos, Directivos, etc.) deben estar **encendidos** y respondiendo en sus respectivos puertos (3001, 3002, etc.). El Gateway funcionará sin ellos, pero arrojará error al intentar enrutar tráfico a un servicio apagado.

## 4. Archivos Clave
El funcionamiento del API Gateway depende de la integridad de los siguientes archivos en su interior:
*   `server.js`: El punto de arranque y configuración central de CORS y puertos.
*   `src/routes/index.js`: El mapa de enrutamiento que decide a qué URL externa redirigir cada petición (`/api/docentes`, `/api/alumnos`, etc.).

## 5. Comando de Arranque (Obligatorio)
Para ponerlo a funcionar y mantenerlo a la escucha de peticiones del frontend, se requiere lanzar el comando:
```bash
# Modo de producción (Mantiene el sistema vivo en 2do plano)
pm2 start ecosystem.config.js
```
*(Alternativamente, se puede usar `node server.js` o `npm start` para pruebas locales).*
