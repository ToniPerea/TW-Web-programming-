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


function mostrarLog(){
    $db = conectDB();
    $queryLog="SELECT * from LOG";
    $res = $db->query($queryLog);

    echo(' <table class="striped">
    <thead>
          <tr>
              <th>Id</th>
              <th>Fecha</th>
              <th>Nombre</th>
          </tr>
        </thead>
    ');
    echo('<tbody>');
    while ($row = $res->fetch_array(MYSQLI_NUM)) {

        echo('<tr>
        <td>'.$row[0].'</td>
        <td>'.$row[1].'</td>
        <td>'.$row[2].'</td>
      </tr>');

    }

    echo('</tbody> </table>');
    disconectDB($db);
}

initHTML();
mostrarHeader();

mostrarNavBar();

initBody();

mostrarLog();







  
  
endBody();

mostrarFooter();

endHTML();

?>