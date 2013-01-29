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
cabecera('GRABADO DE REGISTROS', CABECERA_SIN_CURSOR);
$bd = conectaDb();

$C0 = $_POST['EJER'];	
$C1 = $_POST['MES'];
$C2 = $_POST['PROFESOR'];
$C3 = $_POST['TIPOGASTO'];
$C4 = $_POST['PARTIDA'];
$C5 = $_POST['COMUNES'];
$C6 = $_POST['DESCRIPCION'];
$C7 = $_POST['PROVEEDOR'];
$C8 = $_POST['IMPORTE'];
$C9 = $_POST['OTROS'];
$CP = $_POST["accion10"];

$M1 = "<table border=\"1\" bgcolor=\"#FF3333\" align=\"center\">Registro insertado correctamente";
$M2 = "Error al insertar el registro";
$M3 = "Tiene que seleccionar una modalidad de gasto común";
$M4 = "Tiene que seleccionar una modalidad cuando escoja 'otros' como tipo de gasto";
$M5 = "Tiene que introducir el nombre de un profesor";
$M6 = "Tiene que seleccionar una modalidad de gasto";
$M7 = "Tiene que dar una descripción al gasto";
$M8 = "Tiene que seleccionar un proveedor";
$M9 = "Tiene que seleccionar una partida de gasto";
$M10 = "Tiene que teclear un importe para el gasto";
$M11 = "Tiene que eliminar el campo TIPO GASTO COMUN dado que ha seleccionado el nombre de un profesor";

$codi = "SELECT EJERCICIO FROM CONTROL WHERE IDEJER == $C0"; 
foreach ($bd->query($codi) as $EJER);
$tabla = recogeParaConsulta($bd, 'tabla', $EJER['EJERCICIO']); 
$tabla1 = $tabla;

$CCER = "SELECT * FROM CONTROL WHERE EJERCICIO == '$tabla1'";
foreach ($bd->query($CCER) as $VERR);

if ($VERR['CERRADO'] == "SI") {
echo utf8_encode ("<strong><p align='center'>Lo siento, no es posible grabar en la base de datos al encontrarse cerrado el ejercicio. Si desea grabar algún registro debe abrir previamente dicho ejercicio, para ello tiene que ir a Configurar -> Configuración de los datos de control -> EJERCICIOS.");
} else {

if ($_POST["action1"] == "ANTERIOR") {
$tabla1 = $_POST["accion0"];
$PUNTERO = $CP-1; } 
elseif ($_POST["action4"] == "POSTERIOR"){
$tabla1 = $_POST["accion0"];
$PUNTERO = $CP+1; }
elseif ($_POST["action3"] == "GRABAR"){
$tabla1 = $_POST["accion0"];
}
elseif ($_POST["action2"] == "DUPLICAR"){
$tabla1 = $_POST["accion0"];
}

echo "<p align=\"center\"><strong>GRABAR REGISTROS EN LA BASE DE DATOS</strong></p>";
echo "<p align=\"center\"><strong>EJERCICIO: $tabla1 </strong></p>" ;

if ($_POST["action1"] == "ANTERIOR" || $_POST["action4"] == "POSTERIOR") { // INICIO ANTERIOR 
$tabla = $_POST["accion0"];
$cod = "SELECT * FROM '$tabla' WHERE IDTOTAL == $PUNTERO"; 
foreach ($bd->query($cod) as $C);

$cod1 = "SELECT IDMES FROM CONTROL WHERE MES == '$C[MES]'"; 
foreach ($bd->query($cod1) as $C11);
$C1 = $C11[IDMES];
$cod2 = "SELECT IDPROF FROM CONTROL WHERE PROFESOR == '$C[PROFESOR]'"; 
foreach ($bd->query($cod2) as $C12);
$C2 = $C12[IDPROF];
$cod3 = "SELECT IDTIPO FROM CONTROL WHERE TIPOGASTO == '$C[TIPOGASTO]'"; 
foreach ($bd->query($cod3) as $C13);
$C3 = $C13[IDTIPO];
$cod4 = "SELECT IDPARTIDA FROM CONTROL WHERE PARTIDA == '$C[PARTIDA]'"; 
foreach ($bd->query($cod4) as $C14);
$C4 = $C14[IDPARTIDA];
$cod5 = "SELECT IDCOMUNES FROM CONTROL WHERE COMUNES == '$C[COMUNES]'"; 
foreach ($bd->query($cod5) as $C15);
$C5 = $C15[IDCOMUNES];
$cod7 = "SELECT IDPROV FROM CONTROL WHERE PROVEEDOR == '$C[PROVEEDOR]'"; 
foreach ($bd->query($cod7) as $C17);
$C7 = $C17[IDPROV];
$cod9 = "SELECT IDOTROS FROM CONTROL WHERE OTROS == '$C[OTROS]'"; 
foreach ($bd->query($cod9) as $C19);
$C9 = $C19[IDOTROS];

$IMPORTE = $C[IMPORTE]+0;
$DESCRIPCION = $C[DESCRIPCION];
}  // FIN ANTERIOR O POSTERIOR

$consulta = "SELECT * FROM CONTROL WHERE IDMES > '0'";
$result = $bd->query($consulta); $MES = "<select name=MES>\n";
while($row=$result->fetch())
{if ($row['IDMES'] == $C1) { $dtext = "selected";} else {$dtext = ""; }
$MES .= "<option " . $dtext . " value='".$row['IDMES']. "'>".$row['MES']."</option>\n";	}
$combo .= "</select>\n";
echo $combo;

$consulta = "SELECT * FROM CONTROL WHERE IDPROF > '0' order by PROFESOR";
$result = $bd->query($consulta); $PROFESOR = "<select name=PROFESOR>\n";
while($row=$result->fetch())
{if ($row['IDPROF'] == $C2) { $dtext = "selected";} else {$dtext = ""; }
$PROFESOR .= "<option ".$dtext." value='".$row['IDPROF']. "'>".$row['PROFESOR']."</option>\n";	}
$combo .= "</select>\n";
echo $combo;

$consulta = "SELECT * FROM CONTROL WHERE IDTIPO > '1' AND  IDTIPO < '9' OR IDTIPO = '10' ORDER BY TIPOGASTO";
$result = $bd->query($consulta); $TIPOGASTO = "<select name=TIPOGASTO>\n";
while($row=$result->fetch())
{if ($row['IDTIPO'] == $C3) { $dtext = "selected";} else {$dtext = ""; }
$TIPOGASTO .= "<option ".$dtext." value='".$row['IDTIPO']."'>".$row['TIPOGASTO']."</option>\n";	}
$combo .= "</select>\n";
echo $combo;

$consulta = "SELECT * FROM CONTROL WHERE IDPARTIDA > '0' order by PARTIDA";
$result = $bd->query($consulta); $PARTIDA = "<select name=PARTIDA>\n";
while($row=$result->fetch())
{if ($row['IDPARTIDA'] == $C4) { $dtext = "selected";} else {$dtext = ""; }
$PARTIDA .= "<option ".$dtext." value='".$row['IDPARTIDA']."'>".$row['PARTIDA']."</option>\n";	}
$combo .= "</select>\n";
echo $combo;

$consulta = "SELECT * FROM CONTROL WHERE IDCOMUNES > '0' ORDER BY COMUNES";
$result = $bd->query($consulta); $COMUNES = "<select name=COMUNES>\n";
while($row=$result->fetch())
{if ($row['IDCOMUNES'] == $C5) { $dtext = "selected";} else {$dtext = ""; }
$COMUNES .= "<option ".$dtext." value='".$row['IDCOMUNES']."'>".$row['COMUNES']."</option>\n";	}
$combo .= "</select>\n";
echo $combo;

$consulta = "SELECT * FROM CONTROL WHERE IDPROV > '0' ORDER BY PROVEEDOR";
$result = $bd->query($consulta); $PROVEEDOR = "<select name=PROVEEDOR>\n";
while($row=$result->fetch())
{if ($row['IDPROV'] == $C7) { $dtext = "selected";} else {$dtext = ""; }
$PROVEEDOR .= "<option ".$dtext." value='".$row['IDPROV']."'>".$row['PROVEEDOR']."</option>\n";	}
$combo .= "</select>\n";
echo $combo;

$consulta = "SELECT * FROM CONTROL WHERE IDOTROS > '0' ORDER BY OTROS";
$result = $bd->query($consulta); $OTROS = "<select name=OTROS>\n";
while($row=$result->fetch())
{if ($row['IDOTROS'] == $C9) { $dtext = "selected";} else {$dtext = ""; }
$OTROS .= "<option ".$dtext." value='".$row['IDOTROS']."'>".$row['OTROS']."</option>\n";}
$combo .= "</select>\n";
echo $combo;

if ($_POST["action1"] == "ANTERIOR" || $_POST["action4"] == "POSTERIOR") { 
$S = "SELECT MAX(IDTOTAL) FROM '$tabla' ";
foreach ($bd->query($S) as $ST);
$b1 = max($ST);
$P = $b1 + 0;
}
else {
$S = "SELECT MAX(IDTOTAL) FROM '$tabla' ";
foreach ($bd->query($S) as $ST);
$b1 = max($ST);
$PUNTERO = $b1 + 1;
$P = $b1 + 0;
}

if ($_POST["action3"] == "GRABAR" || $_POST["action2"] == "DUPLICAR") { // INICIO GRABAR O DUPLICAR
$tabla = $_POST["accion0"];
$cod1 = "SELECT MES FROM CONTROL WHERE IDMES == $C1"; 
foreach ($bd->query($cod1) as $C11);
$cod2 = "SELECT PROFESOR FROM CONTROL WHERE IDPROF == $C2"; 
foreach ($bd->query($cod2) as $C12);
$cod3 = "SELECT TIPOGASTO FROM CONTROL WHERE IDTIPO == $C3"; 
foreach ($bd->query($cod3) as $C13);
$cod4 = "SELECT PARTIDA FROM CONTROL WHERE IDPARTIDA == $C4"; 
foreach ($bd->query($cod4) as $C14);
$cod5 = "SELECT COMUNES FROM CONTROL WHERE IDCOMUNES == $C5"; 
foreach ($bd->query($cod5) as $C15);
$cod7 = "SELECT PROVEEDOR FROM CONTROL WHERE IDPROV == $C7"; 
foreach ($bd->query($cod7) as $C17);
$cod9 = "SELECT OTROS FROM CONTROL WHERE IDOTROS == $C9"; 
foreach ($bd->query($cod9) as $C19);

$S = "SELECT MAX(IDTOTAL) FROM '$tabla' ";
foreach ($bd->query($S) as $ST);
$b1 = max($ST);
$PUNTERO = $b1 + 1;
$P = $b1 + 0;

	if ($C12[PROFESOR] == 'GASTOS COMUNES') {
	$C20 = $C15['COMUNES'];
	} 
	else {
	$DES1 = "SELECT DESPACHOS FROM CONTROL WHERE PROFESOR == '$C12[PROFESOR]'"; 
	foreach ($bd->query($DES1) as $valor);
	$C20 = $valor['DESPACHOS'];
	}
	
	if ($C12[PROFESOR] == 'GASTOS COMUNES' && $C5 == '1') {$M = $M3;$tabla1 == $tabla;print utf8_encode ("<table border=\"1\" bgcolor=\"#FF3333\" align=\"center\"><thead><tr><p align=\"center\"><th><strong>$M</strong></p></thead></th></tr>\n");} 
	elseif ($C12[PROFESOR] !== 'GASTOS COMUNES' && $C5 !== '1') {$M = $M11;print utf8_encode ("<table border=\"1\" bgcolor=\"#FF3333\" align=\"center\"><thead><tr><p align=\"center\"><th><strong>$M</strong></p></thead></th></tr>\n");}
	elseif ($C13[TIPOGASTO] == 'OTROS' && $C9 == '1') {$M = $M4;print utf8_encode ("<table border=\"1\" bgcolor=\"#FF3333\" align=\"center\"><thead><tr><p align=\"center\"><th><strong>$M</strong></p></thead></th></tr>\n");}
	elseif ($C2 == 1) {$M = $M5; print utf8_encode ("<table border=\"1\" bgcolor=\"#FF3333\" align=\"center\"><thead><tr><p align=\"center\"><th><strong>$M</strong></p></thead></th></tr>\n");}
	elseif ($C3 == 1) {$M = $M6; print utf8_encode ("<table border=\"1\" bgcolor=\"#FF3333\" align=\"center\"><thead><tr><p align=\"center\"><th><strong>$M</strong></p></thead></th></tr>\n");}
	elseif ($C4 == 1) {$M = $M9; print utf8_encode ("<table border=\"1\" bgcolor=\"#FF3333\" align=\"center\"><thead><tr><p align=\"center\"><th><strong>$M</strong></p></thead></th></tr>\n");}
	elseif ($C7 == 1) {$M = $M8; print utf8_encode ("<table border=\"1\" bgcolor=\"#FF3333\" align=\"center\"><thead><tr><p align=\"center\"><th><strong>$M</strong></p></thead></th></tr>\n");}
	elseif ($C8 == 0) {$M = $M10;print utf8_encode ("<table border=\"1\" bgcolor=\"#FF3333\" align=\"center\"><thead><tr><p align=\"center\"><th><strong>$M</strong></p></thead></th></tr>\n");}
	elseif ($C6 == ''){$M = $M7; print utf8_encode ("<table border=\"1\" bgcolor=\"#FF3333\" align=\"center\"><thead><tr><p align=\"center\"><th><strong>$M</strong></p></thead></th></tr>\n");}			
	else {
$c = "INSERT INTO '$tabla' (IDTOTAL,MES,PROFESOR,TIPOGASTO,PARTIDA,COMUNES,DESCRIPCION,PROVEEDOR,IMPORTE,OTROS,DESPACHO) values ($PUNTERO,'$C11[MES]','$C12[PROFESOR]','$C13[TIPOGASTO]','$C14[PARTIDA]','$C15[COMUNES]','$C6','$C17[PROVEEDOR]','$C8','$C19[OTROS]','$C20')";

$FECHA = date('j/n/Y');	
$D10 = "UPDATE CONTROL SET FECHAACT = '$FECHA' where IDTOTAL == '1'";
$resultado2 = $bd->query($D10);
		
	if ($bd->query($c)) {$M = $M1;} else {$M = $M2;}
	}
} // FIN GRABAR O DUPLICAR

print "<p align=\"center\"><form action=\"grabar.php\" method=\"".POST."\"><table border=\"0\" align=\"center\">
    <thead>
      <tr class=\"neg\">    
        <th colspan=\"2\" align=\"left\">REGISTRO NUMERO: $PUNTERO DE $P</th><th colspan=\"2\" align=\"left\">MES DE IMPUTACION: $MES</th>
	  </tr>
      <tr class=\"neg\">    
        <th colspan=\"2\"  align=\"left\">PROFESOR: $PROFESOR</th><th  colspan=\"2\" align=\"left\">TIPO GASTO COMUN: $COMUNES</th>
	  </tr>	  
      <tr class=\"neg\">    
        <th colspan=\"2\" align=\"left\">TIPO DE GASTO: $TIPOGASTO</th><th colspan=\"2\" align=\"left\">TIPO OTROS GASTOS: $OTROS</th>
	  </tr>	  
      <tr class=\"neg\">    
		<th colspan=\"4\" align=\"left\">DESCRIPCION: <input NAME=\"DESCRIPCION\" TYPE=\"text\" id=\"DESCRIPCION\" value=\"$C6\" SIZE=\"50\" MAXLENGTH=\"60\"></th>     
	  </tr>	  
      <tr class=\"neg\">    
        <th colspan=\"2\" align=\"left\">PROVEEDOR: $PROVEEDOR</th><th align=\"left\">PARTIDA: $PARTIDA</th><th align=\"left\">IMPORTE: <input NAME=\"IMPORTE\" TYPE=\"text\" id=\"IMPORTE\"  value=\"$IMPORTE\" SIZE=\"10\" MAXLENGTH=\"10\"></th>
	  </tr>
 
    </thead>
    <tbody>\n";	
print ("<p> </p>\n");
print ("<p> </p>\n");
print ("<tr> <td></td> </tr>\n");
print ("<tr> <td></td> </tr>\n");
print ("<tr> <td></td> </tr>\n");
print ("
    <thead>
      <tr>  
	   <th><p align=\"center\"><input name=\"action1\" type=\"submit\" value=\"ANTERIOR\" /></th>
	   <th><p align=\"center\"><input name=\"action4\" type=\"submit\" value=\"POSTERIOR\" /></th>
	   
	   <th><p align=\"center\"><input name=\"action3\" type=\"submit\" value=\"GRABAR\" /></th>

<input name=\"accion0\" type=\"hidden\" value=\"$tabla\" />	   
<input name=\"accion1\" type=\"hidden\" value=\"$MES\" />
<input name=\"accion2\" type=\"hidden\" value=\"$PROFESOR\" />
<input name=\"accion3\" type=\"hidden\" value=\"$TIPOGASTO\" />
<input name=\"accion4\" type=\"hidden\" value=\"$PARTIDA\" />
<input name=\"accion5\" type=\"hidden\" value=\"$COMUNES\" />
<input name=\"accion7\" type=\"hidden\" value=\"$PROVEEDOR\" />
<input name=\"accion9\" type=\"hidden\" value=\"$OTROS\" />
<input name=\"accion10\" type=\"hidden\" value=\"$PUNTERO\" />
<input name=\"accion11\" type=\"hidden\" value=\"$DESCRIPCION\" />
</tr>\n");
//<th><p align=\"center\"><input name=\"action2\" type=\"submit\" value=\"DUPLICAR\" /></th>
}
$bd = NULL;
?>