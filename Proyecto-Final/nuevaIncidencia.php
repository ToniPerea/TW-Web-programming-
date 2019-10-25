<?php
require_once 'php/generics.php';
require_once 'php/conexion.php';
require_once 'php/login.php';
require_once 'php/footer.php';
require_once 'php/formulario.php';
require_once 'php/descripcion.php';

require_once 'php/navbar.php';
require_once 'php/header.php';
require_once 'php/panelLogin.php';
require_once 'php/panelYaLogueado.php';

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_GET['p'])) {
    switch ($_GET['p']) {
      case 'add':
        meterIncidencia();

        unset($_GET['p']);
        break;
    }
    
}

function meterIncidencia(){
    $db = conectDB();
    $titulo = $_POST["titulo"];
    $lugar =$_POST["lugar"];
    $nombre =$_POST["nombre"];
    $pclave =$_POST["pclave"];
    $estado =(int)$_POST["estado"];

    $descripcion =$_POST["descripcion"];
    echo($descripcion);

    echo("Email: ");
    $email = $_SESSION["usuario"];


    $archivo = $_FILES["archivito2"]["tmp_name"]; 
    $tamanio = $_FILES["archivito2"]["size"];
    $tipo    = $_FILES["archivito2"]["type"];
    



    $photo = 'https://upload.wikimedia.org/wikipedia/commons/4/44/Pilar_Aranda_Ram%C3%ADrez.jpg';
    if ($archivo != "none") {
        $fp = fopen($archivo, "rb");
        $contenidoImagen = fread($fp, $tamanio);
        $photo = addslashes($contenidoImagen);
        fclose($fp);
    }

    

    $queryInsert="INSERT INTO `Incidencias` (`titulo`,`lugar`,`descripcion`,`palabrasClave`,`photo`,`fechaInclusion`,`email`,`estado`) VALUES ('{$titulo}','{$lugar}','{$descripcion}', '{$pclave}', '{$photo}', NOW(),'{$email}' ,$estado)";
    $queryID= "SELECT `incidencia_id` from `Incidencias` WHERE titulo='{$titulo}' and email='{$email}'";

    
    $db->query($queryInsert);

    $res = $db->query($queryID);

 
    $r = $res->fetch_array(MYSQLI_NUM);

    if ($db) {

        $text="[INFO] Se ha añadido una incidencia al sistema: por parte del usuario ".$email;
        $db->query("INSERT INTO LOG (fecha, concepto) VALUES ( NOW(),'{$text}')");
        header('Location: '.'incidencia.php?p=mostrar&id='.$r[0]);

        
    }
    
    disconectDB($db);
}

function addIncidencia(){

    $db = conectDB();
    $queryIDNuevo= "SELECT auto_increment '.' FROM INFORMATION_SCHEMA.TABLES WHERE table_name='Incidencias'";



    $res = $db->query($queryIDNuevo);
    $r = $res->fetch_array(MYSQLI_NUM);

    $_SESSION["newid"] = $r[0];

    echo('
    <div class="section container">
    <div class="row center">
    <h2>Nueva Incidencia</h2>
    </div>
        <div class="row card"></div>
        <form enctype="multipart/form-data" action="nuevaIncidencia.php?p=add" method="post">

        <div class="col s12 card">
            <div class="input-field col s9">
                <input type="text" placeholder="Titulo de la Incidencia" id="titulo" class="validate" name="titulo" required>
                <label for="titulo"></label>
            </div>
        </div>

        <div class="row card">
            <div class="col s4">
                <input type="text" placeholder="Introduzca el lugar" id="lugar" class="validate" name="lugar" required>
                <label for="lugar"></label>
            </div>

        </div>

        <div class="row card">
            <div class="col s4">
                <input type="text" placeholder="Introduzca una o varias palabras clave" id="clave" name="pclave" class="validate"
                    required>
                <label for="clave"></label>
            </div>
            <div class="col s4">
                <input type="text" placeholder="Negativo = 0, Positivo = 1" id="estado" class="validate" name="estado" required>
                <label for="estado"></label>
            </div>

        </div>

        <p class="card">
            <input type="text" placeholder="Introduzca una descripción del incidente" id="descripcion" name="descripcion" class="validate"
                required>
            <label for="descripcion"></label>
        </p>

        <div class="row card">
            







                <div class="col s10">
                    <span class="black-text">
                        <input type="file" name="archivito2"></input>    
                    </span>
                </div>

            <button class="btn" type="submit">Añadir Incidencia</button>
            </form>
        </div>

</div>


    ');

    disconectDB($db);
}







initHTML();
mostrarHeader();

mostrarNavBar();

initBody();

addIncidencia();

      
      
endBody();

mostrarFooter();

endHTML();


?>


