FROM node:lts

ARG USER_ID=1000
ARG GROUP_ID=1000
ARG USER=dev

RUN npm install pm2 -g

USER node

WORKDIR /home/node/app

EXPOSE 3000
EXPOSE 5173

CMD ["pm2-runtime", "start", "npm", "--", "run", "dev"]