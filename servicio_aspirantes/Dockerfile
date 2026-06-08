FROM node:18-alpine

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .

EXPOSE 3005

CMD [ "sh", "-c", "if [ -f ./node_modules/.bin/nodemon ]; then npm run dev; else npm start; fi" ]
