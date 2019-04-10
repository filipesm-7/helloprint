#specify base image
FROM node:alpine

#set root directory
WORKDIR /webserver

#copy package.json to webserver folder
COPY ./package.json ./

#install dependencies
RUN npm install

#copy remaining files
COPY . .

#RUN npm start on container start
CMD ["npm", "start", "--prefix", "/webserver"]