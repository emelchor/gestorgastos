<?php
include('funciones.php');
cabecera('INGRESOS', CABECERA_SIN_CURSOR);
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
?>
<style type="text/css">
<!--
.Estilo1 {font-size: 3}
.Estilo2 {font-size: 3px}
.Estilo3 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo4 {
	font-size: 3px;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>


<td><table WIDTH="895" align="center" >
<tr>
<td width="887" height="164" ALIGN=left valign="top"><div align="center"></div>
  <form ACTION="ingresos.php" METHOD="POST">
  <p align="center" class="Estilo3">PASO 1/2 SELECCIONE EL EJERCICIO PARA EL QUE DESEA INTRODUCIR INFORMACI&Oacute;N</p>
  <p align="center" class="Estilo3">     <? echo $EJER; ?></p>
  
    <table width="884">
          
          <tr>
            <td height="36"><p align="center"><font face="Arial, Helvetica, sans-serif">
              <input name="submit" type="submit" value="PASO 2/2 GRABAR INFORMACION DE INGRESOS" />
                </font></p>              </td>
          </tr>
          </table>

    </form>
  </td>
</tr>
</table>

</font>
<?php
pie();
?>