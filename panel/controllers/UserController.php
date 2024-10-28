<?php

include_once dirname(__DIR__, 1) . "/utils/render.php";
include_once dirname(__DIR__, 1) . "/utils/logs.php";
include_once dirname(__DIR__, 1) . "/utils/security.php";
include_once dirname(__DIR__, 1) . "/models/user.php";

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
        header("Location: http://localhost/panel/home");
    }

    public function profile()
    {
        $data = [];
        if (!isset($_COOKIE["auth_token"])) {
            header("Location: http://localhost/panel/home");
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (isset($_POST['id']) && isset($_POST['email']) && isset($_POST['old-password']) && isset($_POST['new-password'])) {
                $user = $this->userModel->read_current(Security::get_username());
                if ($user['password'] == Security::hash($_POST['old-password'])) {
                    $password = (trim($_POST['new-password']) == "") ? $user['password'] : $_POST['new-password'];
                    if ($this->userModel->update($_POST['id'], $_POST['email'], Security::hash($password))) {
                        $data["notify"] = [
                            "type" => "success",
                            "message" => "Datos modificados"
                        ];
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
