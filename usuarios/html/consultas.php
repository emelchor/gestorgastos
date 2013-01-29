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
if (isset($_COOKIE['autentificadogastos'])) {
    $validado = $_COOKIE['autentificadogastos'];
} else { $validado = 'NO'; } 
if ( $validado == 'NO') {
	header("Location: ../../index.php");
    exit();
} 
include('funciones.php');
cabecera('');
$bd = conectaDb();

$C4 = $_POST['CONSULTA'];

$CONSULTA2 = $_POST['EJER'];
$CONSULTA5 = $_POST['TIPO'];
$CONSULTA6 = $_POST['CRITER'] - 1;

$codigo1_sql = "SELECT EJERCICIO FROM CONTROL WHERE IDEJER == $CONSULTA2"; 
foreach ($bd->query($codigo1_sql) as $EJERC);
$k= 1;

if ($C4 == '1') {
$CC1 = $_COOKIE['NOMBREUSUARIOGASTOS'];
//ENCABEZADO DE LA PAGINA
echo "<strong><p align='center'>INFORMACIÓN DETALLADA DE LOS GASTOS REALIZADOS EN ".$EJERC['EJERCICIO']  .' POR ' . $CC1 . '</strong><br />';
// ENCABEZADO DE LA TABLA
print "\n<table border=\"1\" align=\"center\">      <tbody><thead>
<tr class=\"tot\"><td align=\"center\"><strong>MES DE IMPUTACIÓN</td><td align=\"center\"><strong>TIPO DE GASTO</td><td align=\"center\" <strong>DETALLE</td><td align=\"center\"><strong>IMPORTE</td></tr>
  </thead>  <tbody>\n";
$codigo2_sql = "SELECT * FROM '$EJERC[EJERCICIO]' WHERE PROFESOR == '$CC1'"; 
foreach ($bd->query($codigo2_sql) as $row)
{
print ("<td align=\"center\">$row[MES]</td> <td align=\"center\">$row[TIPOGASTO]</td><td align=\"center\">$row[DESCRIPCION]</td>
<td align=\"center\">$row[IMPORTE]</td>
\n</tr>\n");
}
print "  \n</table></tbody>\n";

} elseif ($C4 == '2' ) {
$EJANT = $EJERC[EJERCICIO] - 1;
$CAMPO = 'TIPOGASTO'; $ID = 'IDTIPO'; $CONSULTA5 = '8';
$codigo2_sql = "SELECT * FROM CONTROL WHERE IDTIPO == $CONSULTA5"; 
foreach ($bd->query($codigo2_sql) as $TIPOG);	
//ENCABEZADO DE LA PAGINA
echo "<strong><p align='center'>EVOLUCIÓN INTERANUAL DE LOS GASTOS REALIZADOS EN ".$EJERC['EJERCICIO']  .'</strong><br />';
// ENCABEZADO DE LA TABLA
print "\n<table border=\"1\" align=\"center\">      <tbody><thead>
<tr class=\"tot\">	 <td></td><td align=\"center\" colspan=\"2\"><strong>IMPORTE</td><td align=\"center\" colspan=\"2\"><strong>VARIACION</td><td align=\"center\" colspan=\"2\"><strong>ESTRUCTURA %</td></tr>
<tr class=\"tot\">   <th>CONCEPTO</th><th>$EJANT</th><th>$EJERC[EJERCICIO]</th><th>Absoluta</th><th>Relativa</th><th>$EJANT</th><th>$EJERC[EJERCICIO]</th></tr>
  </thead>  <tbody>\n";
// CALCULOS
$codigo_sql = "SELECT $CAMPO,COMUNES,DESPACHO FROM CONTROL WHERE $ID < '9' AND $ID > '1' ORDER BY $CAMPO"; 
foreach ($bd->query($codigo_sql) as $row)
{
$c4 = "SELECT SUM(IMPORTE) AS TOTAL FROM '$EJERC[EJERCICIO]'"; 
foreach ($bd->query($c4) as $TT2);
$c4a = "SELECT SUM(IMPORTE) AS TOTAL FROM '$EJANT'"; 
foreach ($bd->query($c4a) as $TT2a);
$codigo3 = "SELECT SUM(IMPORTE) AS TOTAL FROM '$EJERC[EJERCICIO]' WHERE $CAMPO == '$row[$CAMPO]' ";foreach ($bd->query($codigo3) as $T);
$codigo3a = "SELECT SUM(IMPORTE) AS TOTAL FROM '$EJANT' WHERE $CAMPO == '$row[$CAMPO]' ";
foreach ($bd->query($codigo3a) as $Ta);
if ($k%2 == '0') {print "<tr class=\"neg\">\n";} else {print "<tr>\n";} $k++;
$d = $row[$CAMPO];							
$n = round ($T['TOTAL']*100)/100;
$na = round ($Ta['TOTAL']*100)/100;
$dif = $n - $na;
$rel = round (($dif/$na)*1000)/10;
$t2 = round (($n/$TT2['TOTAL'] )*1000) /10;
$t2a = round (($na/$TT2a['TOTAL'] )*1000) /10;

//LINEAS INERMEDIAS DE LA TABLA
print ("<td>$d</td> <td align=\"center\">$na</td><td align=\"center\">$n</td>
<td align=\"center\">$dif</td><td align=\"center\">$rel</td>
<td align=\"center\">$t2a</td><td align=\"center\">$t2</td>
\n</tr>\n");
}
//LINEA FINAL DE LA TABLA
$tt  = round (($TT2['TOTAL'] )*100) /100;
$t2t = round (($TT2['TOTAL']/$TT2['TOTAL'] )*1000) /10;
$tta  = round (($TT2a['TOTAL'] )*100) /100;
$t2ta = round (($TT2a['TOTAL']/$TT2a['TOTAL'] )*1000) /10;
$dift = $tt - $tta;
$relt = round (($dift/$tta)*1000)/10;
print "    <tr class=\"tot\">\n";
print (" <td><strong>TOTAL</td>
<td align=\"center\"><strong>$tta</td><td align=\"center\"><strong>$tt</td>
<td align=\"center\"><strong>$dift</td><td align=\"center\"><strong>$relt</td>
<td align=\"center\"><strong>$t2ta</td><td align=\"center\"><strong>$t2t</td>
  \n    </tr></strong>\n");
print "  </tbody>\n</table>\n";

echo  "<p align='center'>Nota: Este cuadro sólo es válido para ejercicios ya finalizados, en caso contrario los datos del ejercicio actual podrían estar incompletos." .'<br />' ;

} elseif ($C4 == '3' ) {
    $consulta2 = "SELECT * FROM INGRESOS WHERE ANNO = '$EJERC[EJERCICIO]'";
    $result2 = $bd->query($consulta2);
    if (!$result2) {
        print "<p>Error en la consulta2.</p>\n";
    } else {
		echo "<strong><p align='center'>" ."EJERCICIO ". $EJERC[EJERCICIO]  . '</strong><br />';
        foreach ($result2 as $valor) {
	$c4 = "SELECT SUM(IMPORTE) AS TOTAL FROM '$EJERC[EJERCICIO]'"; 
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
        print "<table border=\"3\" align=\"center\" cellpadding=\"4\">
	      <tr class=\"tot\">    
    <td  colspan=\"4\"align=\"center\"><strong>INGRESOS</strong> </td>	 </td>
	</tr>\n
      <tr class=\"neg\"> 
        <td width=\"200\" align=\"center\"><strong>CONTRATO PROGRAMA</strong></td> <td width=\"200\" align=\"center\"><strong>INGRESOS ANUALES</strong></td><td width=\"200\" align=\"center\"><strong>REMANENTES</strong></td><td width=\"200\" align=\"center\"><strong>DIETAS</strong></td>	    
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
<td align=\"center\">$valor[RETENIDO]</td>
<td align=\"center\">$valor[OBLIGADO]</td>
<td align=\"center\">$valor[PAGADO]</td>
<td align=\"center\">$valor[RESERVADO]  /  $valor[GASDIETAS]</td>
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
	</tr>\n	";
	print "  \n</table></tbody>\n";
		}}
} elseif ($C4 > '3' ) {

if ($C4 == '5' ) {$CONSULTA5 = '11'; $CONSULTA6 = '6';} 

if ($CONSULTA5 !== '6' && $CONSULTA6 == '5') {	
echo  "<p align='center'>Lo siento, este criterio de distribución del gasto sólo está disponible para los otros gastos." .'<br />' ;
} elseif ($CONSULTA5 == '9' && $CONSULTA6 == '1') {
echo  "<p align='center'>Lo siento, este criterio de distribución del gasto no está disponible para los gastos comunes." .'<br />' ;
} elseif ($C4 == '5' && $EJERC[EJERCICIO] < '2009') {
echo  "<p align='center'>Lo siento, este criterio de distribución sólo está disponible a partir de 2008." .'<br />' ;
} else {

if 	   ($CONSULTA6 == '1') {$TITULO = 'PROFESOR'; $CAMPO = 'PROFESOR'; $ID = 'IDPROF';}
elseif ($CONSULTA6 == '2') {$TITULO = 'DESPACHO'; $CAMPO = 'DESPACHO'; $ID = 'IDDESPACHO';}
elseif ($CONSULTA6 == '3') {$TITULO = 'PROVEEDOR';$CAMPO = 'PROVEEDOR';$ID = 'IDPROV';}
elseif ($CONSULTA6 == '4') {$TITULO = 'CONCEPTO'; $CAMPO = 'TIPOGASTO';$ID = 'IDTIPO';}
elseif ($CONSULTA6 == '5') {$TITULO = 'PARTIDA';  $CAMPO = 'OTROS';    $ID = 'IDOTROS';}
elseif ($CONSULTA6 == '6') {$TITULO = 'PARTIDA CONTABLE';  $CAMPO = 'PARTIDA'; $ID = 'IDPARTIDA';}

if ($CONSULTA5 == '9') {
$codigo2_sql = "SELECT * FROM CONTROL WHERE IDCOMUNES == $CONSULTA5"; 
foreach ($bd->query($codigo2_sql) as $TIPOG);	
} else {
$codigo2_sql = "SELECT * FROM CONTROL WHERE IDTIPO == $CONSULTA5"; 
foreach ($bd->query($codigo2_sql) as $TIPOG);	
}

echo "<strong><p align='center'>CONSULTA DE LOS GASTOS REALIZADOS POR ". $TITULO. '</strong><br />';
echo "<strong><p align='center'>" . $TIPOG['TIPOGASTO']  .'</strong><br />';
echo "<strong><p align='center'>EJERCICIO: " . $EJERC['EJERCICIO']  .'</strong><br />';

if ($CONSULTA5 == '11' && $CONSULTA6 == '1') {	
print "\n<table border=\"1\" align=\"center\">  <thead>
    <tr class=\"tot\"> <th>$TITULO</th> <th>IMPORTE</th> <th>%TOTAL GASTO</th><th>LÍMITE</th>	<th>SALDO $EJERC[EJERCICIO]</th></tr>
  </thead>  <tbody>\n";
} elseif ($CONSULTA5 == '11' && $CONSULTA6 == '3') {	
print "\n<table border=\"1\" align=\"center\">  <thead>
    <tr class=\"tot\">   <th>$TITULO</th>    <th>IMPORTE</th>   <th>%TOTAL GASTO</th></tr>
  </thead>  <tbody>\n";
} elseif ($CONSULTA5 == '11' && $CONSULTA6 == '4') {	
print "\n<table border=\"1\" align=\"center\">  <thead>
    <tr class=\"tot\">   <th>$TITULO</th>    <th>IMPORTE</th>   <th>%TOTAL GASTO</th></tr>
  </thead>  <tbody>\n";  
} elseif ($CONSULTA5 == '11' && $CONSULTA6 == '6') {	
print "\n<table border=\"1\" align=\"center\">  <thead>
    <tr class=\"tot\">   <th>$TITULO</th>    <th>IMPORTE</th>   <th>%TOTAL GASTO</th></tr>
  </thead>  <tbody>\n";
} elseif ($CONSULTA5 == '9') {
print "\n<table border=\"1\" align=\"center\">  <thead>
    <tr class=\"tot\">   <th>$TITULO</th>    <th>IMPORTE</th>   <th>%TOTAL GASTO</th></tr>
  </thead>  <tbody>\n";
} else  {
print "\n<table border=\"1\" align=\"center\">  <thead>
    <tr class=\"tot\">   <th>$TITULO</th>    <th>IMPORTE</th>   <th>% TOTAL $TITULO</th>	<th>%TOTAL GASTO</th></tr>
  </thead>  <tbody>\n";
}  

if ($CONSULTA6 == '2') { // DESPACHO
	if ($CONSULTA5 == '5' || $CONSULTA5 == '3' || $CONSULTA5 == '4' ) { // COMUNES
		if ($EJERC[EJERCICIO] >= '2010')  {$ID = 'IDCOMUNES'; $CAMPO = 'COMUNES';} 
		else  { $ID = 'IDDESPACHO'; $CAMPO = 'DESPACHO';}
	} else  {$ID = 'IDDESPACHO'; $CAMPO = 'DESPACHO';}
} else  {}

$codigo_sql = "SELECT * FROM CONTROL WHERE $ID > '0' ORDER BY $CAMPO"; 
foreach ($bd->query($codigo_sql) as $row)
{

$c3="SELECT SUM(IMPORTE) AS TOTAL FROM '$EJERC[EJERCICIO]' WHERE TIPOGASTO == '$TIPOG[TIPOGASTO]'"; 
foreach ($bd->query($c3) as $TT1);
$c4 = "SELECT SUM(IMPORTE) AS TOTAL FROM '$EJERC[EJERCICIO]'"; 
foreach ($bd->query($c4) as $TT2);
$c5 = "SELECT SUM(IMPORTE) AS TOTAL FROM '$EJERC[EJERCICIO]' WHERE PROFESOR == 'GASTOS COMUNES'"; 
foreach ($bd->query($c5) as $TT3);

if ($CONSULTA5 == '11') {
$codigo3_sql = "SELECT SUM(IMPORTE) AS TOTAL FROM '$EJERC[EJERCICIO]' WHERE $CAMPO == '$row[$CAMPO]' "; 
} elseif ($CONSULTA5 == '9' && $CONSULTA6 == '2') {
$codigo3_sql = "SELECT SUM(IMPORTE) AS TOTAL FROM '$EJERC[EJERCICIO]' WHERE $CAMPO == '$row[DESPACHO]' AND PROFESOR == 'GASTOS COMUNES'"; 
} else {
$codigo3_sql = "SELECT SUM(IMPORTE) AS TOTAL FROM '$EJERC[EJERCICIO]' WHERE  TIPOGASTO == '$TIPOG[TIPOGASTO]' AND $CAMPO == '$row[$CAMPO]' ";
}

foreach ($bd->query($codigo3_sql) as $T);
if ($T['TOTAL'] > '0') {
if ($k%2 == '0' ) { print "    <tr class=\"neg\">\n"; } else { print "    <tr>\n";} $k++;
	if ($CONSULTA6 == '2') {	
		if ($CONSULTA5 == '5' || $CONSULTA5 == '3' || $CONSULTA5 == '4' || $CONSULTA5 == '9') {
			if ($EJERC[EJERCICIO] >= '2010')  {$d = $row[$CAMPO];} else  {$d = $row[$CAMPO]; }
		} else {
		$d = $row[$CAMPO];
		}
	} else {
	$d = $row[$CAMPO];
	}
	if ($CONSULTA5 == '11' && $CONSULTA6 == '2') {
	$d = $row[DESPACHO];
	$n = round ($T['TOTAL']*100)/100;
	$t1 = round (($n/$TT2['TOTAL'] )*1000) /10;
	$t2 = round (($n/$TT2['TOTAL'] )*1000) /10;
	} elseif ($CONSULTA5 == '10' && $CONSULTA6 == '3') {
	$n = round ($T['TOTAL']*100)/100;
	$t2 = round (($n/$TT2['TOTAL'] )*1000) /10;
	} elseif ($CONSULTA5 == '10' && $CONSULTA6 == '4') {
	$n = round ($T['TOTAL']*100)/100;
	$t2 = round (($n/$TT2['TOTAL'] )*1000) /10;
	} else {
	$n = round ($T['TOTAL']*100)/100;
	$t1 = round (($n/$TT1['TOTAL'] )*1000) /10;
	$t2 = round (($n/$TT2['TOTAL'] )*1000) /10;
	}
	if ($CONSULTA5 == '11' && $CONSULTA6 == '1') {	
	$SALDO = "SALDO{$EJERC[EJERCICIO]}";	
	$cod = "SELECT $SALDO FROM CONTROL WHERE PROFESOR == '$d'"; 
	foreach ($bd->query($cod) as $TIEMPO);	
	$s = $TIEMPO[$SALDO] - $n;
	if ($row[$CAMPO] == 'GASTOS COMUNES') {	
		print ("<td>$d</td> <td align=\"center\">$n</td> <td align=\"center\">$t2</td><td align=\"center\">---</td> <td align=\"center\">---</td>\n    </tr>\n");
		} else {
			if ($s < '0') {	
			$s = "<strong><font color='red'>$s </font></strong>";
			} else {}
		print ("<td>$d</td> <td align=\"center\">$n</td> <td align=\"center\">$t2</td><td align=\"center\">$TIEMPO[$SALDO]</td> <td align=\"center\">$s</td>\n</tr>\n");
		}
		$tt  = round (($TT2['TOTAL'] )*100) /100;
		$t2t = round (($TT2['TOTAL']/$TT2['TOTAL'] )*1000) /10;
		} elseif ($CONSULTA5 == '9') {
		print ("<td>$d</td> <td align=\"center\">$n</td> <td align=\"center\">$t2</td>\n </tr>\n");
		$tt  = round (($TT3['TOTAL'] )*100) /100;
		$t2t = round (($TT3['TOTAL']/$TT2['TOTAL'] )*1000) /10;
	    } elseif ($CONSULTA5 == '11' && $CONSULTA6 == '6') {
		print ("<td>$d</td> <td align=\"center\">$n</td><td align=\"center\">$t2</td>\n  </tr>\n");	
		$tt  = round (($TT2['TOTAL'] )*100) /100;
		$t2t = round (($TT2['TOTAL']/$TT2['TOTAL'] )*1000) /10;
		} elseif ($CONSULTA5 == '11' && $CONSULTA6 == '2') {
		print ("<td>$d</td> <td align=\"center\">$n</td> <td align=\"center\">$t1</td> <td align=\"center\">$t2</td>\n  </tr>\n");
		$tt  = round (($TT2['TOTAL'] )*100) /100;
		$t1t = round (($TT2['TOTAL']/$TT2['TOTAL'] )*1000) /10;
		$t2t = round (($TT2['TOTAL']/$TT2['TOTAL'] )*1000) /10;
		} elseif ($CONSULTA5 == '11' && $CONSULTA6 == '3') {
		print ("<td>$d</td> <td align=\"center\">$n</td> <td align=\"center\">$t2</td> </tr>\n");
		$tt  = round (($TT2['TOTAL'] )*100) /100;
		$t2t = round (($TT2['TOTAL']/$TT2['TOTAL'] )*1000) /10;		
		} elseif ($CONSULTA5 == '11' && $CONSULTA6 == '4') {
		print ("<td>$d</td> <td align=\"center\">$n</td> <td align=\"center\">$t2</td></tr>\n");
		$tt  = round (($TT2['TOTAL'] )*100) /100;
		$t2t = round (($TT2['TOTAL']/$TT2['TOTAL'] )*1000) /10;	
		} else {
		print ("<td>$d</td> <td align=\"center\">$n</td> <td align=\"center\">$t1</td> <td align=\"center\">$t2</td>\n   </tr>\n");
		$tt  = round (($TT1['TOTAL'] )*100) /100;
		$t1t = round (($TT1['TOTAL']/$TT1['TOTAL'] )*1000) /10;
		$t2t = round (($TT1['TOTAL']/$TT2['TOTAL'] )*1000) /10;
		}
	} else  {}
}

if ($CONSULTA5 == '11'  && $CONSULTA6 == '1') {
      print "    <tr class=\"tot\">\n";
	  print ("<strong>
      <td>TOTAL</td>
      <td align=\"center\"><strong>$tt</td>
	  <td align=\"center\"><strong>$t2t</td>
	  <td align=\"center\"><strong>---</td>
	  <td align=\"center\"><strong>---</td>
	  \n    </tr></strong>\n");
	   print "  </tbody>\n</table>\n";
} elseif ($CONSULTA5 == '11' && $CONSULTA6 == '3') {
      print "    <tr class=\"tot\">\n";
      print (" 
      <td><strong>TOTAL</td>
      <td align=\"center\"><strong>$tt</td>
	  <td align=\"center\"><strong>$t2t</td>
	  \n    </tr></strong>\n");
	   print "  </tbody>\n</table>\n";	
} elseif ($CONSULTA5 == '11' && $CONSULTA6 == '4') {
      print "    <tr class=\"tot\">\n";
      print (" 
      <td><strong>TOTAL</td>
      <td align=\"center\"><strong>$tt</td>
	  <td align=\"center\"><strong>$t2t</td>
	  \n    </tr></strong>\n");
	   print "  </tbody>\n</table>\n";		   	
} elseif ($CONSULTA5 == '11' && $CONSULTA6 == '6') {
      print "    <tr class=\"tot\">\n";
      print (" 
      <td><strong>TOTAL</td>
      <td align=\"center\"><strong>$tt</td>
	  <td align=\"center\"><strong>$t2t</td>
	  \n    </tr></strong>\n");
	   print "  </tbody>\n</table>\n";	
} elseif ($CONSULTA5 == '9') {
      print "    <tr class=\"tot\">\n";
      print (" 
      <td><strong>TOTAL</td>
      <td align=\"center\"><strong>$tt</td>
	  <td align=\"center\"><strong>$t2t</td>
	  \n    </tr></strong>\n");
	   print "  </tbody>\n</table>\n";
} else {
      print "    <tr class=\"tot\">\n";
      print (" 
      <td><strong>TOTAL</td>
      <td align=\"center\"><strong>$tt</td>
	  <td align=\"center\"><strong>$t1t</td>
	  <td align=\"center\"><strong>$t2t</td>
	  \n    </tr></strong>\n");
	   print "  </tbody>\n</table>\n";
}
$cri = "SELECT * FROM CONTROL WHERE IDCRITERIO == $CONSULTA6"; 
foreach ($bd->query($cri) as $CRIT);
	   echo  "<p align='center'>" . $TIPOG['MENSAJE1']  .'<br />' ;
	   echo  "<p align='center'>" . $CRIT['MENSAJE2']  .'<br />' ;
}	
print "  \n</table></tbody>\n";
}
pie();
$bd = NULL;
?>