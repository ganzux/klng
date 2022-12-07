	// Función que entra, des/habilita un botón y muestra una capa oculta
	function entra(boton,capa,existe){
		if (existe=="true")
			document.getElementById(boton).disabled=true;
		else
			document.getElementById(boton).disabled=false;
		muestra(capa);
		return true;
	}
	// Función que muestra u oculta una capa
	function muestra(elemento){
		if (document.getElementById(elemento).style.display=="none")
			document.getElementById(elemento).style.display="block";
		else
			document.getElementById(elemento).style.display="none";
		return true;
	}

	var tempo;
	var opa = 0;
	function ver(elemento) {
		opa+=2;

		if (opa==90)
			clearInterval(tempo);
		obj = document.getElementById(elemento);

		if (document.all)
			obj.style.filter = 'alpha(opacity='+opa+')';
		else
			obj.style.MozOpacity = opa/100;
	}

	function muestraAdm(){
		tempo=setInterval('ver("modulo_administracion")',110);
		muestra('modulo_administracion');
	}

	function abreGaleria(){
		tempo=setInterval('ver("modulo_galeria")',110);
		muestra('modulo_galeria');
	}

			// Encriptación de la contraseña antes del envío al crear un usuario nuevo
		function niu(form){
			if (document.nuevo.nombre_nuevo.value.length == 0){
				alert("Falta el nombre");
				document.nuevo.nombre_nuevo.focus();
				return false;
			}
			else if (document.nuevo.password_nuevo.value.length == 0){
				alert("Falta el password");
				document.nuevo.password_nuevo.focus();
				return false;
			}
			else{ // Asignamos al botón el valor del MD5 de  nombre_usuario concatenado con contraseña
				document.nuevo.password_nuevo.value = hex_md5(document.nuevo.nombre_nuevo.value+document.nuevo.password_nuevo.value);
				return true;
			}
		}// function niu

		function niucol(form){
			if (document.nuevo.nombre_nuevo.value.length == 0){
				alert("Falta el nombre");
				document.nuevo.nombre_nuevo.focus();
				return false;
			}
			else{
				return true;
			}
		}// function niucol

		<!-- LOGUEO DE USUARIO -->
		function enviar(form){
			// Asignamos al botón el valor del MD5 de
			// nombre_usuario concatenado con contraseña
			document.encriptado.pass.value = hex_md5(document.datos.usuario.value+document.datos.password.value);
			document.encriptado.nombre.value = document.datos.usuario.value;
			return true;
		}// function de logueo

		<!-- SUBIR NUEVO CUADRO -->
		function niucuad(form){
			if (document.nuevo.titulo.value.length == 0){
				alert("Falta el título del cuadro");
				document.nuevo.titulo.focus();
				return false;
			}
			else if (document.nuevo.coleccion.value.length == 0){
				alert("Falta la colección del cuadro");
				document.nuevo.coleccion.focus();
				return false;
			}
			else if (document.nuevo.vendido.value.length == 0){
				alert("Falta la opci&oacute,n vendido");
				document.nuevo.vendido.focus();
				return false;
			}
			else if (document.nuevo.material1.value.length == 0){
				alert("Falta el material 1");
				document.nuevo.material1.focus();
				return false;
			}
			else if (document.nuevo.x.value.length == 0){
				alert("Falta la dimensi&oacute;n X");
				document.nuevo.x.focus();
				return false;
			}
			else if (document.nuevo.precio.value.length == 0){
				alert("Falta el precio");
				document.nuevo.precio.focus();
				return false;
			}
			else if (document.nuevo.userfile.value.length == 0){
				alert("Falta la foto");
				document.nuevo.userfile.focus();
				return false;
			}
			else{
				entra('boton_crear_cuadro','capa_procesa','true')
				return true;
			}
		}// function de logueo