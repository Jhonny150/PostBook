<?php
$filePath = 'jsons/posts.json';

$postId = isset($_GET['id']) ? $_GET['id'] : null;

if ($postId === null) {
    echo json_encode(['error' => 'ID del post no proporcionado']);
    exit;
}

$postsJson = file_get_contents($filePath);

if ($postsJson === false) {
    echo json_encode(['error' => 'No se pudo leer el archivo']);
    exit;
}

$posts = json_decode($postsJson, true);

if ($posts === null) {
    echo json_encode(['error' => 'Error al procesar el JSON']);
    exit;
}

$filteredPosts = array_filter($posts, function($post) use ($postId) {
    return $post['id'] != $postId;
});

if (count($filteredPosts) == count($posts)) {
    echo json_encode(['error' => 'Post no encontrado']);
    exit;
}

$filteredPosts = array_values($filteredPosts);

$updatedJson = json_encode($filteredPosts, JSON_PRETTY_PRINT);

if (file_put_contents($filePath, $updatedJson)) {
    echo json_encode(['success' => 'Post eliminado correctamente']);
} else {
    echo json_encode(['error' => 'Error al guardar el archivo']);
}
?>
