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

$cri = "SELECT * FROM CONTROL WHERE IDTOTAL == '1'"; 
foreach ($bd->query($cri) as $MEN);

$ULTEJ = "SELECT MAX(EJERCICIO) FROM CONTROL";
foreach ($bd->query($ULTEJ) as $NULTEJ);
$ACT = max($NULTEJ);
$ANT = $ACT - 1;

$codigo_sql = "SELECT * FROM CONTROL WHERE PROFESOR == '$_COOKIE[NOMBREUSUARIOGASTOS]'"; 
foreach ($bd->query($codigo_sql) as $row);
$co="SELECT SUM(IMPORTE) AS TOTAL FROM '$ACT' WHERE PROFESOR== '$_COOKIE[NOMBREUSUARIOGASTOS]'"; 
foreach ($bd->query($co) as $T);
$co2="SELECT SUM(IMPORTE) AS TOTAL FROM '$ANT' WHERE PROFESOR== '$_COOKIE[NOMBREUSUARIOGASTOS]'"; 
foreach ($bd->query($co2) as $T2);
$codi = "SELECT * FROM CONTROL WHERE IDTOTAL == '1'"; 
foreach ($bd->query($codi) as $FECHA);
$SACT = "SALDO{$ACT}"; $SANT2 = "SALDO{$ANT}";
$SANT = $row[$SANT2] - $T2['TOTAL'];
$RESTO = $row[$SACT] - $T['TOTAL'];

?>
<style type="text/css">
<!--
.Estilo1 {
	font-size: 36px;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.Estilo2 {font-size: 24px}
.Estilo3 {
	font-size: 18px;
	font-style: italic;
}
.Estilo6 {font-size: 10px}
.Estilo13 {font-size: 14px; font-weight: bold; }
.Estilo14 {font-family: Arial, Helvetica, sans-serif}
.Estilo16 {font-family: Arial, Helvetica, sans-serif; font-size: 14px; }
.Estilo18 {font-family: Arial, Helvetica, sans-serif; font-size: 16px; }
.Estilo19 {font-size: 14px}
-->
</style>


<table width="100%" height="412" border="0" align="center" cellpadding="0" cellspacing="0">
	<!-- MSTableType="layout" -->
      <tr>
        <td  width="128" bgcolor="#FFFFCC" style="text-align: center;"><img src="../images/ugr-trp-peq.gif" width="100" height="100"></td>
        <td width="100%" bgcolor="#FFFFCC" style="text-align: center;" ><div align="right" class="Estilo6 Estilo1">
            <p align="right" class="Estilo8 Estilo2">SISTEMA AUTOMATIZADO DE CONSULTA DE GASTOS E INGRESOS</p>
            <p class="Estilo8 Estilo3"> Departamento de <?php echo $MEN['NOMBREDEPTO']; ?> </p>
        </div></td>
      </tr>
	  
	<tr>
		<td height="307" colspan="2" valign="top" bordercolor="#009900">
		
		<div align="center">
		  <p><strong><font face="Arial, Helvetica, sans-serif"><strong><font color="#990000" size="1"
        face="Arial"><img src="../images/new.gif"
        width="45" height="12" border="0" /></font></strong> <?php echo  "<align='center'>" . $MEN['MENSAJE1']; ?></font></strong><font face="Arial, Helvetica, sans-serif"><strong><font color="#990000" size="1"
        face="Arial"><img src="../images/new.gif"
        width="45" height="12" border="0" /></font></strong></font></p>
		  </div>

		<table width="804" align="center">
          <tr>
            <td colspan="5" bgcolor="#FFFFCC"><div align="left"><span class="Estilo18">PROFESOR: <?php echo  "<align='center'>" . $_COOKIE['NOMBREUSUARIOGASTOS']; ?></span></div></td>
          </tr>
          <tr>
            <td bgcolor="#CBE2E4"><div align="center" class="Estilo14"><span class="Estilo13">SALDO AÑO ANTERIOR (<?php echo  "<align='center'>" . $ANT; ?>) </span></div></td>
            <td bgcolor="#CBE2E4"><div align="center" class="Estilo14"><span class="Estilo13">ASIGNACIÓN ANUAL </span></div></td>
            <td bgcolor="#CBE2E4"><div align="center" class="Estilo14"><span class="Estilo13">DISPONIBLE AÑO ACTUAL (<?php echo  "<align='center'>" . $ACT; ?>) </span></div></td>
            <td bgcolor="#CBE2E4"><div align="center" class="Estilo14"><span class="Estilo13">GASTO ACUMULADO </span></div></td>
            <td bgcolor="#CBE2E4"><div align="center" class="Estilo14"><span class="Estilo13">SALDO DISPONIBLE </span></div></td>
          </tr>
          <tr>
            <td bgcolor="#CBE2E4"><div align="center" class="Estilo19"><?php echo  "<align='center'>" . $SANT; ?></div></td>
            <td bgcolor="#CBE2E4"><div align="center" class="Estilo19"><?php echo  "<align='center'>" . $row['LIMITE'] ; ?></div></td>
            <td bgcolor="#CBE2E4"><div align="center" class="Estilo19"><?php echo  "<align='center'>" . $row[$SACT] ; ?></div></td>
            <td bgcolor="#CBE2E4"><div align="center" class="Estilo19"><?php echo  "<align='center'>" . $T['TOTAL'] ; ?></div></td>
            <td bgcolor="#CBE2E4"><div align="center" class="Estilo19"><?php echo  "<align='center'>" . $RESTO ; ?></div></td>
          </tr>
          <tr>
            <td colspan="5" bgcolor="#FFFFCC"><span class="Estilo16">FECHA DE LA ÚLTIMA ACTUALIZACIÓN: <?php echo  "<align='center'>" . $FECHA['FECHAACT'] ; ?></span></td>
          </tr>
        </table>
		<p align="left"><font face="Arial, Helvetica, sans-serif"><strong>En esta p&aacute;gina usted podr&aacute; hacer lo siguiente </strong>:</font></p>
		<ul>
          <li><font face="Arial, Helvetica, sans-serif">Consultar toda la normativa sobre presupuesto aprobada por el Consejo de Departemento y la Junta de Dirección.</font></li>
			<li><font face="Arial, Helvetica, sans-serif">Realizar consultas por ejercicios, tipo de gasto, profesor, etc.</font> <font face="Arial, Helvetica, sans-serif"><strong><font color="#990000" size="1"
        face="Arial"><a href="new.gif"></a></font></strong></font></li>
			<li><font face="Arial, Helvetica, sans-serif">Consultar el detalle de sus propios gastos, con indicación del saldo disponible hasta el último trimestre disponible. </font></li>
			<li><font face="Arial, Helvetica, sans-serif">Contactar con el administrador del sistema.</font></li>
		    <li><font face="Arial, Helvetica, sans-serif">Consultar los informes de gasto aprobados por Consejo de Departamento.</font></li>
      </ul>	  </td>
    </tr>
</table>

</body>

</html>
<?php
pie();
?>