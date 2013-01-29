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
print "<?xml version=\"1.0\" encoding=\"utf-8\"?".">
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//ES\"
       \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
  <title>Gestor de gastos</title>
<link href=\"estilobase.css\"; rel=\"stylesheet\" type=\"text/css\" />
<link rel=\"shortcut icon\" href=\"../images/favicon.ico\" type=\"image/x-icon\" />
</head>\n\n";
include('funciones.php');
$bd = conectaDb();
$EMAIL = $_POST['usuario'];
if(empty($_POST['usuario'])) {
echo "<strong>Debe rellenar el campo de su correo electrónico.</strong>" . '<br />';  
}
else {
$codigo1_sql = "SELECT * FROM CONTROL where CORREO == '$EMAIL'"; 
foreach ($bd->query($codigo1_sql) as $VER);
	if($VER['CORREO'] == $EMAIL) {
	mail($VER['CORREO'],"Recordatorio de clave","Tu clave de acceso es " . $VER['CLAVE']); 
	echo "<p><strong>Hola </strong>". $VER['PROFESOR'];
	echo "<p><strong>Se ha enviado un correo a: </strong>". $VER['CORREO'];
	echo " <strong>con la clave de acceso almacenada en el servidor.</strong>";
	echo "<p><strong>Saludos del administrador del sistema</strong></p>";
	}
   	else {
	echo "<p><strong>Lo siento, no aparece registrado ese correo electrónico en la base de datos de usuarios.</strong></p>";
	}
}
$codigo2_sql = "SELECT * FROM CONTROL where IDTOTAL == 1";
foreach ($bd->query($codigo2_sql) as $VER2);
print '</div><div id="pie"><address>Departamento de ' . $VER['NOMBREDEPTO'] . '. ' . $VER['DIRECCIONDEPTO'] . '<br />';
print utf8_encode('<small>Desarrollo y diseño web: © Elías Melchor Ferrer.</small></address></div></body></html>');
$bd = NULL;
?>