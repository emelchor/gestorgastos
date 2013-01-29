<?php
include('funciones.php');
cabecera('envio de correos', CABECERA_SIN_CURSOR);
$bd = conectaDb();

$C6 = $_POST['ASUNTO'];	
$C7 = $_POST['MENSAJE'];	

$BOTON = '';

if ($_POST["action"] == "BORRAR" || $_POST["action"] == "ENVIAR" || $_POST["action"] == "MARCAR TODOS" || $_POST["action"] == "LIMPIAR TODOS") {
$asunto = $_POST["accion3"];
$mensaje= $_POST["accion4"];
} else {
$asunto  = recogeParaConsulta($bd, 'asunto', $C6); 
$mensaje = recogeParaConsulta($bd, 'mensaje', $C7); 
}
$asunto  = quitaComillasExteriores($asunto); 
$mensaje = quitaComillasExteriores($mensaje); 

if ($_POST["action"] == "ENVIAR") {
$id = recogeMatrizParaConsulta($bd, 'id');
	if (count($id)==0) { print "<p>No se ha marcado ningún alumno para enviar correo.</p>\n";} 
	else {
    	foreach ($id as $indice => $valor) {
		$valor = quitaComillasExteriores($valor); 
		mail($valor," - " . "$asunto","$mensaje");
    	}
		mail("emelchor@ugr.es","COPIA  " . "$asunto","$mensaje");
	}
}

if ($_POST["action"] == "MARCAR TODOS") {
$BOTON = 'checked';
} else if ($_POST["action"] == "LIMPIAR TODOS") {
$BOTON = '';
}

$campo = recogeParaConsulta($bd, 'campo', 'PROFESOR'); $campo = quitaComillasExteriores($campo); 
$orden = recogeParaConsulta($bd, 'orden', 'ASC'); $orden = quitaComillasExteriores($orden);
$consulta1 = "SELECT COUNT(*) FROM CONTROL";
$result1 = $bd->query($consulta1);
if (!$result1) { print "<p>Error en la consulta1.</p>\n";} 
elseif ($result1->fetchColumn()==0) { print "<p>No se ha creado todavía ningún registro.</p>\n";} 
else {
    $consulta2 = "SELECT * FROM CONTROL WHERE CORREO != '' ORDER BY $campo $orden";
    $result2 = $bd->query($consulta2);
    if (!$result2) {print "<p>Error en la consulta2.</p>\n";} 
	else { print "<p align=\"center\"><form action=\"correo.php\" method=\"".POST."\">
  <table border=\"3\" align=\"center\">
    <thead>
      <tr class=\"neg\"> 
	    <th>Marcar para enviar</th>        
        <th><a href=\"$_SERVER[PHP_SELF]?campo=PROFESOR&amp;orden=ASC\"> <img src=\"images/abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          PROFESOR 
          <a href=\"$_SERVER[PHP_SELF]?campo=PROFESOR&amp;orden=DESC\"> <img src=\"images/arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>
        <th><a href=\"$_SERVER[PHP_SELF]?campo=CORREO&amp;orden=ASC\"> <img src=\"images/abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          CORREO 
          <a href=\"$_SERVER[PHP_SELF]?campo=CORREO&amp;orden=DESC\"> <img src=\"images/arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>		  
		</th>
	  </tr>
    </thead>
    <tbody>\n";
        $tmp = TRUE;
		echo "<strong><p align='center'>PASO 2/2 SELECCIONE LOS PROFESORES DESTINATARIOS DEL MENSAJE"  . '<br />';
        foreach ($result2 as $valor) {
            if ($tmp) { print "      <tr>\n";} 
			else { print "      <tr class=\"neg\">\n"; }
            $tmp = !$tmp;
            print  (" 
		<td align=\"center\"><input type=\"checkbox\" name=\"id[$valor[DNI]]\" value=\"$valor[CORREO]\" $BOTON/></td>
	    <td>$valor[PROFESOR]</td>
		<td>$valor[CORREO]</td>
		\n      </tr>\n");
		}
 print ("<P align=\"center\"><input name=\"action\" type=\"submit\" value=\"MARCAR TODOS\" />   <input name=\"action\" type=\"submit\" value=\"ENVIAR\" />   <input name=\"action\" type=\"submit\" value=\"LIMPIAR TODOS\" /><input name=\"accion3\" type=\"hidden\" value=\"$asunto\" /><input name=\"accion4\" type=\"hidden\" value=\"$mensaje\" /></tr>\n");
    }
}

$bd = NULL;
?>