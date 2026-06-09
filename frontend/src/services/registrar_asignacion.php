<?php
/**
 * registrar_asignacion.php
 * Registra una nueva asignación de materia a docente y la guarda en asignaciones.json
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

// Leer JSON existente
$asignaciones = [];
if (file_exists($jsonFile)) {
    $raw = file_get_contents($jsonFile);
    $asignaciones = json_decode($raw, true) ?: [];
}

// Leer body
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    $input = $_POST;
}

$materia   = trim($input['materia'] ?? '');
$clave     = trim($input['clave'] ?? '');
$docente   = trim($input['docente'] ?? '');
$docenteId = trim($input['docenteId'] ?? '');
$grupo     = trim($input['grupo'] ?? '');
$aula      = trim($input['aula'] ?? '');
$horario   = trim($input['horario'] ?? '');

if (empty($materia) || empty($docente) || empty($grupo) || empty($aula) || empty($horario)) {
    echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios para la asignación.']);
    exit;
}

// Validar conflicto de horario (si el mismo docente ya tiene clase a esa misma hora)
foreach ($asignaciones as $asig) {
    if ($asig['docenteId'] === $docenteId && $asig['horario'] === $horario) {
        echo json_encode([
            'success' => false,
            'message' => "Conflicto de horario: El docente {$docente} ya tiene asignada la materia \"{$asig['materia']}\" en el horario {$horario}."
        ]);
        exit;
    }
    if ($asig['aula'] === $aula && $asig['horario'] === $horario) {
        echo json_encode([
            'success' => false,
            'message' => "Conflicto de Aula: El {$aula} ya está ocupado en el horario {$horario} por la materia \"{$asig['materia']}\"."
        ]);
        exit;
    }
}

$nuevaAsignacion = [
    'id'        => uniqid('asig_', true),
    'materia'   => $materia,
    'clave'     => $clave,
    'docente'   => $docente,
    'docenteId' => $docenteId,
    'grupo'     => $grupo,
    'aula'      => $aula,
    'horario'   => $horario,
    'fecha'     => date('Y-m-d H:i:s')
];

$asignaciones[] = $nuevaAsignacion;

if (file_put_contents($jsonFile, json_encode($asignaciones, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) !== false) {
    echo json_encode(['success' => true, 'message' => 'Asignación registrada correctamente.', 'data' => $nuevaAsignacion]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al escribir el archivo de asignaciones.']);
}
