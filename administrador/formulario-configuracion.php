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
cabecera('configuracion', CABECERA_SIN_CURSOR);
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
  <form ACTION="configurar.php" METHOD="POST">
    <table width="930" border="1" align="center">

    <tr>
      <td><p align="center"><strong><font face="Arial, Helvetica, sans-serif">DE LA  BASE DE DATOS </font></strong></p>
        <p align="center">&nbsp;</p></td>
    </tr>
    
    <tr>
      <td><font face="Arial, Helvetica, sans-serif"><span class="Estilo1">
        <input type="radio" name="CONSULTA" value="1" />
      </span>CONFIGURACI&Oacute;N DE LOS DATOS DE PROFESORES </font></td>
    </tr>
    <tr>
      <td><font face="Arial, Helvetica, sans-serif"><span class="Estilo1">
        <input type="radio" name="CONSULTA" value="3" />
      </span>CONFIGURACI&Oacute;N DE LOS DATOS DE MEN&Uacute;S DESPLEGABLES </font></td>
    </tr>
    <tr>
      <td><font face="Arial, Helvetica, sans-serif"><span class="Estilo1">
        <input type="radio" name="CONSULTA" value="2">
      </span>CONFIGURACI&Oacute;N DE LOS DATOS DE PROVEEDORES </font></td>
      </tr>
    <tr>
      <td><label>
        <font face="Arial, Helvetica, sans-serif"><span class="Estilo1">
        <input type="radio" name="CONSULTA" value="5">
        </span>CREAR / BORRAR TABLAS (EJERCICIOS) </font>
        <font size="2" face="Arial, Helvetica, sans-serif"><strong>ACCI&Oacute;N:<font color="#000000">
        <select name="ACCION3" id="select4">
          <option value="1" selected="selected">CREAR</option>
          <option value="2">BORRAR</option>
        </select>
        </font></strong></font></label>
          <div align="center"></div></td>
    </tr>
  </table>
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
