<?php
/**
 * registrar_materia.php
 * Guarda o actualiza una materia en el archivo materias.json local.
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$jsonFile = __DIR__ . '/materias.json';

// Leer JSON existente
$materias = [];
if (file_exists($jsonFile)) {
    $raw = file_get_contents($jsonFile);
    $materias = json_decode($raw, true) ?: [];
}

// Leer body
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    // Fallback: FormData
    $input = $_POST;
}

$nombre  = trim($input['nombre']  ?? $input['nombre_materia']  ?? '');
$clave   = trim($input['clave']   ?? $input['clave_materia']   ?? '');
$carrera = trim($input['carrera'] ?? $input['carrera_materia'] ?? '');
$semestre = $input['semestre'] ?? $input['semestre_materia'] ?? '';
$creditos = $input['creditos'] ?? '';
$objetivo = trim($input['objetivo'] ?? $input['objetivo_general'] ?? '');
$caracteristicas = trim($input['caracteristicas'] ?? '');
$unidades = $input['unidades'] ?? [];
$idEdit  = trim($input['id'] ?? $input['id_materia_edit'] ?? '');

if (empty($nombre) || empty($clave)) {
    echo json_encode(['success' => false, 'message' => 'Nombre y clave son obligatorios.']);
    exit;
}

if (!empty($idEdit)) {
    // Modo edición
    $encontrado = false;
    foreach ($materias as &$m) {
        if ($m['id'] === $idEdit) {
            $m['nombre']          = $nombre;
            $m['clave']           = $clave;
            $m['carrera']         = $carrera;
            $m['semestre']        = $semestre;
            $m['creditos']        = $creditos;
            $m['objetivo']        = $objetivo;
            $m['caracteristicas'] = $caracteristicas;
            $m['unidades']        = $unidades;
            $encontrado = true;
            break;
        }
    }
    unset($m);

    if (!$encontrado) {
        echo json_encode(['success' => false, 'message' => 'Materia no encontrada para editar.']);
        exit;
    }
} else {
    // Modo registro
    $materias[] = [
        'id'              => uniqid('mat_', true),
        'nombre'          => $nombre,
        'clave'           => $clave,
        'carrera'         => $carrera,
        'semestre'        => $semestre,
        'creditos'        => $creditos,
        'objetivo'        => $objetivo,
        'caracteristicas' => $caracteristicas,
        'unidades'        => $unidades,
        'fechaRegistro'   => date('Y-m-d H:i:s')
    ];
}

if (file_put_contents($jsonFile, json_encode($materias, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) !== false) {
    echo json_encode(['success' => true, 'message' => 'Materia guardada correctamente.', 'total' => count($materias)]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al escribir el archivo de materias.']);
}
