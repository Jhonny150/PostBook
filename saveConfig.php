<?php
$configFile = 'jsons/config.json';
$imageDir = 'images/';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevoTitulo = $_POST['titulo'] ?? null;
    $nuevoMensajeHome = $_POST['mensaje_home'] ?? null;
    $nuevoMensajeCambio = $_POST['mensaje_cambio'] ?? null;
    $nuevoMensajeOperaciones = $_POST['mensaje_operaciones'] ?? null;
    $nuevoMensajeConfig = $_POST['mensaje_config'] ?? null;
    $nuevoMensajeBienvenida = $_POST['mensaje_bienvenida'] ?? null;
    $nuevoHomeIcon = $_POST['home_icon'] ?? null;
    $nuevoCambioIcon = $_POST['cambio_icon'] ?? null;
    $nuevoOperacionesIcon = $_POST['operaciones_icon'] ?? null;
    $nuevoConfigIcon = $_POST['config_icon'] ?? null;
    $nuevaImagenInicio = $_FILES['logoFileInput'] ?? null;

    if ($nuevaImagenInicio && $nuevaImagenInicio['error'] === UPLOAD_ERR_OK) {
        $imagenPath = $imageDir . basename($nuevaImagenInicio['name']);
        if (move_uploaded_file($nuevaImagenInicio['tmp_name'], $imagenPath)) {
            $nuevaImagenInicio = $imagenPath;
        } else {
            echo "Error al subir la imagen.";
            exit;
        }
    }
    if (file_exists($configFile)) {
        $jsonData = file_get_contents($configFile);
        $data = json_decode($jsonData, true);

        foreach ($data['configuraciones'] as &$config) {
            switch ($config['clave']) {
                case "TituloPag":
                    if ($nuevoTitulo) $config['valor'] = $nuevoTitulo;
                    break;
                case "mensaje_home":
                    if ($nuevoMensajeHome) $config['valor'] = $nuevoMensajeHome;
                    if ($nuevoHomeIcon) $config['icono'] = $nuevoHomeIcon; // Asegurar que se guarde el ícono
                    break;
                case "mensaje_cambio":
                    if ($nuevoMensajeCambio) $config['valor'] = $nuevoMensajeCambio;
                    if ($nuevoCambioIcon) $config['icono'] = $nuevoCambioIcon; // Asegurar que se guarde el ícono
                    break;
                case "mensaje_operaciones":
                    if ($nuevoMensajeOperaciones) $config['valor'] = $nuevoMensajeOperaciones;
                    if ($nuevoOperacionesIcon) $config['icono'] = $nuevoOperacionesIcon; // Asegurar que se guarde el ícono
                    break;
                case "mensaje_config":
                    if ($nuevoMensajeConfig) $config['valor'] = $nuevoMensajeConfig;
                    if ($nuevoConfigIcon) $config['icono'] = $nuevoConfigIcon; // Asegurar que se guarde el ícono
                    break;
                case "mensaje_bienvenida":
                    if ($nuevoMensajeBienvenida) $config['valor'] = $nuevoMensajeBienvenida;
                    break;
                case "ImagenInicio":
                    if ($nuevaImagenInicio) $config['valor'] = $nuevaImagenInicio;
                    break;
            }
        }

        // Guardar el archivo de configuración actualizado
        if (file_put_contents($configFile, json_encode($data, JSON_PRETTY_PRINT))) {
            echo "success";
        } else {
            echo "Error al guardar el archivo.";
        }
    } else {
        echo "Error: Archivo de configuración no encontrado.";
    }
}
?>
