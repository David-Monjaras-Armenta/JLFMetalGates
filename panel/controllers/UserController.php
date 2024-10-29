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

class UserController
{
    private $userModel = null;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function logout()
    {
        Security::dropCookie();
        header("Location: {$_ENV['DOMAIN']}/panel/home");
    }

    public function profile()
    {
        $data = [];
        if (!isset($_COOKIE["auth_token"])) {
            header("Location: {$_ENV['DOMAIN']}/panel/home");
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['id']) && isset($_POST['email']) && isset($_POST['old-password']) && isset($_POST['new-password'])) {
                $user = $this->userModel->read_current(Security::get_username());
                $password = (trim($_POST['new-password']) == "") ? $user['password'] : Security::hash($_POST['new-password']);
                if ($user['password'] == Security::hash($_POST['old-password'])) {
                    if ($this->userModel->update($_POST['id'], $_POST['email'], $password)) {
                        Security::dropCookie();
                        header("Location: {$_ENV['DOMAIN']}/panel/home");
                    } else {
                        $data["notify"] = [
                            "type" => "error",
                            "message" => "No fue posible modificar los datos"
                        ];
                    }
                } else {
                    $data["notify"] = [
                        "type" => "error",
                        "message" => "Crédenciales inválidas"
                    ];
                }
            }
        }

        $data['user'] = $this->userModel->read_current(Security::get_username());
        Render::render_view('user/profile', $data);
    }
}
