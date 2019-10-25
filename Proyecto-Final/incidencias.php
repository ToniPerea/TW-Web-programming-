
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




function getComentarios($idIncidencia){
    if(!empty($idIncidencia)){
        $db = conectDB();


        $queryGetComentarios="SELECT * from `Comentarios` WHERE incidencia_id='{$idIncidencia}'";    
        $res = $db->query($queryGetComentarios);
        $r = $res->fetch_array(MYSQLI_NUM);

        if($db){
            echo('<main>
            <ul class="collection">');
            while ($row = $res->fetch_array(MYSQLI_NUM)){
                $emailAutor             = $row[0];
                $tituloComentario       = $row[1];
                $descripcionComentario   = $row[2];


                echo('
                        
                    
                    <li class="collection-item avatar">
                        <img src="./images/UsuarioPorDefecto.png" alt="" class="circle">
                        <span class="title">'.$tituloComentario.'</span>
                        <p>'.$descripcionComentario.'<br>'.'</p>
                       
                    </li>

                

                ');


            }

                    echo('</ul>
                    </main>
                    ');
        }else{

        }

        disconectDB($db);
    }
}


function getIncidencias($email){
   
    $db = conectDB();
    if (!empty($email) ) {
        echo('<div class="row center">
        <h2>Mis Incidencias</h2>
        </div>');
        $res = $db->query("select * from Incidencias WHERE email='{$email}'");
    }else{
        echo('<div class="row center">
        <h2>Listado de Incidencias</h2>
        </div>');
        $res = $db->query("select * from Incidencias");
    }
    
    while ($row = $res->fetch_array(MYSQLI_NUM)) {
        $id_incidencia      = $row[0];
        $titulo_incidencia  = $row[1];
        $lugar_incidencia   = $row[2];
        $descripcion        = $row[3];
        $palabrasClave      = $row[4];
        $photo              = $row[5];
        $fechaInclusion     = $row[6];
        $email              = $row[7];
        $estado_incidencia  = ($row[8]==1)?'Valido':'Invalido';
        $_SESSION["idIncidencia"]=$id_incidencia;
        
        echo('
        <main>
        <ul class="collection">
            
            <li class="collection-item avatar">
                <img src="./images/UsuarioPorDefecto.png" alt="" class="circle">
                <span class="title">'.$titulo_incidencia.'</span>
                <p>'.$lugar_incidencia.'<br>'.$estado_incidencia
                .'</p>
                <a href="incidencia.php?p=mostrar&id='.$id_incidencia.'" class="secondary-content"><i class="material-icons">forward</i></a>
            </li>

        </ul>
    </main>
    


        ');
    }
    disconectDB($db);
}
        


    


initHTML();
mostrarHeader();

mostrarNavBar();

initBody();


//mostrarIncidencias();
if (isset($_GET['p'])) {
    switch ($_GET['p']) {
      case 'email':
        getIncidencias($_SESSION["usuario"]);
        unset($_GET['p']);
        break;
    }
    
}else{
    getIncidencias("");
}

      
      
endBody();

mostrarFooter();

endHTML();



?>