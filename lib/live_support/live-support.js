/*** Shared functions ***/

function sound() {
	alert('Live Support request is waiting');

	var NSsound = navigator.plugins && navigator.plugins["LiveAudio"];
	var IEsound = navigator.plugins && document.all;
	var audioEnabled = NSsound || IEsound;

//	if (audioEnabled) {
//		if (IEsound) {
//			document.write('<BGSOUND SRC="img/icons/mission.mid" />');
//		}
//
//		if (NSsound) {
//			document.write('<EMBED SRC="img/icons/mission.mid" HIDDEN="true" AUTOSTART="true" />');
//		}
//	} else {
//		alert('no sound');
//	}
}

function foo() {
	var ret = msg('tiki-live_support_server.php?op_online=pepe');

	alert(ret);
}

function msg(msg) {
	try {
		// for Mozilla
		req = new XMLHttpRequest();

		req.overrideMimeType("text/xml");
	} catch (e) {
		// for IE5+
		req = new ActiveXObject("Msxml2.XMLHTTP");
	}

	req.open("GET", msg, false);
	req.send(null);
	return req.responseText;
}

function msgxml(msg) {
	try {
		// for Mozilla
		req = new XMLHttpRequest();

		req.overrideMimeType("text/xml");
	} catch (e) {
		// for IE5+
		req = new ActiveXObject("Msxml2.XMLHTTP");
	}

	req.open("GET", msg, false);
	req.send(null);
	return req.responseXML;
}

function write_msg(txt, role, name) {
	window.chat_data.document.write(txt);

	window.chat_data.document.write('<br />');
	document.getElementById('data').value = '';
	/* And now send the message to the server */
	window.chat_data.scrollTo(0, 1000000);
	var ret = msg('tiki-live_support_server.php?write=' + document.getElementById('reqId').value
		+ '&msg=' + txt + '&senderId=' + document.getElementById('senderId').value + '&role=' + role + '&name=' + name);
}

function event_poll() {
	evpollInterval = setInterval("pollForEvents()", 10000);
}

function pollForEvents() {
	var ret = msg('tiki-live_support_server.php?get_last_event='
		+ document.getElementById('reqId').value + '&senderId=' + document.getElementById('senderId').value);
	/* alert(ret);
	alert(last_event); */
	if (ret > last_event) {
		while (last_event < ret) {
			last_event = last_event + 1;

			var txt = msg('tiki-live_support_server.php?get_event=' + document.getElementById('reqId').value
				+ '&last=' + last_event + '&senderId=' + document.getElementById('senderId').value);

			if (txt) {
				window.chat_data.document.write(txt);

				window.chat_data.document.write('<br />');
			}
		}

		window.chat_data.scrollTo(0, 1000000);
	}
}

function chat_close(role, user) {
	write_msg('<i>' + user + ' has left the chat' + '</i>', role, user);
}

/*** Client window functions ***/
function request_chat(user, tiki_user, email, reason) {
	document.getElementById('request_chat').style.display = 'none';

	document.getElementById('requesting_chat').style.display = 'block';
	var ret = msg('tiki-live_support_server.php?request_chat=1&reason=' + reason + '&user=' + user + '&tiki_user=' + tiki_user + '&email=' + email);
	document.getElementById('reqId').value = ret;
	client_poll();
}

function client_poll() {
	clourInterval = setInterval("pollForAccept()", 5000);
}

function pollForAccept() {
	var ret = msg('tiki-live_support_server.php?get_status=' + document.getElementById('reqId').value);

	if (ret == 'op_accepted') {
		clearInterval(clourInterval);

		window.location.href = 'tiki-live_support_chat_window.php?reqId=' + document.getElementById('reqId').value + '&role=user';
	}
}

function client_close() {
	msg('tiki-live_support_server.php?client_close=' + document.getElementById('reqId').value);
}

/*** Operator console functions ***/
function pollForRequests() {
	var last = msg('tiki-live_support_server.php?poll_requests=1');

	if (last > last_req) {
		window.location.reload();

		last_req = last;
	}
}

function set_operator_status(status) {
	var ret =
		msg('tiki-live_support_server.php?set_operator_status=' + document.getElementById('user').value + '&status=' + status);
}

function console_poll() {
	var ourInterval = setInterval("pollForRequests()", 10000);
}

var clourInterval = null;

