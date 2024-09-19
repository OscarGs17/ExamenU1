<?php 

require_once "../app/conexion.php";

function inserta_usuario() {
  try {
      $pdo = Conexion::obtener_conexion();
      
      // Verificar si la conexión fue exitosa
      if (!$pdo) {
          echo "Error en la conexión a la base de datos.";
          return;
      }

      $inserta_usuario = $pdo->prepare("INSERT INTO usuario (usuario, password) VALUES (:usuario, :password)");

      // Hashear la contraseña antes de guardarla
      $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

      // Vincular parámetros
      $inserta_usuario->bindParam(':usuario', $_POST['usuario'], PDO::PARAM_STR);
      $inserta_usuario->bindParam(':password', $hashed_password, PDO::PARAM_STR);

      // Ejecutar la consulta
      if ($inserta_usuario->execute()) {
          echo 0; // Usuario creado correctamente
      } else {
          echo "Error al crear el usuario"; // Error general en la inserción
      }
  } catch (PDOException $e) {
      echo "Error en la base de datos: " . $e->getMessage(); // Manejo específico de excepciones de PDO
  } catch (Exception $e) {
      echo "Error: " . $e->getMessage(); // Manejo de otras excepciones
  }
}


function valida_existencia_usuario(){
    try {
        $pdo = Conexion::obtener_conexion();
        $buscar_usuario = $pdo->prepare("SELECT * FROM usuario WHERE usuario = :usuario");
        
        // Ejecutar consulta para buscar si el usuario ya existe
        $buscar_usuario->execute([
            'usuario' => $_POST['usuario']
        ]);

        $datos = $buscar_usuario->fetchAll(PDO::FETCH_ASSOC);

        if(count($datos) > 0){
            echo 7; // El usuario ya existe
        } else {
            inserta_usuario();
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage(); // Manejo de excepciones
    }
}

function valida_password(){
   
    if(preg_match("/^[0-9]{8,}$/", $_POST['password']) !== 1){
        echo 8; // Contraseña inválida
    } else {
        valida_existencia_usuario();
    }
}

function valida_usuario(){
    // Validación del nombre de usuario (entre 3 y 16 caracteres alfanuméricos)
    if(preg_match("/^[a-zA-Z0-9]{3,16}$/", $_POST['usuario']) !== 1){
        echo 9; // Usuario inválido
    } else {
        valida_password();
    }
}

valida_usuario();

?>
