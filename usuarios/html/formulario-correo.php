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
cabecera();
$bd = conectaDb();
?>
<td><table WIDTH="932" align="center" >
<tr>
<td width="924" height="284" ALIGN=left valign="top"><form ACTION="correo.php" METHOD="POST"><div align="center">
  <div align="center"><strong><font size="5" face="Arial, Helvetica, sans-serif">SERVIDOR DE CORREO </font></strong>&nbsp;
    </p>
  </div>
  <p align="left">&nbsp;</p>
  <p align="left"><font face="Arial, Helvetica, sans-serif"><strong>Asunto:</strong>    
    <input TYPE="text" NAME="subject" SIZE="57" MAXLENGTH="50">
    <font size="2">(max. 50 caracteres) </font></font> </p>
  <p><font face="Arial, Helvetica, sans-serif"><strong>Mensaje</strong>:
        <textarea rows="10" cols="120" name="message"></textarea>    
      </font>
    <p align="center">
      <font face="Arial, Helvetica, sans-serif">
      <input name="submit" type="submit" value="ENVIAR MENSAJE" />
      </font>
    </form>
  <div align="center"><b><font face="Arial">Para contactar con el administrador puede 
    completar el siguiente formulario, recibir&aacute; en su correo un 
    mensaje autom&aacute;tico de confirmaci&oacute;n del envio procedente del servidor</font></b><br>
  </div>
  </form></td>
</tr>
</table>
</font>
<?php
pie();
?>