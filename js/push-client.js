/*
 * Push Client
 */
(function(w) {

	var pushclient = {
		_socket: null
	};

	pushclient.connect = function() {
		this._socket = new WebSocket('ws://' + location.host + ':' + pushclient_port);
	};

	pushclient.writeTest = function() {
		this._socket.send('EHLO?'); // lol
	};

	w.pushclient = pushclient;

})(window);
