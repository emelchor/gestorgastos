<?php

include('funciones.php');
cabecera('consultas', CABECERA_SIN_CURSOR);
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

$consulta = "SELECT * FROM CONTROL WHERE IDTIPO > '1'";
$result = $bd->query($consulta);
$TIPO = "<select name=TIPO>\n"; //Inicias una variable para guardar el select o combo box.
while($row=$result->fetch())
{
$TIPO .= " <option value='".$row['IDTIPO'];	//concatenamos y le damos el value a la opcion
$TIPO .= "'>".$row['TIPOGASTO']."</option>\n";//concatenamos e insertamos el dato que se mostrara
}
$combo .= "</select>\n";		//concatenamos y cerramos el select
echo $combo;

$consulta = "SELECT * FROM CONTROL WHERE IDCRITERIO > '1'";
$result = $bd->query($consulta);
$CRITER = "<select name=CRITER>\n"; //Inicias una variable para guardar el select o combo box.
while($row=$result->fetch())
{
$CRITER .= " <option value='".$row['IDCRITERIO'];	//concatenamos y le damos el value a la opcion
$CRITER .= "'>".$row['CRITERIO']."</option>\n";//concatenamos e insertamos el dato que se mostrara
}
$combo .= "</select>\n";		//concatenamos y cerramos el select
echo $combo;

?>
<td><table WIDTH="889" align="center" >
<tr>
<td width="881" height="338" ALIGN=left valign="top"><div align="center"><font size="5" face="Arial, Helvetica, sans-serif"><strong> REALIZACI&Oacute;N DE CONSULTAS </strong></font>
</div>
  <form ACTION="consultas.php" METHOD="POST">
    <table width="796" align="center">
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="503"><div align="center"><font face="Arial, Helvetica, sans-serif">Seleccione un ejercicio <? echo $EJER; ?></font></div></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><div align="left"><b><font face="Arial, Helvetica, sans-serif"><span class="Estilo1">
        <input name="CONSULTA" type="radio" value="4" checked="checked" />
      </span></font></b><font face="Arial">CONSULTAS A MEDIDA </font></div></td>
    </tr>
    
    <tr>
      <td><div align="left">
        <ul>
          <li><font face="Arial, Helvetica, sans-serif">Seleccione un concepto de gasto <? echo $TIPO; ?></font></li>
        </ul>
      </div></td>
    </tr>
    <tr>
      <td><div align="left">
        <ul>
          <li><font face="Arial, Helvetica, sans-serif">Seleccione un criterio de distribuci&oacute;n de gasto </font><? echo $CRITER; ?></li>
        </ul>
      </div></td>
    </tr>
  </table>
    <table width="796" align="center">
    
    <tr>
      <td width="503"><font face="Arial, Helvetica, sans-serif"><span class="Estilo1">
        <input type="radio" name="CONSULTA" value="1" />
      </span> VER EL DETALLE DE LOS GASTOS REALIZADOS. </font>
        </label></td>
    </tr>
    <tr>
      <td><font face="Arial, Helvetica, sans-serif"><span class="Estilo1">
        <input type="radio" name="CONSULTA" value="2" />
      </span> GASTOS POR CONCEPTO (ABSOLUTOS, RELATIVOS, ESTRUCTURA PORCENTUAL) </font>
        </label></td>
    </tr>
    <tr>
      <td><font face="Arial, Helvetica, sans-serif"><span class="Estilo1">
        <input type="radio" name="CONSULTA" value="3" />
      </span>BALANCE DE INGRESOS, GASTOS Y DISPONIBLE </font>
        </label></td>
    </tr>
    <tr>
      <td><font face="Arial, Helvetica, sans-serif"><span class="Estilo1">
        <input type="radio" name="CONSULTA" value="5" />
      </span> LISTADO DE GASTOS POR PARTIDA CONTABLE </font>
        </label></td>
    </tr>
    <tr>
      <td><font face="Arial, Helvetica, sans-serif"><span class="Estilo1">
        <input type="radio" name="CONSULTA" value="6" />
</span> LISTADO DE CON TODA LA INFORMACI&Oacute;N GRABADA </font>
        </label></td>
    </tr>
  </table>
  <p align="center"><input name="submit" type="submit" value="REALIZAR CONSULTA SOLICITADA" />
    </p>
  </form>
</form></td>
</tr>

</table>

</font>
<?php
pie();
?>