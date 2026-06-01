<?php
header('Content-Type: application/json');

$jsonFile = __DIR__ . '/carreras.json';

// Si el archivo no existe, crearlo con una carrera inicial
if (!file_exists($jsonFile)) {
    $initialData = [
        [
            "id" => "1",
            "nombre" => "Ingeniería en TICs",
            "clave" => "ITIC-2010-225",
            "modalidad" => "Escolarizada",
            "duracion" => "9",
            "estado" => "Activa",
            "objetivo" => "Formar profesionales líderes en tecnologías de información y comunicaciones.",
            "ingreso" => "Habilidades lógicas, de análisis y gusto por la tecnología.",
            "egreso" => "Competencias en desarrollo de software, redes y gestión de TI."
        ]
    ];
    file_put_contents($jsonFile, json_encode($initialData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

$data = json_decode(file_get_contents($jsonFile), true);

$id = isset($_POST['id_carrera_edit']) ? trim($_POST['id_carrera_edit']) : '';
$nombre = isset($_POST['nombre_carrera']) ? trim($_POST['nombre_carrera']) : '';
$modalidad = isset($_POST['modalidad']) ? trim($_POST['modalidad']) : '';
$clave = isset($_POST['clave_carrera']) ? trim($_POST['clave_carrera']) : '';
$duracion = isset($_POST['duracion']) ? trim($_POST['duracion']) : '';
$estado = isset($_POST['estado_carrera']) ? trim($_POST['estado_carrera']) : '';
$objetivo = isset($_POST['objetivo_carrera']) ? trim($_POST['objetivo_carrera']) : '';
$ingreso = isset($_POST['perfil_ingreso']) ? trim($_POST['perfil_ingreso']) : '';
$egreso = isset($_POST['perfil_egreso']) ? trim($_POST['perfil_egreso']) : '';

if (empty($nombre) || empty($clave) || empty($modalidad) || empty($duracion)) {
    echo json_encode(["success" => false, "message" => "Faltan campos obligatorios."]);
    exit;
}

if (!empty($id)) {
    // Editar carrera existente
    $found = false;
    foreach ($data as &$carrera) {
        if ($carrera['id'] === $id) {
            $carrera['nombre'] = $nombre;
            $carrera['clave'] = $clave;
            $carrera['modalidad'] = $modalidad;
            $carrera['duracion'] = $duracion;
            $carrera['estado'] = $estado;
            $carrera['objetivo'] = $objetivo;
            $carrera['ingreso'] = $ingreso;
            $carrera['egreso'] = $egreso;
            $found = true;
            break;
        }
    }
    if ($found) {
        file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        echo json_encode(["success" => true, "message" => "Carrera actualizada correctamente."]);
    } else {
        echo json_encode(["success" => false, "message" => "No se encontró la carrera a actualizar."]);
    }
} else {
    // Agregar nueva carrera
    $newId = count($data) > 0 ? (string)(max(array_column($data, 'id')) + 1) : "1";
    $nuevaCarrera = [
        "id" => $newId,
        "nombre" => $nombre,
        "clave" => $clave,
        "modalidad" => $modalidad,
        "duracion" => $duracion,
        "estado" => $estado,
        "objetivo" => $objetivo,
        "ingreso" => $ingreso,
        "egreso" => $egreso
    ];
    $data[] = $nuevaCarrera;
    file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo json_encode(["success" => true, "message" => "Carrera registrada correctamente."]);
}
