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