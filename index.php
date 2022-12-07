<?php
include("include/cabecera.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>
			<? echo ($CONFIG_TITLE_WEB); ?>
		</title>
		<link href="css/menu.css" rel="stylesheet" type="text/css" />
		<link href="css/comun.css" rel="stylesheet" type="text/css" />
		<script language="javascript" src="js/InnerDiv.js"></script>
		<script language="javascript" src="js/funciones.js"></script>

		<script language="javascript">
			function lanzar(web,titulo,ancho,alto){
				id	= 'miId';			//---- id de la ventana
				x	= (document.body.clientWidth - ancho) / 2;// Centrado de la ventana
				y	= 60;    			//---- posicion y
				an	= ancho;       		//---- ancho
				al	= alto;  			//---- alto
				d	= web;       		//---- pagina de carga
				i	= titulo;			//---- texto de la barra
				v	= null 				//---- indica si utiliza CSS
				INNERDIV.newInnerDiv(id,x,y,an,al,d,i,v);
			}
		</script>
	</head>

	<body>
		<TABLE BORDER=0 width=800 ALIGN="center">
			<TR>
				<TD>
					<div id="vista_toolbar">
						<ul>
							<!-- ARTISTA -->
							<li>
								<a href="#" onclick="lanzar('artista.php','<? echo ($CONFIG_ARTISTA); ?>',800,500)">
									<span>
										<img align="left" src="images/icon_user.gif" alt="<? echo ($CONFIG_ARTISTA); ?>"/>
										<? echo ($CONFIG_ARTISTA); ?>
									</span>
								</a>
							</li>
							<!-- FIN DE ARTISTA -->

							<!-- OBRA -->
						    <li>
						    	<a href="#" onclick="lanzar('obra.php','<? echo ($CONFIG_OBRA); ?>',800,500)">
						    		<span>
						    			<img align="left" src="images/icon_wand.gif" alt="<? echo ($CONFIG_OBRA); ?>"/>
						    			<? echo ($CONFIG_OBRA); ?>
						    		</span>
						    	</a>
						    </li>
							<!-- FIN DE OBRA -->

							<!-- GALERÍA -->
						    <li>
							    <a href="#" onclick="abreGaleria();">
								    <span>
									    <img align="left" src="images/page_girl.gif" alt="<? echo ($CONFIG_GALERIA); ?>"/>
									    <? echo ($CONFIG_GALERIA); ?>
								    </span>
							    </a>
						    </li>
							<!-- FIN DE GALERÍA -->

							<!-- EXPOSICIONES -->
							<li>
								<a href="#" onclick="lanzar('exposiciones.php','<? echo ($CONFIG_EXPOSICIONES); ?>',450,300)">
									<span>
										<img align="left" src="images/date.gif" alt="<? echo ($CONFIG_EXPOSICIONES); ?>"/>
										<? echo ($CONFIG_EXPOSICIONES); ?>
									</span>
								</a>
							</li>
							<!-- FIN DE EXPOSICIONES -->

							<!-- ADMINISTRACIÓN -->
							<li>
								<a class="right" href="#" onclick="muestraAdm();">
									<span>
										<img align="left" src="images/icon_key.gif" alt="<? echo ($CONFIG_ADMINISTRA); ?>"/>
										<? echo ($CONFIG_ADMINISTRA); ?>
									</span>
								</a>
							</li>
							<!-- FIN DE ADMINISTRACIÓN -->

							<!-- CONTACTO -->
						    <li>
						    	<a class="right" href="#" onclick="lanzar('contacto.php','<? echo ($CONFIG_CONTACTO); ?>',400,300)">
						    		<span>
						    			<img align="left" src="images/email.gif" alt="<? echo ($CONFIG_CONTACTO); ?>"/>
						    			<? echo ($CONFIG_CONTACTO); ?>
						    		</span>
						    	</a>
						    </li>
							<!-- FIN DE CONTACTO -->

						</ul>
					</div>
				</TD>
			</TR>
		</TABLE>
		<DIV ID="modulo_administracion" align="center" style="display:none">
			<HR width="55%">
			<A HREF="">
				<? echo ($ADM_MODE_SALIR); ?>
			</A>
			<HR width="55%">
			<BR/>
			<iframe width="950" height="700" src="admin/index.php" frameborder="0"></iframe>
		</DIV>
		<DIV ID="modulo_galeria" align="center" style="display:none">
			<HR width="55%">
			<A HREF="">
				<? echo ($GAL_MODE_SALIR); ?>
			</A>
			<HR width="55%">
			<BR/>
			<iframe width="950" height="700" src="galeria/index.php" frameborder="0"></iframe>
		</DIV>
<?php
include("include/pie.php");
?>