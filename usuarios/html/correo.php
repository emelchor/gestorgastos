<?php
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
$CONSULTA1 = $_COOKIE['CORREOUSUARIOGASTOS'];
if(empty($_POST['message']) || empty($_POST['subject'])) {
echo "<p><strong>Lo siento, debe completar todos los campos del formulario.</strong></p>";
}
else {	
$codigo1_sql = "SELECT * FROM CONTROL where CORREO == '$CONSULTA1'"; 
foreach ($bd->query($codigo1_sql) as $REG);
$codigo2_sql = "SELECT * FROM CONTROL where IDTOTAL == 1"; 
foreach ($bd->query($codigo2_sql) as $REG2);
mail($REG2['ADMINISTRADOR'],$_POST['subject'] . " - " . $REG['PROFESOR'],$REG['CORREO'],$_POST['message']);
mail($REG['CORREO'],"Confirmacion de mensaje","Mensaje automatico de confirmación de recepcion de mensaje. Ha enviado a $REG2[ADMINISTRADOR] el siguiente mensaje: $_POST[message]"); 
echo "<p><strong>Usuario del servicio de mensajería web: </strong>". $REG['PROFESOR'];
echo "<p><strong>Ha enviado un correo de: </strong>". $REG['CORREO'];
echo "<p><strong>Al administrador del sistema: </strong>". $REG2['ADMINISTRADOR'];
}
pie();
$bd = NULL;
?>