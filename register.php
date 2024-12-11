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
    <title>Registro</title>
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
        /* Imagen en la parte superior */
        .login-image {
            width: 300px;
            height: 300px;
            margin-bottom: 5px;
        }
        /* Título de la página con fondo resaltado */
        h2 {
            background-color: #6c757d; /* Fondo gris para el título */
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
            background-color: #dce3eb;
            color: #333;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745; /* Verde para el botón */
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        button:hover {
            background-color: #218838;
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
        <!-- Imagen de icono -->
        <img src="iconoPostbook.jpeg" alt="Login Icon" class="login-image">
        <h1>Registrate Aqui</h1>
        <form id="registerForm">
            <input type="text" id="regUsername" placeholder="Usuario" required>
            <input type="password" id="regPassword" placeholder="Contraseña" required>
            <button type="submit">Registrarse</button>
        </form>
        <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const username = document.getElementById('regUsername').value;
            const password = document.getElementById('regPassword').value;

            fetch('guardar_usuario.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ username, password }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Usuario registrado exitosamente');
                    window.location.href = 'login.php'; 
                } else {
                    alert('Error al registrar el usuario: ' + data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error al registrar.');
            });
        });
    </script>
</body>
</html>
