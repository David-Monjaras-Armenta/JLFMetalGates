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
}