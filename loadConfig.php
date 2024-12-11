<?php
header('Content-Type: application/json');
$configFile = 'jsons/config.json';

if (file_exists($configFile)) {
    $jsonData = file_get_contents($configFile);
    echo $jsonData;
} else {
    echo json_encode(["error" => "No se pudo cargar el archivo de configuración."]);
}
?>
