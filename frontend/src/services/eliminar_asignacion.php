<?php
/**
 * eliminar_asignacion.php
 * Elimina una asignación de docente por ID del archivo asignaciones.json
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
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
$idEliminar = trim($input['id'] ?? $_POST['id_eliminar'] ?? '');

if (empty($idEliminar)) {
    echo json_encode(['success' => false, 'message' => 'ID no proporcionado.']);
    exit;
}

$asignaciones = json_decode(file_get_contents($jsonFile), true) ?: [];
$nuevas   = array_filter($asignaciones, fn($a) => $a['id'] !== $idEliminar);

if (count($nuevas) === count($asignaciones)) {
    echo json_encode(['success' => false, 'message' => 'Asignación no encontrada.']);
    exit;
}

$nuevas = array_values($nuevas);

if (file_put_contents($jsonFile, json_encode($nuevas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) !== false) {
    echo json_encode(['success' => true, 'message' => 'Asignación eliminada correctamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al guardar cambios.']);
}
