<?php
require_once "connect.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

// Lire les données brutes de la requête HTTP
$input = file_get_contents("php://input");

// Afficher les données brutes pour le débogage
// echo 'Données brutes : ' . $input . '<br>';

// Décoder les données JSON
$data = json_decode($input);

// Vérifier si la décodage a échoué
if (json_last_error() !== JSON_ERROR_NONE) {
    // Afficher le message d'erreur de décodage JSON
    echo 'Erreur de décodage JSON : ' . json_last_error_msg();
} else {
    $task = R::dispense('task');
    $task-setAttr('title', $data->title);
    $task-setAttr('verified', $data->verified);
    R::store($task);
}

// Envoyer une réponse JSON au client (par exemple, une réponse de succès)
header('Content-Type: application/json');
echo json_encode(['status' => 'success', 'data' => $data]);







