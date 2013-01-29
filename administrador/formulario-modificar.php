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
include('funciones.php');
cabecera('Modificar', CABECERA_SIN_CURSOR);
$bd = conectaDb();
$consulta = "SELECT * FROM CONTROL WHERE IDEJER > '0' ORDER BY EJERCICIO DESC";
$result = $bd->query($consulta);
$EJER = "<select name=EJER>\n"; //Inicias una variable para guardar el select o combo box.
while($row=$result->fetch())
{
$EJER .= " <option value='".$row['IDEJER'];	//concatenamos y le damos el value a la opcion
$EJER .= "'>".$row['EJERCICIO']."</option>\n";//concatenamos e insertamos el dato que se mostrara
}
$combo .= "</select>\n";		//concatenamos y cerramos el select
echo $combo;

$consulta1 = "SELECT * FROM CONTROL WHERE IDEJER > '0'";
$result1 = $bd->query($consulta1);
$EJER1 = "<select name=EJER1>\n"; //Inicias una variable para guardar el select o combo box.
while($row=$result1->fetch())
{
$EJER1 .= " <option value='".$row['IDEJER'];	//concatenamos y le damos el value a la opcion
$EJER1 .= "'>".$row['EJERCICIO']."</option>\n";//concatenamos e insertamos el dato que se mostrara
}
$combo .= "</select>\n";		//concatenamos y cerramos el select
echo $combo;
?>

<td><table WIDTH="941" align="center" >
<tr>
<td width="933" height="396" ALIGN=left valign="top">
  <form ACTION="modificar.php" METHOD="POST">
    <table width="930" border="1" align="center">
    <tr>
      <td height="22"><div align="center"><p align="center"><strong><font face="Arial, Helvetica, sans-serif">SELECCIONE EL EJERCICIO CUYOS DATOS DESEA MODIFICAR</font></strong><span class="Estilo1"><strong>:</strong><? echo $EJER; ?></span> </strong> </div>
        <label> </label></td>
    </tr>
    
    
    <tr>
      <td height="25"><label>
        <input type="radio" name="CONSULTA" value="1" />
        <font face="Arial, Helvetica, sans-serif">MODIFICAR EL CONTENIDO  DE REGISTROS DE UN EJERCICIO</font></label>
        <label></label>
        <label></label>
        <label></label></td>
    </tr>
    <tr>
      <td height="25"><label>
        <input type="radio" name="CONSULTA" value="2" />
        <font face="Arial, Helvetica, sans-serif">BORRAR  UNA SELECCI&Oacute;N DE REGISTROS DE UN EJERCICIO</font></label>
        <label></label>
        <label></label>
        <label></label></td>
    </tr>
    <tr>
      <td height="25"><label>
        <input type="radio" name="CONSULTA" value="3" />
        <font face="Arial, Helvetica, sans-serif">REEMPLAZAR DATOS DE CAMPO </font>
      </label>
        <label></label>
        <label></label>
        <label><font size="2" face="Arial, Helvetica, sans-serif"><strong><font face="Arial, Helvetica, sans-serif"><strong>CAMPO:
        <input name="CAMPO2" type="text" id="CAMPO2" size="10" maxlength="20" />
        ANTES:
        <input name="ANTES" type="text" id="ANTES" size="10" maxlength="40" />
        </strong></font></strong></font><font size="2" face="Arial, Helvetica, sans-serif"><strong><font face="Arial, Helvetica, sans-serif"><strong>AHORA:
        <input name="AHORA" type="text" id="AHORA" size="10" maxlength="40" />
        </strong></font></strong></font></label></td>
    </tr>
  </table>
  <BR>
  <p align="center">
    <input name="submit" type="submit" value="REALIZAR CONSULTA SOLICITADA" />
  </p>
  <div align="center"></div>
</form>
</form></td>
</tr>
</table>

  </font>
  <?php
pie();
?>
