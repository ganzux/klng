<?
ini_set("session.cookie_lifetime",0);
session_start();

include("cabecera.php");
?>

<div id="titulo">Colecciones De Cuadros</div>

<?php
// SI EXISTE LA SESIÓN:
IF (session_is_registered("usuario") && session_is_registered("pass") ){

// CREACIÓN DE COLECCIONES
if ( ISSET($_POST['nombre_nuevo']) && ISSET($_POST['creacion']) && (TRIM($_POST['nombre_nuevo']) != '') ){

	echo "Insertando colecci&oacute;n en archivo de colecciones... ";

	#Abrimos el fichero en modo de edición ("a")
	$DescriptorFichero = fopen("../datos/colecciones.dat","a");

	#Escribimos la primera línea dentro de él
	$string1 = TRIM($_POST['nombre_nuevo'])."\r\n";
	fputs($DescriptorFichero,$string1);

	#Cerramos el fichero
	fclose($DescriptorFichero);


	echo "Colecci&oacute;n ".$_POST['nombre_nuevo']." insertado con éxito. <BR>";

} // CREACIÓN DE COLECCIONES


//  BORRADO DE COLECCIONES
if (ISSET($_GET['opcion']) && ISSET($_GET['valor']) && TRIM($_GET['valor'] != "") && TRIM($_GET['opcion']!="") ){

	// BORRADO
	if ( TRIM( $_GET['opcion'] ) == "borrar" ){
		echo "Eliminando colecci&oacute;n ".(($_GET['valor'])+1)."...";

		// Volcamos el fichero a un Array
		$archivo = file("../datos/colecciones.dat");
		// Y contamos sus líneas, o sea, el número de colecciones que hay
		$lineas = count($archivo);
		//  Borramos el archivo
		unlink("../datos/colecciones.dat");

		#Abrimos el fichero en modo de edición ("a")
		$DescriptorFichero = fopen("../datos/colecciones.dat","a");

		// Recorremos todos los usuarios
		for($i=0; $i < $lineas; $i++){

			// Si la fila no coincide con el índice, lo metemos en un nuevo fichero
			// partes será un vector con los datos de la linea
			$partes = explode("|",$archivo[$i]);

			if ($i != $_GET['valor']){
				$string1 = TRIM($partes[0])."\r\n";
				fputs($DescriptorFichero,$string1);
			}
		}// Fin del recorrer los colecciones
		#Cerramos el fichero
		fclose($DescriptorFichero);
	}// Fin del Borrado
} // BORRADO DE COLECCIONES


	// Vamos a leer el fichero con los datos de los colecciones
	$archivo = file("../datos/colecciones.dat");
	// Y contamos sus líneas, o sea, el número de colecciones que hay
	$lineas = count($archivo);

	echo "<div align='center'><H3>HAY UN TOTAL DE ".$lineas." COLECCIONES</H3></div><BR />";

	echo '<div id="contenido">';
	echo "<TABLE ALIGN = 'center' width = '400' border='0' cellspacing='5'>";
	echo "	<TR>";
	echo "		<TH>N.</TH>";
	echo "		<TH>Nombre</TH>";
	echo "		<TH>Borrar</TH>";
	echo "	</TR>";

	// Recorremos todos los colecciones
	for($i=0; $i < $lineas; $i++){

		if ($i%2!=0)
			echo "	<TR>";
		else
			echo "	<TR style='background-color:grey'>";

		// partes será un vector con los datos de la linea
		$partes = explode("|",$archivo[$i]);

		echo "		<TD>".(($i)+1)."</TD>";
		echo "		<TD>".$partes[0]."</TD>";
		echo 		'<TD><DIV ALIGN="CENTER"><A HREF="3colecciones.php?opcion=borrar&valor='.$i.'"><img align="center" border="0" src="../images/cubo.gif" ALT="Borrar" /></A></div></TD>';

		echo "	</TR>";

	}// Fin del recorrer los colecciones

	// NUEVO colecciones:

	echo '<form name="nuevo" id="nuevo" method="post" action="3colecciones.php" onsubmit="return niucol(this)">';

	echo "	<TR>";

		echo '		<TD><img align="center" border="0" src="../images/add.gif" ALT="Borrar" /></TD>';
		echo '		<TD><input type="text" name="nombre_nuevo" /></TD>';
		echo 		'<td><input type="submit" name="creacion" value="Crear Colecci&oacute;n" /></td>';

	echo "	</TR>";

	echo "</FORM>";

	echo "</TABLE> <BR />";
	echo '</div>';


}// Dentro de la sesión


// NO EXISTE LA SESIÓN
else {
?>
		<BR /><BR /><A HREF="1login.php"><div id="error_sesion">Error: Debe iniciar la sesi&oacute;n</div></A><BR />
<?php

}// NO HAY SESIÓN
// En cualquier caso, incluímos el fichero pie
include("pie.php"); ?>