<?php
if (isset($_COOKIE['autentificadogastos'])) {
    $validado = $_COOKIE['autentificadogastos'];
} else { $validado = 'NO'; } 
if ( $validado == 'NO') {
	header("Location: ../../index.php");
    exit();
} 
include('funciones.php');
cabecera('MODIFICACION DE CLAVE', CABECERA_SIN_CURSOR);
$bd = conectaDb();
$NOMUSU = $_COOKIE['NOMBREUSUARIOGASTOS'];
$CORUSU = $_COOKIE['CORREOUSUARIOGASTOS'];
echo "<p align=\"center\"><strong>MODIFICACIÓN DE CONTRASEÑA Y DIRECCIÓN DE CORREO ELECTRÓNICO</strong></p>";
echo "<p align=\"center\"><strong></strong></p>";
if ($_POST["action"] == "GRABAR") {
	$odex1 	= recogeMatrizParaConsulta($bd, 'odex1');
	$odex2 	= recogeMatrizParaConsulta($bd, 'odex2');
	foreach ($odex1 as $ondice => $valor ) {
	$consulta0 = "UPDATE CONTROL SET CLAVE = $valor WHERE IDTOTAL = $ondice";
	$result0 = $bd->query($consulta0); }
	foreach ($odex2 as $ondice => $valor ) {
	$consulta0 = "UPDATE CONTROL SET CORREO = $valor WHERE IDTOTAL = $ondice";
	$result0 = $bd->query($consulta0); }	
	if ($bd->query($consulta0)) {print "<p>";} else {print "<p>Error al grabar el registro.</p>\n";}
}
$consulta2 = "SELECT * FROM CONTROL WHERE CORREO == '$CORUSU'"; 
$result2 = $bd->query($consulta2);
if (!$result2) { print "<p>Error en la consulta.</p>\n";
} else {
        foreach ($result2 as $valor) {
  print  ("
  <p align=\"center\"><form action=\"clave.php\" method=\"".POST."\">
  <table border=\"0\" align=\"center\">
    <tbody><thead>
      <tr class=\"neg\">    
        <th colspan=\"2\" align=\"CENTER\">APELLIDOS Y NOMBRE: $NOMUSU</th>
      <tr></tr>		<tr></tr>	<tr></tr>	<tr></tr>	<tr></tr>	<tr></tr>	<tr></tr>	
      <tr class=\"neg\">  
        <th align=\"left\">CONTRASEÑA ACTUAL: $valor[CLAVE]</th><th align=\"left\">DIRECCIÓN DE CORREO ACTUAL: $CORUSU</th>  
		<tr class=\"neg\">   
        <th align=\"left\">NUEVA CONTRASEÑA: <input type=\"text\" name=\"odex1[$valor[IDTOTAL]]\" value=\"$valor[CLAVE]\" size=\"15\" " ."maxlength=\"15\"</a></th><th align=\"left\">NUEVA DIRECCIÓN DE CORREO: <input type=\"text\" name=\"odex2[$valor[IDTOTAL]]\" value=\"$valor[CORREO]\" size=\"30\" " ."maxlength=\"30\"</a></th>
	  </tr>	  		
");
print "  \n</table></tbody>\n";
		}
 print (" <p align=\"center\"><input name=\"action\" type=\"submit\" value=\"GRABAR\" /></tr>\n");
}
pie();
$bd = NULL;
?>