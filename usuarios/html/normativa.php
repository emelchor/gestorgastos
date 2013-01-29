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
$bd = conectaDb();
$codigo1_sql = "SELECT * FROM NORMATIVA where TITULO !== ''";
foreach ($bd->query($codigo1_sql) as $VER);
?>

<style type="text/css">
<!--
.Estilo7 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #000099;
}
.Estilo8 {font-family: Arial, Helvetica, sans-serif}
-->
</style>

<td><table WIDTH="895" align="center" >
<tr>
<td width="887" height="164" ALIGN=left valign="top"><div align="center"></div>
  <div align="center"><font face="Arial, Helvetica, sans-serif"><strong><font size="5">NORMATIVA SOBRE PRESUPUESTO RECOGIDA EN ACTAS DE CONSEJO DE DEPARTAMENTO Y DE JUNTA DE DIRECCI&Oacute;N </font></strong></font>
      </div>
    
      <?php
$CCON1 = "SELECT * FROM NORMATIVA WHERE IDNORMATIVA > '0' ORDER BY IDNORMATIVA DESC";
foreach ($bd->query($CCON1) as $row) {
print "<p><strong><font color=\"#000099\" face=\"Arial, Helvetica, sans-serif\">" . $row['TITULO'] . "</font></strong></p>";
print "<p class=\"Estilo8\">".  $row['CONTENIDO'] . "</p>";
print "<p class=\"Estilo8\"></p>";
}
?>
  </div></td>
</tr>
</table>
</font>
<?php
pie();
?>