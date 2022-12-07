<?
ini_set("session.cookie_lifetime",0);
session_start();

include("cabecera.php");

$RUTA_FICHERO_CONFIG = "../include/cabecera.php";
?>
<script language="javascript" src="../js/funciones.js"></script>
<div id="titulo">Otros</div>

<?php
// SI EXISTE LA SESIÓN:
if (session_is_registered("usuario") && session_is_registered("pass") ){

  // La sección OTROS se divide en 2; por una parte se muestra el formulario y por otra
  // se envían los datos para poder actualizar el ficero.

  // Zona de actualización del fichero
  if ( ISSET($_POST['actualiza']) ){
    echo("Creando Fichero de seguridad...<BR />");
    $fecha = time ();
	$dato_copia = date ( "Y.n.d.h.i.s" , $fecha );
	copy($RUTA_FICHERO_CONFIG,$RUTA_FICHERO_CONFIG.$dato_copia.".php");

    echo("Eliminando datos antiguos...<BR />");
	// Borrmaos el fihero
	unlink($RUTA_FICHERO_CONFIG);

	echo("Creando datos nuevos...<BR />");
	#Abrimos el fichero en modo de edición ("a")
	$DescriptorFichero = fopen($RUTA_FICHERO_CONFIG,"a");

	// Texto del fichero:
	$cadena = array();

	array_push($cadena,'<?php');
	array_push($cadena,'// Archivo de configuración de la aplicación con datos varios:');
	array_push($cadena,'');
	array_push($cadena,'// Imágenes');
	array_push($cadena,'	$CONFIGcalidad		=	'.TRIM( htmlentities( $_POST['calidad'] ) ).';');
	array_push($cadena,'	$CONFIGthumb		=	"'.TRIM( htmlentities( $_POST['thumb'] ) ).'";');
	array_push($cadena,'	$CONFIGmedium		=	"'.TRIM( htmlentities( $_POST['medios'] ) ).'";');
	array_push($cadena,'');
	array_push($cadena,'// Tablas');
	array_push($cadena,'	$CONFIG_TABLA_tecnicas	=	'.TRIM( htmlentities( $_POST['tabla1'] ) ).';	// De 2 a 10');
	array_push($cadena,'	$CONFIG_TABLA_cuadros	=	'.TRIM( htmlentities( $_POST['tabla2'] ) ).';	// De 2 a 10');
	array_push($cadena,'');
	array_push($cadena,'// Textos');
	array_push($cadena,'// WEB');
	array_push($cadena,'	// INDICE');
	array_push($cadena,'	$CONFIG_TITLE_WEB		=	"'.TRIM( htmlentities( $_POST['ini1'] ) ).'";');
	array_push($cadena,'	$CONFIG_ARTISTA			=	"'.TRIM( htmlentities( $_POST['ini2'] ) ).'";');
	array_push($cadena,'	$CONFIG_OBRA			=	"'.TRIM( htmlentities( $_POST['ini3'] ) ).'";');
	array_push($cadena,'	$CONFIG_GALERIA			=	"'.TRIM( htmlentities( $_POST['ini4'] ) ).'";');
	array_push($cadena,'	$CONFIG_EXPOSICIONES	=	"'.TRIM( htmlentities( $_POST['ini5'] ) ).'";');
	array_push($cadena,'	$CONFIG_ADMINISTRA		=	"'.TRIM( htmlentities( $_POST['ini6'] ) ).'";');
	array_push($cadena,'	$CONFIG_CONTACTO		=	"'.TRIM( htmlentities( $_POST['ini7'] ) ).'";');
	array_push($cadena,'	$CONFIG_CIERRE			=	"'.TRIM( htmlentities( $_POST['ini8'] ) ).'";');
	array_push($cadena,'');
	array_push($cadena,'	// ARTISTA');
	array_push($cadena,'	$CONFIG_ARTISTA_TITULO	=	"'.TRIM( htmlentities( $_POST['artista0'] ) ).'";');
	array_push($cadena,'	$CONFIG_ARTISTA_LINEA_1	=	"'.TRIM( htmlentities( $_POST['artista1'] ) ).'";');
	array_push($cadena,'	$CONFIG_ARTISTA_LINEA_2	=	"'.TRIM( htmlentities( $_POST['artista2'] ) ).'";');
	array_push($cadena,'	$CONFIG_ARTISTA_LINEA_3	=	"'.TRIM( htmlentities( $_POST['artista3'] ) ).'";');
	array_push($cadena,'	$CONFIG_ARTISTA_LINEA_4	=	"'.TRIM( htmlentities( $_POST['artista4'] ) ).'";');
	array_push($cadena,'	$CONFIG_ARTISTA_LINEA_5	=	"'.TRIM( htmlentities( $_POST['artista5'] ) ).'";');
	array_push($cadena,'');
	array_push($cadena,'	// OBRA');
	array_push($cadena,'	$CONFIG_OBRA_TITULO		=	"'.TRIM( htmlentities( $_POST['obra0'] ) ).'";');
	array_push($cadena,'	$CONFIG_OBRA_LINEA_1	=	"'.TRIM( htmlentities( $_POST['obra1'] ) ).'";');
	array_push($cadena,'	$CONFIG_OBRA_LINEA_2	=	"'.TRIM( htmlentities( $_POST['obra2'] ) ).'";');
	array_push($cadena,'	$CONFIG_OBRA_LINEA_3	=	"'.TRIM( htmlentities( $_POST['obra3'] ) ).'";');
	array_push($cadena,'	$CONFIG_OBRA_LINEA_4	=	"'.TRIM( htmlentities( $_POST['obra4'] ) ).'";');
	array_push($cadena,'');
	array_push($cadena,'	// GALERIA');
	array_push($cadena,'	$CONFIG_GALERIA_TITULO	=	"'.TRIM( htmlentities( $_POST['gal0'] ) ).'";');
	array_push($cadena,'	$GAL_MODE_SALIR			=	"'.TRIM( htmlentities( $_POST['gal1'] ) ).'";');
	array_push($cadena,'	$CONFIGtituloindex		=	"'.TRIM( htmlentities( $_POST['gal2'] ) ).'";');
	array_push($cadena,'	$CONFIGtecnicas			=	"'.TRIM( htmlentities( $_POST['gal3'] ) ).'";');
	array_push($cadena,'	$CONFIGcontacta			=	"'.TRIM( htmlentities( $_POST['gal4'] ) ).'";');
	array_push($cadena,'	$CONFIGtitulo			=	"'.TRIM( htmlentities( $_POST['gal5'] ) ).'";');
	array_push($cadena,'	$CONFIGinicio			=	"'.TRIM( htmlentities( $_POST['gal6'] ) ).'";');
	array_push($cadena,'');
	array_push($cadena,'	// EXPOSICIONES');
	array_push($cadena,'	$CONFIG_EXPO_TITULO		=	"'.TRIM( htmlentities( $_POST['expo0'] ) ).'";');
	array_push($cadena,'	$CONFIG_EXPO_LINEA_1	=	"'.TRIM( htmlentities( $_POST['expo1'] ) ).'";');
	array_push($cadena,'	$CONFIG_EXPO_LINEA_2	=	"'.TRIM( htmlentities( $_POST['expo2'] ) ).'";');
	array_push($cadena,'	$CONFIG_EXPO_LINEA_3	=	"'.TRIM( htmlentities( $_POST['expo3'] ) ).'";');
	array_push($cadena,'	$CONFIG_EXPO_LINEA_4	=	"'.TRIM( htmlentities( $_POST['expo4'] ) ).'";');
	array_push($cadena,'');
	array_push($cadena,'	// CONTACTO');
	array_push($cadena,'	$CONFIG_CONTACTO_TITULO	=	"'.TRIM( htmlentities( $_POST['cto0'] ) ).'";');
	array_push($cadena,'	$CONFIG_CONTACTO_LINEA_1=	"'.TRIM( htmlentities( $_POST['cto1'] ) ).'";');
	array_push($cadena,'	$CONFIG_CONTACTO_LINEA_2=	"'.TRIM( htmlentities( $_POST['cto2'] ) ).'";');
	array_push($cadena,'	$CONFIG_CONTACTO_LINEA_3=	"'.TRIM( htmlentities( $_POST['cto3'] ) ).'";');
	array_push($cadena,'');
	array_push($cadena,'	//MÓDULO DE ADMINISTRACIÓN');
	array_push($cadena,'	$ADM_MODE_SALIR	= 	"'.TRIM( htmlentities( $_POST['adm_salir'] ) ).'";');
	array_push($cadena,'// Fin de los textos');
	array_push($cadena,'?>');

	echo("Guardando fichero nuevo...<BR />");
	foreach($cadena as $item){
    	fwrite($DescriptorFichero, $item."\r\n");
  	}

	#Cerramos el fichero
	fclose($DescriptorFichero);

  // Formulario de datos
  }
  include($RUTA_FICHERO_CONFIG);
  ?>
  	<BR />
    <div id="">Atenci&oacute;n: Los campos marcados con asterisco * no se deben cambiar una vez se introduzcan fotos en la aplicaci&oacute;n.</div>
    <FORM action="5.php" method="POST" type="multipart/form-data">
      <input TYPE="hidden" name="actualiza" value="caca de vaca" />
      <TABLE ALIGN="center" width="90%">
        <!-- Imágenes -->
        <TR>
          <TD align="center" width="100%">
            <DIV ID="cabeza">
              Configuraci&oacute;n de las im&aacute;genes
              <A onclick="muestra('1');">
                <IMG SRC="../images/add.gif"  border="0" align="center" />
              </A>
            </DIV>
            <DIV ID="1" style="display: none">
              <TABLE align="center" width="100%">
                <TR>
                  <TD align="right" width="40%">
                    Calidad de las im&aacute;genes *
                  </TD>
                  <TD width="10%" />
                  <TD align="left" width="40%">
					<select name="calidad">
						<? for ($i=1;$i<101;$i++){
							if (TRIM($CONFIGcalidad) == $i)
								echo('<option value="'.$i.'" selected="selected">'.$i.'</option>');
							else
								echo('<option value="'.$i.'">'.$i.'</option>');
						}
						?>
					</select>
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Prefijo de las miniaturas *
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <INPUT TYPE="text" name="thumb" value="<? echo($CONFIGthumb); ?>" maxlenght="10" />
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Prefijo de los tama&ntilde;os medios *
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <INPUT TYPE="text" name="medios" value="<? echo($CONFIGmedium); ?>"  maxlenght="10" />
                  </TD>
                </TR>
              </TABLE>
            </DIV>
          </TD>
        </TR>
        <!-- Fin de Imágenes -->

        <!-- Tablas -->
        <TR>
          <TD align="center" width="100%">
            <DIV ID="cabeza">
              Configuraci&oacute;n de las tablas
              <A onclick="muestra('2');">
                <IMG SRC="../images/add.gif"  border="0" align="center" />
              </A>
            </DIV>
            <DIV ID="2" style="display: none">
              <TABLE ALIGN="center" width="100%">
                <TR>
                  <TD align="right" width="40%">
                    Columnas para t&eacute;cnicas
                  </TD>
                  <TD width="10%" />
                  <TD align="left" width="40%">
                  	<select name="tabla1">
						<? for ($i=2;$i<11;$i++){
							if (TRIM($CONFIG_TABLA_tecnicas) == $i)
								echo('<option value="'.$i.'" selected="selected">'.$i.'</option>');
							else
								echo('<option value="'.$i.'">'.$i.'</option>');
						}
						?>
					</select>
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Columnas de los cuadros
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <select name="tabla2">
						<? for ($i=2;$i<11;$i++){
							if (TRIM($CONFIG_TABLA_cuadros) == $i)
								echo('<option value="'.$i.'" selected="selected">'.$i.'</option>');
							else
								echo('<option value="'.$i.'">'.$i.'</option>');
						}
						?>
					</select>
                  </TD>
                </TR>
              </TABLE>
            </DIV>
          </TD>
        </TR>
        <!-- Fin de Tablas -->

        <!-- Página de Inicio -->
        <TR>
          <TD align="center" width="100%">
            <DIV ID="cabeza">
              P&aacute;gina de Inicio
              <A onclick="muestra('3');">
                <IMG SRC="../images/add.gif"  border="0" align="center" />
              </A>
            </DIV>
            <DIV ID="3" style="display: none">
              <TABLE align="center" width="100%">
                <TR>
                  <TD align="right" width="40%">
                    T&iacute;tulo de la web
                  </TD>
                  <TD width="10%" />
                  <TD align="left" width="40%">
                    <INPUT TYPE="text" name="ini1" value="<? echo($CONFIG_TITLE_WEB); ?>" size="30"/>
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Men&uacute; "Artista"
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <INPUT TYPE="text" name="ini2" value="<? echo($CONFIG_ARTISTA); ?>" size="30" />
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Men&uacute; "Obra"
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <INPUT TYPE="text" name="ini3" value="<? echo($CONFIG_OBRA); ?>" size="30" />
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Men&uacute; "Galer&iacute;a"
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <INPUT TYPE="text" name="ini4" value="<? echo($CONFIG_GALERIA); ?>" size="30" />
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Men&uacute; "Exposiciones"
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <INPUT TYPE="text" name="ini5" value="<? echo($CONFIG_EXPOSICIONES); ?>" size="30" />
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Men&uacute; "Administraci&oacute;n"
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <INPUT TYPE="text" name="ini6" value="<? echo($CONFIG_ADMINISTRA); ?>" size="30" />
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Men&uacute; "Contacto"
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <INPUT TYPE="text" name="ini7" value="<? echo($CONFIG_CONTACTO); ?>" size="30" />
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Texto "cierre de secci&oacute;n"
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <INPUT TYPE="text" name="ini8" value="<? echo($CONFIG_CIERRE); ?>" size="30" />
                  </TD>
                </TR>
              </TABLE>
            </DIV>
          </TD>
        </TR>
        <!-- Fin de Página de Inicio -->

        <!-- Artista -->
        <TR>
          <TD align="center" width="100%">
            <DIV ID="cabeza">
              P&aacute;gina "Artista"
              <A onclick="muestra('4');">
                <IMG SRC="../images/add.gif"  border="0" align="center" />
              </A>
            </DIV>
            <DIV ID="4" style="display: none">
              <TABLE align="center" width="100%">
                <TR>
                  <TD align="right" width="40%">
                    T&iacute;tulo de la zona
                  </TD>
                  <TD width="10%" />
                  <TD align="left" width="40%">
                    <INPUT TYPE="text" name="artista0" value="<? echo($CONFIG_ARTISTA_TITULO); ?>" size="30" />
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Zona de texto 1
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <textarea cols="24" rows="3" name="artista1"><? echo($CONFIG_ARTISTA_LINEA_1); ?></textarea>
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Zona de texto 2
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                  	<textarea cols="24" rows="3" name="artista2"><? echo($CONFIG_ARTISTA_LINEA_2); ?></textarea>
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Zona de texto 3
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                  	<textarea cols="24" rows="3" name="artista3"><? echo($CONFIG_ARTISTA_LINEA_3); ?></textarea>
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Zona de texto 4
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                   	<textarea cols="24" rows="3" name="artista4"><? echo($CONFIG_ARTISTA_LINEA_4); ?></textarea>
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Zona de texto 5
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                  	<textarea cols="24" rows="3" name="artista5"><? echo($CONFIG_ARTISTA_LINEA_5); ?></textarea>
                  </TD>
                </TR>
              </TABLE>
            </DIV>
          </TD>
        </TR>
        <!-- Fin de Artista -->

        <!-- Obra -->
        <TR>
          <TD align="center" width="100%">
            <DIV ID="cabeza">
              P&aacute;gina "Obra"
              <A onclick="muestra('5');">
                <IMG SRC="../images/add.gif"  border="0" align="center" />
              </A>
            </DIV>
            <DIV ID="5" style="display: none">
              <TABLE align="center" width="100%">
                <TR>
                  <TD align="right" width="40%">
                    T&iacute;tulo de la zona
                  </TD>
                  <TD width="10%" />
                  <TD align="left" width="40%">
                  	<INPUT TYPE="text" name="obra0" value="<? echo($CONFIG_OBRA_TITULO); ?>" size="30" />
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Zona de texto 1
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
					<textarea cols="24" rows="3" name="obra1"><? echo($CONFIG_OBRA_LINEA_1); ?></textarea>
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Zona de texto 2
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <textarea cols="24" rows="3" name="obra2"><? echo($CONFIG_OBRA_LINEA_2); ?></textarea>
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Zona de texto 3
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <textarea cols="24" rows="3" name="obra3"><? echo($CONFIG_OBRA_LINEA_3); ?></textarea>
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Zona de texto 4
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <textarea cols="24" rows="3" name="obra4"><? echo($CONFIG_OBRA_LINEA_4); ?></textarea>
                  </TD>
                </TR>
              </TABLE>
            </DIV>
          </TD>
        </TR>
        <!-- Fin de Obra -->

        <!-- Galería -->
        <TR>
          <TD align="center" width="100%">
            <DIV ID="cabeza">
              P&aacute;gina "Galer&iacute;a"
              <A onclick="muestra('6');">
                <IMG SRC="../images/add.gif"  border="0" align="center" />
              </A>
            </DIV>
            <DIV ID="6" style="display: none">
              <TABLE align="center" width="100%">
                <TR>
                  <TD align="right" width="40%">
                    T&iacute;tulo de la zona
                  </TD>
                  <TD width="10%" />
                  <TD align="left" width="40%">
                    <INPUT TYPE="text" name="gal0" value="<? echo($CONFIG_GALERIA_TITULO); ?>" size="30" />
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Texto de Salir
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <textarea cols="24" rows="3" name="gal1"><? echo($GAL_MODE_SALIR); ?></textarea>
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    &Iacute;ndice
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <textarea cols="24" rows="3" name="gal1"><? echo($CONFIGtituloindex); ?></textarea>
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Texto "T&eacute;cnicas"
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <textarea cols="24" rows="3" name="gal3"><? echo($CONFIGtecnicas); ?></textarea>
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Texto "Contacta"
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <textarea cols="24" rows="3" name="gal4"><? echo($CONFIGcontacta); ?></textarea>
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    T&iacute;tulo
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <textarea cols="24" rows="3" name="gal5"><? echo($CONFIGtitulo); ?></textarea>
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Inicio
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <textarea cols="24" rows="3" name="gal6"><? echo($CONFIGinicio); ?></textarea>
                  </TD>
                </TR>
              </TABLE>
            </DIV>
          </TD>
        </TR>
        <!-- Fin de Galería -->

        <!-- Exposiciones -->
        <TR>
          <TD align="center" width="100%">
            <DIV ID="cabeza">
              P&aacute;gina "Exposiciones"
              <A onclick="muestra('9');">
                <IMG SRC="../images/add.gif"  border="0" align="center" />
              </A>
            </DIV>
            <DIV ID="9" style="display: none">
              <TABLE align="center" width="100%">
                <TR>
                  <TD align="right" width="40%">
                    T&iacute;tulo de la zona
                  </TD>
                  <TD width="10%" />
                  <TD align="left" width="40%">
                    <INPUT TYPE="text" name="expo0" value="<? echo($CONFIG_EXPO_TITULO); ?>" size="30" />
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Zona de texto 1
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <textarea cols="24" rows="3" name="expo1"><? echo($CONFIG_EXPO_LINEA_1); ?></textarea>
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Zona de texto 2
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <textarea cols="24" rows="3" name="expo2"><? echo($CONFIG_EXPO_LINEA_2); ?></textarea>
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Zona de texto 3
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <textarea cols="24" rows="3" name="expo3"><? echo($CONFIG_EXPO_LINEA_3); ?></textarea>
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Zona de texto 4
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <textarea cols="24" rows="3" name="expo4"><? echo($CONFIG_EXPO_LINEA_4); ?></textarea>
                  </TD>
                </TR>
              </TABLE>
            </DIV>
          </TD>
        </TR>
        <!-- Fin de Exposiciones -->

        <!-- Contacto -->
        <TR>
          <TD align="center" width="100%">
            <DIV ID="cabeza">
              P&aacute;gina "Contacto"
              <A onclick="muestra('7');">
                <IMG SRC="../images/add.gif"  border="0" align="center" />
              </A>
            </DIV>
            <DIV ID="7" style="display: none">
              <TABLE align="center" width="100%">
                <TR>
                  <TD align="right" width="40%">
                    T&iacute;tulo de la zona
                  </TD>
                  <TD width="10%" />
                  <TD align="left" width="40%">
                    <INPUT TYPE="text" name="cto0" value="<? echo($CONFIG_CONTACTO_TITULO); ?>" size="30" />
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Zona de texto 1
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <textarea cols="24" rows="3" name="cto1"><? echo($CONFIG_CONTACTO_LINEA_1); ?></textarea>
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Zona de texto 2
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <textarea cols="24" rows="3" name="cto2"><? echo($CONFIG_CONTACTO_LINEA_2); ?></textarea>
                  </TD>
                </TR>
                <TR>
                  <TD align="right">
                    Zona de texto 3
                  </TD>
                  <TD width="10%" />
                  <TD align="left">
                    <textarea cols="24" rows="3" name="cto3"><? echo($CONFIG_CONTACTO_LINEA_3); ?></textarea>
                  </TD>
                </TR>
              </TABLE>
            </DIV>
          </TD>
        </TR>
        <!-- Fin de Contacto -->

       <!-- Administrción -->
        <TR>
          <TD align="center" width="100%">
            <DIV ID="cabeza">
              P&aacute;gina "Administraci&oacute;n"
              <A onclick="muestra('8');">
                <IMG SRC="../images/add.gif"  border="0" align="center" />
              </A>
            </DIV>
            <DIV ID="8" style="display: none">
              <TABLE align="center" width="100%">
                <TR>
                  <TD align="right" width="40%">
                    Texto de salir
                  </TD>
                  <TD width="10%" />
                  <TD align="left" width="40%">
                    <INPUT TYPE="text" name="adm_salir" value="<? echo($ADM_MODE_SALIR); ?>" size="30" />
                  </TD>
                </TR>
              </TABLE>
            </DIV>
          </TD>
        </TR>
        <!-- Fin de Administración -->

      </TABLE>
      <div align="center">
        <BR /><BR />
        <INPUT TYPE="submit" value="Actualizar Datos">
      </div>
    </FORM>
  <?php
 }
// NO EXISTE LA SESIÓN
else {
?>
    <BR /><BR /><A HREF="1login.php"><div id="error_sesion">Error: Debe iniciar la sesi&oacute;n</div></A><BR />
<?php

}// NO HAY SESIÓN
// En cualquier caso, incluímos el fichero pie
include("pie.php"); ?>