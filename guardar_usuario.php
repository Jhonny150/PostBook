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
    file_put_contents($jsonFile, json_encode([]));
}
$jsonData = json_decode(file_get_contents($jsonFile), true);

$jsonData[] = [
    'username' => $username,
    'password' => password_hash($password, PASSWORD_DEFAULT), 
];

if (file_put_contents($jsonFile, json_encode($jsonData, JSON_PRETTY_PRINT))) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'No se pudo guardar el archivo']);
}
?>
