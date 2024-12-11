<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css" />
    <title id="titulo_app"></title>
    <style>
        /* Estilo para que el botón se quede fijo en la parte superior */
        #addPostButton {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }

        /* Espaciado adicional para que los posts no se solapen con el botón */
        #posts-container {
            margin-top: 80px; /* Ajusta este valor según el tamaño del botón */
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
    
    <!-- Botón de "Agregar Post" fijo en la parte superior -->
    <button id="addPostButton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarPostModal">Agregar Post</button>
    <h1>Posts del Usuario</h1>
    <!-- Contenedor de los posts -->
    <div id="posts-container" class="container mt-5">
        
        <div id="postsList" class="list-group mt-3">
            <!-- Aquí se van a agregar los posts dinámicamente -->
        </div>
    </div>

    <!-- Footer -->
    <div id="footer-bar" class="footer-bar-6">
        <a href="index.php" data-script="js/app.js"><i id="homeIcon"></i><span id="home"></span></a>
        <a href="Publicar.php" data-script="js/TipoCambio.js"><i id="tpcambioIcon"></i><span id="tpcambio"></span></a>
        <a href="Comunidad.php" data-script="js/Operaciones.js"><i id="operacionesIcon"></i><span id="operaciones"></span></a>
        <a href="Cuenta.php" data-script="js/Configuracion.js"><i id="configuIcon"></i><span id="configu"></span></a>
    </div>

    <!-- Modal para agregar post -->
    <div class="modal fade" id="agregarPostModal" tabindex="-1" aria-labelledby="agregarPostModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarPostModalLabel">Agregar Nuevo Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="postForm">
                        <div class="mb-3">
                            <label for="tituloPost" class="form-label">Título</label>
                            <input type="text" class="form-control" id="tituloPost" placeholder="Escribe el título del post" required>
                        </div>
                        <div class="mb-3">
                            <label for="imagenPost" class="form-label">Imagen</label>
                            <input type="file" class="form-control" id="imagenPost" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcionPost" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcionPost" rows="4" placeholder="Escribe una descripción del post" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="guardarPostBtn">Publicar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/TipoCambio.js"></script>
    <!-- <script>
        document.getElementById('logoutButton').addEventListener('click', () => {
            document.cookie = "usuario=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;"; 
            alert('Has cerrado sesión.');
            window.location.href = 'login.php'; 
        });
        
      
       
    </script> -->
</body>

</html>
