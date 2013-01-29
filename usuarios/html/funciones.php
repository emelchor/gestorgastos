<?php

define('TAM_DNI',     10);  // Tamaño del campo DNI
define('TAM_NOMBRE',  40);  // Tamaño del campo Apellidos
define('TAM_CORREO',  25);  // Tamaño del campo Correo
define('TAM_CLAVE',   10);  // Tamaño del campo CLAVE
define('CABECERA_CON_CURSOR',    TRUE);   // Para función cabecera()           
define('CABECERA_SIN_CURSOR',    FALSE);  // Para función cabecera()
define('FORM_METHOD',            'post'); // Formularios se envían con POST
define('SQLITE',         'SQLite');
?>

<?php
$dbMotor = SQLITE;             				
$dbDb     = '../../GASTOS.sqlite';  	// Nombre de la base de datos

function conectaDb()
{
    global $dbMotor, $dbDb; 
    try {
        $bd = new PDO('sqlite:'.$dbDb);
        return($bd);
    } catch (PDOException $e) {
        print "<p>Error: No puede conectarse con la base de datos.</p>\n";
        print "<p>Error: " . $e->getMessage() . "</p>\n";
        pie();
        exit();
    }
}

function recorta($campo, $cadena)
{
    global $recorta;

    $tmp = isset($recorta[$campo]) ? substr($cadena, 0, $recorta[$campo]) : $cadena; 
    return $tmp;
}

function recogeParaConsulta($db, $var, $var2='') 
{
    $tmp = (isset($_REQUEST[$var]) && ($_REQUEST[$var]!='')) ?
        trim(strip_tags($_REQUEST[$var])) : trim(strip_tags($var2));
    if (get_magic_quotes_gpc()) {
        $tmp = stripslashes($tmp);
    }
    $tmp = str_replace('&', '&amp;',  $tmp);
    $tmp = str_replace('"', '&quot;', $tmp);
    $tmp = recorta($var, $tmp);
    if (!is_numeric($tmp)) {
        $tmp = $db->quote($tmp);
    }
    return $tmp;
}

function recogeMatrizParaConsulta($db, $var) 
{
    $tmpMatriz = array();
    if (isset($_REQUEST[$var]) && is_array($_REQUEST[$var])) {
        foreach ($_REQUEST[$var] as $indice => $valor) {
            $tmp = trim(strip_tags($indice));
            if (get_magic_quotes_gpc()) {
                $tmp = stripslashes($tmp);
            }
            $tmp = str_replace('&', '&amp;',  $tmp);
            $tmp = str_replace('"', '&quot;', $tmp);
            $tmp = recorta($var, $tmp);
            if (!is_numeric($tmp)) {
                $tmp = $db->quote($tmp);
            }
            $indiceLimpio = $tmp;

            $tmp = trim(strip_tags($valor));
            if (get_magic_quotes_gpc()) {
                $tmp = stripslashes($tmp);
            }
            $tmp = str_replace('&', '&amp;',  $tmp);
            $tmp = str_replace('"', '&quot;', $tmp);
            $tmp = recorta($var, $tmp);
            if (!is_numeric($tmp)) {
                $tmp = $db->quote($tmp);
            }
            $valorLimpio  = $tmp;

            $tmpMatriz[$indiceLimpio] = $valorLimpio;
        }
    }
    return $tmpMatriz;
}

function quitaComillasExteriores($var)
{
    if (is_string($var)) {
        if (isset($var[0]) && ($var[0]=="'")) {
            $var = substr($var, 1, strlen($var)-1); 
        }
        if (isset($var[strlen($var)-1]) && ($var[strlen($var)-1]=="'")) {
            $var = substr($var, 0, strlen($var)-1); 
        }
    }
    return $var;
}

function cabecera() 
{
print "<?xml version=\"1.0\" encoding=\"utf-8\"?".">
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//ES\"
       \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
  <title>Gestor de gastos</title>
<link href=\"estilobase.css\"; rel=\"stylesheet\" type=\"text/css\" />
<link rel=\"shortcut icon\" href=\"../images/favicon.ico\" type=\"image/x-icon\" />
</head>\n\n
<body>
<ul id=\"nav\">
	<li class=\"top\"><a href=\"inicio.php\" class=\"top_link\"><span>Inicio</span></a></li>
	<li class=\"top\"><a href=\"clave.php\" class=\"top_link\"><span>Modificar mis datos</span></a></li>
	<li class=\"top\"><a href=\"formulario-consultas.php\" class=\"top_link\"><span>Consultas</span></a></li>
	<li class=\"top\"><a href=\"formulario-informes.php\" class=\"top_link\"><span>Informes</span></a></li>
	<li class=\"top\"><a href=\"normativa.php\" class=\"top_link\"><span>Normativa</span></a></li>
	<li class=\"top\"><a href=\"formulario-correo.php\" class=\"top_link\"><span>Contacto</span></a></li>
    <li class=\"top\">  <strong>    Usuario: $_COOKIE[NOMBREUSUARIOGASTOS]</strong></li>
	<li class=\"top\">  <a href=\"../../salir.php\"><img border=\"0\" src=\"../images/cerrar-sesion-icono.png\" width=\"30\" height=\"30\" ></a></li>
	</ul>  
</div>\n\n<div id=\"contenido\">\n";
}

function pie() 
{
$bd = conectaDb();
$codigok_sql = "SELECT * FROM CONTROL where IDTOTAL == '1'";
foreach ($bd->query($codigok_sql) as $VERK);
print '</div><div id="pie"><address>Departamento de ' . $VERK['NOMBREDEPTO'] . '. ' . $VERK['DIRECCIONDEPTO'] . '<br />';
print '<small>Desarrollo y diseño web: © Elías Melchor Ferrer.</small></address>';
print '<p class="licencia">
<i><small>La información facilitada puede no estar exenta de algún error u omisión, si lo detecta no dude en contactar con el administrador.</small></i>
</div></body></html>';
}
?>