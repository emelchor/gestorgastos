<?php
include('funciones.php');
cabecera('INGRESOS', CABECERA_SIN_CURSOR);
$bd = conectaDb();

$C15 = $_POST['EJER'];	

$codi = "SELECT EJERCICIO FROM CONTROL WHERE IDEJER == $C15"; 
foreach ($bd->query($codi) as $EJER);
$tabla = recogeParaConsulta($bd, 'tabla', $EJER['EJERCICIO']); 
//echo "<p align=\"center\"><strong>MODIFICACIÓN DE REGISTROS EN LA BASE DE DATOS</strong></p>";

$CCER = "SELECT * FROM CONTROL WHERE EJERCICIO == '$tabla'";
foreach ($bd->query($CCER) as $VERR);
if ($VERR['CERRADO'] == "SI") {
echo ("<strong><p align='center'>Lo siento, no es posible grabar en la base de datos al encontrarse cerrado el ejercicio. Si desea grabar algún registro debe abrir previamente dicho ejercicio, para ello tiene que ir a Configurar -> Configuración de los datos de control -> EJERCICIOS.");
} else {

if ($_POST["action"] == "GRABAR") {
$tabla = $_POST["accion1"];

$odex1 	= recogeMatrizParaConsulta($bd, 'odex1');
$odex2 	= recogeMatrizParaConsulta($bd, 'odex2');
$odex3 	= recogeMatrizParaConsulta($bd, 'odex3');
$odex4 	= recogeMatrizParaConsulta($bd, 'odex4');
$odex5 	= recogeMatrizParaConsulta($bd, 'odex5');
$odex6 	= recogeMatrizParaConsulta($bd, 'odex6');
$odex1A = recogeMatrizParaConsulta($bd, 'odex1A');
$odex2A = recogeMatrizParaConsulta($bd, 'odex2A');
$odex3A = recogeMatrizParaConsulta($bd, 'odex3A');
$odex4A = recogeMatrizParaConsulta($bd, 'odex4A');
$odex5A = recogeMatrizParaConsulta($bd, 'odex5A');
$odex6A = recogeMatrizParaConsulta($bd, 'odex6A');
$odex7 	= recogeMatrizParaConsulta($bd, 'odex7');
$odex8 	= recogeMatrizParaConsulta($bd, 'odex8');
$odex9 	= recogeMatrizParaConsulta($bd, 'odex9');
$odex10 = recogeMatrizParaConsulta($bd, 'odex10');
$odex11 = recogeMatrizParaConsulta($bd, 'odex11');
$odex12 = recogeMatrizParaConsulta($bd, 'odex12');
$odex13 = recogeMatrizParaConsulta($bd, 'odex13');

foreach ($odex1 as $ondice => $valor ) {
$consulta0 = "UPDATE INGRESOS SET CONTRATO1 = $valor WHERE ANNO = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex2 as $ondice => $valor ) {
$consulta0 = "UPDATE INGRESOS SET CONTRATO2 = $valor WHERE ANNO = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex1A as $ondice => $valor ) {
$consulta0 = "UPDATE INGRESOS SET CONTRATO3 = $valor WHERE ANNO = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex2A as $ondice => $valor ) {
$consulta0 = "UPDATE INGRESOS SET CONTRATO4 = $valor WHERE ANNO = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex3 as $ondice => $valor ) {
$consulta0 = "UPDATE INGRESOS SET ANUAL1 = $valor WHERE ANNO = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex4 as $ondice => $valor ) {
$consulta0 = "UPDATE INGRESOS SET ANUAL2 = $valor WHERE ANNO = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex3A as $ondice => $valor ) {
$consulta0 = "UPDATE INGRESOS SET ANUAL3 = $valor WHERE ANNO = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex4A as $ondice => $valor ) {
$consulta0 = "UPDATE INGRESOS SET ANUAL4 = $valor WHERE ANNO = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex5 as $ondice => $valor ) {
$consulta0 = "UPDATE INGRESOS SET REMANENTE1 = $valor WHERE ANNO = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex6 as $ondice => $valor ) {
$consulta0 = "UPDATE INGRESOS SET REMANENTE2 = $valor WHERE ANNO = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex5A as $ondice => $valor ) {
$consulta0 = "UPDATE INGRESOS SET REMANENTE3 = $valor WHERE ANNO = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex6A as $ondice => $valor ) {
$consulta0 = "UPDATE INGRESOS SET REMANENTE4 = $valor WHERE ANNO = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex7 as $ondice => $valor ) {
$consulta0 = "UPDATE INGRESOS SET DIETAS1 = $valor WHERE ANNO = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex8 as $ondice => $valor ) {
$consulta0 = "UPDATE INGRESOS SET DIETAS2 = $valor WHERE ANNO = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex9 as $ondice => $valor ) {
$consulta0 = "UPDATE INGRESOS SET RETENIDO = $valor WHERE ANNO = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex10 as $ondice => $valor ) {
$consulta0 = "UPDATE INGRESOS SET OBLIGADO = $valor WHERE ANNO = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex11 as $ondice => $valor ) {
$consulta0 = "UPDATE INGRESOS SET PAGADO = $valor WHERE ANNO = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex12 as $ondice => $valor ) {
$consulta0 = "UPDATE INGRESOS SET RESERVADO = $valor WHERE ANNO = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex13 as $ondice => $valor ) {
$consulta0 = "UPDATE INGRESOS SET GASDIETAS = $valor WHERE ANNO = $ondice";
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
    $consulta2 = "SELECT * FROM INGRESOS WHERE ANNO = $tabla";
    $result2 = $bd->query($consulta2);
    if (!$result2) {
        print "<p>Error en la consulta2.</p>\n";
    } else {
        print "<p align=\"center\"><form action=\"ingresos.php\" method=\"".POST."\">
  <table border=\"3\" align=\"center\" cellpadding=\"4\">
    <thead>
	      <tr class=\"tot\">    
    <td  colspan=\"4\"align=\"center\"><strong>INGRESOS</strong> </td>	 </td>
	</tr>\n
      <tr class=\"neg\"> 
        <td width=\"200\" align=\"center\"><strong>CONTRATO PROGRAMA</strong></td> <td width=\"200\" align=\"center\"><strong>INGRESOS ANUALES</strong></td><td width=\"200\" align=\"center\"><strong>REMANENTES</strong></td><td width=\"200\" align=\"center\"><strong>DIETAS</strong></td>	    
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
	$c4 = "SELECT SUM(IMPORTE) AS TOTAL FROM '$tabla'"; 
	foreach ($bd->query($c4) as $TT2);
	$CONTRATO=$valor['CONTRATO1']+$valor['CONTRATO2']+$valor['CONTRATO3'] + $valor['CONTRATO4'];
	$ANUAL = $valor['ANUAL1'] + $valor['ANUAL2'] + $valor['ANUAL3'] + $valor['ANUAL4'];
	$REMANENTE=$valor['REMANENTE1']+$valor['REMANENTE2']+$valor['REMANENTE3']+$valor['REMANENTE4'];
	$DIETAS = $valor['DIETAS1'] + $valor['DIETAS2'];
	$TOTAL = $CONTRATO + $ANUAL + $REMANENTE + $DIETAS;	
	$TOTALSD = $CONTRATO + $ANUAL + $REMANENTE ;	
	$GASTOS = $valor['RETENIDO'] +$valor['OBLIGADO']+$valor['RESERVADO']+$valor['PAGADO'];												
	$GASTOSSD=$valor['RETENIDO']+$valor['OBLIGADO']+$valor['RESERVADO']+$valor['PAGADO']-$valor['GASDIETAS'];
	$DISP = $TOTAL - $GASTOS;
	$DISPSD = $DISP - $DIETAS;
	$GASINDIV = $TT2['TOTAL'];
	$DIFGAS = round (($GASTOS - $GASINDIV)*100) / 100;
            print  (" 
<td align=\"center\"><input type=\"text\" name=\"odex1[$valor[ANNO]]\" value=\"$valor[CONTRATO1]\" size=\"10\" " ."maxlength=\"10\">  <input type=\"text\" name=\"odex1A[$valor[ANNO]]\" value=\"$valor[CONTRATO3]\" size=\"10\" " ."maxlength=\"10\"></td>

<td align=\"center\"><input type=\"text\" name=\"odex3[$valor[ANNO]]\" value=\"$valor[ANUAL1]\"    size=\"10\" " ."maxlength=\"10\"> <input type=\"text\" name=\"odex3A[$valor[ANNO]]\" value=\"$valor[ANUAL3]\" size=\"10\" " ."maxlength=\"10\"></td>

<td align=\"center\"><input type=\"text\" name=\"odex5[$valor[ANNO]]\" value=\"$valor[REMANENTE1]\"size=\"10\" " ."maxlength=\"10\"> <input type=\"text\" name=\"odex5A[$valor[ANNO]]\" value=\"$valor[REMANENTE3]\"size=\"10\" " ."maxlength=\"10\"></td>

<td align=\"center\"><input type=\"text\" name=\"odex7[$valor[ANNO]]\" value=\"$valor[DIETAS1]\"   size=\"20\" " ."maxlength=\"10\"></td>
</tr>
<tr>
<td align=\"center\"><input type=\"text\" name=\"odex2[$valor[ANNO]]\" value=\"$valor[CONTRATO2]\" size=\"10\" " ."maxlength=\"10\"> <input type=\"text\" name=\"odex2A[$valor[ANNO]]\" value=\"$valor[CONTRATO4]\" size=\"10\" " ."maxlength=\"10\"></td>

<td align=\"center\"><input type=\"text\" name=\"odex4[$valor[ANNO]]\" value=\"$valor[ANUAL2]\"    size=\"10\" " ."maxlength=\"10\"> <input type=\"text\" name=\"odex4A[$valor[ANNO]]\" value=\"$valor[ANUAL4]\"    size=\"10\" " ."maxlength=\"10\"></td>

<td align=\"center\"><input type=\"text\" name=\"odex6[$valor[ANNO]]\" value=\"$valor[REMANENTE2]\"size=\"10\" " ."maxlength=\"10\"> <input type=\"text\" name=\"odex6A[$valor[ANNO]]\" value=\"$valor[REMANENTE4]\"size=\"10\" " ."maxlength=\"10\"></td>

<td align=\"center\"><input type=\"text\" name=\"odex8[$valor[ANNO]]\" value=\"$valor[DIETAS2]\"   size=\"20\" " ."maxlength=\"10\"></td>
</tr>
<tr>
<td align=\"center\"> $CONTRATO </td>
<td align=\"center\"> $ANUAL </td>
<td align=\"center\"> $REMANENTE </td>
<td align=\"center\"> $DIETAS </td>
	  </tr>
      <tr class=\"neg\">    
    <td width=\"200\" colspan=\"2\"align=\"center\"><strong>TOTAL DE INGRESOS: $TOTAL</strong> </td>	    <td width=\"200\" colspan=\"2\"align=\"center\"><strong>TOTAL DE INGRESOS (SIN DIETAS): $TOTALSD</strong> </td>
	</tr>\n
      <tr class=\"tot\">    
    <td  colspan=\"4\"align=\"center\"><strong>GASTOS</strong> </td>	 </td>
	</tr>\n
	      <tr class=\"neg\"> 
        <td width=\"200\" align=\"center\"><strong>RETENIDO</strong></td> <td width=\"200\" align=\"center\"><strong>OBLIGADO</strong></td><td width=\"200\" align=\"center\"><strong>PAGADO</strong></td><td width=\"200\" align=\"center\"><strong>RESERVADO / DIETAS</strong></td>	    
	  </tr>
<tr>	  
<td align=\"center\"><input type=\"text\" name=\"odex9[$valor[ANNO]]\" value=\"$valor[RETENIDO]\" size=\"10\" " ."maxlength=\"10\"</td>

<td align=\"center\"><input type=\"text\" name=\"odex10[$valor[ANNO]]\" value=\"$valor[OBLIGADO]\"    size=\"10\" " ."maxlength=\"10\"></td>

<td align=\"center\"><input type=\"text\" name=\"odex11[$valor[ANNO]]\" value=\"$valor[PAGADO]\"size=\"10\" " ."maxlength=\"10\"></td>

<td align=\"center\"><input type=\"text\" name=\"odex12[$valor[ANNO]]\" value=\"$valor[RESERVADO]\"   size=\"10\" " ."maxlength=\"10\"> <input type=\"text\" name=\"odex13[$valor[ANNO]]\" value=\"$valor[GASDIETAS]\"   size=\"10\" " ."maxlength=\"10\"></td>
</tr>	
      <tr class=\"neg\">    
    <td width=\"200\" colspan=\"2\"align=\"center\"><strong>TOTAL DE GASTOS: $GASTOS</strong> </td>	    <td width=\"200\" colspan=\"2\"align=\"center\"><strong>TOTAL DE GASTOS (SIN DIETAS): $GASTOSSD</strong> </td>
	</tr>\n
      <tr class=\"tot\">    
    <td  colspan=\"4\"align=\"center\"><strong>SALDOS</strong> </td>	 </td>
	</tr>\n	
        <tr class=\"neg\">    
    <td width=\"200\" colspan=\"2\"align=\"center\"><strong>DISPONIBLE: $DISP</strong> </td>	    <td width=\"200\" colspan=\"2\"align=\"center\"><strong>DISPONIBLE (SIN DIETAS): $DISPSD</strong> </td>
	</tr>\n
        <tr class=\"tot\">    
    <td width=\"200\" colspan=\"2\"align=\"center\"><strong>TOTAL GASTO INDIVIDUALIZADO: $GASINDIV</strong> </td>	    <td width=\"200\" bgcolor=\"#FF3333\" colspan=\"2\"align=\"center\"><strong>DIFERENCIA (ERRORES U OMISIONES): $DIFGAS</strong> </td>
	</tr>\n	
		");
		}
 print (" <p align=\"center\"><input name=\"action\" type=\"submit\" value=\"GRABAR\" /><input name=\"accion1\" type=\"hidden\" value=\"$tabla\" /></tr>\n");

    }
}
}
$bd = NULL;
?>