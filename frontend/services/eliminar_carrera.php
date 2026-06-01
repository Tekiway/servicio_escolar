<?php
header('Content-Type: application/json');

$jsonFile = __DIR__ . '/carreras.json';

if (!file_exists($jsonFile)) {
    echo json_encode(["success" => false, "message" => "No hay carreras registradas."]);
    exit;
}

$idEliminar = isset($_POST['id_eliminar']) ? trim($_POST['id_eliminar']) : '';

if (empty($idEliminar)) {
    echo json_encode(["success" => false, "message" => "ID no proporcionado."]);
    exit;
}

$data = json_decode(file_get_contents($jsonFile), true);
$newData = [];
$found = false;

foreach ($data as $carrera) {
    if ($carrera['id'] === $idEliminar) {
        $found = true;
    } else {
        $newData[] = $carrera;
    }
}

if ($found) {
    file_put_contents($jsonFile, json_encode($newData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo json_encode(["success" => true, "message" => "Carrera eliminada correctamente."]);
} else {
    echo json_encode(["success" => false, "message" => "No se encontró la carrera con ID " . $idEliminar]);
}
