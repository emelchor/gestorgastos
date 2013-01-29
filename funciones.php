<?php
define('FORM_METHOD',            'post'); // Formularios se envían con POST
define('SQLITE',         'SQLite');
$dbMotor = SQLITE;             				
$dbDb     = 'GASTOS.sqlite';  	// Nombre de la base de datos
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
?>