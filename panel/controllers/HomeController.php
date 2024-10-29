<?php

include_once dirname(__DIR__, 1) . "/utils/render.php";
include_once dirname(__DIR__, 1) . "/utils/logs.php";
include_once dirname(__DIR__, 1) . "/utils/security.php";
include_once dirname(__DIR__, 1) . "/models/user.php";

include_once dirname(__DIR__, 2) . '/vendor/autoload.php';

# Carga de las variables de entorno
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

class HomeController
{
    private $userModel = null;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST["email"]) || !isset($_POST["password"])) {
                Render::render_view("home/index", ["error" => "Correo y/o contraseña inválidos"]);
            } else {
                $user = $this->userModel->read_by_email($_POST["email"], Security::hash($_POST["password"]));

                if ($user) {
                    Security::setCookie($_POST["email"]);
                    header("Location: {$_ENV['DOMAIN']}/panel/contact");
                } else {
                    Render::render_view("home/index", ["error" => "Correo y/o contraseña inválidos"]);
                }
            }
        } else {
            Render::render_view("home/index");
        }
    }
}