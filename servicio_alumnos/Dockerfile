# 1. Usamos una imagen ligera de Node.js
FROM node:18-alpine

# 2. Creamos el directorio de trabajo dentro del contenedor
WORKDIR /app

# 3. Copiamos los archivos de dependencias
COPY package*.json ./

# 4. Instalamos solo las dependencias necesarias
RUN npm install --production

# 5. Copiamos el resto del código
COPY . .

# 6. Exponemos el puerto que usa tu app (ej. 3001)
EXPOSE 3001

# 7. Comando para arrancar la app
CMD ["node", "server.js"] 