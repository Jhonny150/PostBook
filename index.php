<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css" />
    <title id="titulo_app">Inicio</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #000000; /* Fondo gris claro */
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        /* Estilos para el encabezado */
        .header {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 20px;
        }

        /* Imagen de la aplicación */
        .header img {
            width: 20vw; /* El ancho se ajusta al 20% del viewport */
            height: auto; /* Mantiene la proporción */
            border-radius: 50%; /* Hace la imagen circular */
            object-fit: cover; /* Ajusta la imagen dentro del círculo sin deformarse */
            border: 3px solid #ddd; /* Borde opcional alrededor de la imagen */
        }

        /* Media query para pantallas más pequeñas */
        @media (max-width: 600px) {
            .header img {
                width: 30vw; /* En pantallas pequeñas, la imagen ocupa el 30% del viewport */
            }
        }

        /* Media query para pantallas muy grandes */
        @media (min-width: 1200px) {
            .header img {
                width: 150px; /* Tamaño fijo en pantallas grandes */
            }
        }

        /* Botón de cerrar sesión */
        .logout-btn {
            position: fixed;
            top: 15px;
            right: 15px;
            padding: 12px 20px;
            background-color: #ff4b5c; /* Rojo para destacar */
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            z-index: 10; /* Asegura que el botón esté sobre todo */
        }

        .logout-btn:hover {
            background-color: #d93c4b;
            transform: scale(1.05); /* Efecto de escala al pasar el mouse */
        }

        /* Contenido principal */
        main {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
            max-width: 600px;
            margin: 20px auto;
        }

        h2 {
            font-size: 28px;
            color: #007bff;
            margin-bottom: 10px;
        }

        .hero-text {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }

        .logo {
            width: 200px; /* Logo dentro del main */
            margin-top: 20px;
        }

        /* Footer sin cambios */
        .footer-bar-6 {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #000;
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
        }

        .footer-bar-6 a {
            color: #fff;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <?php
    if (!isset($_COOKIE['usuario'])) {
        header('Location: login.php'); 
        exit;
    }
    ?>

    <!-- Encabezado con la imagen -->
    <div class="header">
        <button class="logout-btn" id="logoutButton">Cerrar sesión</button>
        <img src="iconoPostbook.jpeg" alt="APPCHIDA Logo">
    </div>

    <!-- Contenido principal -->
    <main id="content">
        <h2 id="mensaje_bienvenida">¡Bienvenido a APPCHIDA!</h2>
        <p class="hero-text">
            Explora esta aplicación para compartir tus <strong>actividades creativas</strong> con otros usuarios.
            Publica imágenes, añade descripciones y participa en una comunidad dinámica.
            Conéctate, comparte tus intereses y descubre nuevos talentos. ¡Comienza ahora!
        </p>
        <img class="logo" src="logo.png" alt="Logo de la Aplicación" />
    </main>

    <!-- Footer -->
    <div id="footer-bar" class="footer-bar-6">
        <a href="index.php" data-script="js/app.js"><i id="homeIcon"></i><span id="home"></span></a>
        <a href="Publicar.php" data-script="js/TipoCambio.js"><i id="tpcambioIcon"></i><span id="tpcambio"></span></a>
        <a href="Comunidad.php" data-script="js/Operaciones.js"><i id="operacionesIcon"></i><span id="operaciones"></span></a>
        <a href="Cuenta.php" data-script="js/Configuracion.js"><i id="configuIcon"></i><span id="configu"></span></a>
    </div>

    <!-- Script para cerrar sesión -->
    <script src="js/app.js"></script>
    <script>
        document.getElementById('logoutButton').addEventListener('click', () => {
            document.cookie = "usuario=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
            alert('Has cerrado sesión.');
            window.location.href = 'login.php'; 
        });
    </script>
</body>

</html>
