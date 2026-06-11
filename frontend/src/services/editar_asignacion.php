<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$jsonFile = __DIR__ . '/asignaciones.json';

if (!file_exists($jsonFile)) {
    echo json_encode(['success' => false, 'message' => 'No hay asignaciones registradas.']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$id = trim($input['id'] ?? '');

if (empty($id)) {
    echo json_encode(['success' => false, 'message' => 'ID de asignación requerido.']);
    exit;
}

$raw = file_get_contents($jsonFile);
$asignaciones = json_decode($raw, true) ?: [];

$encontrado = false;
foreach ($asignaciones as &$asig) {
    if ($asig['id'] === $id) {
        $asig['grupo'] = trim($input['grupo'] ?? $asig['grupo']);
        $asig['aula'] = trim($input['aula'] ?? $asig['aula']);
        $asig['horario'] = trim($input['horario'] ?? $asig['horario']);
        $encontrado = true;
        break;
    }
}

if (!$encontrado) {
    echo json_encode(['success' => false, 'message' => 'Asignación no encontrada.']);
    exit;
}

if (file_put_contents($jsonFile, json_encode($asignaciones, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) !== false) {
    echo json_encode(['success' => true, 'message' => 'Asignación actualizada correctamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al escribir el archivo de asignaciones.']);
}
