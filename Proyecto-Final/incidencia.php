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

$action='mostrar';
$incidencia=1;

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_GET["p"])) {
    if (isset($_GET["id"])) {
        switch ($_GET["p"]) {
            case 'addComentario':

            $incidencia=$_GET["id"];
            addComentario($incidencia);
            break;
            
            case 'mostrar':
            $action='mostrar';
            $incidencia=$_GET["id"];
            break;

            case 'actualizarValoracionPositiva':
                $incidencia=$_GET["id"];
                sumarVotos($incidencia,1);
            break;


            case 'actualizarValoracionNegativa':
                $incidencia=$_GET["id"];
                sumarVotos($incidencia,0);
            break;
        }
    }
}


function sumarVotos($incidencia,$valor){
    $db = conectDB();

    $email = "";



    

    if(!isset($_SESSION["usuario"])){
        $queryInsert = "INSERT INTO Valoraciones (incidencia_id, email, calificacion) VALUES('{$incidencia}', '{$email}', '{$valor}')";
        $db->query($queryInsert);


    }else{
        $queryObtenerUserValor = "select * from Valoraciones where email='{$email}' and incidencia_id='{$incidencia}' ";
        
        $res = $db->query($queryObtenerUserValor);
        
        $row = $res->fetch_array(MYSQLI_NUM);

        if ($res->num_rows  < 1 ) {
            $queryInsert = "INSERT INTO Valoraciones (incidencia_id, email, calificacion) VALUES('{$incidencia}', '{$email}', '{$valor}')";
            $db->query($queryInsert);

        }
       
    }
    
    

    disconectDB($db);
}




function mostrarFormularioAddComentario(){

    echo('
        <div class="setion container">
            <h2 class = "center">Añadir Comentario</h2>
        
        
            <form action="incidencia.php?p=addComentario&id='.$_GET["id"].'"  method="post">
        
  

            <div class="row">
                <div class="col s12 card">
                    <input type="text" name="comentario" placeholder="Introduzca su comentario" id="comentario" class="validate" required>
                    <label for="comentario"></label>
                </div>
            
                <div class="input-field col s12">
                    <button class="btn" type="submit">Publicar Comentario</button>
                </div>
            </div>
        

            </form>
        </div>
        </div>


        ');
}


function addComentario($idIncidencia){
    $db = conectDB();

    !isset($_SESSION["usuario"])?$email=NULL:$email=$_SESSION["usuario"];
    $comentario = $_POST["comentario"];


    

    $queryInsertComentario= $db->query("INSERT INTO `Comentarios` (`incidencia_id`,`email`,`comentario`,`fechaInclusion`) VALUES ('{$idIncidencia}','{$email}', '{$comentario}', NOW() )");


    $text="[INFO] Se ha añadido un comentario a: ".$idIncidencia." por parte del usuario ".$email;
    $db->query("INSERT INTO LOG (fecha, concepto) VALUES ( NOW(),'{$text}')");
    //header('Location: '.'incidencia.php?p=mostrar&id='.$idIncidencia);


    disconectDB($db);
}

function getIncidencia($idIncidencia){
    $db = conectDB();

    $valPositivasResult = $db->query("select count(*) from Valoraciones where incidencia_id=".$idIncidencia." and calificacion=1");
    $valNegativasResult = $db->query("select count(*) from Valoraciones where incidencia_id=".$idIncidencia." and calificacion=0");

    

    $pos = $valPositivasResult->fetch_array(MYSQLI_NUM);
    $neg = $valNegativasResult->fetch_array(MYSQLI_NUM);

    $valPositivas=$pos[0];
    $valNegativas=$neg[0];


    $res = $db->query("select * from Incidencias where incidencia_id=".$idIncidencia);
    $r = $res->fetch_array(MYSQLI_NUM);

    if ($res->num_rows > 0) {
        $id_incidencia      = $r[0];
        $titulo_incidencia  = $r[1];
        $lugar_incidencia   = $r[2];
        $descripcion        = $r[3];
        $palabrasClave      = $r[4];
        $photo              = $r[5];
        $fechaInclusion     = $r[6];
        $email              = $r[7];
        $estado_incidencia  = ($r[8]==1)?'Valido':'Invalido';


        echo('
            <div class="setion container">
                <h2 class = "center">Incidencia</h2>

            <div class="col s12 card">
                <p class="blue ">
                '.$titulo_incidencia.'
                </p>
            </div>

            <div class="row card">
                <div class="col s4">
                    <p>Lugar:
                    '.$lugar_incidencia.'
                    </p>
                </div>
                <div class="col s4">
                    <p>Fecha:
                    '.$fechaInclusion.'
                    </p>
                </div>
                <div class="col s4">
                    <p>Creado por:
                        '.$email.'
                    </p>
                </div>
            </div>

            <div class="row card">
                <div class="col s4">
                    <p>Palabras clave:
                    '.$palabrasClave.'
                    </p>
                </div>
                <div class="col s4">
                    <p>Estado:'.$estado_incidencia.'</p>
                </div>
                <div class="col s4">
                    <p>Valoraciones Positivas: '.$valPositivas.'<a href="incidencia.php?p=actualizarValoracionPositiva&id='.$idIncidencia.'" class="secondary-content"><i class="material-icons">add</i></a></p> 
                    <p>Valoraciones Negativas: '.$valNegativas.'<a href="incidencia.php?p=actualizarValoracionNegativa&id='.$idIncidencia.'" class="secondary-content"><i class="material-icons">remove</i></a></p>
                </div>
            </div>


        

            <p class="card">'.$descripcion.'</p> <div class="row card">');
        echo('<img width="150px" class=" responsive-img center" src="data:image/jpeg;base64,'.base64_encode($photo).'"/>');
        
        echo('</div> </div> </div>');


        getComentarios($idIncidencia);
        mostrarFormularioAddComentario();

        $text="[INFO] Se mostrado la incidencia: ".$idIncidencia." por parte del usuario ".$email;
        $db->query("INSERT INTO LOG (fecha, concepto) VALUES ( NOW(),'{$text}')");





        disconectDB($db);
    }
}

function getComentarios($idIncidencia){

    echo('<div class="setion container"> <h2 class = "center">Comentarios</h2>');

    $db = conectDB();

    $res = $db->query("select * from Comentarios WHERE incidencia_id='{$idIncidencia}'");
    while ($row = $res->fetch_array(MYSQLI_NUM)) {
        

        $email="Anonimo";
        if($row[2]!=""){
            $email=$row[2];
        }

    
        $comentario = $row[3];
        $fecha      = $row[4];



        echo('
        <div class="row">

            <div >
                <div class="col s3 card">
                    <p>'.$email.'   '.$fecha.'</p>
                </div>
                <div class="col s9 card-panel ">
                    <p>'.$comentario.'</p>
                </div>
            </div>
        </div>
        ');
    }
  
    
        


       

    echo('</div>');
    disconectDB($db);
   

}





initHTML();
mostrarHeader();

mostrarNavBar();

initBody();

if($action=='mostrar'){
    getIncidencia($incidencia);
}



      
      
endBody();

mostrarFooter();

endHTML();


?>