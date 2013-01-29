<?php
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