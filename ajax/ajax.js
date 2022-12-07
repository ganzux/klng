	function ajaxobj() {
		try {
			_ajaxobj = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				_ajaxobj = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (E) {
				_ajaxobj = false;
			}
		}

		if (!_ajaxobj && typeof XMLHttpRequest!='undefined') {
			_ajaxobj = new XMLHttpRequest();
		}

		return _ajaxobj;
	}

	function cargaColecciones(id, lugar) {
		var ajax = ajaxobj();
		ajax.open("POST", "../datos/colecciones.xml", true);
		ajax.onreadystatechange=function() {
			if (ajax.readyState==4) {
				var datos = ajax.responseXML;
				var lugar = document.getElementById("lugar"+(id+1));

				var txt = "<p>";
				txt += datos.getElementsByTagName('ID').item(0).firstChild.data+"<br />";
				txt += datos.getElementsByTagName('TITULO').item(0).firstChild.data;
				txt += "</p>";

				lugar.innerHTML = txt;
			}
		}
		ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		ajax.send("&id="+id);
	}
