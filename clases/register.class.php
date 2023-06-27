<?php 

    require_once 'conexion/conexion.php';

    class register extends conexion{
        public function registrarUsuario($nombre, $apellido, $correo, $password){
            $query = "INSERT INTO users (Nombre, Apellido, Correo, Password) VALUES ('$nombre', '$apellido', '$correo', '$password')";
            parent::nonQuery($query);
        }
    }

?>