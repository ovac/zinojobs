var PORT = process.env.PORT||3000;

var express = require('express');
var app = express();
var ExpressPeerServer = require('peer').ExpressPeerServer;

var server = app.listen(PORT , function(){
	console.log('Listeing on port '+ PORT);
});

var io = require('socket.io')(server);

var Redis = require('ioredis');

var redis = new Redis();

redis.subscribe('application-messages-channel');

redis.on('message', function(channel, message) {
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});

app.use('/peer', ExpressPeerServer(server, { debug: true }));
