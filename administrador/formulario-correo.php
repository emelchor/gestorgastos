<?php
include('funciones.php');
cabecera('envio de correos', CABECERA_SIN_CURSOR);
$bd = conectaDb();
$codigok_sql = "SELECT * FROM CONTROL where IDTOTAL == '1'";
foreach ($bd->query($codigok_sql) as $VERK);
?><html>

<td><table WIDTH="941" align="center" >
<tr>
<td width="933" height="330" ALIGN=left valign="top">
  <form ACTION="correo.php" METHOD="POST">
    <div align="center"><strong><font size="3" face="Arial, Helvetica, sans-serif">PASO 1/2 ESCRIBA EL ASUNTO Y EL CUERPO DEL MENSAJE </font></strong><BR>
      </div>
    <p align="center"><strong><font face="Arial, Helvetica, sans-serif">IMPORTANTE: NO PONER NING&Uacute;N TIPO DE COMILLAS (&quot; O ') EN ASUNTO O MENSAJE </font></strong></p>
    <p><strong>Asunto:</strong>
      <input NAME="ASUNTO" TYPE="text" id="ASUNTO" SIZE="57" MAXLENGTH="50">
      <font size="2" face="Arial, Helvetica, sans-serif">(max. 50 caracteres) </font> </p>
    <p><strong>Mensaje</strong>:
      <textarea name="MENSAJE" cols="98" rows="12" id="MENSAJE">








Departamento de <?php print "$VERK[NOMBREDEPTO]"; ?><br>
<?php print "$VERK[DIRECCIONDEPTO]"; ?><br>
email: <?php print "$VERK[ADMINISTRADOR]"; ?></textarea>      
      <p align="center">
    <input name="submit" type="submit" value="PASO 2/2 SELECCIONAR LOS DESTINATARIOS DEL MENSAJE" />
  </p>
  <div align="center"></div>
</form>
</form></td>
</tr>
</table>

  <p>&nbsp;</p>
</font></body></html>
<?php
pie();
?>