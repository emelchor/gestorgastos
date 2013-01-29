<?php
include('funciones.php');		cabecera('GRABADO DE NORMATIVA', CABECERA_SIN_CURSOR);	$bd = conectaDb();
$C0 = $_POST['TITULO'];			$C1 = $_POST['CONTENIDO'];  	$CP = $_POST["accion10"];
$M1 = "<table border=\"1\" bgcolor=\"#FF3333\" align=\"center\">Registro insertado correctamente";
$M2 = "Error al insertar el registro";
//if ($_POST["action1"] == "ANTERIOR") { } elseif ($_POST["action4"] == "POSTERIOR"){$PUNTERO = $CP+1; }
echo "<p align=\"center\"><strong>GRABAR NORMATIVA EN LA BASE DE DATOS</strong></p>";
$S = "SELECT MAX(IDNORMATIVA) FROM NORMATIVA ";
foreach ($bd->query($S) as $ST);
$b1 = max($ST);
if ($_POST["action1"] == "ANTERIOR") { // INICIO ANTERIOR 
	if ($CP <=1) {
	echo "Lo siento, no hay registros disponibles.";
	$PUNTERO = $CP;
	$P = $b1;
	$cod = "SELECT * FROM NORMATIVA WHERE IDNORMATIVA == $P"; 
	foreach ($bd->query($cod) as $C);
	} else {
	$PUNTERO = $CP-1;
	$cod = "SELECT * FROM NORMATIVA WHERE IDNORMATIVA == $PUNTERO"; 
	foreach ($bd->query($cod) as $C);
	$P = $b1 + 0;}  // FIN ANTERIOR 
}
elseif ($_POST["action4"] == "POSTERIOR") { // INICIO POSTERIOR 
	if ($CP > $b1) {
	echo "Lo siento, no hay registros disponibles.";
	$PUNTERO = $CP;
	$P = $b1;
	} else {
	$PUNTERO = $CP+1;
	$cod = "SELECT * FROM NORMATIVA WHERE IDNORMATIVA == $PUNTERO"; 
	foreach ($bd->query($cod) as $C);
	$P = $b1 + 0;}  // FIN POSTERIOR 
}
else {$PUNTERO = $b1 + 1; $P = $b1 + 0; }
if ($_POST["action2"] == "MODIFICAR") { // INICIO MODIFICAR 
	$cc = "UPDATE NORMATIVA SET TITULO = '$C0'    WHERE IDNORMATIVA = $CP";  $result0 = $bd->query($cc); 
	$cc = "UPDATE NORMATIVA SET CONTENIDO = '$C1' WHERE IDNORMATIVA = $CP";  $result0 = $bd->query($cc); 
	if ($bd->query($cc)) {$M = $M1;} else {$M = $M2;} 
} // FIN MODIFICAR 
if ($_POST["action3"] == "GRABAR") { // INICIO GRABAR 
	$c = "INSERT INTO NORMATIVA (IDNORMATIVA,TITULO,CONTENIDO) values ($CP,'$C0','$C1')";
	if ($bd->query($c)) {$M = $M1;} else {$M = $M2;}
} // FIN GRABAR 
print "<p align=\"center\"><form action=\"formulario-normativa.php\" method=\"".POST."\"><table border=\"0\" align=\"center\">
    <thead>
<th align=\"left\">REGISTRO NUMERO: $PUNTERO DE $P</th></tr>
<th align=\"left\">TITULOS: <textarea NAME=\"TITULO\" id=\"TITULO\"   rows=\"2\" cols=\"100\"  >$C[TITULO] </textarea></tr>
<th align=\"left\">DETALLE: <textarea NAME=\"CONTENIDO\" id=\"CONTENIDO\"   rows=\"15\" cols=\"100\" >$C[CONTENIDO] </textarea></tr>
	  </tr>\n";	
print (" 
<td><p align=\"center\"><input name=\"action1\" type=\"submit\" value=\"ANTERIOR\" />
<align=\"center\"><input name=\"action4\" type=\"submit\" value=\"POSTERIOR\" />
<align=\"center\"><input name=\"action3\" type=\"submit\" value=\"GRABAR\" />
<align=\"center\"><input name=\"action2\" type=\"submit\" value=\"MODIFICAR\" />
<input name=\"accion10\" type=\"hidden\" value=\"$PUNTERO\" />
\n");
print utf8_encode("<p align=\"left\">Nota: Si desea que aparezcan los puntos y aparte ha de copiar y pegar allí donde corresponda este código (sin espacios) < br > ");
print utf8_encode("<p align=\"left\">Para grabar un nuevo registro vaya al último registro disponible en blanco y pulse grabar.");
print utf8_encode("<p align=\"left\">Si lo que desea es modificar un registro existente vaya al registro en cuestión y luego pulse modificar, ya que en caso de pinchar en grabar duplicará el registro.");
$bd = NULL;
?>