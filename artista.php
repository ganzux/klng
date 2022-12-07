<?php
include("include/cabecera.php");
?>
<HTML>
	<HEAD>
		<TITLE>
			<? echo ($CONFIG_ARTISTA_TITULO); ?>
		</TITLE>

		<link rel="stylesheet" href="css/seccion.css" type="text/css">

	</HEAD>
	<body topmargin="0" style="margin:0" onload="ini()" onresize=ini()>

		<DIV id="titulo"><? echo ($CONFIG_ARTISTA_TITULO); ?></DIV>
		<BR />
		<div id="cuerpo">
			<UL>
				<?php
				if ($CONFIG_ARTISTA_LINEA_1 != '')
					echo("<LI>".$CONFIG_ARTISTA_LINEA_1."</LI><BR/>");
				if ($CONFIG_ARTISTA_LINEA_2 != '')
					echo("<LI>".$CONFIG_ARTISTA_LINEA_2."</LI><BR/>");
				if ($CONFIG_ARTISTA_LINEA_3 != '')
					echo("<LI>".$CONFIG_ARTISTA_LINEA_3."</LI><BR/>");
				if ($CONFIG_ARTISTA_LINEA_4 != '')
					echo("<LI>".$CONFIG_ARTISTA_LINEA_4."</LI><BR/>");
				if ($CONFIG_ARTISTA_LINEA_5 != '')
					echo("<LI>".$CONFIG_ARTISTA_LINEA_5."</LI><BR/>");
				?>
			</UL>
		</div>
		<DIV id="pie"><? echo ($CONFIG_CIERRE); ?></DIV>
<?php
include("include/pie.php");
?>