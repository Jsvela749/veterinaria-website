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
    <section id="login">
        <form id="form" action="login.php" method="post">
                <label for="usuario">Correo:</label>
                <input type="text" name="usuario" id="usuario">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password">
                <input type="submit" value="Ingresar">
        </form>
        <p>¿No tiene una cuenta? <a href="register">Regístrese</a> </p>
    </section>
    <footer>VetPet&copy; 2023.</footer>
</body>
</html>

<?php 

    session_start();

    // Verificar que el usuario no esté logueado
    if(isset($_SESSION) && is_array($_SESSION) && array_key_exists('user', $_SESSION)){
        // Si lo está, se le redirige al dashboard
       header('Location: dashboard');
       exit();
    }

    require_once 'clases/login.class.php';
    
    $login = new conexion();


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Suponiendo que recibe JSON
    //$datos = file_get_contents('php://input');
    //$datos = json_decode($datos, true);
    $datos = $_POST;
    if(!isset($datos['usuario']) || !isset($datos['password'])){
        echo "Datos enviados con formato incorrecto";
        die();
    }
    $user = $datos['usuario'];
    $password = $datos['password'];
    $query = "SELECT UserID, Nombre, Apellido, Password FROM users WHERE Correo = '$user'";
    $resultados = $login->ejecutarQuery($query);
    if($resultados == null){
        echo "El usuario específicado no existe";
    }else{
        if($login->encriptar($password) == $resultados['Password']){
                echo "Contraseña aceptada. Bienvenido";
                $_SESSION['user'] = $resultados['UserID'];
                $_SESSION['nombreUsuario'] = $resultados['Nombre'];
                $_SESSION['apellidoUsuario'] = $resultados['Apellido'];
                header('Location: dashboard');
                exit();
            }else{
                echo "Contraseña incorrecta";
            }
        }
    }

?>