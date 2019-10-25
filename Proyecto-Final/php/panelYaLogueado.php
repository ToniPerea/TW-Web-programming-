<?php
function mostrarPanelYaLogueado()
{

    $db = conectDB();
    $res = $db->query("select * from Usuarios where `email`='{$_SESSION["usuario"]}' ");
    $r = $res->fetch_array(MYSQLI_NUM);
    disconectDB($db);
    echo('
      <div class=" row card-panel col s3 right">
        <div class="row valign-wrapper">
        <div class="col s12 center">');
    echo('<img width="150px" class="circle responsive-img center" src="data:image/jpeg;base64,'.base64_encode($r[9]).'"/>');
    echo('<p>');
    echo($_SESSION["nombre"]);
    echo('</p>');

    echo('<p>');
    echo($_SESSION["apellidos"]);
    echo('</p>
          <div class="card-action">
              <a href="modificarPerfil.php">Modificar Perfil</a>
          </div>
          <div>
              <a href="nuevaIncidencia.php">Crear Incidencia</a>
          </div>
          <div>
              <a href="incidencias.php?p=email">Mis Incidencias</a>
          </div>
          <div>
              <a href="log.php">Ver Logs</a>
          </div>
      </div>
  </div>
</div>
      ');
}
