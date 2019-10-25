<?php

require_once 'conexion.php'; 



// Funcion de logueo
function login(){
    $db = conectDB();
    echo $_POST["usuario"];
    $ps=password_hash($_POST['pass'], PASSWORD_DEFAULT);

    $res = $db->query("select * from Usuarios where `email`='{$_POST["usuario"]}' ");

    $r = $res->fetch_array(MYSQLI_NUM);
    

    if ($res->num_rows > 0 && password_verify($_POST['pass'], $r[2])) {

        $_SESSION["userid"]         = $r[0];
        $_SESSION["usuario"]        = $r[1];
        $_SESSION["pass"]           = $_POST["pass"];
        $_SESSION["nombre"]         = $r[3];
        $_SESSION["apellidos"]      = $r[4];
        $_SESSION["dir_postal"]     = $r[5];
        $_SESSION["telefono"]       = $r[6];
        $_SESSION["is_active"]      = $r[7];
        $_SESSION["is_admin"]       = $r[8];
        $_SESSION["foto"]           = $r[9];



    }

    $text="[INFO] Ha iniciado en el sistema el usuario: ".$_SESSION["usuario"];
    
    $db->query("INSERT INTO LOG (fecha, concepto) VALUES ( NOW(),'{$text}')");
    
    disconectDB($db);


    
    
}


function mostrarError($masInfo) {
    echo <<< HTML
    <h1>Error</h1>
    <hr>
    <p>$masInfo</p>
HTML;

}


function register(){
    $db = conectDB();
    echo 'Los datos obtenidos en el post son:';
    $no = $_POST["nombre"];
    $ap = $_POST["apellidos"];
    $em = $_POST["email"];


    $archivo = $_FILES["archivito"]["tmp_name"]; 
    $tamanio = $_FILES["archivito"]["size"];
    $tipo    = $_FILES["archivito"]["type"];
    $nombre  = $_FILES["archivito"]["name"];

   
    if($_POST['clavePrimera']!=$_POST['claveSegunda']){
        
        mostrarError("Las claves no coinciden");
       

    }else{

        $photo = '';
        $cl = password_hash($_POST['clavePrimera'], PASSWORD_DEFAULT);
        $di = $_POST["direccion"];
        $tl = $_POST["tlf"];
        $admin = 0;
        $active = 1;

        if ($archivo != "none") {
            $fp = fopen($archivo, "rb");
            $contenidoImagen = fread($fp, $tamanio);
            $photo = addslashes($contenidoImagen);
            fclose($fp);
        }
    
       
       
    
    
        $q = "INSERT INTO Usuarios VALUES (NULL,'{$em}','{$cl}' ,'{$no}','{$ap}','{$di}','{$tl}','{$active}', '{$admin}','{$photo}'  )";
        $db->query($q);
        if ($db) {
            echo 'La inserción se realizó correctamente';
            echo $db->error;
        }else{
            echo 'La inserción a la base de datos falló';
            echo $db->error;
        }
    
    }

    $text="[INFO] Se ha registrado en el sistema el usuario: ".$em;
    
    $db->query("INSERT INTO LOG (fecha, concepto) VALUES ( NOW(),'{$text}')");
    


    disconectDB($db);

    
}


function logout(){
    if(isset($_SESSION["usuario"]) && $_SESSION["pass"]){
        $db = conectDB();
        $text="[INFO] Se ha salido del sistema el usuario: ".$_SESSION["usuario"];
        $db->query("INSERT INTO LOG (fecha, concepto) VALUES ( NOW(),'{$text}')");
        $_SESSION = array();
        disconectDB($db);
        header('Location: '.'index.php');


    }
}





function mostrarIncidencias(){
    echo('
    
    <main>
    <ul class="collection">
        <li class="collection-header"><h4>Listado de Incidencias</h4></li>
        <li class="collection-item avatar">
            <img src="./images/img.png" alt="" class="circle">
            <span class="title">Title</span>
            <p>First Line <br>
                Second Line
            </p>
            <a href="#!" class="secondary-content"><i class="material-icons">announcement</i></a>
        </li>

    </ul>
</main>
    
    ');
}




function actualizarPerfil(){
    $usuario    = $_SESSION["usuario"]      = $_POST["email"];
    $pass       = $_SESSION["pass"]         = password_hash($_POST['clavePrimera'], PASSWORD_DEFAULT);
    $nombre     = $_SESSION["nombre"]       = $_POST["nombre"];
    $apellidos  = $_SESSION["apellidos"]    = $_POST["apellidos"];
    $dir_postal = $_SESSION["dir_postal"]   = $_POST["direccion"];
    $telefono   = $_SESSION["telefono"]     =  $_POST["tlf"];
    $is_active  = $_SESSION["is_active"]    = $_SESSION["is_active"];
    $is_admin   = $_SESSION["is_admin"]     = $_SESSION["is_admin"];
  
  
    $archivo = $_FILES["archivito"]["tmp_name"]; 
    $tamanio = $_FILES["archivito"]["size"];
    $tipo    = $_FILES["archivito"]["type"];
    

    $photo = $_SESSION["foto"];
    if ($archivo != "none") {
        $fp = fopen($archivo, "rb");
        $contenidoImagen = fread($fp, $tamanio);
        $photo = addslashes($contenidoImagen);
        fclose($fp);
    }
    
  
  
    $db = conectDB();

    $queryUpdateProfile="UPDATE Usuarios SET email = '{$usuario}', pass = '{$pass}', nombre = '{$nombre}', apellidos = '{$apellidos}', direccionPostal = '{$dir_postal}', telefono = '{$telefono}', activo = '{$is_active}',administrador = '{$is_admin}',photo = '{$photo}' WHERE user_id = '{$_SESSION["userid"]}'";
   
    $res = $db->query($queryUpdateProfile);

    $res = $db->query("select * from Usuarios where `email`='{$_POST["usuario"]}' ");

    $r = $res->fetch_array(MYSQLI_NUM);

    $_SESSION["foto"] = $r[9];




    $text="[INFO] Se ha actualizado el usuario: ".$_SESSION["usuario"];
    $db->query("INSERT INTO LOG (fecha, concepto) VALUES ( NOW(),'{$text}')");


    header('Location: '.'index.php');
    
    disconectDB($db);
  
  }


?>


