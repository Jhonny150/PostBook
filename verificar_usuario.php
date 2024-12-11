<?php
header("Content-Type: application/json");

$jsonFile = __DIR__ . '/jsons/usuarios.json';

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!isset($data['username']) || !isset($data['password'])) {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
    exit;
}

$username = $data['username'];
$password = $data['password'];

if (!file_exists($jsonFile)) {
    echo json_encode(['success' => false, 'error' => 'Base de datos de usuarios no encontrada']);
    exit;
}

$jsonData = json_decode(file_get_contents($jsonFile), true);

foreach ($jsonData as $user) {
    if ($user['username'] === $username && password_verify($password, $user['password'])) {
        echo json_encode(['success' => true]);
        setcookie("usuario", $username, time() + 3600, "/"); 

        exit;
    }
}

echo json_encode(['success' => false, 'error' => 'Usuario o contraseña incorrectos']);
?>
