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


function mostrarModificarPerfil(){
    $userId         = $_SESSION["userid"];
    $usuario        = $_SESSION["usuario"];
    $pass           = $_SESSION["pass"];
    $nombre         = $_SESSION["nombre"];
    $apellidos      = $_SESSION["apellidos"];
    $dir_postal     = $_SESSION["dir_postal"];
    $telefono       = $_SESSION["telefono"];
    $is_active      = $_SESSION["is_active"];
    $is_admin       = $_SESSION["is_admin"];
    $foto           = $_SESSION["foto"];




    echo('<div class="section container">
    <div class="row center">
    <h2>Modificar Usuario</h2>
    </div>
    <form enctype="multipart/form-data" action="index.php?p=actualizarPerfil" method="post">
        <div class="row card-panel">
            <div class="col s12 m8 offset-m2 l6 offset-l3">
                <div class="card-panel grey lighten-5 z-depth-1">
                    <div class="row valign-wrapper">
                        <div class="col s12">
                        
                        <img width="150px" class="circle responsive-img center" src="images/UsuarioPorDefecto.png"/>

                        </div>
                        <div class="col s10">
                            <span class="black-text">
                            <input type="file" name="archivito"></input>
                            
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="input-field col s12">
                <input name="nombre" type="text" value="'.$nombre.'" id="nombrePerfil" class="validate" required>
                <label for="nombrePerfil">Nombre:</label>
            </div>

            <div class="input-field col s12">
                <input name="apellidos" type="text" value="'.$apellidos.'" id="apellidosPerfil" class="validate"
                    required>
                <label for="apellidosPerfil">Apellidos:</label>
            </div>

            <div class="input-field col s12">
                <input name="email" type="text" value="'.$usuario.'" id="emailPerfil" class="validate" required>
                <label for="emailPerfil">Email:</label>
            </div>

            <div class="input-field col s6">
                    <input name="clavePrimera" type="password" placeholder="Introduzca su Clave" id="clavePrimera" class="validate" required>
                    <label for="clavePrimera">Clave:</label>
            </div>

            <div class="input-field col s6">
                    <input name="claveSegunda" type="password" placeholder="Vuelva a introducir su Clave" id="claveSegunda" class="validate" required>
                    <label for="claveSegunda">Clave:</label>
            </div>
        

            <div class="input-field col s12">
                <input name="direccion" type="text" value="'.$dir_postal.'" id="direcciónPerfil" class="validate" required>
                <label for="direcciónPerfil">Dirección:</label>
            </div>

            <div class="input-field col s12">
                <input name="tlf" type="text" value="'.$telefono.'" id="telefonoPerfil" class="validate" required>
                <label for="telefonoPerfil">Teléfono:</label>
            </div>
            ');

            if($_SESSION["is_admin"]=="1"){
                echo('<div class="input-field col s12">
                <select>
                  <option value="1">Colaborador</option>
                  <option value="2">Administrador</option>
                </select>
                <label>Rol:</label>
              </div>
    
              <div class="input-field col s12">
                <select>
                  <option value="1">Activo</option>
                  <option value="2">No Activo</option>
                </select>
                <label>Estado:</label>
              </div>');
            }
            
           
            


        echo('
            <div class="input-field col s12">
                <button class="btn" type="submit">Actualizar Usuario</button>

            </div>
       </div>
    </form>
</div>
');
}




initHTML();
mostrarHeader();

mostrarNavBar();

initBody();

mostrarModificarPerfil();

      
      
endBody();

mostrarFooter();

endHTML();


?>