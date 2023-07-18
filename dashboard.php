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
    <script src="dashboard.js"></script>
    <title>VetPet - Servicios Veterinarios</title>
</head>

<body>
    <nav>
        <div class="nav-pages">
            <div class="nav-item"><a href="index">Inicio</a></div>
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
            <form id="formulario">
                <label for="nombreMascota">Nombre:</label>
                <input type="text" name="nombreMascota" id="nombreMascota">
                <label for="edadMascota">Edad (En años):</label>
                <input type="number" name="edadMascota" id="edadMascota" min="0" max="100">
                <label for="especieMascota">Especie:</label>
                <select name="especieMascota" id="especieMascota">
                    <option value="Perro">Perro</option>
                    <option value="Gato">Gato</option>
                    <option value="Tortuga">Tortuga</option>
                    <option value="Iguana">Iguana</option>
                </select>
            </form>
            <button onclick="enviarDatos()">Registrar mascota</button>
        </div>
        <div id="mascotas-registradas">
        </div>
    </section>
    <!--<button onclick="pedirDatos()">Recibir datos</button>-->
    
    <!-- Pide los datos de las mascotas registradas por el usuario apenas ingresar a la página -->
    <script>pedirDatos();</script>
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
    }

?>