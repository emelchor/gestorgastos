<?php
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

if ($cns == '9') {
$cns = recogeParaConsulta($bd, 'cns', '9'); 
$cns = quitaComillasExteriores($cns); 

$ULTEJ = "SELECT MAX(EJERCICIO) FROM CONTROL";
foreach ($bd->query($ULTEJ) as $NULTEJ);
$ULT = max($NULTEJ);
$PENULT = $ULT - 1;
$SULT = "SALDO{$ULT}"; $SPENULT = "SALDO{$PENULT}";

if ($_POST["action"] == "GRABAR") {
$tabla = $_POST["accion1"];
$cns = $_POST["accion2"];

$ULTREG = "SELECT MAX(IDTOTAL) FROM CONTROL";
foreach ($bd->query($ULTREG) as $NULTREG);
$ULTIMOREG = max($NULTREG);
$NEXTULT = $ULTIMOREG + 1;
$AVISOULT = $ULTIMOREG - 3;
$c31 = "SELECT MAX(IDPROV) FROM CONTROL ";
foreach ($bd->query($c31) as $NY31);
$b131 = max($NY31);
if ($AVISOULT < $b131 ) {
$NEWREG = "INSERT INTO CONTROL (IDTOTAL,IDPROF,IDPROV,IDDESPACHO,IDTIPO,IDPARTIDA,IDOTROS,IDCOMUNES,IDEJER,IDCRITERIO) values ($NEXTULT,0,0,0,0,0,0,0,0,0)";
foreach ($bd->query($NEWREG) as $NNN);
} else {}

$odex1 	= recogeMatrizParaConsulta($bd, 'odex1');$odex17 = recogeMatrizParaConsulta($bd, 'odex17');
$odex2 	= recogeMatrizParaConsulta($bd, 'odex2');$odex18 = recogeMatrizParaConsulta($bd, 'odex18');
$odex3 	= recogeMatrizParaConsulta($bd, 'odex3');$odex19 = recogeMatrizParaConsulta($bd, 'odex19');
$odex20 = recogeMatrizParaConsulta($bd, 'odex20');
$odex5 	= recogeMatrizParaConsulta($bd, 'odex5');$odex21 = recogeMatrizParaConsulta($bd, 'odex21');
$odex6 	= recogeMatrizParaConsulta($bd, 'odex6');$odex22 = recogeMatrizParaConsulta($bd, 'odex22');
$odex7 	= recogeMatrizParaConsulta($bd, 'odex7');$odex23 = recogeMatrizParaConsulta($bd, 'odex23');
$odex8 	= recogeMatrizParaConsulta($bd, 'odex8');$odex24 = recogeMatrizParaConsulta($bd, 'odex24');
$odex9 	= recogeMatrizParaConsulta($bd, 'odex9');$odex25 = recogeMatrizParaConsulta($bd, 'odex25');
$odex26 = recogeMatrizParaConsulta($bd, 'odex26');$odex11= recogeMatrizParaConsulta($bd, 'odex11');$odex27 = recogeMatrizParaConsulta($bd, 'odex27');$odex12= recogeMatrizParaConsulta($bd, 'odex12');$odex28 = recogeMatrizParaConsulta($bd, 'odex28');$odex13= recogeMatrizParaConsulta($bd, 'odex13');$odex29 = recogeMatrizParaConsulta($bd, 'odex29');$odex14= recogeMatrizParaConsulta($bd, 'odex14');$odex30 = recogeMatrizParaConsulta($bd, 'odex30');$odex15= recogeMatrizParaConsulta($bd, 'odex15');$odex31= recogeMatrizParaConsulta($bd, 'odex31');$odex16 = recogeMatrizParaConsulta($bd, 'odex16');$odex32= recogeMatrizParaConsulta($bd, 'odex32');$odex33 = recogeMatrizParaConsulta($bd, 'odex33');$odex34= recogeMatrizParaConsulta($bd, 'odex34');$odex35 = recogeMatrizParaConsulta($bd, 'odex35');

$ULTEJ = "SELECT MAX(EJERCICIO) FROM CONTROL";
foreach ($bd->query($ULTEJ) as $NULTEJ);
$ULT = max($NULTEJ);
$PENULT = $ULT - 1;
$SULT = "SALDO{$ULT}"; $SPENULT = "SALDO{$PENULT}";

foreach ($odex1 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET IDTOTAL =$valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex2 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET MES = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex3 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET IDMES = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex5 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET SALDO2010 = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex6 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET SALDO2011 = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex7 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET PROFESOR = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex8 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET CORREO = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex9 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET DESPACHOS = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex11 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET CLAVE = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex12 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET LIMITE = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex13 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET DESPACHO = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex14 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET IDDESPACHO = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex15 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET MENSAJE1 = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex16 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET TIPOGASTO = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex17 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET IDTIPO = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex18 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET PARTIDA = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex19 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET IDPARTIDA = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex20 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET PROVEEDOR = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex21 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET IDPROV = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex22 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET OTROS = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex23 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET IDOTROS = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex24 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET COMUNES = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex25 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET IDCOMUNES = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex26 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET EJERCICIO = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex27 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET IDEJER = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex28 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET MENSAJE2 = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex29 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET CRITERIO = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex30 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET IDCRITERIO = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex31 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET ADMINISTRADOR = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex32 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET CERRADO = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex33 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET $SPENULT = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex34 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET $SULT = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex35 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET IDPROF = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }

if ($bd->query($consulta0)) {} else {print "<p>Error al grabar el registro.</p>\n";}
} //159 FIN ACCION GRABAR
$consulta1 = "SELECT COUNT(*) FROM CONTROL ";
$result1 = $bd->query($consulta1);
if (!$result1) {
    print "<p>Error en la consulta.</p>\n";
} elseif ($result1->fetchColumn()==0) {
    print "<p>No se ha creado todavía ningún registro.</p>\n";
} else {

	$c = "SELECT MAX(IDPROF) FROM CONTROL ";
	foreach ($bd->query($c) as $NY);
	$b1 = max($NY);
	$B = $b1 + 3;
    $consulta2 = "SELECT * FROM CONTROL WHERE IDTOTAL < $B";
    $result2 = $bd->query($consulta2);
    if (!$result2) {
        print "<p>Error en la consulta.</p>\n";
    } else {
        print "<p align=\"center\"><form action=\"configurar.php\" method=\"".POST."\">
  <table border=\"1\" align=\"center\">
    <thead>
<tr class=\"neg\">  <td align=\"center\" ><strong>ID</td><td align=\"center\"><strong>PROFESOR</td><td align=\"center\"><strong>CORREO</td><td align=\"center\"><strong>DESP.</td><td align=\"center\"><strong>CLAVE</td><td align=\"center\"><strong>ASIGNACIÓN</td><td align=\"center\"><strong>$SPENULT</td><td align=\"center\"><strong>$SULT</td><td align=\"center\"><strong>IDPROF</td></tr> 
    </thead>
    <tbody>\n";
        $tmp = TRUE;
print (" <p align=\"center\"><input name=\"action\" type=\"submit\" value=\"GRABAR\" /><input name=\"accion1\" type=\"hidden\" value=\"$tabla\" /><input name=\"accion2\" type=\"hidden\" value=\"$cns\" /></tr>\n");	
		echo "<strong><p align='center'>DATOS GENERALES DE LOS PROFESORES</strong>"  . '<br />';
	    foreach ($result2 as $valor) {
            if ($tmp) {
                print "      <tr>\n";
            } else {
                print "      <tr class=\"neg\">\n";
            }
            $tmp = !$tmp;
            print  (" 
		<td align=\"center\"><input type=\"text\" name=\"odex1[$valor[IDTOTAL]]\" value=\"$valor[IDTOTAL]\" size=\"2\" " ."maxlength=\"3\"</a></td>
		<td align=\"center\"><input type=\"text\" name=\"odex7[$valor[IDTOTAL]]\" value=\"$valor[PROFESOR]\" size=\"20\" " ."maxlength=\"55\"</a></td>
		<td align=\"center\"><input type=\"text\" name=\"odex8[$valor[IDTOTAL]]\" value=\"$valor[CORREO]\" size=\"15\" " ."maxlength=\"55\"</a></td>
		<td align=\"center\"><input type=\"text\" name=\"odex9[$valor[IDTOTAL]]\" value=\"$valor[DESPACHOS]\" size=\"7\" " ."maxlength=\"55\"</a></td>
		<td align=\"center\"><input type=\"text\" name=\"odex11[$valor[IDTOTAL]]\" value=\"$valor[CLAVE]\" size=\"10\" " ."maxlength=\"55\"</a></td>		
		<td align=\"center\"><input type=\"text\" name=\"odex12[$valor[IDTOTAL]]\" value=\"$valor[LIMITE]\" size=\"4\" " ."maxlength=\"5\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex33[$valor[IDTOTAL]]\" value=\"$valor[$SPENULT]\" size=\"9\" " ."maxlength=\"9\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex34[$valor[IDTOTAL]]\" value=\"$valor[$SULT]\" size=\"9\" " ."maxlength=\"9\"</a></td>		
		<td align=\"center\"><input type=\"text\" name=\"odex35[$valor[IDTOTAL]]\" value=\"$valor[IDPROF]\" size=\"2\" " ."maxlength=\"3\"</a></td>																		
		\n      </tr>\n");
	} //303 FOR RES2
	} // 293 ELSE TITULOS BLOQUE 1
	$c1 = "SELECT MAX(IDPARTIDA) FROM CONTROL ";
	foreach ($bd->query($c1) as $NY1);
	$b11 = max($NY1);
	$B1 = $b11 + 3;
    $consulta21 = "SELECT * FROM CONTROL WHERE IDTOTAL < $B1";
    $result21 = $bd->query($consulta21);
    if (!$result21) {
        print "<p>Error en la consulta.</p>\n";
    } else {		
	        print "<p align=\"center\">
  <table border=\"1\" align=\"center\">
      <tr class=\"neg\">  
	    <tr class=\"neg\">  <td align=\"center\"><strong>ID</td><td align=\"center\" colspan=\"2\"><strong>DESPACHOS</td><td align=\"center\" colspan=\"3\"><strong>CONCEPTOS</td><td align=\"center\" colspan=\"2\"><strong>PARTIDA</td></tr> 
      <tr class=\"neg\"> 
<tr class=\"neg\">  <td align=\"center\" ><strong></td><td align=\"center\" ><strong>Nº </td><td align=\"center\" ><strong>ID.</td><td align=\"center\" ><strong>NOTAS</td><td align=\"center\"><strong>CONCEPTO</td><td align=\"center\"><strong>ID</td><td align=\"center\"><strong>Nº</td><td align=\"center\"><strong>ID</td></tr>";
        $tmp = TRUE;
			print "<p >Notas: BLOQUE PROFESORES.</p>";
	    foreach ($result21 as $valor) {
            if ($tmp) {
                print "      <tr>\n";
            } else {
                print "      <tr class=\"neg\">\n";
            }
            $tmp = !$tmp;
            print  (" 
		<td align=\"center\">$valor[IDTOTAL]</td>
		<td align=\"center\"><input type=\"text\" name=\"odex13[$valor[IDTOTAL]]\" value=\"$valor[DESPACHO]\" size=\"6\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex14[$valor[IDTOTAL]]\" value=\"$valor[IDDESPACHO]\" size=\"2\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex15[$valor[IDTOTAL]]\" value=\"$valor[MENSAJE1]\" size=\"53\" " ."maxlength=\"150\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex16[$valor[IDTOTAL]]\" value=\"$valor[TIPOGASTO]\" size=\"17\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex17[$valor[IDTOTAL]]\" value=\"$valor[IDTIPO]\" size=\"2\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex18[$valor[IDTOTAL]]\" value=\"$valor[PARTIDA]\" size=\"6\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex19[$valor[IDTOTAL]]\" value=\"$valor[IDPARTIDA]\" size=\"2\" " ."maxlength=\"55\"</a></td>	
	\n      </tr>\n");
	} //339 FOR 21

	print "<p align=\"center\"><strong>LISTADOS DE DESPACHOS, CONCEPTOS Y PARTIDAS</strong></p>";		
	} //330 ELSE TITULOS BLOQUE 2

	$c2 = "SELECT MAX(IDCOMUNES) FROM CONTROL ";
	foreach ($bd->query($c2) as $NY2);
	$b12 = max($NY2);
	$B2 = $b12 + 3;
    $consulta22 = "SELECT * FROM CONTROL WHERE IDTOTAL < $B2";
    $result22 = $bd->query($consulta22);
    if (!$result22) {
        print "<p>Error en la consulta.</p>\n";
    } else {		
	        print "<p align=\"center\">
  <table border=\"1\" align=\"center\">
      <tr class=\"neg\">  
	    <tr class=\"neg\">  <td align=\"center\"><strong>ID</td><td align=\"center\" colspan=\"2\"><strong>OTROS</td><td align=\"center\" colspan=\"2\"><strong>COMUNES</td><td align=\"center\" colspan=\"3\"><strong>EJERCICIO</td><td align=\"center\" colspan=\"3\"><strong>CRITERIO</td><td align=\"center\"><strong>ADMI-</td></tr> 
      <tr class=\"neg\"> 
<tr class=\"neg\">  <td align=\"center\" ><strong></td><td align=\"center\" ><strong>TIPO</td><td align=\"center\" ><strong>ID.</td><td align=\"center\" ><strong>TIPO</td><td align=\"center\"><strong>ID.</td><td align=\"center\"><strong>AÑO</td><td align=\"center\"><strong>CERR</td><td align=\"center\"><strong>ID</td><td align=\"center\"><strong>NOTA</td><td align=\"center\"><strong>TIPO</td><td align=\"center\"><strong>ID.</td><td align=\"center\"><strong>NISTRADOR</td></tr>";
        $tmp = TRUE;
			print "<p >Notas:  NOTAS DESPACHOS, CONCEPTOS Y PARTIDAS.</p>";
	    foreach ($result22 as $valor) {
            if ($tmp) {
                print "      <tr>\n";
            } else {
                print "      <tr class=\"neg\">\n";
            }
            $tmp = !$tmp;
            print  (" 
		<td align=\"center\">$valor[IDTOTAL]</td>
		<td align=\"center\"><input type=\"text\" name=\"odex22[$valor[IDTOTAL]]\" value=\"$valor[OTROS]\" size=\"10\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex23[$valor[IDTOTAL]]\" value=\"$valor[IDOTROS]\" size=\"2\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex24[$valor[IDTOTAL]]\" value=\"$valor[COMUNES]\" size=\"10\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex25[$valor[IDTOTAL]]\" value=\"$valor[IDCOMUNES]\" size=\"2\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex26[$valor[IDTOTAL]]\" value=\"$valor[EJERCICIO]\" size=\"4\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex32[$valor[IDTOTAL]]\" value=\"$valor[CERRADO]\" size=\"2\" " ."maxlength=\"55\"</a></td>			
		<td align=\"center\"><input type=\"text\" name=\"odex27[$valor[IDTOTAL]]\" value=\"$valor[IDEJER]\" size=\"2\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex28[$valor[IDTOTAL]]\" value=\"$valor[MENSAJE2]\" size=\"29\" " ."maxlength=\"120\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex29[$valor[IDTOTAL]]\" value=\"$valor[CRITERIO]\" size=\"10\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex30[$valor[IDTOTAL]]\" value=\"$valor[IDCRITERIO]\" size=\"2\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex31[$valor[IDTOTAL]]\" value=\"$valor[ADMINISTRADOR]\" size=\"10\" " ."maxlength=\"55\"</a></td>	
	\n      </tr>\n");
	} //378 FOR 22 

		print "<p align=\"center\"><strong>LISTADO DE OTROS GASTOS, GASTOS COMUNES, EJERCICIOS, ADMINISTRADOR Y CRITERIO DE DISTRIBUCIÓN DEL GASTO </strong></p>";		
	} //369 ELSE TITULOS BLOQUE 3
	
	$c3 = "SELECT MAX(IDPROV) FROM CONTROL ";
	foreach ($bd->query($c3) as $NY3);
	$b13 = max($NY3);
	$B3 = $b13 + 3;	  
	$consulta3 = "SELECT * FROM CONTROL WHERE IDTOTAL < $B3"; 
    $result3 = $bd->query($consulta3);
    if (!$result3) {
        print "<p>Error en la consulta.</p>\n";
    } else {		
	        print "<p align=\"center\">
  <table border=\"1\" align=\"center\">
<tr class=\"neg\"><td align=\"center\" ><strong>ID</td><td align=\"center\" ><strong>PROVEEDOR</td><td align=\"center\" ><strong>ID. PROVEEDOR</td></tr>";
        $tmp = TRUE;
			print "<p >Notas: NOTAS OTROS GASTOS Y COMUNES.</p>";
	    foreach ($result3 as $valor) {
            if ($tmp) {
                print "      <tr>\n";
            } else {
                print "      <tr class=\"neg\">\n";
            }
            $tmp = !$tmp;
            print  (" 
		<td align=\"center\">$valor[IDTOTAL]</td>
		<td align=\"center\"><input type=\"text\" name=\"odex20[$valor[IDTOTAL]]\" value=\"$valor[PROVEEDOR]\" size=\"55\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex21[$valor[IDTOTAL]]\" value=\"$valor[IDPROV]\" size=\"3\" " ."maxlength=\"3\"</a></td>	
	\n      </tr>\n");
	} //417 FOR 3 
	print "<p align=\"center\"><strong>LISTADO DE PROVEEDORES </strong></p>";		
	} //411 ELSE TITULOS BLOQUE 4
    print "<p align=\"center\"> <table border=\"1\" align=\"center\">Notas: NOTAS PROVEEDORES.</p>";
    //}
} //284 FIN ELSE REGISTROS CREADOS

//CONSULTA 2
} 

elseif ($cns == '1') {
$cns = recogeParaConsulta($bd, 'cns', '1'); 
$cns = quitaComillasExteriores($cns); 

$ULTEJ = "SELECT MAX(EJERCICIO) FROM CONTROL";
foreach ($bd->query($ULTEJ) as $NULTEJ);
$ULT = max($NULTEJ);
$PENULT = $ULT - 1;
$SULT = "SALDO{$ULT}"; $SPENULT = "SALDO{$PENULT}";

if ($_POST["action"] == "GRABAR") {
$tabla = $_POST["accion1"];
$cns = $_POST["accion2"];

$ULTREG = "SELECT MAX(IDTOTAL) FROM CONTROL";
foreach ($bd->query($ULTREG) as $NULTREG);
$ULTIMOREG = max($NULTREG);
$NEXTULT = $ULTIMOREG + 1;
$AVISOULT = $ULTIMOREG - 3;
$c31 = "SELECT MAX(IDPROV) FROM CONTROL ";
foreach ($bd->query($c31) as $NY31);
$b131 = max($NY31);
if ($AVISOULT < $b131 ) {
$NEWREG = "INSERT INTO CONTROL (IDTOTAL,IDPROF,IDPROV,IDDESPACHO,IDTIPO,IDPARTIDA,IDOTROS,IDCOMUNES,IDEJER,IDCRITERIO) values ($NEXTULT,0,0,0,0,0,0,0,0,0)";
foreach ($bd->query($NEWREG) as $NNN);
} else {}

$odex1 	= recogeMatrizParaConsulta($bd, 'odex1');
$odex2 	= recogeMatrizParaConsulta($bd, 'odex2');
$odex3 	= recogeMatrizParaConsulta($bd, 'odex3');
$odex4  = recogeMatrizParaConsulta($bd, 'odex4');
$odex5 	= recogeMatrizParaConsulta($bd, 'odex5');
$odex6 	= recogeMatrizParaConsulta($bd, 'odex6');
$odex7 	= recogeMatrizParaConsulta($bd, 'odex7');
$odex8 	= recogeMatrizParaConsulta($bd, 'odex8');
$odex9 	= recogeMatrizParaConsulta($bd, 'odex9');


foreach ($odex1 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET IDTOTAL =$valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex2 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET PROFESOR = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex3 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET CORREO = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex4 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET DESPACHOS = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex5 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET CLAVE = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex6 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET LIMITE = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex7 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET $SPENULT = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex8 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET $SULT = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex9 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET IDPROF = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }

if ($bd->query($consulta0)) {} else {print "<p>Error al grabar el registro.</p>\n";}
} //159 FIN ACCION GRABAR
$consulta1 = "SELECT COUNT(*) FROM CONTROL ";
$result1 = $bd->query($consulta1);
if (!$result1) {
    print "<p>Error en la consulta.</p>\n";
} elseif ($result1->fetchColumn()==0) {
    print "<p>No se ha creado todavía ningún registro.</p>\n";
} else {

	$c = "SELECT MAX(IDPROF) FROM CONTROL ";
	foreach ($bd->query($c) as $NY);
	$b1 = max($NY);
	$B = $b1 + 3;
    $consulta2 = "SELECT * FROM CONTROL WHERE IDTOTAL < $B";
    $result2 = $bd->query($consulta2);
    if (!$result2) {
        print "<p>Error en la consulta.</p>\n";
    } else {
        print "<p align=\"center\"><form action=\"configurar.php\" method=\"".POST."\">
  <table border=\"1\" align=\"center\">
    <thead>
<tr class=\"neg\">  <td align=\"center\" ><strong>ID</td><td align=\"center\"><strong>PROFESOR</td><td align=\"center\"><strong>CORREO</td><td align=\"center\"><strong>DESP.</td><td align=\"center\"><strong>CLAVE</td><td align=\"center\"><strong>ASIGNACIÓN</td><td align=\"center\"><strong>$SPENULT</td><td align=\"center\"><strong>$SULT</td><td align=\"center\"><strong>IDPROF</td></tr> 
    </thead>
    <tbody>\n";
        $tmp = TRUE;
print (" <p align=\"center\"><input name=\"action\" type=\"submit\" value=\"GRABAR\" /><input name=\"accion1\" type=\"hidden\" value=\"$tabla\" /><input name=\"accion2\" type=\"hidden\" value=\"$cns\" /></tr>\n");	
		echo "<strong><p align='center'>DATOS GENERALES DE LOS PROFESORES</strong>"  . '<br />';
	    foreach ($result2 as $valor) {
            if ($tmp) {
                print "      <tr>\n";
            } else {
                print "      <tr class=\"neg\">\n";
            }
            $tmp = !$tmp;
            print  (" 
		<td align=\"center\"><input type=\"text\" name=\"odex1[$valor[IDTOTAL]]\" value=\"$valor[IDTOTAL]\" size=\"2\" " ."maxlength=\"3\"</a></td>
		<td align=\"center\"><input type=\"text\" name=\"odex2[$valor[IDTOTAL]]\" value=\"$valor[PROFESOR]\" size=\"20\" " ."maxlength=\"55\"</a></td>
		<td align=\"center\"><input type=\"text\" name=\"odex3[$valor[IDTOTAL]]\" value=\"$valor[CORREO]\" size=\"15\" " ."maxlength=\"55\"</a></td>
		<td align=\"center\"><input type=\"text\" name=\"odex4[$valor[IDTOTAL]]\" value=\"$valor[DESPACHOS]\" size=\"7\" " ."maxlength=\"55\"</a></td>
		<td align=\"center\"><input type=\"text\" name=\"odex5[$valor[IDTOTAL]]\" value=\"$valor[CLAVE]\" size=\"10\" " ."maxlength=\"55\"</a></td>		
		<td align=\"center\"><input type=\"text\" name=\"odex6[$valor[IDTOTAL]]\" value=\"$valor[LIMITE]\" size=\"4\" " ."maxlength=\"5\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex7[$valor[IDTOTAL]]\" value=\"$valor[$SPENULT]\" size=\"9\" " ."maxlength=\"9\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex8[$valor[IDTOTAL]]\" value=\"$valor[$SULT]\" size=\"9\" " ."maxlength=\"9\"</a></td>		
		<td align=\"center\"><input type=\"text\" name=\"odex9[$valor[IDTOTAL]]\" value=\"$valor[IDPROF]\" size=\"2\" " ."maxlength=\"3\"</a></td>																		
		\n      </tr>\n");
	} //303 FOR RES2
	    print "<p align=\"center\"> <table border=\"1\" align=\"center\">Notas: NOTAS BLOQUE PROFESORES.</p>";
	
	} //369 ELSE TITULOS BLOQUE 3
	

    //}
} //284 FIN ELSE REGISTROS CREADOS

//CONSULTA 2
} 

elseif ($cns == '2') {
$cns = recogeParaConsulta($bd, 'cns', '2'); 
$cns = quitaComillasExteriores($cns); 

$ULTEJ = "SELECT MAX(EJERCICIO) FROM CONTROL";
foreach ($bd->query($ULTEJ) as $NULTEJ);
$ULT = max($NULTEJ);
$PENULT = $ULT - 1;
$SULT = "SALDO{$ULT}"; $SPENULT = "SALDO{$PENULT}";

if ($_POST["action"] == "GRABAR") {
$tabla = $_POST["accion1"];
$cns = $_POST["accion2"];

$ULTREG = "SELECT MAX(IDTOTAL) FROM CONTROL";
foreach ($bd->query($ULTREG) as $NULTREG);
$ULTIMOREG = max($NULTREG);
$NEXTULT = $ULTIMOREG + 1;
$AVISOULT = $ULTIMOREG - 3;
$c31 = "SELECT MAX(IDPROV) FROM CONTROL ";
foreach ($bd->query($c31) as $NY31);
$b131 = max($NY31);
if ($AVISOULT < $b131 ) {
$NEWREG = "INSERT INTO CONTROL (IDTOTAL,IDPROF,IDPROV,IDDESPACHO,IDTIPO,IDPARTIDA,IDOTROS,IDCOMUNES,IDEJER,IDCRITERIO) values ($NEXTULT,0,0,0,0,0,0,0,0,0)";
foreach ($bd->query($NEWREG) as $NNN);
} else {}

$odex20 	= recogeMatrizParaConsulta($bd, 'odex20');
$odex21 	= recogeMatrizParaConsulta($bd, 'odex21');

foreach ($odex20 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET PROVEEDOR = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex21 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET IDPROV = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }

if ($bd->query($consulta0)) {} else {print "<p>Error al grabar el registro.</p>\n";}
} //159 FIN ACCION GRABAR
$consulta1 = "SELECT COUNT(*) FROM CONTROL ";
$result1 = $bd->query($consulta1);
if (!$result1) {
    print "<p>Error en la consulta.</p>\n";
} elseif ($result1->fetchColumn()==0) {
    print "<p>No se ha creado todavía ningún registro.</p>\n";
} else {

	$c3 = "SELECT MAX(IDPROV) FROM CONTROL ";
	foreach ($bd->query($c3) as $NY3);
	$b13 = max($NY3);
	$B3 = $b13 + 3;	  
	$consulta3 = "SELECT * FROM CONTROL WHERE IDTOTAL < $B3"; 
    $result3 = $bd->query($consulta3);
    if (!$result3) {
        print "<p>Error en la consulta.</p>\n";
    } else {		
	        print "<p align=\"center\"><form action=\"configurar.php\" method=\"".POST."\">
  <table border=\"1\" align=\"center\">
<tr class=\"neg\"><td align=\"center\" ><strong>ID</td><td align=\"center\" ><strong>PROVEEDOR</td><td align=\"center\" ><strong>ID. PROVEEDOR</td></tr>";
        $tmp = TRUE;
		print (" <p align=\"center\"><input name=\"action\" type=\"submit\" value=\"GRABAR\" /><input name=\"accion1\" type=\"hidden\" value=\"$tabla\" /><input name=\"accion2\" type=\"hidden\" value=\"$cns\" /></tr>\n");	
	    foreach ($result3 as $valor) {
            if ($tmp) {
                print "      <tr>\n";
            } else {
                print "      <tr class=\"neg\">\n";
            }
            $tmp = !$tmp;
            print  (" 
		<td align=\"center\">$valor[IDTOTAL]</td>
		<td align=\"center\"><input type=\"text\" name=\"odex20[$valor[IDTOTAL]]\" value=\"$valor[PROVEEDOR]\" size=\"55\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex21[$valor[IDTOTAL]]\" value=\"$valor[IDPROV]\" size=\"3\" " ."maxlength=\"3\"</a></td>	
	\n      </tr>\n");
	} //417 FOR 3 
	print "<p align=\"center\"><strong>LISTADO DE PROVEEDORES </strong></p>";		
	} //411 ELSE TITULOS BLOQUE 4
    print "<p align=\"center\"> <table border=\"1\" align=\"center\">Notas: NOTAS PROVEEDORES.</p>";
    //}
} //284 FIN ELSE REGISTROS CREADOS

//CONSULTA 5
} 

elseif ($cns == '3') {
$cns = recogeParaConsulta($bd, 'cns', '3'); 
$cns = quitaComillasExteriores($cns); 

if ($_POST["action"] == "GRABAR") {
$tabla = $_POST["accion1"];
$cns = $_POST["accion2"];

$ULTREG = "SELECT MAX(IDTOTAL) FROM CONTROL";
foreach ($bd->query($ULTREG) as $NULTREG);
$ULTIMOREG = max($NULTREG);
$NEXTULT = $ULTIMOREG + 1;
$AVISOULT = $ULTIMOREG - 3;
$c31 = "SELECT MAX(IDPROV) FROM CONTROL ";
foreach ($bd->query($c31) as $NY31);
$b131 = max($NY31);
if ($AVISOULT < $b131 ) {
$NEWREG = "INSERT INTO CONTROL (IDTOTAL,IDPROF,IDPROV,IDDESPACHO,IDTIPO,IDPARTIDA,IDOTROS,IDCOMUNES,IDEJER,IDCRITERIO) values ($NEXTULT,0,0,0,0,0,0,0,0,0)";
foreach ($bd->query($NEWREG) as $NNN);
} else {}

$odex1 	= recogeMatrizParaConsulta($bd, 'odex1');  $odex24 = recogeMatrizParaConsulta($bd, 'odex24');
$odex13 = recogeMatrizParaConsulta($bd, 'odex13'); $odex25 = recogeMatrizParaConsulta($bd, 'odex25');
$odex14 = recogeMatrizParaConsulta($bd, 'odex14'); $odex26 = recogeMatrizParaConsulta($bd, 'odex26');
$odex15 = recogeMatrizParaConsulta($bd, 'odex15'); $odex27 = recogeMatrizParaConsulta($bd, 'odex27');
$odex16 = recogeMatrizParaConsulta($bd, 'odex16'); $odex28 = recogeMatrizParaConsulta($bd, 'odex28');
$odex17 = recogeMatrizParaConsulta($bd, 'odex17'); $odex29 = recogeMatrizParaConsulta($bd, 'odex29');
$odex18 = recogeMatrizParaConsulta($bd, 'odex18'); $odex30 = recogeMatrizParaConsulta($bd, 'odex30');
$odex19 = recogeMatrizParaConsulta($bd, 'odex19'); $odex31 = recogeMatrizParaConsulta($bd, 'odex31');
$odex22 = recogeMatrizParaConsulta($bd, 'odex22'); $odex32 = recogeMatrizParaConsulta($bd, 'odex32');
$odex23 = recogeMatrizParaConsulta($bd, 'odex23');

foreach ($odex1 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET IDTOTAL =$valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex13 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET DESPACHO = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex14 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET IDDESPACHO = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex15 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET MENSAJE1 = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex16 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET TIPOGASTO = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex17 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET IDTIPO = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex18 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET PARTIDA = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex19 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET IDPARTIDA = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex22 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET OTROS = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex23 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET IDOTROS = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex24 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET COMUNES = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex25 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET IDCOMUNES = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex26 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET EJERCICIO = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex27 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET IDEJER = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex28 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET MENSAJE2 = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex29 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET CRITERIO = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex30 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET IDCRITERIO = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex31 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET ADMINISTRADOR = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }
foreach ($odex32 as $ondice => $valor ) {
$consulta0 = "UPDATE CONTROL SET CERRADO = $valor WHERE IDTOTAL = $ondice";
$result0 = $bd->query($consulta0); }

if ($bd->query($consulta0)) {} else {print "<p>Error al grabar el registro.</p>\n";}
} //159 FIN ACCION GRABAR
$consulta1 = "SELECT COUNT(*) FROM CONTROL ";
$result1 = $bd->query($consulta1);
if (!$result1) {
    print "<p>Error en la consulta.</p>\n";
} elseif ($result1->fetchColumn()==0) {
    print "<p>No se ha creado todavía ningún registro.</p>\n";
} else {
	$c1 = "SELECT MAX(IDPARTIDA) FROM CONTROL ";
	foreach ($bd->query($c1) as $NY1);
	$b11 = max($NY1);
	$B1 = $b11 + 3;
    $consulta21 = "SELECT * FROM CONTROL WHERE IDTOTAL < $B1";
    $result21 = $bd->query($consulta21);
    if (!$result21) {
        print "<p>Error en la consulta.</p>\n";
    } else {		
	        print "<p align=\"center\"><form action=\"configurar.php\" method=\"".POST."\">
  <table border=\"1\" align=\"center\">
      <tr class=\"neg\">  
	    <tr class=\"neg\">  <td align=\"center\"><strong>ID</td><td align=\"center\" colspan=\"2\"><strong>DESPACHOS</td><td align=\"center\" colspan=\"3\"><strong>CONCEPTOS</td><td align=\"center\" colspan=\"2\"><strong>PARTIDA</td></tr> 
      <tr class=\"neg\"> 
<tr class=\"neg\">  <td align=\"center\" ><strong></td><td align=\"center\" ><strong>Nº </td><td align=\"center\" ><strong>ID.</td><td align=\"center\" ><strong>NOTAS</td><td align=\"center\"><strong>CONCEPTO</td><td align=\"center\"><strong>ID</td><td align=\"center\"><strong>Nº</td><td align=\"center\"><strong>ID</td></tr>";
        $tmp = TRUE;
				print (" <p align=\"center\"><input name=\"action\" type=\"submit\" value=\"GRABAR\" /><input name=\"accion1\" type=\"hidden\" value=\"$tabla\" /><input name=\"accion2\" type=\"hidden\" value=\"$cns\" /></tr>\n");
	    foreach ($result21 as $valor) {
            if ($tmp) {
                print "      <tr>\n";
            } else {
                print "      <tr class=\"neg\">\n";
            }
            $tmp = !$tmp;
            print  (" 
		<td align=\"center\">$valor[IDTOTAL]</td>
		<td align=\"center\"><input type=\"text\" name=\"odex13[$valor[IDTOTAL]]\" value=\"$valor[DESPACHO]\" size=\"6\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex14[$valor[IDTOTAL]]\" value=\"$valor[IDDESPACHO]\" size=\"2\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex15[$valor[IDTOTAL]]\" value=\"$valor[MENSAJE1]\" size=\"53\" " ."maxlength=\"150\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex16[$valor[IDTOTAL]]\" value=\"$valor[TIPOGASTO]\" size=\"17\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex17[$valor[IDTOTAL]]\" value=\"$valor[IDTIPO]\" size=\"2\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex18[$valor[IDTOTAL]]\" value=\"$valor[PARTIDA]\" size=\"6\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex19[$valor[IDTOTAL]]\" value=\"$valor[IDPARTIDA]\" size=\"2\" " ."maxlength=\"55\"</a></td>	
	\n      </tr>\n");
	} //339 FOR 21

	print "<p align=\"center\"><strong>LISTADOS DE DESPACHOS, CONCEPTOS Y PARTIDAS</strong></p>";		
	} //330 ELSE TITULOS BLOQUE 2

	$c2 = "SELECT MAX(IDCOMUNES) FROM CONTROL ";
	foreach ($bd->query($c2) as $NY2);
	$b12 = max($NY2);
	$B2 = $b12 + 3;
    $consulta22 = "SELECT * FROM CONTROL WHERE IDTOTAL < $B2";
    $result22 = $bd->query($consulta22);
    if (!$result22) {
        print "<p>Error en la consulta.</p>\n";
    } else {		
	        print "<p align=\"center\">
  <table border=\"1\" align=\"center\">
      <tr class=\"neg\">  
	    <tr class=\"neg\">  <td align=\"center\"><strong>ID</td><td align=\"center\" colspan=\"2\"><strong>OTROS</td><td align=\"center\" colspan=\"2\"><strong>COMUNES</td><td align=\"center\" colspan=\"3\"><strong>EJERCICIO</td><td align=\"center\" colspan=\"3\"><strong>CRITERIO</td><td align=\"center\"><strong>ADMI-</td></tr> 
      <tr class=\"neg\"> 
<tr class=\"neg\">  <td align=\"center\" ><strong></td><td align=\"center\" ><strong>TIPO</td><td align=\"center\" ><strong>ID.</td><td align=\"center\" ><strong>TIPO</td><td align=\"center\"><strong>ID.</td><td align=\"center\"><strong>AÑO</td><td align=\"center\"><strong>CERR</td><td align=\"center\"><strong>ID</td><td align=\"center\"><strong>NOTA</td><td align=\"center\"><strong>TIPO</td><td align=\"center\"><strong>ID.</td><td align=\"center\"><strong>NISTRADOR</td></tr>";
        $tmp = TRUE;
			print "<p >Notas:  NOTAS DESPACHOS, CONCEPTOS Y PARTIDAS.</p>";
	    foreach ($result22 as $valor) {
            if ($tmp) {
                print "      <tr>\n";
            } else {
                print "      <tr class=\"neg\">\n";
            }
            $tmp = !$tmp;
            print  (" 
		<td align=\"center\">$valor[IDTOTAL]</td>
		<td align=\"center\"><input type=\"text\" name=\"odex22[$valor[IDTOTAL]]\" value=\"$valor[OTROS]\" size=\"10\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex23[$valor[IDTOTAL]]\" value=\"$valor[IDOTROS]\" size=\"2\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex24[$valor[IDTOTAL]]\" value=\"$valor[COMUNES]\" size=\"10\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex25[$valor[IDTOTAL]]\" value=\"$valor[IDCOMUNES]\" size=\"2\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex26[$valor[IDTOTAL]]\" value=\"$valor[EJERCICIO]\" size=\"4\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex32[$valor[IDTOTAL]]\" value=\"$valor[CERRADO]\" size=\"2\" " ."maxlength=\"55\"</a></td>			
		<td align=\"center\"><input type=\"text\" name=\"odex27[$valor[IDTOTAL]]\" value=\"$valor[IDEJER]\" size=\"2\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex28[$valor[IDTOTAL]]\" value=\"$valor[MENSAJE2]\" size=\"29\" " ."maxlength=\"120\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex29[$valor[IDTOTAL]]\" value=\"$valor[CRITERIO]\" size=\"10\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex30[$valor[IDTOTAL]]\" value=\"$valor[IDCRITERIO]\" size=\"2\" " ."maxlength=\"55\"</a></td>	
		<td align=\"center\"><input type=\"text\" name=\"odex31[$valor[IDTOTAL]]\" value=\"$valor[ADMINISTRADOR]\" size=\"10\" " ."maxlength=\"55\"</a></td>	
	\n      </tr>\n");
	} //378 FOR 22 

		print "<p align=\"center\"><strong>LISTADO DE OTROS GASTOS, GASTOS COMUNES, EJERCICIOS, ADMINISTRADOR Y CRITERIO DE DISTRIBUCIÓN DEL GASTO </strong></p>";		
	} //369 ELSE TITULOS BLOQUE 3
} //284 FIN ELSE REGISTROS CREADOS

//CONSULTA 2
} 

elseif ($cns == '5') {

if($C13 == '1') {
// SELECCIÓN DEL ÚLTIMO EJERCICIO Y DEL NUEVO A AÑADIR
$ULTEJ = "SELECT MAX(EJERCICIO) FROM CONTROL";
foreach ($bd->query($ULTEJ) as $NULTEJ);
$ULT = max($NULTEJ);
$NEWEJER = $ULT + 1;
$PENULT = $ULT - 1;

$CCER = "SELECT * FROM CONTROL WHERE EJERCICIO == '$ULT'";
foreach ($bd->query($CCER) as $VERR);
if ($VERR['CERRADO'] !== "SI") {
echo ("<strong><p align='center'>Lo siento, no es posible dar de alta un ejercicio al no encontrarse cerrado el ejercicio anterior.");
} else {

// CREACIÓN DE LA TABLA DEL NUEVO EJERCICIO
$consulta = "CREATE TABLE '$NEWEJER' AS SELECT * FROM '$ULT'";
	if ($bd->query($consulta)) {
   	print "<p>Tabla " . $NEWEJER . " creada correctamente.</p>\n";
	// AÑADIR LINEA A CAMPOS EJERCICIO E IDEJER
	$c = "SELECT MAX(IDEJER) FROM CONTROL ";
	foreach ($bd->query($c) as $NY);
	$b1 = max($NY); 	$B = $b1 + 1;
	$consulta0 = "UPDATE CONTROL SET EJERCICIO = $NEWEJER , IDEJER = $B WHERE IDTOTAL = $B";
	if ($bd->query($consulta0)) {
	print "<p>Actualizados campos de control. Ejercicio: ".$NEWEJER.". IDEJER: " .$B.".</p>\n";	}
	else {print "<p>Error al actualizar los datos del fichero de control.</p>\n";}
	// ELIMINAR REGISTROS DE LA TABLA ORIGINAL
	$con1 = "DELETE FROM '$NEWEJER' WHERE IDTOTAL > 0  ";
	if ($bd->query($con1)) {print "<p>Eliminados todos los registros de la tabla original.</p>\n";}
	else {print "<p>Error al borrar todos los registros de la tabla original.</p>\n";}
	// AÑADIR CAMPO DE SALDO AL NUEVO EJERCICIO EN LA TABLA DE CONTROL
	$SNEW = "SALDO{$NEWEJER}"; $SULT = "SALDO{$ULT}";
	$CC = "ALTER TABLE 'CONTROL' ADD $SNEW DOUBLE";
	if ($bd->query($CC)) {print "<p>Campo " . $SNEW . " creado en la tabla CONTROL.</p>\n";	} 
	else {print "<p>Error al crear el campo.</p>\n";}	
	// AÑADIR REGISTRO NUEVO EN TABLA DE INGRESOS
	$NEWING = "INSERT INTO INGRESOS (ANNO) values ($NEWEJER)";
	if ($bd->query($NEWING)) {
	$CON3 = "SELECT ANNO FROM (INGRESOS) where ANNO == $NEWEJER"; 
	foreach ($bd->query($CON3) as $NEW);
	echo "<p>CREADO NUEVO REGISTRO EN LA TABLA INGRESOS PARA EL AÑO: ". $NEW['ANNO'] . ". ";} 
	else {	print "<p>Error al añadir un nuevo registro en la tabla de INGRESOS.</p>\n";	}	
	// RELLENAR EL CAMPO DE SALDO CON SALDO ANTERIOR + ASIGNACION CON LIMITE
	$codigo_sql = "SELECT * FROM CONTROL WHERE IDPROF > '0' ORDER BY PROFESOR"; 
	foreach ($bd->query($codigo_sql) as $row)
	{
	$cod3_sql = "SELECT SUM(IMPORTE) AS TOTAL FROM '$ULT' WHERE PROFESOR == '$row[PROFESOR]' "; 
	foreach ($bd->query($cod3_sql) as $T);
	$cod = "SELECT * FROM CONTROL WHERE PROFESOR == '$row[PROFESOR]'"; 
	foreach ($bd->query($cod) as $TIEMPO);	
	$SALDOS = $TIEMPO[$SULT] - $T['TOTAL'] + $TIEMPO['LIMITE'];
	$LIM = $TIEMPO['LIMITE'] * 2;
	if ($SALDOS > $LIM) { $SALDOS = $LIM + 0; }else {}
	echo "<p>Profesor: " . $row[PROFESOR] . " Saldo del ejercicio ". $ULT . ": ". $TIEMPO[$SULT] . " Dotación anual: " . $TIEMPO['LIMITE'] . " Importe total de gasto en " . $ULT . ": ". $T['TOTAL'] . " Límite de gasto para " . $NEWEJER . ": " .$SALDOS . ".</p>\n";
	$consulta0 = "UPDATE CONTROL SET $SNEW = $SALDOS WHERE PROFESOR == '$row[PROFESOR]'";
	$result0 = $bd->query($consulta0);
	if ($bd->query($consulta0)) {print "<p>Límite de saldo introducido para el ejercicio " . $NEWEJER . ": " . $SALDOS .".</p>\n";} else {print "<p>Error al grabar el registro.</p>\n";}
	
	} //FINAL FOREACH
		
} else {
   print "<p>Error al crear la tabla: " . $C14 . ". </p>\n";
   print "<p>Posiblemente ello sea debido a que ya existe otra tabla con ese mismo nombre. </p>\n";
}
}
}
else {
$consulta = "DROP TABLE '$C14' ";
	if ($bd->query($consulta)) {
   	print "<p>Tabla " . $C14 . " borrada correctamente.</p>\n";
	} else {
    print "<p>Error al borrar la tabla " . $C14 . ". </p>\n";
	}
	$c = "UPDATE CONTROL SET EJERCICIO = '' , IDEJER = 0 WHERE EJERCICIO = $C14";
	if ($bd->query($c)) {
	print "<p>Registro eliminado correctamente.</p>\n";
	} 
	else {
	print "<p>Error al eliminar el registro.</p>\n";
	}
}
} 
$bd = NULL;
?>