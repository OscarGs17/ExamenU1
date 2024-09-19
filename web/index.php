<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio de sesion</title>
  <?php require_once './app/dependencias.php'; ?>
</head>
<body>
  <?php
  
    session_start();
    #require_once './view/login.php';

    if(isset($_GET['vista'])){
      switch($_GET['vista']){
        case 'login':{
          require_once './view/login.php';
          break;
        }case 'registro':{
          require_once './view/registro.php';
          break;
        }case 'home':{
          require_once './view/home.php';
          break;
        }
        case 'salir':{
          require_once 'control/salir.php';
          break;
        }
        default:{
          require_once './view/404.php';
          break;
        } 
      }
    }else{
      require_once './view/login.php';
    }

  
  ?>
</body>
</html>