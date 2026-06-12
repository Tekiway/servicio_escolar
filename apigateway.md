# API Gateway - Documentación Técnica y Configuración

Este documento explica cómo está configurado el **API Gateway** de nuestro sistema, cómo funciona la arquitectura de red y las instrucciones exactas para ejecutarlo, de manera que todo el equipo pueda sincronizarse sin errores.

---

## 1. ¿Qué es y qué hace el API Gateway?
El API Gateway es el corazón del sistema. El Frontend **no se comunica directamente** con la base de datos ni con los microservicios individuales. Toda petición del Frontend (PHP/JS) pasa primero por el API Gateway (puerto `3000`), y este se encarga de:
1. Validar la solicitud.
2. Enrutarla al microservicio correcto (`alumno-service`, `docente-service`, etc.).
3. **Mecanismo de Respaldo (Fallback):** Si un microservicio se cae (por error de sintaxis o fallo en la BD), el API Gateway intercepta el error y utiliza memoria temporal para que la interfaz web no se congele ni lance errores críticos al usuario.

---

## 2. Arquitectura de Docker (Nueva Configuración)

> [!IMPORTANT]
> **El API Gateway YA NO corre mediante PM2 ni requiere Node.js instalado en sus computadoras de forma nativa.** 

Ahora, **TODO el ecosistema está contenerizado**. El archivo `docker-compose.yml` en la raíz del proyecto es el único que necesitan usar. Las conexiones entre microservicios ya no usan `localhost`, sino que utilizan la red interna de Docker mediante los nombres de los servicios.

### Mapa de Servicios y Puertos Internos
- **API Gateway:** Expuesto en `http://localhost:3000` (El único que el frontend llama).
- **Alumnos:** `http://alumno-service:3001`
- **Docentes:** `http://docente-service:3002`
- **Directivos:** `http://directivo-service:3003`
- **Finanzas:** `http://finance-service:3004`
- **Aspirantes:** `http://aspirante-service:3005`

*(Nota: Las variables de entorno ya están inyectadas directamente dentro del `docker-compose.yml`, por lo que **ya no necesitan** configurar un archivo `.env` manual para enrutar puertos).*

---

## 3. Instrucciones de Arranque para el Equipo

Para descargar los últimos cambios y arrancar todo el sistema sin errores, sigan estos pasos exactos en su terminal (ubicados en la raíz del proyecto `servicio_escolar`):

1. **Bajar los últimos cambios de GitHub (si aplica):**
   ```bash
   git pull origin main
   ```

2. **Apagar contenedores antiguos (Importante para evitar código basura o caché):**
   ```bash
   docker compose down
   ```

3. **Arrancar todo el sistema construyendo la última versión del código:**
   ```bash
   docker compose up -d --build
   ```

Este único comando (`--build`) obligará a Docker a leer los últimos cambios de código (como los arreglos del `apiGateway.js` o correcciones en controladores) y levantará MongoDB, el API Gateway y todos los microservicios juntos en segundo plano (`-d`).

---

## 4. Resolución de Problemas (Troubleshooting)

Si algo "no guarda" o aparece un "N/D" persistente:

1. **Caché Agresiva del Navegador (Problemas de "N/D" o Estilos CSS rotos):** 
   - **Síntoma 1 (Datos):** Al editar un usuario, la tabla sigue mostrando "N/D" o el dato viejo a pesar de que el sistema dice "Guardado exitosamente".
   - **Síntoma 2 (Estilos):** Las vistas cargan en blanco, pierden el diseño (CSS), o las rutas de los estilos parecen "romperse".
   - **Solución:** El navegador (Chrome/Edge) guarda en memoria temporal archivos críticos como `apiGateway.js` o archivos CSS. Es **obligatorio** presionar `Ctrl + F5` (o borrar la caché del navegador) cada vez que bajen cambios del repositorio. Se han inyectado variables como `?v=3` en el código para evitar esto, pero un Hard Refresh es fundamental.
2. **Revisar errores de Microservicios:** Si el API Gateway está funcionando, pero un dato no se actualiza, es probable que un microservicio haya crasheado (ej. error de sintaxis). Para ver los errores en tiempo real, ejecuten:
   ```bash
   # Ver logs del microservicio de alumnos
   docker logs servicio_escolar-alumno-service-1 --tail 50
   
   # Ver logs del API Gateway
   docker logs servicio_escolar-api-gateway-1 --tail 50
   ```
3. **Nodemon Autorestart:** Los contenedores están configurados con volumen y `nodemon`. Si editan un archivo dentro de la carpeta de un microservicio, Docker lo detectará y reiniciará ese servicio en 1 o 2 segundos automáticamente. No necesitan reiniciar todo Docker.
