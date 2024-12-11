<?php
if (isset($_COOKIE['usuario'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000; /* Fondo negro */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff; /* Fondo blanco para el formulario */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
        }
        /* Imagen del icono en la parte superior */
        .login-image {
            width: 300px; /* Tamaño de la imagen grande */
            height: 300px;
            
        }
        /* Título de la página */
        h2 {
            background-color: #6c757d;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        input {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            background-color: #f1f1f1; /* Fondo claro para los campos de entrada */
            color: #333;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff; /* Azul para el botón */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        button:hover {
            background-color: #0056b3; /* Azul más oscuro al pasar el ratón */
        }
        p {
            margin-top: 20px;
            font-size: 14px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Imagen del login en la parte superior -->
        <img src="iconoPostbook.jpeg" alt="Login Icon" class="login-image">

        <h1>Iniciar Sesión</h1>
        <form id="loginForm">
            <input type="text" id="username" placeholder="Usuario" required>
            <input type="password" id="password" placeholder="Contraseña" required>
            <button type="submit">Entrar</button> <!-- Se ha restaurado el texto del botón -->
        </form>
        <p>¿No tienes cuenta? <a href="register.php">Regístrate</a></p>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            fetch('verificar_usuario.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ username, password }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Inicio de sesión exitoso');
                    window.location.href = 'index.php'; 
                } else {
                    alert('Usuario o contraseña incorrectos');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error al intentar iniciar sesión.');
            });
        });
    </script>
</body>
</html>
