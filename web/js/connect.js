var socket = io.connect('http://localhost:3000', {reconnect: true});

var arr1=[]
var arr=["LTCEUR","XRPUSD","BTCUSD","BTCUSDT","BTCSTORJ","ETHETC"]
socket.on('connect', function() {
    // Connected, let's sign-up for to receive messages for this room
    socket.emit('room', arr);

});


