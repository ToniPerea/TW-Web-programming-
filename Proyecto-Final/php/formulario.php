<?php

function mostrarFormulario(){
    echo ('<!--Todos los formularios-->
    <div class="section container">
  
      <h2>Criterio de Búsqueda</h2>
      <div class="row">
        <form class="col s9" action="incidencias.php" method="post">
  
          <div class="row card-panel">
             
            <p>Incidencias que contengan:</p>
            <div class="input-field col s9">
              <input type="text" placeholder="Texto de Búsqueda" id="busqueda" class="validate" required>
              <label for="busqueda">Texto</label>
            </div>
  
            <div class="input-field col s9">
              <input type="text" placeholder="Lugar" id="lugar" class="validate" required>
              <label for="lugar">Lugar</label>
            </div>
  
            <div class="col s9">
              <p>Estado:</p>
              <form action="#">
                <p>
                  <label>
                    <input type="checkbox" />
                    <span>Pendiente</span>
                  </label>
                </p>
                <p>
                  <label>
                    <input type="checkbox" />
                    <span>Tramitada</span>
                  </label>
                </p>
              </form>
            </div>
  
            <div class="input-field col s9">
              <select>
                <option value="0">Todas</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
              <label>Número de incidencias a mostrar:</label>
            </div>
  
  
            <button class="btn" type="submit">Aplicar criterios de búsqueda</button>
  
        </form>
      </div>
  
    </div>
    </div>');
}

?>