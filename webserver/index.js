console.log('Running at port 80');

const express = require('express');
const app = express();
const router = express.Router();

router.get('/login', (request, response) => {
    response.sendFile(__dirname+'/login.html');
});

app.use('/', router);
app.use(express.static(__dirname+'/')); //serve static resources
app.listen(80);