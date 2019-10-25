<?php

function mostrarNavBar(){
    echo('    <nav>
    <div class="nav-wrapper">
    <a href="index.php" class="brand-logo center"><img class="logo" id="logo" src="./images/QUÉJATE (NEGATIVO).png" /></a>
      <ul id="nav-mobile" class="left hide-on-med-and-down">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="incidencias.php?">Incidencias</a></li>
        
    ');

    if (isset($_SESSION["usuario"])) {
        echo('
        <li><a  href="index.php?p=logout">Cerrar Sesion</a></li>
        ');
    }

    echo('</ul>
        </div>
    </nav>');
}


?>