<?php
include_once dirname(__DIR__, 1) . "/utils/mailer.php";
include_once dirname(__DIR__, 1) . "/utils/logs.php";
include_once dirname(__DIR__, 1) . "/models/contact.php";
include_once dirname(__DIR__, 2) . '/vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

header('Content-Type: application/json');

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
header("Access-Control-Request-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Allow: GET, POST, PUT, DELETE, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$response = [
    "status" => "error",
    "message" => "Error inesperado"
];
try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['message'])) {
            $contactModel = new ContactModel();
            if ($contactModel->create($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['message'])) {
                $message = "Nombre: <b>{$_POST['name']}</b><br/>";
                $message .= "Correo Electrónico: <b>{$_POST['email']}</b><br/>";
                $message .= "Teléfono: <b>{$_POST['phone']}</b><br/>";
                $message .= "Mensaje: {$_POST['message']}";

                MailHandler::send_mail($_ENV['ADMIN_MAIL'], "JlF Metal Gates - Nuevo Contacto", $message);
                $response = [
                    "status" => "success",
                    "message" => "Contacto registrado"
                ];
            }
        } else {
            http_response_code(403);
            $response = [
                "status" => "error",
                "message" => "No se encontraron uno o más campos requeridos"
            ];
        }
    } else {
        http_response_code(405);
        $response = [
            "status" => "error",
            "message" => "Método {$_SERVER['REQUEST_METHOD']} no soportado"
        ];
    }

    echo json_encode($response);
} catch (\Throwable $th) {
    Logger::log(Logger::$ERROR, $th);
    $response = [
        "status" => "error",
        "message" => "Error inesperado"
    ];
    echo json_encode($response);
}
