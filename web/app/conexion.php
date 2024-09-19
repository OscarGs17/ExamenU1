<?php
    define('SERVER','localhost');
    define('USER','root');
    define('PASS', '');
    define('DB', 'usuarios');

    class Conexion{
        private static $conexion;

        private static function abrir_conexion(){
            if(!isset(self::$conexion)){
                try{
                    self::$conexion = new PDO('mysql:host='.SERVER.';dbname='.DB,USER,PASS);
                    self::$conexion->exec('SET CHARACTER SET utf8');
                    return self::$conexion;
                }catch(PDOException $e){
                    echo "Error en la conexion: ".$e;
                    die();
                }
            }else{
                return self::$conexion;
            }
        }

        public static function obtener_conexion(){
            $conexion = self::abrir_conexion();
            return $conexion;
        }

        public static function cerrar_conexion(){
            self::$conexion = null;
        }
    }
    Conexion::obtener_conexion();
?>