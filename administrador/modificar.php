<?php
/** Copyright (C) 2013  Elías Melchor Ferrer

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as
    published by the Free Software Foundation, either version 3 of the
    License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public
License
    along with this program.  If not, see <http://www.gnu.org/licenses/>
*/
include('funciones.php');
cabecera('Configuracion', CABECERA_SIN_CURSOR);
$bd = conectaDb();

$C4 = $_POST['CONSULTA'];	
$C8 = $_POST['ACCION1'];	
$C9 = $_POST['CAMPO'];	
$C10 = $_POST['TIPO'];	
$C12 = $_POST['ACCION2'];	
$C13 = $_POST['ACCION3'];	
$C15 = $_POST['EJER'];	
$C16 = $_POST['CAMPO2'];	
$C17 = $_POST['ANTES'];	
$C18 = $_POST['AHORA'];	

$BOTON = '';

$codi = "SELECT EJERCICIO FROM CONTROL WHERE IDEJER == $C15"; 
foreach ($bd->query($codi) as $EJER);
if ($_POST["action"] == "BORRAR" || $_POST["action"] == "GRABAR" || $_POST["action"] == "MARCAR TODOS" || $_POST["action"] == "LIMPIAR TODOS" || $_POST["action"] == "Si" || $_POST["action"] == "No") {
$tabla = $_POST["accion1"];
$cns = $_POST["accion2"];
} else {
$tabla = recogeParaConsulta($bd, 'tabla', $EJER['EJERCICIO']); 
$C4 = $_POST['CONSULTA'];	
$cns = recogeParaConsulta($bd, 'cns', $C4); 
}

$cns = quitaComillasExteriores($cns); 
if ($cns == '1') {
$C15 = $_POST['EJER'];	

$codi = "SELECT EJERCICIO FROM CONTROL WHERE IDEJER == $C15"; 
foreach ($bd->query($codi) as $EJER);
$tabla = recogeParaConsulta($bd, 'tabla', $EJER['EJERCICIO']); 

$CCER = "SELECT * FROM CONTROL WHERE EJERCICIO == '$tabla'";
foreach ($bd->query($CCER) as $VERR);
if ($VERR['CERRADO'] == "SI") {
echo ("<strong><p align='center'>Lo siento, no es posible grabar en la base de datos al encontrarse cerrado el ejercicio. Si desea grabar algún registro debe abrir previamente dicho ejercicio, para ello tiene que ir a Configurar -> Configuración de los datos de control -> EJERCICIOS.");
} else {

echo "<p align=\"center\"><strong>MODIFICACIÓN DE REGISTROS EN LA BASE DE DATOS</strong></p>";

$campo = recogeParaConsulta($bd, 'campo', 'IDTOTAL'); 
$campo = quitaComillasExteriores($campo); 
$orden = recogeParaConsulta($bd, 'orden', 'ASC'); 
$orden = quitaComillasExteriores($orden);

if ($_POST["action"] == "GRABAR") {
$tabla = $_POST["accion1"];
$campo = $_POST["accion2"];
$orden = $_POST["accion3"];

$odex1 	= recogeMatrizParaConsulta($bd, 'odex1');
$odex2 	= recogeMatrizParaConsulta($bd, 'odex2');
$odex3 	= recogeMatrizParaConsulta($bd, 'odex3');
$odex4 	= recogeMatrizParaConsulta($bd, 'odex4');
$odex5 	= recogeMatrizParaConsulta($bd, 'odex5');
$odex6 	= recogeMatrizParaConsulta($bd, 'odex6');
$odex7 	= recogeMatrizParaConsulta($bd, 'odex7');
$odex8 	= recogeMatrizParaConsulta($bd, 'odex8');
$odex9 	= recogeMatrizParaConsulta($bd, 'odex9');
$odex10 = recogeMatrizParaConsulta($bd, 'odex10');

foreach ($odex1 as $ondice => $valor ) {
$consulta0 = "UPDATE '$tabla' SET MES = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex2 as $ondice => $valor ) {
$consulta0 = "UPDATE '$tabla' SET PROFESOR = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex3 as $ondice => $valor ) {
$consulta0 = "UPDATE '$tabla' SET TIPOGASTO = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex4 as $ondice => $valor ) {
$consulta0 = "UPDATE '$tabla' SET PARTIDA = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex5 as $ondice => $valor ) {
$consulta0 = "UPDATE '$tabla' SET COMUNES = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex6 as $ondice => $valor ) {
$consulta0 = "UPDATE '$tabla' SET DESCRIPCION = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex7 as $ondice => $valor ) {
$consulta0 = "UPDATE '$tabla' SET PROVEEDOR = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex8 as $ondice => $valor ) {
$consulta0 = "UPDATE '$tabla' SET IMPORTE = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex9 as $ondice => $valor ) {
$consulta0 = "UPDATE '$tabla' SET OTROS = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex10 as $ondice => $valor ) {
$consulta0 = "UPDATE '$tabla' SET DESPACHO = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }

if ($bd->query($consulta0)) {} else {print "<p>Error al grabar el registro.</p>\n";}
}

$consulta1 = "SELECT COUNT(*) FROM '$tabla'";
$result1 = $bd->query($consulta1);
if (!$result1) {
    print "<p>Error en la consulta1.</p>\n";
} elseif ($result1->fetchColumn()==0) {
    print "<p>No se ha creado todavía ningún registro.</p>\n";
} else {
    $consulta2 = "SELECT * FROM '$tabla' WHERE MES != ''
	        ORDER BY $campo $orden";
    $result2 = $bd->query($consulta2);
    if (!$result2) {
        print "<p>Error en la consulta2.</p>\n";
    } else {
        print "<p align=\"center\"><form action=\"modificar-registro.php\" method=\"".POST."\">
  <table border=\"3\" align=\"center\">
    <thead>
      <tr class=\"neg\">    
        <th><a href=\"$_SERVER[PHP_SELF]?campo=IDTOTAL&amp;tabla=$tabla&amp;orden=ASC\">   <img src=\"images/abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          ID
          <a href=\"$_SERVER[PHP_SELF]?campo=IDTOTAL&amp;tabla=$tabla&amp;orden=DESC\">    <img src=\"images/arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>	      
        <th><a href=\"$_SERVER[PHP_SELF]?campo=MES&amp;tabla=$tabla&amp;orden=ASC\">   <img src=\"images/abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          MES
          <a href=\"$_SERVER[PHP_SELF]?campo=MES&amp;tabla=$tabla&amp;orden=DESC\">    <img src=\"images/arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>
        <th><a href=\"$_SERVER[PHP_SELF]?campo=PROFESOR&amp;tabla=$tabla&amp;orden=ASC\"> <img src=\"images/abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          PROFESOR 
          <a href=\"$_SERVER[PHP_SELF]?campo=PROFESOR&amp;tabla=$tabla&amp;orden=DESC\"> <img src=\"images/arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>
        <th><a href=\"$_SERVER[PHP_SELF]?campo=TIPOGASTO&amp;tabla=$tabla&amp;orden=ASC\">   <img src=\"images/abajo.png\" alt=\"0-9\" title=\"0-9\" /></a>
          TIPOGASTO 
          <a href=\"$_SERVER[PHP_SELF]?campo=TIPOGASTO&amp;tabla=$tabla&amp;orden=DESC\">    <img src=\"images/arriba.png\" alt=\"9-0\" title=\"9-0\" /></a></th>
        <th><a href=\"$_SERVER[PHP_SELF]?campo=PARTIDA&amp;tabla=$tabla&amp;orden=ASC\">   <img src=\"images/abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          PARTIDA
          <a href=\"$_SERVER[PHP_SELF]?campo=PARTIDA&amp;tabla=$tabla&amp;orden=DESC\"> <img src=\"images/arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>
        <th><a href=\"$_SERVER[PHP_SELF]?campo=COMUNES&amp;tabla=$tabla&amp;orden=ASC\">   <img src=\"images/abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          COMUNES
          <a href=\"$_SERVER[PHP_SELF]?campo=COMUNES&amp;tabla=$tabla&amp;orden=DESC\"> <img src=\"images/arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>
        <th><a href=\"$_SERVER[PHP_SELF]?campo=DESCRIPCION&amp;tabla=$tabla&amp;orden=ASC\">   <img src=\"images/abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          DESCRIPCION
          <a href=\"$_SERVER[PHP_SELF]?campo=DESCRIPCION&amp;tabla=$tabla&amp;orden=DESC\"> <img src=\"images/arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a</th>
		  <th><a href=\"$_SERVER[PHP_SELF]?campo=PROVEEDOR&amp;tabla=$tabla&amp;orden=ASC\">   <img src=\"images/abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          PROVEEDOR
          <a href=\"$_SERVER[PHP_SELF]?campo=PROVEEDOR&amp;tabla=$tabla&amp;orden=DESC\"> <img src=\"images/arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a</th>
		  <th><a href=\"$_SERVER[PHP_SELF]?campo=IMPORTE&amp;tabla=$tabla&amp;orden=ASC\">   <img src=\"images/abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          IMPORTE
          <a href=\"$_SERVER[PHP_SELF]?campo=IMPORTE&amp;tabla=$tabla&amp;orden=DESC\"> <img src=\"images/arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a</th>
		  <th><a href=\"$_SERVER[PHP_SELF]?campo=OTROS&amp;tabla=$tabla&amp;orden=ASC\">   <img src=\"images/abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          OTROS
          <a href=\"$_SERVER[PHP_SELF]?campo=OTROS&amp;tabla=$tabla&amp;orden=DESC\"> <img src=\"images/arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a</th>		
		  <th><a href=\"$_SERVER[PHP_SELF]?campo=DESPACHO&amp;tabla=$tabla&amp;orden=ASC\">   <img src=\"images/abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          DESPACHO
          <a href=\"$_SERVER[PHP_SELF]?campo=DESPACHO&amp;tabla=$tabla&amp;orden=DESC\"> <img src=\"images/arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a</th>		    
		</th>

	  </tr>
    </thead>
    <tbody>\n";
        $tmp = TRUE;
		echo "<strong><p align='center'>" ."EJERCICIO ". $tabla  . '<br />';
        foreach ($result2 as $valor) {
            if ($tmp) {
                print "      <tr>\n";
            } else {
                print "      <tr class=\"neg\">\n";
            }
            $tmp = !$tmp;
            print  (" 
        <td>$valor[IDTOTAL]</td>
		<td><input type=\"text\" name=\"odex1[$valor[IDTOTAL]]\" value=\"$valor[MES]\" size=\"9\" " ."maxlength=\"10\"</a></td>
		<td><input type=\"text\" name=\"odex2[$valor[IDTOTAL]]\" value=\"$valor[PROFESOR]\" size=\"25\" " ."maxlength=\"50\"</a></td>
		<td><input type=\"text\" name=\"odex3[$valor[IDTOTAL]]\" value=\"$valor[TIPOGASTO]\" size=\"12\" " ."maxlength=\"30\"</a></td>
		<td><input type=\"text\" name=\"odex4[$valor[IDTOTAL]]\" value=\"$valor[PARTIDA]\" size=\"6\" " ."maxlength=\"6\"</a></td>
		<td><input type=\"text\" name=\"odex5[$valor[IDTOTAL]]\" value=\"$valor[COMUNES]\" size=\"8\" " ."maxlength=\"25\"</a></td>
		<td><input type=\"text\" name=\"odex6[$valor[IDTOTAL]]\" value=\"$valor[DESCRIPCION]\" size=\"15\" " ."maxlength=\"15\"</a></td>		
		<td><input type=\"text\" name=\"odex7[$valor[IDTOTAL]]\" value=\"$valor[PROVEEDOR]\" size=\"15\" " ."maxlength=\"25\"</a></td>	
		<td><input type=\"text\" name=\"odex8[$valor[IDTOTAL]]\" value=\"$valor[IMPORTE]\" size=\"7\" " ."maxlength=\"8\"</a></td>	
		<td><input type=\"text\" name=\"odex9[$valor[IDTOTAL]]\" value=\"$valor[OTROS]\" size=\"15\" " ."maxlength=\"30\"</a></td>	
		<td><input type=\"text\" name=\"odex10[$valor[IDTOTAL]]\" value=\"$valor[DESPACHO]\" size=\"8\" " ."maxlength=\"8\"</a></td>									
		\n      </tr>\n");
		}
 print (" <p align=\"center\"><input name=\"action\" type=\"submit\" value=\"GRABAR\" /><input name=\"accion1\" type=\"hidden\" value=\"$tabla\" /><input name=\"accion2\" type=\"hidden\" value=\"$campo\" /><input name=\"accion3\" type=\"hidden\" value=\"$orden\" /></tr>\n");

    }
}
}
} elseif ($cns == '2') {
if ($_POST["action"] == "Si") {
$id = recogeMatrizParaConsulta($bd, 'id');
	if (count($id)==0) { print "<p align=\"center\"><strong>No se ha marcado nada para borrar.</strong></p>\n";} 
	else {	
	    	foreach ($id as $indice => $valor) {
	       	 $consulta0 = "DELETE FROM '$tabla' WHERE IDTOTAL=$indice";
    	    if ($bd->query($consulta0)) {
			print "<p align=\"center\"><strong>Registro/s borrado/s correctamente.</strong></p>\n";
			} else { print "<p>Error al borrar el registro.</p>\n";}
    		}
	}
} 	else {	}

if ($_POST["action"] == "MARCAR TODOS") {
$BOTON = 'checked';
} else if ($_POST["action"] == "LIMPIAR TODOS") {
$BOTON = '';
}

$campo = recogeParaConsulta($bd, 'campo', 'MES'); 	$campo = quitaComillasExteriores($campo); 
$orden = recogeParaConsulta($bd, 'orden', 'ASC'); 	$orden = quitaComillasExteriores($orden);
$consulta1 = "SELECT COUNT(*) FROM '$tabla'";
$result1 = $bd->query($consulta1);
if (!$result1) { print "<p>Error en la consulta1.</p>\n";} 
elseif ($result1->fetchColumn()==0) { print "<p>No se ha creado todavía ningún registro.</p>\n";} 
else {
// bloque nuevo para que en segundo paso solo salgan las marcadas
if ($_POST["accion20"] == "2") {
$id = recogeMatrizParaConsulta($bd, 'id');
foreach ($id as $indice => $valor) {
$consulta2 = "SELECT * FROM '$tabla' WHERE IDTOTAL=$indice";}
$BOTON = 'checked';}
else { $consulta2 = "SELECT * FROM '$tabla' ";}
    $result2 = $bd->query($consulta2);
    if (!$result2) {print "<p>Error en la consulta2.</p>\n";} 
	else { print "<p align=\"center\"><form action=\"configurar.php\" method=\"".POST."\">
  <table border=\"3\" align=\"center\">
    <thead>
      <tr class=\"neg\"> 
	    <th>Borrar</th>        
        <th><a href=\"$_SERVER[PHP_SELF]?campo=IDTOTAL&amp;tabla='$tabla'&amp;cns=$cns&amp;orden=ASC\">   <img src=\"images/abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          ID
          <a href=\"$_SERVER[PHP_SELF]?campo=IDTOTAL&amp;tabla='$tabla'&amp;cns=$cns&amp;orden=DESC\"><img src=\"images/arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a></th>
		</th>        
		<th><a href=\"$_SERVER[PHP_SELF]?campo=MES&amp;tabla='$tabla'&amp;cns=$cns&amp;orden=ASC\"> <img src=\"images/abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          MES 
          <a href=\"$_SERVER[PHP_SELF]?campo=MES&amp;tabla='$tabla'&amp;cns=$cns&amp;orden=DESC\"> <img src=\"images/arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a>
		</th>
        <th><a href=\"$_SERVER[PHP_SELF]?campo=PROFESOR&amp;tabla='$tabla'&amp;cns=$cns&amp;orden=ASC\"> <img src=\"images/abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          PROFESOR
          <a href=\"$_SERVER[PHP_SELF]?campo=PROFESOR&amp;tabla='$tabla'&amp;cns=$cns&amp;orden=DESC\"><img src=\"images/arriba.png\" alt=\"Z-A\" title=\"Z-A\"/></a>
		</th>
		<th><a href=\"$_SERVER[PHP_SELF]?campo=TIPOGASTO&amp;tabla='$tabla'&amp;cns=$cns&amp;orden=ASC\"> <img src=\"images/abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          TIPO DE GASTO
          <a href=\"$_SERVER[PHP_SELF]?campo=TIPOGASTO&amp;tabla='$tabla'&amp;cns=$cns&amp;orden=DESC\"> <img src=\"images/arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a>			       </th>
        <th><a href=\"$_SERVER[PHP_SELF]?campo=DESCRIPCION&amp;tabla='$tabla'&amp;cns=$cns&amp;orden=ASC\"> <img src=\"images/abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          DESCRIPCION 
          <a href=\"$_SERVER[PHP_SELF]?campo=DESCRIPCION&amp;tabla='$tabla'&amp;cns=$cns&amp;orden=DESC\"> <img src=\"images/arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a>		
		</th>  
        <th><a href=\"$_SERVER[PHP_SELF]?campo=IMPORTE&amp;tabla='$tabla'&amp;cns=$cns&amp;orden=ASC\"> <img src=\"images/abajo.png\" alt=\"A-Z\" title=\"A-Z\" /></a>
          IMPORTE 
          <a href=\"$_SERVER[PHP_SELF]?campo=IMPORTE&amp;tabla='$tabla'&amp;cns=$cns&amp;orden=DESC\"> <img src=\"images/arriba.png\" alt=\"Z-A\" title=\"Z-A\" /></a>			        </th>
	  </tr>
    </thead>
    <tbody>\n";
        $tmp = TRUE;

		echo "<strong><p align='center'>EJERCICIO: " .$tabla  . '<br />';
        foreach ($result2 as $valor) {
            if ($tmp) { print "      <tr>\n";} 
			else { print "      <tr class=\"neg\">\n"; }
            $tmp = !$tmp;
            print  ("<td align=\"center\"><input type=\"checkbox\" name=\"id[$valor[IDTOTAL]]\" $BOTON/></td>
		<td>$valor[IDTOTAL]</td>
	    <td>$valor[MES]</td>
	    <td>$valor[PROFESOR]</td>
	    <td>$valor[TIPOGASTO]</td>
	    <td>$valor[DESCRIPCION]</td>
	    <td>$valor[IMPORTE]</td>		
				\n      </tr>\n");
		}

if ($_POST["action"] == "BORRAR") {
 	print "<p align=\"center\"><strong>Esta operación es potencialmente peligrosa, ¿está seguro de que desea continuar?</strong></p>";
print ("<p align=\"center\"><input name=\"action\" type=\"submit\" value=\"Si\"/>
<input name=\"action\" type=\"submit\" value=\"No\"  /><input name=\"accion1\" type=\"hidden\" value=\"$tabla\" /><input name=\"accion2\" type=\"hidden\" value=\"$cns\" /></tr>\n"); 
} else {
 print ("<P align=\"center\"><input name=\"action\" type=\"submit\" value=\"MARCAR TODOS\" />   <input name=\"action\" type=\"submit\" value=\"BORRAR\" />   <input name=\"action\" type=\"submit\" value=\"LIMPIAR TODOS\" /><input name=\"accion1\" type=\"hidden\" value=\"$tabla\" /><input name=\"accion2\" type=\"hidden\" value=\"$cns\" /><input name=\"accion20\" type=\"hidden\" value=\"2\" /></tr>\n");
}
    }
}

} 
elseif ($cns == '3') {
echo "<p>NOMBRE DEL CAMPO A REEMPLAZAR: " . $C16 . "</p> <p>BUSCAR: " . $C17 . " </p><p>REEMPLAZAR POR: " . $C18 . " </p><p>PARA EL EJERCICIO: " . $EJER['EJERCICIO'];
$consulta = "UPDATE '$EJER[EJERCICIO]' SET $C16 = '$C18' WHERE $C16 = '$C17'";
if ($bd->query($consulta)) { print "<p>Registro modificado correctamente.</p>\n";} else { print "<p>Error al modificar el registro.</p>\n";} 
}
$bd = NULL;
?>