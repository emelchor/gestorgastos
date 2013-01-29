<?php
if (isset($_COOKIE['autentificadogastos'])) {
    $validado = $_COOKIE['autentificadogastos'];
} else { $validado = 'NO'; } 
if ( $validado == 'NO') {
	header("Location: ../../index.php");
    exit();
} 

include('funciones.php');
$bd = conectaDb();
$C0 = $_POST['EJER'];	
$codi = "SELECT EJERCICIO FROM CONTROL WHERE IDEJER == $C0"; 
foreach ($bd->query($codi) as $EJER);
$CCER = "SELECT * FROM CONTROL WHERE EJERCICIO == '$EJER[EJERCICIO]'";
foreach ($bd->query($CCER) as $VERR);

if ($VERR['CERRADO'] == "SI") {

define('FPDF_FONTPATH', 'fpdf/font/');
require_once 'fpdf/fpdf.php';
class PDF extends FPDF
{

function Footer()
{
	$this->SetTextColor(0,0,0);
    $this->SetFont('Arial','B',12);
	$this->Ln(135);
	$this->Image('../images/fondo-pie.jpg',15.2,280,177);	
    $this->SetY(-17);
    $this->SetFont('Arial','B',12);
	$this->SetTextColor(255,255,255);
    $this->Cell(0,10,$this->PageNo(),0,0,'C');	
	$this->SetTextColor(255,255,255);
}

function Header()
{
$C0 = $_POST['EJER'];	
$bd = conectaDb();
$codi = "SELECT EJERCICIO FROM CONTROL WHERE IDEJER == $C0"; 
foreach ($bd->query($codi) as $EJER);

    $this->Image('../images/escudo-encabezado.jpg',25,25,50);
    $this->SetFont('Arial','B',10);
    $this->multicell(0,4,'Departamento de Economía Internacional',0,'R');
    $this->multicell(0,4,'y de España',0,'R');
	$this->multicell(0,4,'Ejercicio: '. $EJER['EJERCICIO'] ,0,'R');
    $this->Ln(5);
}

function ChapterTitle($num, $label)
{
    $this->SetFont('Arial','I',12);
    $this->SetFillColor(200,220,255);
    $this->Cell(0,6,$label. ". ",0,1,'L',true);
    $this->Ln(5);
}

function informe($C4,$CONSULTA2,$CONSULTA5,$CONSULTA6,$EPIGRAFE)
{
$CONSULTA2 = $_POST['EJER'];
$bd = conectaDb();
$C4 = recogeParaConsulta($bd, 'C4', $C4); 
$C4 = quitaComillasExteriores($C4); 
$CONSULTA2 = recogeParaConsulta($bd, 'CONSULTA2', $CONSULTA2); 
$CONSULTA2 = quitaComillasExteriores($CONSULTA2); 
$CONSULTA5 = recogeParaConsulta($bd, 'CONSULTA5', $CONSULTA5); 
$CONSULTA5 = quitaComillasExteriores($CONSULTA5); 
$CONSULTA6 = recogeParaConsulta($bd, 'CONSULTA6', $CONSULTA6); 
$CONSULTA6 = quitaComillasExteriores($CONSULTA6); 
$CONSULTA6 = $CONSULTA6 - 1;

$codigo1_sql = "SELECT EJERCICIO FROM CONTROL WHERE IDEJER == $CONSULTA2"; 
foreach ($bd->query($codigo1_sql) as $EJERC);

if ($C4 == '2' ) {
$EJANT = $EJERC[EJERCICIO] - 1;
$CAMPO = 'TIPOGASTO'; $ID = 'IDTIPO'; $CONSULTA5 = '8';
$codigo2_sql = "SELECT * FROM CONTROL WHERE IDTIPO == $CONSULTA5"; 
foreach ($bd->query($codigo2_sql) as $TIPOG);	
//ENCABEZADO DE LA PAGINA
		$this->SetFont('Arial','B',11);			
    	$this->SetTextColor(0,0,0);
   	 	$this->multicell(0, 5, " ", 0, 'C');
		$this->Ln(1);
		$this->ChapterTitle(2,$EPIGRAFE .". EVOLUCIÓN INTERANUAL DE LOS GASTOS REALIZADOS EN ". $EJERC['EJERCICIO']);
		$this->Ln(2); 
// ENCABEZADO DE LA TABLA
		$this->SetFont('Arial','B',11);	
		$this->SetFillColor(224,248,128);		
		$this->Cell(50, 5, "", 0, 0, 'C', true);
		$this->Cell(40, 5, "IMPORTE", 0, 0, 'C', true);
		$this->Cell(40, 5, "VARIACIÓN", 0, 0, 'C', true);	
		$this->Cell(40, 5, "ESTRUCTURA %", 0, 0, 'C', true);			
		$this->Ln(5);
		$this->Cell(50, 5, "CONCEPTO", 0, 0, 'C', true);
		$this->Cell(20, 5, $EJANT, 0, 0, 'C', true);
		$this->Cell(20, 5, $EJERC[EJERCICIO], 0, 0, 'C', true);	
		$this->Cell(20, 5, "Absoluta", 0, 0, 'C', true);	
		$this->Cell(20, 5, "Relativa", 0, 0, 'C', true);	
		$this->Cell(20, 5, $EJANT, 0, 0, 'C', true);
		$this->Cell(20, 5, $EJERC[EJERCICIO], 0, 0, 'C', true);						
		$this->Ln(5);
		
// CALCULOS
$codigo_sql = "SELECT $CAMPO,COMUNES,DESPACHO FROM CONTROL WHERE $ID < '9' AND $ID > '1' OR $ID = '10' ORDER BY $CAMPO"; 
foreach ($bd->query($codigo_sql) as $row)
{
$c4 = "SELECT SUM(IMPORTE) AS TOTAL FROM '$EJERC[EJERCICIO]'"; 
foreach ($bd->query($c4) as $TT2);
$c4a = "SELECT SUM(IMPORTE) AS TOTAL FROM '$EJANT'"; 
foreach ($bd->query($c4a) as $TT2a);
$codigo3 = "SELECT SUM(IMPORTE) AS TOTAL FROM '$EJERC[EJERCICIO]' WHERE $CAMPO == '$row[$CAMPO]' ";foreach ($bd->query($codigo3) as $T);
$codigo3a = "SELECT SUM(IMPORTE) AS TOTAL FROM '$EJANT' WHERE $CAMPO == '$row[$CAMPO]' ";
foreach ($bd->query($codigo3a) as $Ta);
$d = $row[$CAMPO];							
$n = round ($T['TOTAL']*100)/100;
$na = round ($Ta['TOTAL']*100)/100;
$dif = $n - $na;
$rel = round (($dif/$na)*1000)/10;
$t2 = round (($n/$TT2['TOTAL'] )*1000) /10;
$t2a = round (($na/$TT2a['TOTAL'] )*1000) /10;

//LINEAS INERMEDIAS DE LA TABLA
		$this->SetFont('Arial','',11);		
		$this->SetFillColor(255,255,255);				
		$this->Cell(50, 5, utf8_decode($d), 0, 0, 'L', true);
		$this->Cell(20, 5, $na, 0, 0, 'C', true);
		$this->Cell(20, 5, $n, 0, 0, 'C', true);	
		$this->Cell(20, 5, $dif, 0, 0, 'C', true);	
		$this->Cell(20, 5, $rel, 0, 0, 'C', true);	
		$this->Cell(20, 5, $t2a, 0, 0, 'C', true);
		$this->Cell(20, 5, $t2, 0, 0, 'C', true);						
		$this->Ln(5);
}	
//LINEA FINAL DE LA TABLA
$tt  = round (($TT2['TOTAL'] )*100) /100;
$t2t = round (($TT2['TOTAL']/$TT2['TOTAL'] )*1000) /10;
$tta  = round (($TT2a['TOTAL'] )*100) /100;
$t2ta = round (($TT2a['TOTAL']/$TT2a['TOTAL'] )*1000) /10;
$dift = $tt - $tta;
$relt = round (($dift/$tta)*1000)/10;
		$this->SetFont('Arial','B',11);	
		$this->SetFillColor(224,248,128);					
		$this->Cell(50, 5, "TOTAL", 0, 0, 'L', true);
		$this->Cell(20, 5, $tta, 0, 0, 'C', true);
		$this->Cell(20, 5, $tt, 0, 0, 'C', true);	
		$this->Cell(20, 5, $dift, 0, 0, 'C', true);	
		$this->Cell(20, 5, $relt, 0, 0, 'C', true);	
		$this->Cell(20, 5, $t2ta, 0, 0, 'C', true);
		$this->Cell(20, 5, $t2t, 0, 0, 'C', true);						
		$this->Ln(10);
} // fin elseif

elseif ($C4 == '3' ) {
    $consulta2 = "SELECT * FROM INGRESOS WHERE ANNO = '$EJERC[EJERCICIO]'";
    $result2 = $bd->query($consulta2);
    if (!$result2) { //print "<p>Error en la consulta2.</p>\n";
    } else {
		$this->ChapterTitle(2,$EPIGRAFE .". BALANCE DE SITUACIÓN EN ". $EJERC['EJERCICIO']);
		$this->Ln(2); 
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
	$DIETASDISP=$DIETAS - $valor['GASDIETAS'];
	$DISP = $TOTAL - $GASTOS;
	$DISPSD = $DISP - $DIETAS;
	$GASINDIV = $TT2['TOTAL'];
	$DIFGAS = round (($GASTOS - $GASINDIV)*100) / 100;
// ENCABEZADO DE LA TABLA
		$this->SetFont('Arial','B',11);	
		$this->SetFillColor(224,248,128);					
		$this->Cell(50, 5, "", 0, 0, 'C', true);
		$this->Cell(40, 5, "CRÉDITOS", 0, 0, 'C', true);
		$this->Cell(40, 5, "GASTOS", 0, 0, 'C', true);	
		$this->Cell(40, 5, "DISPONIBLE", 0, 0, 'C', true);			
		$this->Ln(5);
//LINEAS INERMEDIAS DE LA TABLA
		$this->SetFont('Arial','',11);
		$this->SetFillColor(255,255,255);				
		$this->Cell(50, 5, "DIETAS", 0, 0, 'L', true);
		$this->Cell(40, 5, $DIETAS, 0, 0, 'C', true);
		$this->Cell(40, 5, $valor['GASDIETAS'], 0, 0, 'C', true);	
		$this->Cell(40, 5, $DIETASDISP, 0, 0, 'C', true);
		$this->Ln(5);
		$this->SetFont('Arial','',11);
		$this->SetFillColor(255,255,255);			
		$this->Cell(50, 5, "EXCLUIDO DIETAS", 0, 0, 'L');
		$this->Cell(40, 5, $TOTALSD, 0, 0, 'C', true);
		$this->Cell(40, 5, $GASTOSSD, 0, 0, 'C', true);	
		$this->Cell(40, 5, $DISPSD, 0, 0, 'C', true);
		$this->Ln(5);
//LINEA FINAL DE LA TABLA		
		$this->SetFont('Arial','B',11);		
		$this->SetFillColor(224,248,128);				
		$this->Cell(50, 5, "TOTAL", 0, 0, 'L', true);
		$this->Cell(40, 5, $TOTAL, 0, 0, 'C', true);
		$this->Cell(40, 5, $GASTOS, 0, 0, 'C', true);	
		$this->Cell(40, 5, $DISP, 0, 0, 'C', true);
		$this->Ln(10);				
		}}
} // FIN ELSEIF

elseif ($C4 > '3' ) {

if ($C4 == '5' ) {$CONSULTA5 = '11'; $CONSULTA6 = '6';} 

if ($CONSULTA5 !== '6' && $CONSULTA6 == '5') {	
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
		$this->ChapterTitle(2,$EPIGRAFE.". GASTOS REALIZADOS EN ".utf8_decode($TIPOG['TIPOGASTO']) . " POR ". $TITULO );
		$this->Ln(2); 

if ($CONSULTA5 == '11' && $CONSULTA6 == '1') {	
		$this->SetFont('Arial','B',11);	
		$this->SetFillColor(224,248,128);					
		$this->Cell(60, 5, $TITULO, 0, 0, 'L', true);
		$this->Cell(25, 5, "IMPORTE", 0, 0, 'C', true);
		$this->Cell(35, 5, "%TOTAL GASTO", 0, 0, 'C', true);
		$this->Cell(25, 5, "LÍMITE", 0, 0, 'C', true);
		$this->Cell(25, 5, "SALDO " . $EJERC[EJERCICIO], 0, 0, 'C', true);				
		$this->Ln(5);
} elseif ($CONSULTA5 == '11' && $CONSULTA6 == '3') {	
		$this->SetFont('Arial','B',11);	
		$this->SetFillColor(224,248,128);				
		$this->Cell(80, 5, $TITULO, 0, 0, 'L', true);
		$this->Cell(40, 5, "IMPORTE", 0, 0, 'C', true);
		$this->Cell(50, 5, "%TOTAL GASTO", 0, 0, 'C', true);
		$this->Ln(5);
} elseif ($CONSULTA5 == '11' && $CONSULTA6 == '4') {	
		$this->SetFont('Arial','B',11);		
		$this->SetFillColor(224,248,128);				
		$this->Cell(80, 5, $TITULO, 0, 0, 'L',true);
		$this->Cell(40, 5, "IMPORTE", 0, 0, 'C', true);
		$this->Cell(50, 5, "%TOTAL GASTO", 0, 0, 'C', true);
		$this->Ln(5);
} elseif ($CONSULTA5 == '11' && $CONSULTA6 == '6') {	
		$this->SetFont('Arial','B',11);	
		$this->SetFillColor(224,248,128);					
		$this->Cell(80, 5, $TITULO, 0, 0, 'L', true);
		$this->Cell(40, 5, "IMPORTE", 0, 0, 'C', true);
		$this->Cell(50, 5, "%TOTAL GASTO", 0, 0, 'C', true);
		$this->Ln(5);
} elseif ($CONSULTA5 == '9') {
		$this->SetFont('Arial','B',11);		
		$this->SetFillColor(224,248,128);				
		$this->Cell(80, 5, $TITULO, 0, 0, 'L', true);
		$this->Cell(40, 5, "IMPORTE", 0, 0, 'C', true);
		$this->Cell(50, 5, "%TOTAL GASTO", 0, 0, 'C', true);
		$this->Ln(5);
} else  {
		$this->SetFont('Arial','B',11);		
		$this->SetFillColor(224,248,128);				
		$this->Cell(70, 5, $TITULO, 0, 0, 'L', true);
		$this->Cell(30, 5, "IMPORTE", 0, 0, 'C', true);
		$this->Cell(40, 5, "%TOTAL " . $TITULO, 0, 0, 'C', true);
		$this->Cell(30, 5, "%TOTAL GASTO", 0, 0, 'C', true);
		$this->Ln(5);
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
$codigo3_sql = "SELECT SUM(IMPORTE) AS TOTAL FROM '$EJERC[EJERCICIO]' WHERE $CAMPO == '$row[$CAMPO]' AND PROFESOR == 'GASTOS COMUNES'"; 
} else {
$codigo3_sql = "SELECT SUM(IMPORTE) AS TOTAL FROM '$EJERC[EJERCICIO]' WHERE  TIPOGASTO == '$TIPOG[TIPOGASTO]' AND $CAMPO == '$row[$CAMPO]' "; }

foreach ($bd->query($codigo3_sql) as $T);
if ($T['TOTAL'] > '0') {
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
	} elseif ($CONSULTA5 == '11' && $CONSULTA6 == '3') {
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
		$this->SetFont('Arial','',11);
		$this->SetFillColor(255,255,255);			
		$this->Cell(60, 5, utf8_decode($d), 0, 0, 'L', true);
		$this->Cell(25, 5, $n, 0, 0, 'C', true);
		$this->Cell(35, 5, $t2, 0, 0, 'C', true);
		$this->Cell(25, 5, "---", 0, 0, 'C', true);
		$this->Cell(25, 5, "---", 0, 0, 'C', true);				
		$this->Ln(5);
		} else {
			if ($s < '0') {	
					$this->SetFillColor(248,88,120);	
			} else {		$this->SetFillColor(255,255,255);	}
		$this->SetFont('Arial','',11);		
		$this->SetFillColor(255,255,255);				
		$this->Cell(60, 5, utf8_decode($d), 0, 0, 'L', true);
		$this->Cell(25, 5, $n, 0, 0, 'C', true);
		$this->Cell(35, 5, $t2, 0, 0, 'C', true);
		$this->Cell(25, 5, $TIEMPO[$SALDO], 0, 0, 'C', true);
		$this->Cell(25, 5, $s, 0, 0, 'C', true);				
		$this->Ln(5);
		}
		$tt  = round (($TT2['TOTAL'] )*100) /100;
		$t2t = round (($TT2['TOTAL']/$TT2['TOTAL'] )*1000) /10;
		} elseif ($CONSULTA5 == '9') {
		$this->SetFont('Arial','',11);	
		$this->SetFillColor(255,255,255);					
		$this->Cell(80, 5, utf8_decode($d), 0, 0, 'L', true);
		$this->Cell(40, 5, $n, 0, 0, 'C', true);
		$this->Cell(50, 5, $t2, 0, 0, 'C', true);
		$this->Ln(5);
		$tt  = round (($TT3['TOTAL'] )*100) /100;
		$t2t = round (($TT3['TOTAL']/$TT2['TOTAL'] )*1000) /10;
	    } elseif ($CONSULTA5 == '11' && $CONSULTA6 == '6') {
		$this->SetFont('Arial','',11);	
		$this->SetFillColor(255,255,255);					
		$this->Cell(80, 5, utf8_decode($d), 0, 0, 'L',true);
		$this->Cell(40, 5, $n, 0, 0, 'C', true);
		$this->Cell(50, 5, $t2, 0, 0, 'C', true);
		$this->Ln(5);
		$tt  = round (($TT2['TOTAL'] )*100) /100;
		$t2t = round (($TT2['TOTAL']/$TT2['TOTAL'] )*1000) /10;
		} elseif ($CONSULTA5 == '11' && $CONSULTA6 == '2') {
		$this->SetFont('Arial','',11);	
		$this->SetFillColor(255,255,255);					
		$this->Cell(70, 5, utf8_decode($d), 0, 0, 'L', true);
		$this->Cell(30, 5, $n, 0, 0, 'C', true);
		$this->Cell(40, 5, $t1, 0, 0, 'C', true);
		$this->Cell(30, 5, $t2, 0, 0, 'C', true);		
		$this->Ln(5);
		$tt  = round (($TT2['TOTAL'] )*100) /100;
		$t1t = round (($TT2['TOTAL']/$TT2['TOTAL'] )*1000) /10;
		$t2t = round (($TT2['TOTAL']/$TT2['TOTAL'] )*1000) /10;
		} elseif ($CONSULTA5 == '11' && $CONSULTA6 == '3') {
		$this->SetFont('Arial','',11);
		$this->SetFillColor(255,255,255);				
		$this->Cell(80, 5, utf8_decode($d), 0, 0, 'L', true);
		$this->Cell(40, 5, $n, 0, 0, 'C', true);
		$this->Cell(50, 5, $t2, 0, 0, 'C', true);
		$this->Ln(5);
		$tt  = round (($TT2['TOTAL'] )*100) /100;
		$t2t = round (($TT2['TOTAL']/$TT2['TOTAL'] )*1000) /10;		
		} elseif ($CONSULTA5 == '11' && $CONSULTA6 == '4') {
		$this->SetFont('Arial','',11);
		$this->SetFillColor(255,255,255);				
		$this->Cell(80, 5, utf8_decode($d), 0, 0, 'L', true);
		$this->Cell(40, 5, $n, 0, 0, 'C', true);
		$this->Cell(45, 5, $t2, 0, 0, 'C', true);
		$this->Ln(5);
		$tt  = round (($TT2['TOTAL'] )*100) /100;
		$t2t = round (($TT2['TOTAL']/$TT2['TOTAL'] )*1000) /10;	
		} else {
		$this->SetFont('Arial','',11);
		$this->SetFillColor(255,255,255);				
		$this->Cell(70, 5, utf8_decode($d), 0, 0, 'L',true);
		$this->Cell(30, 5, $n, 0, 0, 'C', true);
		$this->Cell(40, 5, $t1, 0, 0, 'C', true);
		$this->Cell(30, 5, $t2, 0, 0, 'C', true);		
		$this->Ln(5);
		$tt  = round (($TT1['TOTAL'] )*100) /100;
		$t1t = round (($TT1['TOTAL']/$TT1['TOTAL'] )*1000) /10;
		$t2t = round (($TT1['TOTAL']/$TT2['TOTAL'] )*1000) /10;
		}
	} else  {}
}

if ($CONSULTA5 == '11'  && $CONSULTA6 == '1') {
		$this->SetFont('Arial','B',11);	
		$this->SetFillColor(224,248,128);					
		$this->Cell(60, 5, "TOTAL", 0, 0, 'L', true);
		$this->Cell(25, 5, $tt, 0, 0, 'C', true);
		$this->Cell(35, 5, $t2t, 0, 0, 'C', true);
		$this->Cell(25, 5, "---", 0, 0, 'C', true);
		$this->Cell(25, 5, "---", 0, 0, 'C', true);				
		$this->Ln(5);
} elseif ($CONSULTA5 == '11' && $CONSULTA6 == '3') {
		$this->SetFont('Arial','B',11);	
		$this->SetFillColor(224,248,128);					
		$this->Cell(80, 5, "TOTAL", 0, 0, 'L', true);
		$this->Cell(40, 5, $tt, 0, 0, 'C', true);
		$this->Cell(50, 5, $t2t, 0, 0, 'C', true);
		$this->Ln(5);
} elseif ($CONSULTA5 == '11' && $CONSULTA6 == '4') {
		$this->SetFont('Arial','B',11);	
		$this->SetFillColor(224,248,128);					
		$this->Cell(80, 5, "TOTAL", 0, 0, 'L', true);
		$this->Cell(40, 5, $tt, 0, 0, 'C', true);
		$this->Cell(50, 5, $t2t, 0, 0, 'C', true);
		$this->Ln(5);	   	
} elseif ($CONSULTA5 == '11' && $CONSULTA6 == '6') {
		$this->SetFont('Arial','B',11);	
		$this->SetFillColor(224,248,128);					
		$this->Cell(80, 5, "TOTAL", 0, 0, 'L', true);
		$this->Cell(40, 5, $tt, 0, 0, 'C', true);
		$this->Cell(50, 5, $t2t, 0, 0, 'C', true);
		$this->Ln(5);
} elseif ($CONSULTA5 == '9') {
		$this->SetFont('Arial','B',11);
		$this->SetFillColor(224,248,128);				
		$this->Cell(80, 5, "TOTAL", 0, 0, 'L', true);
		$this->Cell(40, 5, $tt, 0, 0, 'C', true);
		$this->Cell(45, 5, $t2t, 0, 0, 'C', true);
		$this->Ln(5);
} else {
		$this->SetFont('Arial','B',11);	
		$this->SetFillColor(224,248,128);					
		$this->Cell(70, 5, "TOTAL", 0, 0, 'L', true);
		$this->Cell(30, 5, $tt, 0, 0, 'C', true);
		$this->Cell(40, 5, $t1t, 0, 0, 'C', true);
		$this->Cell(30, 5, $t2t, 0, 0, 'C', true);		
		$this->Ln(5);
}
$cri = "SELECT * FROM CONTROL WHERE IDCRITERIO == $CONSULTA6"; 
foreach ($bd->query($cri) as $CRIT);
$this->SetFont('Arial','',10);
if ($CONSULTA5 == '10') {} else  { 
$this->multicell(0, 5, utf8_decode($TIPOG['MENSAJE1']), 0,'J');}
$this->multicell(0, 5, utf8_decode($CRIT['MENSAJE2']), 0,'J');
$this->Ln(5);
} // fin elseif	

} // fin elseif	


//}
//}
}  // fin funcion informe
} //fin clas pdf

$pdf = new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetMargins(20,25,20,25);

$C0 = $_POST['EJER'];	
$codi = "SELECT EJERCICIO FROM CONTROL WHERE IDEJER == $C0"; 
foreach ($bd->query($codi) as $EJER);
$FECHA = date('j/n/Y H:i');	

$pdf->Image('../images/portada.jpg',1,1,210);
$pdf->SetFont('Arial','B',40);	
$pdf->Ln(70);
$pdf->multicell(0,5,'INFORME ANUAL' ,0,'R');
$pdf->SetFont('Arial','B',30);	
$pdf->Ln(10);
$pdf->multicell(0,5,'Ejercicio: '. $EJER['EJERCICIO'] ,0,'R');
$pdf->Ln(120);
$pdf->SetFont('Arial','',10);	
$pdf->multicell(0,5,'Generado automáticamente el ' . $FECHA ,0,'R');
$pdf->multicell(0,5,'@ Elías Melchor Ferrer' ,0,'R');
$pdf->AddPage();

$pdf->informe(2,$CONSULTA2,0,0,1);
$pdf->informe(3,$CONSULTA2,0,0,2);
$pdf->informe(4,$CONSULTA2,11,2,3);
$pdf->informe(4,$CONSULTA2,11,3,4);
$pdf->informe(4,$CONSULTA2,11,4,5);
$pdf->informe(4,$CONSULTA2,8,2,6);
$pdf->informe(4,$CONSULTA2,2,2,7);
$pdf->informe(4,$CONSULTA2,10,2,8);
$pdf->informe(4,$CONSULTA2,9,3,9);
$pdf->informe(4,$CONSULTA2,3,3,10);
$pdf->informe(4,$CONSULTA2,4,3,11);
$pdf->informe(4,$CONSULTA2,5,3,12);
$pdf->informe(4,$CONSULTA2,6,2,13);
$pdf->informe(4,$CONSULTA2,6,6,14);
$pdf->informe(4,$CONSULTA2,7,2,15);
//$pdf->informe(4,$CONSULTA2,7,2,11);
$pdf->Output();
} else {
cabecera();
}
$bd = NULL;
?>