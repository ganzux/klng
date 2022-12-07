<?
ini_set("session.cookie_lifetime",0);
session_start();

include("cabecera.php");
// Recuperamos el archivo con los parámetros de configuración
include ("../datos/config.php");
?>

<div id="titulo">Cuadros</div>

<?php
// SI EXISTE LA SESIÓN:
IF (session_is_registered("usuario") && session_is_registered("pass") ){

/*
	TITULO|2 (COLECCIÓN)|NO(VENDIDO)|Acuarela(MATERIAL 1)|Papel(MATERIAL 2)|30(X)|24(Y)|90(PRECIO)|1_-_STATUE_OF_LIBERTY.jpg(FOTO)
*/

// CREACIÓN DE CUADROS:
if ( ISSET($_POST['titulo']) && ( TRIM($_POST['titulo']) != "" ) &&
	ISSET($_POST['coleccion']) && ( TRIM($_POST['coleccion']) != "" ) &&
	ISSET($_POST['vendido']) && ( TRIM($_POST['vendido']) != "" ) &&
	ISSET($_POST['material1']) && ( TRIM($_POST['material1']) != "" ) &&
	ISSET($_POST['x']) && ( TRIM($_POST['x']) != "" ) &&
	ISSET($_POST['precio']) && ( TRIM($_POST['precio']) != "" ) &&
	ISSET($_POST['material2']) && ISSET($_POST['y']) ){

	echo "Insertando cuadro en archivo de usuarios... ";

	#Abrimos el fichero en modo de edición ("a")
	$DescriptorFichero = fopen("../datos/cuadros.dat","a");

	#Escribimos la primera línea dentro de él
	$string1 =	TRIM($_POST['titulo'])."|".
				TRIM($_POST['coleccion'])."|".
				TRIM($_POST['vendido'])."|".
				TRIM($_POST['material1'])."|".
				TRIM($_POST['material2'])."|".
				TRIM($_POST['x'])."|".
				TRIM($_POST['y'])."|".
				TRIM($_POST['precio'])."|".
				TRIM($HTTP_POST_FILES['userfile']['name'])."\r\n";

	fputs($DescriptorFichero,$string1);

	#Cerramos el fichero
	fclose($DescriptorFichero);
////////////////////////////////////////////////////////

	//datos del arhivo
	$nombre_archivo = $HTTP_POST_FILES['userfile']['name'];
	$tipo_archivo = $HTTP_POST_FILES['userfile']['type'];
	$tamano_archivo = $HTTP_POST_FILES['userfile']['size'];

	//compruebo si las características del archivo son las que deseo
	if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 1024000))) {
	    echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 1 Mb. máximo.</td></tr></table>";
	}
	else{
	    if (move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], "../cuadros/".$nombre_archivo)){
			echo "<BR />El archivo ha sido cargado correctamente.<BR />";

			// Creamos la miniaura y la imagen normal
			$original = imagecreatefromjpeg("../cuadros/".$nombre_archivo."");
			// Calculamos el ancho y el alto del archivo
			$ancho = imagesx($original);
			$alto = imagesy($original);

			//      THUMB
			// La proporción será ancho / 150
			$proporcion = $alto * 150 / $ancho;
			// Creamos el thumb
			$thumb = imagecreatetruecolor(150,$proporcion); // Lo haremos de un tamaño máximo 150 x X
			imagecopyresampled($thumb,$original,0,0,0,0,150,$proporcion,$ancho,$alto);
			imagejpeg($thumb,'../cuadros/'.$CONFIGthumb.$nombre_archivo,$CONFIGcalidad); // $CONFIGcalidad es la calidad de compresión

			//      MEDIUM
			// La proporción será ancho / 400
			$proporcion = $alto * 400 / $ancho;
			// Creamos el medium
			$thumb = imagecreatetruecolor(400,$proporcion); // Lo haremos de un tamaño máximo 400 x X
			imagecopyresampled($thumb,$original,0,0,0,0,400,$proporcion,$ancho,$alto);
			imagejpeg($thumb,'../cuadros/'.$CONFIGmedium.$nombre_archivo,$CONFIGcalidad); // $CONFIGcalidad es la calidad de compresión
	    }
		else{
			echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
		}
	}

///////////////////////////////////////////////////////////


	echo "Cuadro ".$_POST['titulo']." insertado con éxito. <BR>";

} // CREACIÓN DE CUADROS


//  BORRADO DE CUADRO
if (ISSET($_GET['opcion']) && ISSET($_GET['valor']) && TRIM($_GET['valor'] != "") && TRIM($_GET['opcion']!="") ){

	// BORRADO
	if ( TRIM( $_GET['opcion'] ) == "borrar" ){
		echo "Eliminando cuadro ".(($_GET['valor'])+1)."...";

		// Volcamos el fichero a un Array
		$archivo = file("../datos/cuadros.dat");
		// Y contamos sus líneas, o sea, el número de cuadros que hay
		$lineas = count($archivo);
		//  Borramos el archivo
		unlink("../datos/cuadros.dat");

		#Abrimos el fichero en modo de edición ("a")
		$DescriptorFichero = fopen("../datos/cuadros.dat","a");

		// Recorremos todos los usuarios
		for($i=0; $i < $lineas; $i++){

			// Si la fila no coincide con el índice, lo metemos en un nuevo fichero
			// partes será un vector con los datos de la linea
			$partes = explode("|",$archivo[$i]);

			if ($i != $_GET['valor']){
				$string1 = 	TRIM($partes[0])."|".
							TRIM($partes[1])."|".
							TRIM($partes[2])."|".
							TRIM($partes[3])."|".
							TRIM($partes[4])."|".
							TRIM($partes[5])."|".
							TRIM($partes[6])."|".
							TRIM($partes[7])."|".
							TRIM($partes[8])."\r\n";

				fputs($DescriptorFichero,$string1);
			}
		}// Fin del recorrer los cuadros

			#Cerramos el fichero
	fclose($DescriptorFichero);

	}// Fin del Borrado


} // BORRADO DE USUARIOS


	// Vamos a leer el fichero con los datos de los cuadros
	$archivo = file("../datos/cuadros.dat");
	// Y contamos sus líneas, o sea, el número de cuadros que hay
	$lineas = count($archivo);

	echo "<div align='center'><H3>HAY UN TOTAL DE ".$lineas." CUADROS</H3></div><BR />";

	echo '<div align="center">';
	echo "<TABLE ALIGN = 'center' width = '600' border='0' cellspacing='5'>";
	echo "	<TR>";
	echo "		<TH>N.</TH>";
	echo "		<TH>Foto</TH>";
	echo "		<TH>Nombre</TH>";
	echo "		<TH>Borrar</TH>";
	echo "	</TR>";

	// Recorremos todos los usuarios
	for($i=0; $i < $lineas; $i++){

		if ($i%2!=0)
			echo "	<TR>";
		else
			echo "	<TR style='background-color:grey'>";

		// partes será un vector con los datos de la linea
		$partes = explode("|",$archivo[$i]);
		echo "		<TD>".(($i)+1)."</TD>";
		echo '		<TD align="center">
						<a href="../cuadros/'.$CONFIGmedium.$partes[8].'" rel="lightbox[roadtrip]" title="Imagen con calidad media de '.$partes[0].'">
							<img align="center" border="0" src="../cuadros/'.$CONFIGthumb.$partes[8].'" ALT="Imagen con calidad media de '.$partes[0].'" />
						</A>
						&nbsp;
						<a href="../cuadros/'.$partes[8].'" rel="lightbox" title="Imagen con calidad alta de '.$partes[0].'">
							<img align="center" border="0" src="../cuadros/'.$CONFIGthumb.$partes[8].'" ALT="Imagen con calidad alta de '.$partes[0].'" />
						</A>
					</TD>';
			?>
		<TD>
			<? echo($partes[0]); ?>
			&nbsp;&nbsp;<IMG SRC="../images/help.gif" alt="Informaci&oacute;n del Cuadro" align="center" onClick='javascript:alert("Informaci&oacute;n del Cuadro:\nT&iacute;tulo: <? echo($partes[0]);?>\nColecci&oacute;n: <? echo($partes[1]);?>\nVendido: <? echo($partes[2]);?>\nMaterial 1: <? echo($partes[3]);?>\nMaterial 2: <? echo($partes[4]);?>\nAncho: <? echo($partes[5]);?>\nAlto: <? echo($partes[6]);?>\nPrecio:  <? echo($partes[7]);?>");' />
		</TD>
<?		echo 		'<TD><DIV ALIGN="CENTER"><A HREF="4cuadros.php?opcion=borrar&valor='.$i.'"><img align="center" border="0" src="../images/cubo.gif" ALT="Borrar" /></A></div></TD>';

		echo "	</TR>";

	}// Fin del recorrer los cuadros
		echo "</TABLE> <BR />";
		echo '</div><BR />';

	// NUEVO CUADRO:


	echo '<form name="nuevo" id="nuevo" method="POST" action="4cuadros.php" onsubmit="return niucuad(this)" enctype="multipart/form-data">';
	echo "<TABLE ALIGN = 'center' width = '600' border='0' cellspacing='5'>";
	echo '	<TR>
				<TD><img align="center" border="0" src="../images/add.gif" ALT="Borrar" /></TD>
				<TD>Nuevo Cuadro</TD>
			</TR>
			<TR>
				<TD>T&iacute;tulo *</TD>
				<TD><input type="text" name="titulo" size="30" maxlength="200"></TD>
			</TR>
			<TR>
				<TD>Colecci&oacute;n *</TD>';
				echo ("<TD>");
				echo ('	<select name="coleccion">');
				// Vamos a leer el fichero con los datos de los colecciones
				$archivoc = file("../datos/colecciones.dat");
				// Y contamos sus líneas, o sea, el número de colecciones que hay
				$lineasc = count($archivoc);

				// Recorremos todas las colecciones
				for ($j=0; $j < $lineasc; $j++){
					$partesc = explode("|",$archivoc[$j]);
					echo ('		<option value="'.$partesc[0].'">'.$partesc[0].'</option>');
				}
				echo ("	</select>");
				echo ("</TD>");

		echo'
			</TR>
			<TR>
				<TD>Vendido *</TD>
				<TD><select name="vendido"><option value="NO">No</option><option value="SI">S&iacute;</option></select></TD>
			</TR>
			<TR>
				<TD>Material 1 *</TD>
				<TD><input type="text" name="material1" size="30" maxlength="200"></TD>
			</TR>
			<TR>
				<TD>Material 2</TD>
				<TD><input type="text" name="material2" size="30" maxlength="200"></TD>
			</TR>
			<TR>
				<TD>Ancho *</TD>
				<TD><input type="text" name="x" size="10" maxlength="10"></TD>
			</TR>
			<TR>
				<TD>Alto</TD>
				<TD><input type="text" name="y" size="10" maxlength="10"></TD>
			</TR>
			<TR>
				<TD>Precio *</TD>
				<TD><input type="text" name="precio" size="10" maxlength="10"></TD>
			</TR>
			<TR>
				<TD>Foto *</TD>
				<TD><input name="userfile" type="file"></TD>
			</TR>
			<TR>
				<TD align="right">
					<input type="hidden" name="MAX_FILE_SIZE" value="100000">
					<input type="submit" value="Subir" name="Crear" id="boton_crear_cuadro">
				</TD>
				<TD>
					<div id="capa_procesa" style="display:none;">
						<img src="../images/proceso.gif" />
					</div>
				</TD>
			</TR>
		</FORM>';


 } // FIN DE LA SESION
// NO EXISTE LA SESIÓN
else {
?>
		<BR /><BR /><A HREF="1login.php"><div id="error_sesion">Error: Debe iniciar la sesi&oacute;n</div></A><BR />
<?php

}// NO HAY SESIÓN
// En cualquier caso, incluímos el fichero pie
include("pie.php"); ?>