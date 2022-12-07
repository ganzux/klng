<?php
include("cabecera.php");
include("../include/cabecera.php");
// Verificamos que está tratando de entrar en una colección
if ( ISSET( $_GET['coleccion'] ) ){

	$contador=0;

	// Recorremos los cuadros para ver el número de cuadros que hay en la colección
	// Vamos a leer el fichero con los datos de los cuadros
	$archivo = file("../datos/cuadros.dat");
	// Y contamos sus líneas, o sea, el número de cuadros que hay
	$lineas = count($archivo);

	$cuadrosAMostrar=array();

	// Si no existe la ariable todos
	if (!ISSET ($_GET['todos']) ){
		for ($i=0;$i<$lineas;$i++){
			// partes será un vector con los datos de la linea
			$partes = explode("|",$archivo[$i]);
			if ($partes[1]==$_GET['coleccion'])
				array_push($cuadrosAMostrar,$partes);
		}
	} else {
		for ($i=0;$i<$lineas;$i++){
			// partes será un vector con los datos de la linea
			$partes = explode("|",$archivo[$i]);
			array_push($cuadrosAMostrar,$partes);
		}
	}
$contador=count($cuadrosAMostrar);
// Titulo, colección, vendido, material, material, ancho, alto, precio, foto
//   0        1          2        3         4       5       6      7     8
?>

		<div id="titulo">GALERIA DE CUADROS</div>
		<BR/>
		<div id="subtitulo">Hay un total de <?echo($contador);?> cuadros
			<? if (!ISSET ($_GET['todos']) ) {
				echo (' en '.$_GET['coleccion']);
			}
			?>
		</div>
		<div align="center"><A HREF="index.php">(Volver al Inicio de la galería)</A></DIV>
		<BR/>

		<table width="90%"  border="1" align="center" bordercolor="#000000">

		<?for ($i=0;$i<$contador;$i){ ?>
			<TR>
				<?for ($j=0;$j<$CONFIG_TABLA_cuadros;$j++){ ?>
					<? if ($i < $contador){ ?>
					<th width="<? echo(90/$CONFIG_TABLA_cuadros); ?>%" bgcolor="#57BDB3" scope="col">
						<div id="datos">
							<?
							// Foto
							echo('<a href="../cuadros/'.$CONFIGmedium.$cuadrosAMostrar[$i][8].'" rel="lightbox[grupo]" title="'.$cuadrosAMostrar[$i][0].'">
								<img align="center" border="0" src="../cuadros/'.$CONFIGthumb.$cuadrosAMostrar[$i][8].'" ALT="'.$cuadrosAMostrar[$i][0].'" />
							</A>'); ?><BR />
							"<? echo($cuadrosAMostrar[$i][0]); ?>"
							<IMG SRC='../images/sobre.gif' alt='Informaci&oacute;n sobre el cuadro'/>
							<BR />
							<?
							// Materiales
							echo($cuadrosAMostrar[$i][3]);
							if ($cuadrosAMostrar[$i][4] != '')
								echo(' / '.$cuadrosAMostrar[$i][4]);
							?><BR />
							<?
							// Medidas
							echo($cuadrosAMostrar[$i][5]);
							if ($cuadrosAMostrar[$i][6] != '')
								echo(' x '.$cuadrosAMostrar[$i][4].' cm.');
							else
								echo(' cm. de digonal');
							?><BR />
							<?
							// Precio o vendido
							if ($cuadrosAMostrar[$i][2]=='NO'){
								echo($cuadrosAMostrar[$i][7].' Euros');
								echo("<IMG SRC='../images/carrito_compra.gif' alt='Adquirir cuadro' />");
							}
							else
								echo('VENDIDO');
							?>
						</DIV>
					</TD>
				<? } ?>
				<?$i++;} ?>
			</TR>
		<?} ?>

		</TABLE>

<? } else {
	echo("No se ha especificado Colección de cuadros");
} ?>
