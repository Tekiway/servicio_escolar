<?php
/**
 * listar_materias.php
 * Devuelve todas las materias guardadas en materias.json
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

$jsonFile = __DIR__ . '/materias.json';

if (!file_exists($jsonFile)) {
    echo json_encode([]);
    exit;
}

$materias = json_decode(file_get_contents($jsonFile), true) ?: [];
echo json_encode($materias);
