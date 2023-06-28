<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Roboto:wght@100;300;400;500;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>VetPet - Servicios Veterinarios</title>
</head>

<body>
    <nav>
        <div class="nav-pages">
            <div class="nav-item"><a href="index">Inicio</a>
            </div>

            <div class="nav-item"><a href="galeria">Galeria</a></div>
        </div>
        <!--<div class="nav-item"></div>
                <div class="nav-item"></div>-->
        <div class="login">
            <form action="logout.php" method="post">
                <input type="submit" value="Cerrar Sesión">
            </form>
        </div>
    </nav>
    <section class="saludo">
        <h2 class="seccion-subtitulo">¡Hola <?php session_start(); echo $_SESSION['nombreUsuario'] . " " . $_SESSION['apellidoUsuario'] . "!" ?> </h2>
    </section>
    <section class="mascotas">
        <div class="agregarMascota">
            <form action="dashboard.php" method="post">
                <label for="nombreMascota">Nombre:</label>
                <input type="text" name="nombreMascota" id="nombreMascota">
                <input type="submit" value="Registrar mascota">
            </form>
        </div>
    </section>
</body>
</html>

<?php 

    // Si el usuario aún no se ha logueado, redirigirlo a login.php
    if($_SESSION['user'] == null){
        header('Location: login');
        exit();
    }else{
        require_once 'conexion/conexion.php';
        $conexion = new conexion();
        $usuario = $_SESSION['user'];
        echo "Bienvenido usuario $usuario";

        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $query = "SELECT * FROM mascotas WHERE DuenoID = $usuario";
            $_SESSION['numMascotas'] = $conexion->contarResultadosQuery($query);
            $resultados = $conexion->ejecutarQueryMultiple($query);
            if($resultados == null){
                echo "No tienes mascotas :P";
            }else{
                // Mostrar las máscotas guardadas
            }
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($_SESSION['numMascotas'] <= 10){
                // Proceso para agregar una nueva mascota
                $query = "INSERT INTO mascotas (Nombre, DuenoID) VALUES ('" . $_POST['nombreMascota'] . "', '" . $_SESSION['user'] . "')";
                $conexion->nonQuery($query);
                echo print_r($numMascotas);
            }else{
                echo "Usted tiene demasiadas máscotas. Por favor, elimine una antes de agregar una nueva";
            }
        }
    }

?>