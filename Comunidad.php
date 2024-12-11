<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css" />
    <title id="titulo_app"></title>
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .posts-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly; /* Centra y distribuye las tarjetas */
            gap: 24px; /* Espacio entre las tarjetas */
            padding: 20px;
        }

        .card {
            flex: 0 1 45%; /* Las tarjetas ocupan el 45% del contenedor */
            max-width: 35rem; /* Máximo ancho de tarjeta */
            min-width: 25rem; /* Mínimo ancho para evitar que se hagan chicas */
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .card-img-top {
            width: 100%;
            height: 250px; /* Altura fija */
            object-fit: cover; /* Evita deformación de la imagen */
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .card-text {
            font-size: 1.1rem;
            color: #555;
        }

        .text-muted {
            font-size: 0.9rem;
            color: #999;
        }

        @media (max-width: 768px) {
            .card {
                flex: 0 1 80%; /* Tamaño más grande en pantallas medianas */
            }
        }

        @media (max-width: 480px) {
            .card {
                flex: 0 1 100%; /* Una tarjeta por fila en pantallas pequeñas */
            }
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
    <br>
    <h1>Posts de la Comunidad</h1>
    <button class="logout-btn" id="logoutButton"></button>
    <main>
        <div id="postsList" class="posts-list">
            <!-- Aquí irán las tarjetas dinámicamente -->
        </div>
    </main>

    <div id="footer-bar" class="footer-bar-6">
        <a href="index.php"><i id="homeIcon"></i><span id="home"></span></a>
        <a href="Publicar.php"><i id="tpcambioIcon"></i><span id="tpcambio"></span></a>
        <a href="Comunidad.php"><i id="operacionesIcon"></i><span id="operaciones"></span></a>
        <a href="Cuenta.php"><i id="configuIcon"></i><span id="configu"></span></a>
    </div>

    <script src="js/Operaciones.js"></script>
    <script>
        document.getElementById('logoutButton').addEventListener('click', () => {
            document.cookie = "usuario=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
            alert('Has cerrado sesión.');
            window.location.href = 'login.php'; 
        });

        // Ejemplo de cómo agregar contenido dinámicamente a las tarjetas
        const posts = [
            { title: "Post 1", text: "Descripción del post 1", img: "https://via.placeholder.com/300" },
            { title: "Post 2", text: "Descripción del post 2", img: "https://via.placeholder.com/300" },
            { title: "Post 3", text: "Descripción del post 3", img: "https://via.placeholder.com/300" },
            { title: "Post 4", text: "Descripción del post 4", img: "https://via.placeholder.com/300" }
        ];

        const postsList = document.getElementById('postsList');

        posts.forEach(post => {
            const card = document.createElement('div');
            card.className = 'card';
            card.innerHTML = `
                <img src="${post.img}" class="card-img-top" alt="${post.title}">
                <div class="card-body">
                    <h5 class="card-title">${post.title}</h5>
                    <p class="card-text">${post.text}</p>
                    <p class="text-muted">Publicado recientemente</p>
                </div>
            `;
            postsList.appendChild(card);
        });
    </script>
</body>

</html>
