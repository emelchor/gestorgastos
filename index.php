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
.Estilo1 {font-weight: bold}
.Estilo9 {font-size: 30px}
-->
</style>
<body>
<form action="control.php" method="POST">
<div style="width: 100%; margin: 0px auto; background-color: #FFF;">
  <div align="center">
    <table style="width: 100%; margin: 0px auto 5px auto;" class="simple">
      <tr>
        <td  width="115" bgcolor="#FFFFCC" style="text-align: center;"><img src="ugr-trp-peq.gif" width="105" height="106"></td>
        <td width="831" bgcolor="#FFFFCC" style="text-align: center;" ><div align="right" class="Estilo6">
            <p class="Estilo4">Departamento de <?php echo $VER['NOMBREDEPTO'];?> </p>
        </div></td>
      </tr>

      <tbody>
        <tr>
          <td colspan="2" bgcolor="#FFCC66" style="text-align: left;"><div align="center" class="Estilo9"><span class="Estilo4">Acceso Restringido </span></div></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div align="center" id='contentwide'>
    <div align='center' style='width:70%; margin-left: 0px;'><div align="center"><fieldset>
      <table align="center" width="444" cellspacing="2" cellpadding="2" border="0">
            <tr>
              <td colspan="2" align="center"
<?if ($_GET["errorusuario"]=="si"){?>
bgcolor=red><span class="Estilo4" style="color:ffffff"><b>Datos incorrectos</b></span>
                  <span class="Estilo4">
<?}else{?>
<?if ($_GET["errorusuario"]=="noexiste"){?>
bgcolor=red><span class="Estilo4" style="color:ffffff"><b>No se encuentra registrado como usuario</b></span>
                  <span class="Estilo4">
<?}else{?>
<?if ($_GET["errorusuario"]=="blanco"){?>
bgcolor=red><span class="Estilo4" style="color:ffffff"><b>Debe completar todos los campos</b></span>
                  <span class="Estilo4">
<?}else{?>

bgcolor=#cccccc><strong>Introduzca su clave de acceso</strong>
<?}?>
<?}?>
<?}?>
                </span></td>
            </tr>
            <tr>
              <td width="302" align="right"><span class="Estilo4">Usuario:</span></td>
              <td width="128"><input type="Text" name="usuario" size="20" maxlength="50"></td>
            </tr>
            <tr>
              <td align="right"><span class="Estilo4">Contrase&ntilde;a:</span></td>
              <td><input type="password" name="contrasena" size="15" maxlength="15"></td>
            </tr>
            <tr>
              <td colspan="2" align="center"><input name="Submit" type="Submit" value="ACCEDER AL SISTEMA"></td>
            </tr>
                  </table>

      </fieldset>
      <div align="center"></div>
    </div>
  </div>
  <div class="clear"></div>
</div>
<p align="center"><a href="formulario-password.php" class="Estilo4"><strong>&iquest;Olvid&oacute; su contrase&ntilde;a o a&uacute;n no dispone de ella?</strong></a></p>
<div align="center"></div>

</body>
</html> 
<?php
print '</div><div id="pie"><address>Departamento de ' . $VER['NOMBREDEPTO'] . '. ' . $VER['DIRECCIONDEPTO'] . '<br />';
print utf8_encode('<small>Desarrollo y diseño web: © Elías Melchor Ferrer.</small></address></div></body></html>');
?>