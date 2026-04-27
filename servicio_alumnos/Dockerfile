# 1. Usamos una imagen ligera de Node.js
FROM node:18-alpine

# 2. Creamos el directorio de trabajo dentro del contenedor
WORKDIR /app

# 3. Copiamos los archivos de dependencias
COPY package*.json ./

# 4. Instalamos todas las dependencias (incluyendo nodemon para desarrollo)
RUN npm install

# 5. Copiamos el resto del código
COPY . .

# 6. Exponemos el puerto que usa tu app (ej. 3001)
EXPOSE 3001

# 7. Comando para desarrollo: usar nodemon si está instalado (útil con bind mount)
CMD [ "sh", "-c", "if [ -f ./node_modules/.bin/nodemon ]; then npm run dev; else npm start; fi" ]