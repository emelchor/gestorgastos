<?php
include('funciones.php');
print "<?xml version=\"1.0\" encoding=\"utf-8\"?".">
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//ES\"
       \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
  <title>Gestor de gastos</title>
<link href=\"estilobase.css\"; rel=\"stylesheet\" type=\"text/css\" />
<link rel=\"shortcut icon\" href=\"favicon.ico\" type=\"image/x-icon\" />
</head>
\n\n";
$bd = conectaDb();
$codigo1_sql = "SELECT * FROM CONTROL where IDTOTAL == 1";
foreach ($bd->query($codigo1_sql) as $VER);
?>
</head>
<style type="text/css">
<!--
.Estilo4 {font-family: Arial, Helvetica, sans-serif}
.Estilo6 {
	font-weight: bold;
	font-size: 30px;
}
.Estilo9 {font-size: 30px}
-->
</style>
<body>
<form action="password.php" method="POST">
<div style="width: 100%; margin: 0px auto; background-color: #FFF;">
  <div align="center">
    <table style="width: 100%; margin: 0px auto 5px auto;" class="simple">
      <tr>
        <td  width="115" bgcolor="#FFFFCC" style="text-align: center;"><img src="ugr-trp-peq.gif" width="105" height="106"></td>
        <td width="831" bgcolor="#FFFFCC" style="text-align: center;" ><div align="right" class="Estilo6">
            <p class="Estilo4">Departamento de <?php echo $VER['NOMBREDEPTO']; ?> </p>
        </div></td>
      </tr>      <tbody>
        <tr>
          <td colspan="2" bgcolor="#FFCC66" style="text-align: left;"><div align="center" class="Estilo9"><span class="Estilo4">Solicitud de contrase&ntilde;a  </span></div></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div align="center" id='contentwide'>
    <div align='center' class="Estilo4 Estilo2" style='border: 3px solid #090; color:#339900; margin: 30px 20px 10px 20px;'> <strong>Introduzca su direcci&oacute;n de correo el&eacute;ctr&oacute;nico, recibir&aacute; un mensaje con la contrase&ntilde;a almacenada en el servidor. </strong><strong>Si lo desea, una vez haya accedido al sistema podr&aacute; cambiarla </strong></div>
    <div align='center' style='width:70%; margin: 20px 20px 20px 20px;'><div align="center"><fieldset>
      <table align="center" width="444" cellspacing="2" cellpadding="2" border="0">
            
            <tr>
              <td width="302" align="right"><span class="Estilo4">Usuario (direcci&oacute;n de email):</span></td>
              <td width="128"><input type="Text" name="usuario" size="20" maxlength="50"></td>
            </tr>
            <tr>
              <td colspan="2" align="center"><input name="Submit" type="Submit" value="REALIZAR LA CONSULTA SOLICITADA"></td>
            </tr>
      </table>

      </fieldset>
      <div align="center"></div>
    </div>
  </div>
  <div class="clear"></div>
</div>
</body>
</html> 
<?php
print '</div><div id="pie"><address>Departamento de ' . $VER['NOMBREDEPTO'] . '. ' . $VER['DIRECCIONDEPTO'] . '<br />';
print utf8_encode('<small>Desarrollo y diseño web: © Elías Melchor Ferrer.</small></address></div></body></html>');
?>