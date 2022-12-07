<?
ini_set("session.cookie_lifetime",0);
session_start();

// Cerrar sesión
if ( ISSET( $_GET['opcion'] ) && TRIM ( $_GET['opcion'] != "" ) ){
	if ( TRIM( $_GET['opcion'] ) == "cerrar" ){
		session_destroy();
		header("Location:1login.php");
	}
}// Cerrar sesión

include("cabecera.php");
?>

<div id="titulo">Login De Usuario</div>

<?php
// SI NO EXISTE LA SESIÓN:
IF (!session_is_registered("usuario") && !session_is_registered("pass") ){

if ( ISSET($_POST['nombre']) && ISSET($_POST['pass']) ){

	$logueado = false;

	$nombre = $_POST['nombre'];
	$pass = $_POST['pass'];

	/*	En este momento, en nombre y en pass tenemos SEGURO una cadena de caracteres.
		Revisamos el archivo de usuarios, parseándolo a una variable y miramos si coincide con 'nombre'
		Recordemos cómo está formado el archivo de usuarios:
			../datos/users.dat
		________________________________
		usuario1 | clave_encriptada_1
		usuario2 | clave_encriptada_2
		...
		usuarion | clave_encriptada_n
		________________________________
	*/
	// Vamos a leer el fichero con los datos de los usuarios
	$archivo = file("../datos/users.dat");
	// Y contamos sus líneas, o sea, el número de usuarios que hay
	$lineas = count($archivo);

	// Recorremos todos los usuarios
	for($i=0; $i < $lineas; $i++){
		// partes será un vector con los datos de la linea
		$partes = explode("|",$archivo[$i]);
		// NOMBRE			$partes[0]
		// PASSENCR		$partes[1]

		if ( (TRIM( $partes[0] ) == TRIM( $nombre) ) && ( TRIM($partes[1] ) == TRIM( $pass ) ) ){
			$logueado	= true;
			$usuario	= $partes[0];

			// Copia de Seguridad: SIEMPRE una copia de seguridad con el día y la hora :)
			$fecha = time ();
			$dato_copia = date ( "Y.n.d.h.i.s" , $fecha );
			copy("../datos/users.dat","../datos/users.".$dato_copia.".old.dat");
			copy("../datos/cuadros.dat","../datos/cuadros.".$dato_copia.".old.dat");
			copy("../datos/colecciones.dat","../datos/colecciones.".$dato_copia.".old.dat");
		}
	}// Fin del recorrer los usuarios

	// Si se encontró al usuario, mensaje de Bienvenida
	if($logueado){
		session_register("usuario","pass");
		echo "<div align='center'><H3>Conectado como: ".$_SESSION["usuario"]."</H3></div><BR />";
		echo '<div id="contenido">';
		echo 	"<div class='cuerpo'><strong><BR /><A HREF='1login.php?opcion=cerrar'>CERRAR SESI&Oacute;N</A></strong></div>";
		echo '</div>';
		}
	// En caso contrario
	else{
		echo "<div align='center'><H3>USUARIO NO ENCONTRADO</H3></div><BR /><BR />";
		echo '<BR /><BR /><A HREF="1login.php"><div id="error_sesion">Volver</div></A><BR />';
	}

} //  Nombre y pass




// Si NO existe el POST o el GET, ponemos el formulario
else {

?>
<div id="contenido">
	<BR />
	<table width="100%"  border="0" cellspacing="5" align="center">
	<form name="datos" id="datos">
		<tr>
			<td width="20">
				<img src="../images/icon_user.gif" width="16" height="16" />
			</td>
			<td width="150">Nombre de Usuario </td>
			<td width="230">
				<input type="text" name="usuario" />
			</td>
		</tr>
		<tr>
			<td>
				<img src="../images/icon_key.gif" width="16" height="16" />
			</td>
			<td>Contrase&ntilde;a</td>
			<td>
				<input type="password" name="password" />
			</td>
		</tr>
	</form>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>
				<form name="encriptado" id="encriptado" method="POST" action="1login.php" onsubmit="return enviar(this)">
					<input name="nombre" type="hidden" />
					<input name="pass" type="hidden" />
					<input type="submit" id="boton_entrar" value="Entrar" onSubmit="return entra('boton_entrar','capa_procesa','true')" />
				</form>
				<div id="capa_procesa" style="display:none;">
					<img src="../images/proceso.gif" />
				</div>
			</td>
		</tr>
	</table>
</div>
<?php } // Fin del Formulario de logueo. ?>
<?php }

	// SÍ EXISTE LA SESIÓN
	else {
		echo "<div align='center'><H3>Conectado como: ".$_SESSION["usuario"]."</H3></div><BR />";
		echo '<div id="contenido">';
		echo 	"<div class='cuerpo'><strong><BR /><A HREF='1login.php?opcion=cerrar'>CERRAR SESI&Oacute;N</A></strong></div>";
		echo '</div>';
	}

// En cualquier caso, se incluye el pie de página
include("pie.php");
?>