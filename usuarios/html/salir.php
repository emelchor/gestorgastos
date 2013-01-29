<?php
setcookie('autentificadogastos', '', time() -3600);
setcookie('NOMBREUSUARIOGASTOS', '', time() -3600);
setcookie('CORREOUSUARIOGASTOS', '', time() -3600);
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
?>
</head>
<style type="text/css">
<!--
.Estilo4 {font-family: Arial, Helvetica, sans-serif}
.Estilo6 {font-weight: bold}
.Estilo1 {font-weight: bold}
.Estilo8 {font-family: Arial, Helvetica, sans-serif; font-size: 36px; }
-->
</style>
<body>
<form action="control.php" method="POST">
<div style="width: 100%; margin: 0px auto; background-color: #FFF;">
  <div align="center">
    <table style="width: 100%; margin: 0px auto 5px auto;" class="simple">
      <tr>
        <td  width="115" bgcolor="#FFFFCC" style="text-align: center;"><img src="../images/ugr-trp-peq.gif" width="105" height="106"></td>
        <td width="831" bgcolor="#FFFFCC" style="text-align: center;" ><div align="right" class="Estilo6">
            <p class="Estilo8">Departamento de Econom&iacute;a Internacional y de Espa&ntilde;a </p>
        </div></td>
      </tr>
      <tbody>
        <tr>
          <td colspan="2" bgcolor="#FFCC66" style="text-align: left;"><div align="center"><span class="Estilo8">Desconexi&oacute;n del Sistema </span></div></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div align="center" id='contentwide'>
    <h1 align='center' class="Estilo1 Estilo4">&nbsp;</h1>
    <div align='center' style='width:70%; margin-left: 0px;'><div align="center"><fieldset>
      <table align="center" width="444" cellspacing="2" cellpadding="2" border="0">
            <tr>
              <td align="right">&nbsp;</td>
            </tr>
            <tr>
              <td align="right"><div align="center" class="Estilo4"><strong>HA FINALIZADO LA SESI&Oacute;N </strong></div></td>
            </tr>
            <tr>
              <td align="right"><span class="Estilo4"></span></td>
            </tr>
            <tr>
              <td align="right"><div align="center" class="Estilo4"><strong>GRACIAS POR SU VISITA </strong></div></td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
            </tr>
      </table>

      </fieldset>
      <div align="center"></div>
    </div>
  </div>
  <div class="clear"></div>
</div>
<p align="center"><a href="../../index.php" class="Estilo4"><strong>Volver a conectarse </strong></a></p>
<div align="center"></div>

</body>
</html> 
<?php
pie();
?>