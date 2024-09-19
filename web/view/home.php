<?php

  session_start();


  if(isset($_SESSION['usuario'])){

?>

<div class="container"></div>
  <div class="row">
    <div class="col-sm-12">
      <img src="./assets/img/home.jpeg" class="img-fluid w-100">
    </div>
  </div>
  <div class="row mt-4">
    <div class="col"></div>
    <div class="col"><a class="btn btn-danger w-100" href="salir">Cerrar Sesión</a></div>
    <div class="col"></div>
  </div>
</div>



<?php
      
  }else{

    //si no hay sesion iniciada te mandamos a login
    header('location:login');

  }

?>