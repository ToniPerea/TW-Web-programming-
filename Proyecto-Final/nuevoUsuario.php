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



function mostrarRegistrar(){
    echo('<div class="section container">

    <div class="row center">
    <h2>Nuevo Usuario</h2>
    </div>
    <form enctype="multipart/form-data" action="index.php?p=register" method="post">
        <div class="row card-panel">
            <div class="col s12 m8 offset-m2 l6 offset-l3">
                <div class="card-panel grey lighten-5 z-depth-1">
                    <div class="row valign-wrapper">
                        <div class="col s12">
                            <img src="images/UsuarioPorDefecto.png" class="circle responsive-img">

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
                <input name="nombre" type="text" placeholder="Introduzca su Nombre" id="nombrePerfil" class="validate" required>
                <label for="nombrePerfil">Nombre:</label>
            </div>

            <div class="input-field col s12">
                <input name="apellidos" type="text" placeholder="Introduzca sus Apellidos" id="apellidosPerfil" class="validate"
                    required>
                <label for="apellidosPerfil">Apellidos:</label>
            </div>

            <div class="input-field col s12">
                <input name="email" type="text" placeholder="Introduzca su Email" id="emailPerfil" class="validate" required>
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
                <input name="direccion" type="text" placeholder="Introduzca su Dirección" id="direcciónPerfil" class="validate" required>
                <label for="direcciónPerfil">Dirección:</label>
            </div>

            <div class="input-field col s12">
                <input name="tlf" type="text" placeholder="Introduzca su Número de Teléfono" id="telefonoPerfil" class="validate" required>
                <label for="telefonoPerfil">Teléfono:</label>
            </div>

            <div class="input-field col s12">
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
              </div>



            <div class="input-field col s12">
                <button class="btn" type="submit">Crear Usuario</button>

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

mostrarRegistrar();

      
      
endBody();

mostrarFooter();

endHTML();


?>