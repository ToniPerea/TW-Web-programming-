

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



// Si el estado de la sesión es inválido, iniciamos una nueva sesión.
if (session_status() != PHP_SESSION_ACTIVE) {
	session_start();
}

if (isset($_GET['p'])) {
	switch ($_GET['p']) {
	  case 'login':
		  login();
		  unset($_GET['p']);
		  break;
	  case 'logout':
		  logout();
		  unset($_GET['p']);
		  break;

	  case 'register':
		  register();
		  unset($_GET['p']);
		  break;

	  case 'actualizarPerfil':
		  actualizarPerfil();
		  break;
  }
}


	initHTML();
	mostrarHeader();

	mostrarNavBar();
	
	initBody();

	
	initRow();
	mostrarDescripcion();

	if (isset($_SESSION["usuario"])){
		mostrarPanelYaLogueado();
	}else{
		mostrarPanelLogin();
 
	}

	endRow();

	mostrarFormulario();




	  
	  
	endBody();

	mostrarFooter();

	endHTML();
?>


