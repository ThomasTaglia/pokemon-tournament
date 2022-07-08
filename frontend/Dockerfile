FROM node:alpine

WORKDIR /var/www/pokemon-tournament-server/frontend

COPY package.json package-lock.json ./
COPY src ./src
COPY public ./public

RUN npm install && \
    npm install --production && \
    rm -r package-lock.json

ENV NODE_PATH src
EXPOSE 3000

CMD [ "npm", "run", "start" ]