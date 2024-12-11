<?php
// Iniciar sesión y establecer cabeceras para permitir solicitudes desde el frontend
session_start();
header('Content-Type: application/json');

// Configuración para manejar el tamaño máximo de archivos (si es necesario)
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');

// Verificar que los datos fueron enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si los campos 'titulo', 'descripcion' y 'imagen' existen
    if (isset($_POST['titulo']) && isset($_POST['descripcion']) && isset($_FILES['imagen'])) {
        // Obtener los datos del formulario
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $imagen = $_FILES['imagen'];

        // Verificar si el ID del usuario está disponible en la cookie
        if (isset($_COOKIE['usuario'])) {
            $usuario_id = $_COOKIE['usuario']; // Obtener el ID del usuario desde la cookie
        } else {
            echo json_encode(['success' => false, 'message' => 'Usuario no autenticado.']);
            exit;
        }

        // Validar los datos
        if (empty($titulo) || empty($descripcion) || empty($imagen['name'])) {
            echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
            exit;
        }

        // Validar la imagen (por ejemplo, que sea una imagen JPG, PNG o JPEG)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($imagen['type'], $allowedTypes)) {
            echo json_encode(['success' => false, 'message' => 'Solo se permiten imágenes JPG, PNG o JPEG.']);
            exit;
        }

        // Mover la imagen a una carpeta específica
        $uploadDir = 'jsons/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Crear la carpeta si no existe
        }

        $imagenName = basename($imagen['name']);
        $targetFilePath = $uploadDir . $imagenName;

        if (move_uploaded_file($imagen['tmp_name'], $targetFilePath)) {

            $jsonFile = 'jsons/posts.json';

            // Leer el archivo JSON de posts
            if (file_exists($jsonFile)) {
                $postsData = json_decode(file_get_contents($jsonFile), true);
            } else {
                $postsData = [];
            }

            // Crear el nuevo post con el usuario_id
            $newPost = [
                'id' => count($postsData) + 1, // Generar un ID único para el post
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'imagen' => $imagenName,
                'fecha_creacion' => date('Y-m-d H:i:s'),
                'usuario_id' => $usuario_id // Asociar el post al usuario
            ];

            // Agregar el nuevo post al array de posts
            $postsData[] = $newPost;

            // Guardar el archivo JSON actualizado
            if (file_put_contents($jsonFile, json_encode($postsData, JSON_PRETTY_PRINT))) {
                echo json_encode(['success' => true, 'message' => 'Post guardado con éxito.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al guardar el archivo JSON.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Hubo un error al subir la imagen.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Faltan datos para procesar el formulario.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método de solicitud no permitido.']);
}
?>
