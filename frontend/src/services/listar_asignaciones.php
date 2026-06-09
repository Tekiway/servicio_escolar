<?php
/**
 * listar_asignaciones.php
 * Retorna el listado de asignaciones registradas en asignaciones.json
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$jsonFile = __DIR__ . '/asignaciones.json';

if (!file_exists($jsonFile)) {
    echo json_encode([]);
    exit;
}

$raw = file_get_contents($jsonFile);
$data = json_decode($raw, true) ?: [];

echo json_encode($data);
