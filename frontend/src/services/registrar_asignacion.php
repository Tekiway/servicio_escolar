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

// Determinar URL del Gateway (Local vs Producción)
$gatewayHost = (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] === 'localhost') 
    ? 'http://localhost:3000' 
    : 'https://TU-DOMINIO-REAL-DE-GATEWAY.up.railway.app'; // Reemplazar por tu URL de Railway real

$url = "{$gatewayHost}/api/academico/horarios";

// Enviar datos al Microservicio mediante el Gateway
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($input));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: ' . ($_SERVER['HTTP_AUTHORIZATION'] ?? '')
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode >= 200 && $httpCode < 300) {
    echo $response;
} else {
    http_response_code($httpCode ?: 500);
    echo json_encode([
        'success' => false,
        'message' => 'Error al comunicar con el API Gateway',
        'details' => json_decode($response)
    ]);
}
