<?php 

    require_once 'conexion/conexion.php';

    session_start();

    $conexion = new conexion();

    // Se verifica que la sesión esté iniciada para evitar que se hagan llamadas externas a la URL.
    if(isset($_SESSION['user'])){
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $usuario = $_SESSION['user'];
            $query = "SELECT * FROM mascotas WHERE DuenoID = $usuario";
            $resultados = $conexion->ejecutarQueryMultiple($query);
            $_SESSION['numMascotas'] = count($resultados);
            $resultados = json_encode($resultados);
            print_r($resultados);
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Agregar validacion de numero de mascotas
            // Proceso para agregar una nueva mascota
            $query = "INSERT INTO mascotas (Nombre, Edad, Especie, DuenoID) VALUES ('" . $_POST['nombreMascota'] . "', '" . $_POST['edadMascota'] . "', '" . $_POST['especieMascota'] . "', '" . $_SESSION['user'] . "')";
            $conexion->nonQuery($query);
            print_r('Mascota agregada con éxito');
        }

    }

?>