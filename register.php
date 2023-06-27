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
            <div class="nav-item"><a href="login" >Ingresar</a></div>
        </div>
    </nav>
    <section id="register">
        <form action="register.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre">
            <label for="apellido">Apellido:</label>
            <input type="text" name="apellido" id="apellido">
            <label for="usuario">Correo:</label>
            <input type="text" name="usuario" id="usuario">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password">
            <input type="submit" value="Ingresar">
        </form>
        <p>¿Ya tiene una cuenta? <a href="login">Iniciar sesión</a> </p>
    </section>
    <footer>VetPet&copy; 2023.</footer>
</body>
</html>

<?php 

    require_once 'clases/register.class.php';

    $registro = new register();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $datos = $_POST;
        if(!isset($datos['usuario']) || !isset($datos['nombre']) || !isset($datos['apellido']) || !isset($datos['password'])){
            echo "Datos enviados con formato incorrecto";
            die();
        }
        $user = $datos['usuario'];
        // Comprobacion si el usuario existe
        $verificarUsuario = "SELECT UserID FROM users WHERE Correo = '$user'";
        if($registro->ejecutarQuery($verificarUsuario) == null){
            $password = $registro->encriptar($datos['password']);
            $nombre = $datos['nombre'];
            $apellido = $datos['apellido'];
            $registro->registrarUsuario($nombre, $apellido, $user, $password);
        }else{
            echo "Ya existe un usuario registrado con el correo ingresado";
        }

    }

?>