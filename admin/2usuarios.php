<?
ini_set("session.cookie_lifetime",0);
session_start();

include("cabecera.php");
?>

<div id="titulo">Administraci&oacute;n De Usuarios</div>

<?php
// SI EXISTE LA SESIÓN:
IF (session_is_registered("usuario") && session_is_registered("pass") ){


/* ACCIONES QUE REALIZA EL FICHERO PHP COMO SERVLET*/

// CREACIÓN DE USUARIOS:
if ( ISSET($_POST['nombre_nuevo']) && ISSET($_POST['password_nuevo']) && ISSET($_POST['creacion'])
	&& (TRIM($_POST['nombre_nuevo']) != '') && (TRIM($_POST['password_nuevo']) != '')){

	echo "Insertando usuario en archivo de usuarios... ";

	#Abrimos el fichero en modo de edición ("a")
	$DescriptorFichero = fopen("../datos/users.dat","a");

	#Escribimos la primera línea dentro de él
	$string1 = TRIM($_POST['nombre_nuevo'])."|".TRIM($_POST['password_nuevo'])."\r\n";
	fputs($DescriptorFichero,$string1);

	#Cerramos el fichero
	fclose($DescriptorFichero);


	echo "Usuario ".$_POST['nombre_nuevo']." insertado con éxito. <BR>";

} // CREACIÓN DE USUARIOS


//  BORRADO DE USUARIOS
if (ISSET($_GET['opcion']) && ISSET($_GET['valor']) && TRIM($_GET['valor'] != "") && TRIM($_GET['opcion']!="") ){

	// BORRADO
	if ( TRIM( $_GET['opcion'] ) == "borrar" ){
		echo "Eliminando usuario ".(($_GET['valor'])+1)."...";

		// Volcamos el fichero a un Array
		$archivo = file("../datos/users.dat");
		// Y contamos sus líneas, o sea, el número de usuarios que hay
		$lineas = count($archivo);
		//  Borramos el archivo
		unlink("../datos/users.dat");

		#Abrimos el fichero en modo de edición ("a")
		$DescriptorFichero = fopen("../datos/users.dat","a");

		// Recorremos todos los usuarios
		for($i=0; $i < $lineas; $i++){

			// Si la fila no coincide con el índice, lo metemos en un nuevo fichero
			// partes será un vector con los datos de la linea
			$partes = explode("|",$archivo[$i]);
			// NOMBRE			$partes[0]
			// PASSENCR		$partes[1]

			if ($i != $_GET['valor']){
				$string1 = TRIM($partes[0])."|".TRIM($partes[1])."\r\n";
				fputs($DescriptorFichero,$string1);
			}
		}// Fin del recorrer los usuarios

			#Cerramos el fichero
	fclose($DescriptorFichero);

	}// Fin del Borrado


} // BORRADO DE USUARIOS



	/*	Revisamos el archivo de usuarios, parseándolo a una variable y miramos si coincide con 'nombre'
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

	echo "<div align='center'><H3>HAY UN TOTAL DE ".$lineas." USUARIOS</H3></div><BR />";

	echo '<div id="contenido">';
	echo "<TABLE ALIGN = 'center' width = '400' border='0' cellspacing='5'>";
	echo "	<TR>";
	echo "		<TH>N.</TH>";
	echo "		<TH>Nombre</TH>";
	//echo "		<TH>Password</TH>";
	//echo "		<TH>Editar</TH>";
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
		// NOMBRE			$partes[0]
		// PASSENCR		$partes[1]

		echo "		<TD>".(($i)+1)."</TD>";
		echo "		<TD>".$partes[0]."</TD>";
		//echo '		<td><input name="pswd" type="password" size="20" /></td>';
		//echo 		'<TD><DIV ALIGN="CENTER"><A HREF="2usuarios.php?opcion=editar&valor='.$i.'"><img align="center" border="0" src="../images/abierto.gif" ALT="Editar" /></A></div></TD>';
		echo 		'<TD><DIV ALIGN="CENTER"><A HREF="2usuarios.php?opcion=borrar&valor='.$i.'"><img align="center" border="0" src="../images/cubo.gif" ALT="Borrar" /></A></div></TD>';

		echo "	</TR>";

	}// Fin del recorrer los usuarios

	// NUEVO USUARIO:

	echo '<form name="nuevo" id="nuevo" method="post" action="2usuarios.php" onsubmit="return niu(this)">';

	echo "	<TR>";

		echo '		<TD><img align="center" border="0" src="../images/add.gif" ALT="Borrar" /></TD>';
		echo '		<TD><input type="text" name="nombre_nuevo" /></TD>';
		//echo '		<td><input name="pswd" type="password" size="20" /></td>';
		echo 		'<td><input type="password" name="password_nuevo" /></td>';
		echo 		'<td><input type="submit" name="creacion" value="Crear Usuario" /></td>';

	echo "	</TR>";

	echo "</FORM>";

	echo "</TABLE> <BR />";
	echo '</div>';
 } else {?>
		<BR /><BR /><A HREF="1login.php"><div id="error_sesion">Error: Debe iniciar la sesi&oacute;n</div></A><BR />
<?php } ?>
<?php include("pie.php"); ?>