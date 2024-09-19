<?php

require_once "../app/conexion.php";

session_start();

function valida_existencia_DB(){

  $pdo=Conexion::obtener_conexion();

  // busqueda en la base de datos
  $buscar_usuario = $pdo->prepare("SELECT * FROM usuario WHERE usuario = :bus_usuario AND password = :bus_password");
  
  // pasar de manera segura lo que vo a buscar en la bd
  $buscar_usuario->bindParam('bus_usuario', $_POST['usuario'], PDO::PARAM_STR);
  $buscar_usuario->bindParam('bus_password', $_POST['password'], PDO::PARAM_STR);

  // ejecuta la actividad en la bd
  $buscar_usuario->execute();

  #$datos = $buscar_usuario->fetchAll(PDO::FETCH_ASSOC);
  $datos = $buscar_usuario->fetch(PDO::FETCH_ASSOC);

  #if(count($datos) > 0){
  if($datos){

    //construcción de la variable de sesion al encontrar el usuario en la DB
    $_SESSION['usuario']=$_POST['usuario'];

    $array = array(
      "usuario" => $datos['usuario'],
      "password" => $datos['password'],
      "id" => $datos['id'],
      "valor" => "0"
    );

    // enviamos los datos a la pagina web
    echo json_encode($array);

    #echo json_encode(['llave'=>$datos['usuario']]);
  }else{
    #echo "el usuario no existe en la db";

    $array = array(
      "valor" => "9"
    );
    echo json_encode($array);


  }
}

valida_existencia_DB();


#echo $_POST['usuario']." ".$_POST['password'];

?>