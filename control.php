<?php
ini_set("session.use_cookies", 1);
ini_set("session.use_only_cookies", 1);
if (empty($_POST['usuario']) || empty($_POST['contrasena'])){
header("Location: index.php?errorusuario=blanco");
} else {
include('funciones.php');
$bd = conectaDb();
$USU = $_POST['usuario'];
$codigo1_sql = "SELECT * FROM CONTROL where CORREO == '$USU'";
foreach ($bd->query($codigo1_sql) as $VER);
if ($_POST['usuario']!==$VER['CORREO']){
    header("Location: index.php?errorusuario=noexiste");
} elseif ($_POST['usuario']==$VER['CORREO'] && $_POST['contrasena']==$VER['CLAVE']){
    session_regenerate_id(true);
	setcookie('autentificadogastos', 1, time()+3600);
	setcookie('NOMBREUSUARIOGASTOS', $VER['PROFESOR'], time()+3600);
	setcookie('CORREOUSUARIOGASTOS', $VER['CORREO'], time()+3600);
    header ("Location: usuarios/html/inicio.php");
} else {
    header("Location: index.php?errorusuario=si");
}
}
$bd = NULL;
?> 