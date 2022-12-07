<?php
include("cabecera.php");
include("../include/cabecera.php");
// Cálculos:

	// Vamos a leer el fichero con los datos de los cuadros
	$archivo = file("../datos/cuadros.dat");
	// Y contamos sus líneas, o sea, el número de cuadros que hay
	$lineas = count($archivo);


// Vamos a leer el fichero con los datos de los colecciones
$archivoc = file("../datos/colecciones.dat");
// Y contamos sus líneas, o sea, el número de colecciones que hay
$lineasc = count($archivoc);
// Número de Filas es TÉCNICAS DISPONIBLES / ANCHO DE TÉCNICAS
$numeroDeFilas = ($lineasc/$CONFIG_TABLA_tecnicas);
$contador=0;
?>
		<div id="titulo">GALERIA DE CUADROS</div>
		<BR/>
		<div id="subtitulo">Hay un total de <?echo($lineas);?> cuadros en <?echo($lineasc);?> colecciones</div>
		<div align="center"><A HREF="cuadros.php?coleccion=&todos">(Ver todos los cuadros)</A></DIV>
		<BR/>
		<TABLE align="center" border="0" width="60%" frameborder="5" cellspacing="5">
		<?for ($i=0;$i<$numeroDeFilas;$i++){ ?>
			<TR>
				<?for ($j=0;$j<$CONFIG_TABLA_tecnicas;$j++){ ?>
					<TD width="<? echo(90/$CONFIG_TABLA_tecnicas); ?>%" align="left">
						<? if ($contador < $lineasc) {?>
						<img src="../images/pincel.gif" align="center"/>
						<A HREF="cuadros.php?coleccion=<? echo($archivoc[$contador]); ?>">
							<? echo($archivoc[$contador++]); ?>
						</A>
						<? } ?>
					</TD>
				<?} ?>
			</TR>
			<TR>
				<TD colspan="<? echo($CONFIG_TABLA_tecnicas); ?>" />
			</TR>
		<?} ?>

		</TABLE>
	</BODY>
</HTML>