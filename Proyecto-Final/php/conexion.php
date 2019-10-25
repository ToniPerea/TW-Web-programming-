<?php


require_once('pref.php');


// Conexion a la base de datos
function conectDB() {
    //$db = mysqli_connect($db_host, $db_user, $db_pass, $db_database, $db_port);
    $db = new mysqli(DBHOST,DBUSER,DBPASS,DBSCHEM,3306);
    if (!$db) {
        echo "<p>Error de conexión</p>";
        echo "<p>Código: ".mysqli_connect_errno()."</p>";
        echo "<p>Mensaje: ".mysqli_connect_error()."</p>";
        return false;
    }

    //echo "Éxito: La conexión a la base de datos se realizó correctamente" . PHP_EOL;
    //echo "Información del host: " . mysqli_get_host_info($db) . PHP_EOL;
    
    
    mysqli_set_charset($db,"utf8"); // colation mysql
    return $db;
}


// Desconexión de la base de datos Mysql
function disconectDB($db) {
    mysqli_close($db);
}


?>