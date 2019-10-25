<?php
function mostrarPanelLogin()
{
    echo('<div class=" row card-panel col s3 right">
    <!--Parte izquierda registo de usuario y texto plano de los que mas añaden u opinan-->
    <form action="index.php?p=login" method="post">
      <div class="input-field ">
        <input type="text" name="usuario" placeholder="Usuario" id="usuario" class="validate" required>
        <label for="usuario"></label>
      </div>

      <div class="input-field ">
        <input type="password" name="pass" placeholder="Contraseña" id="pass" class="validate" required>
        <label for="pass"></label>
      </div>
      
      <div class="row">
          <div class="col left">
          <button class="btn" type="submit">Login</button> 
          </div>
          <div class="col right">
          <a href="nuevoUsuario.php"> Registrar</a>
          </div>
      
    </div>
    </form>
   
  </div>
  ');
}


?>