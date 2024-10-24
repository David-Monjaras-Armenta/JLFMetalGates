<?php

include_once dirname(__DIR__, 1) . "/utils/render.php";
include_once dirname(__DIR__, 1) . "/utils/logs.php";
include_once dirname(__DIR__, 1) . "/utils/security.php";
include_once dirname(__DIR__, 1) . "/models/contact.php";

class ContactController
{
    private $contactModel = null;

    public function __construct()
    {
        $this->contactModel = new ContactModel();
    }

    public function index()
    {
        

        $data = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST["id"])) {
                $result = $this->contactModel->update(intval($_POST["id"]));
                if ($result) {
                    $data["notify"] = [
                        "type" => "success",
                        "message" => "Contacto actualizado"
                    ];
                } else {
                    $data["notify"] = [
                        "type" => "success",
                        "message" => "No fue posible actualizar el contacto"
                    ];
                }
            }
        }

        $contacts = $this->contactModel->read();
        $data["contacts"] = $contacts;
        Render::render_view("contact/index", $data);
    }
}
