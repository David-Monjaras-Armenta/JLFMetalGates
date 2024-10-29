<?php

include_once dirname(__DIR__, 1) . "/utils/render.php";
include_once dirname(__DIR__, 1) . "/utils/logs.php";
include_once dirname(__DIR__, 1) . "/utils/image.php";
include_once dirname(__DIR__, 1) . "/utils/security.php";
include_once dirname(__DIR__, 1) . "/models/section.php";
include_once dirname(__DIR__, 1) . "/models/content.php";

class CmsController
{
    private $sectionModel = null;
    private $contentModel = null;

    public function __construct()
    {
        $this->sectionModel = new SectionModel();
        $this->contentModel = new ContentModel();
    }

    public function home()
    {
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST["id_en"])) {
                $images = explode(", ", $this->contentModel->read_by_id($_POST['id_en'])['image']);

                $image_desk = $images[0];
                $image_tab = $images[1];
                $image_mov = $images[2];

                if ($_FILES["image_desk"]["size"] > 0) {
                    $image_desk = ImageHandler::upload($_FILES["image_desk"], "pictures");
                }
                if ($_FILES["image_tab"]["size"] > 0) {
                    $image_tab = ImageHandler::upload($_FILES["image_tab"], "pictures");
                }
                if ($_FILES["image_mov"]["size"] > 0) {
                    $image_mov = ImageHandler::upload($_FILES["image_mov"], "pictures");
                }

                $en = [
                    "id" => intval($_POST["id_en"]),
                    "name" => $_POST["name_en"],
                    "title" => $_POST["title_en"],
                    "text" => $_POST["text_en"],
                ];

                $es = [
                    "id" => intval($_POST["id_es"]),
                    "name" => $_POST["name_en"],
                    "title" => $_POST["title_es"],
                    "text" => $_POST["text_es"],
                ];

                $result_en = $this->contentModel->update($en["id"], $en["name"], $en["title"], $en["text"], "{$image_desk}, {$image_tab}, {$image_mov}");

                $result_es = $this->contentModel->update($es["id"], $es["name"], $es["title"], $es["text"], "{$image_desk}, {$image_tab}, {$image_mov}");

                if ($result_en && $result_es) {
                    $data["notify"] = [
                        "type" => "success",
                        "message" => "'{$en['name']}' modificado correctamente"
                    ];
                } else {
                    $data["notify"] = [
                        "type" => "error",
                        "message" => "Error al modificar '{$en['name']}'"
                    ];
                }
            } else if(isset($_POST["delete"])) {
                $result_en = $this->contentModel->delete($_POST['en']);
                $result_es = $this->contentModel->delete($_POST['es']);

                if ($result_en && $result_es) {
                    $data["notify"] = [
                        "type" => "success",
                        "message" => "'{$_POST['delete']}' eliminado correctamente"
                    ];
                } else {
                    $data["notify"] = [
                        "type" => "error",
                        "message" => "Error al eliminar '{$_POST['delete']}'"
                    ];
                }
            } else {
                if (isset($_FILES["image_desk"]) && isset($_FILES["image_tab"]) && isset($_FILES["image_mov"])) {
                    $image_desk = ImageHandler::upload($_FILES["image_desk"], "pictures");
                    $image_tab = ImageHandler::upload($_FILES["image_tab"], "pictures");
                    $image_mov = ImageHandler::upload($_FILES["image_mov"], "pictures/");

                    $en = [
                        "name" => $_POST["name"],
                        "title" => $_POST["title_en"],
                        "text" => $_POST["text_en"],
                    ];

                    $es = [
                        "name" => $_POST["name"],
                        "title" => $_POST["title_es"],
                        "text" => $_POST["text_es"],
                    ];

                    $result_en = $this->contentModel->create($en["name"], $en["title"], $en["text"], "{$image_desk}, {$image_tab}, {$image_mov}", 2, 2);

                    $result_es = $this->contentModel->create($es["name"], $es["title"], $es["text"], "{$image_desk}, {$image_tab}, {$image_mov}", 2, 1);

                    if ($result_en && $result_es) {
                        $data["notify"] = [
                            "type" => "success",
                            "message" => "Elemento creado"
                        ];
                    } else {
                        $data["notify"] = [
                            "type" => "error",
                            "message" => "Error al crear el elemento"
                        ];
                    }
                } else {
                    $data["notify"] = [
                        "type" => "error",
                        "message" => "Error al crear el elemento"
                    ];
                }
            }
        }

        $section = $this->sectionModel->read_by_id(2);
        $data["section"] = $section;
        Render::render_view("cms/home", $data);
    }

    public function solutions()
    {
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id_en'])) {
                $images = explode(", ", $this->contentModel->read_by_id($_POST['id_en'])['image']);
                $image_before = $images[0];
                $image_after = $images[1];

                if ($_FILES["image_before"]["size"] > 0) {
                    $image_before = ImageHandler::upload($_FILES["image_before"], "pictures");
                }
                if ($_FILES["image_after"]["size"] > 0) {
                    $image_after = ImageHandler::upload($_FILES["image_after"], "pictures");
                }

                $en = [
                    "id" => intval($_POST["id_en"]),
                    "name" => $_POST["name_en"],
                    "title" => $_POST["title_en"],
                ];

                $es = [
                    "id" => intval($_POST["id_es"]),
                    "name" => $_POST["name_en"],
                    "title" => $_POST["title_es"],
                ];

                $result_en = $this->contentModel->update($en["id"], $en["name"], $en["title"], "", "{$image_before}, {$image_after}");

                $result_es = $this->contentModel->update($es["id"], $es["name"], $es["title"], "", "{$image_before}, {$image_after}");

                if ($result_en && $result_es) {
                    $data["notify"] = [
                        "type" => "success",
                        "message" => "'{$en['name']}' modificado correctamente"
                    ];
                } else {
                    $data["notify"] = [
                        "type" => "error",
                        "message" => "Error al modificar '{$en['name']}'"
                    ];
                }
            } else if(isset($_POST["delete"])) {
                $result_en = $this->contentModel->delete($_POST['en']);
                $result_es = $this->contentModel->delete($_POST['es']);

                if ($result_en && $result_es) {
                    $data["notify"] = [
                        "type" => "success",
                        "message" => "'{$_POST['delete']}' eliminado correctamente"
                    ];
                } else {
                    $data["notify"] = [
                        "type" => "error",
                        "message" => "Error al eliminar '{$_POST['delete']}'"
                    ];
                }
            } else {
                if (isset($_FILES["image_after"]) && isset($_FILES["image_before"])) {
                    $image_before = ImageHandler::upload($_FILES["image_before"], "pictures");
                    $image_after = ImageHandler::upload($_FILES["image_after"], "pictures");

                    $en = [
                        "name" => $_POST["name"],
                        "title" => $_POST["title_en"],
                    ];

                    $es = [
                        "name" => $_POST["name"],
                        "title" => $_POST["title_es"],
                    ];

                    $result_en = $this->contentModel->create($en["name"], $en["title"], "", "{$image_before}, {$image_after}", 3, 2);

                    $result_es = $this->contentModel->create($es["name"], $es["title"], "", "{$image_before}, {$image_after}", 3, 1);

                    if ($result_en && $result_es) {
                        $data["notify"] = [
                            "type" => "success",
                            "message" => "Elemento creado"
                        ];
                    } else {
                        $data["notify"] = [
                            "type" => "error",
                            "message" => "Error al crear el elemento"
                        ];
                    }
                } else {
                    $data["notify"] = [
                        "type" => "error",
                        "message" => "Error al crear el elemento"
                    ];
                }
            }
        }

        $section = $this->sectionModel->read_by_id(3);
        $data["section"] = $section;
        Render::render_view("cms/solutions", $data);
    }

    public function about()
    {
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id_en'])) {
                $image = $this->contentModel->read_by_id($_POST['id_en'])['image'];
                if ($_FILES["image"]["size"] > 0) {
                    $image = ImageHandler::upload($_FILES["image"], "pictures");
                }

                $en = [
                    "id" => intval($_POST["id_en"]),
                    "name" => $_POST["name_en"],
                    "title" => $_POST["title_en"],
                    "text" => $_POST["text_en"],
                ];

                $es = [
                    "id" => intval($_POST["id_es"]),
                    "name" => $_POST["name_en"],
                    "title" => $_POST["title_es"],
                    "text" => $_POST["text_es"],
                ];

                $result_en = $this->contentModel->update($en["id"], $en["name"], $en["title"], $en["text"], $image);

                $result_es = $this->contentModel->update($es["id"], $es["name"], $es["title"], $es["text"], $image);

                if ($result_en && $result_es) {
                    $data["notify"] = [
                        "type" => "success",
                        "message" => "'{$en['name']}' modificado correctamente"
                    ];
                } else {
                    $data["notify"] = [
                        "type" => "error",
                        "message" => "Error al modificar '{$en['name']}'"
                    ];
                }
            } else if(isset($_POST["delete"])) {
                $result_en = $this->contentModel->delete($_POST['en']);
                $result_es = $this->contentModel->delete($_POST['es']);

                if ($result_en && $result_es) {
                    $data["notify"] = [
                        "type" => "success",
                        "message" => "'{$_POST['delete']}' eliminado correctamente"
                    ];
                } else {
                    $data["notify"] = [
                        "type" => "error",
                        "message" => "Error al eliminar '{$_POST['delete']}'"
                    ];
                }
            } else {
                if ($_FILES["image"]["size"] > 0) {
                    $image = ImageHandler::upload($_FILES["image"], "pictures");

                    $en = [
                        "name" => $_POST["name"],
                        "title" => $_POST["title_en"],
                        "text" => $_POST["text_en"],
                    ];

                    $es = [
                        "name" => $_POST["name"],
                        "title" => $_POST["title_es"],
                        "text" => $_POST["text_es"],
                    ];

                    $result_en = $this->contentModel->create($en["name"], $en["title"], $en["text"], $image, 4, 2);

                    $result_es = $this->contentModel->create($es["name"], $es["title"], $es["text"], $image, 4, 1);

                    if ($result_en && $result_es) {
                        $data["notify"] = [
                            "type" => "success",
                            "message" => "Elemento creado"
                        ];
                    } else {
                        $data["notify"] = [
                            "type" => "error",
                            "message" => "Error al crear el elemento"
                        ];
                    }
                } else {
                    $data["notify"] = [
                        "type" => "error",
                        "message" => "Error al crear el elemento"
                    ];
                }
            }
        }

        $section = $this->sectionModel->read_by_id(4);
        $data["section"] = $section;
        Render::render_view("cms/about", $data);
    }

    public function gallery()
    {
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id_en'])) {
                if (isset($_POST["title_en"])) {
                    $en = [
                        "id" => intval($_POST['id_en']),
                        "name" => $_POST["name_en"],
                        "title" => $_POST["title_en"],
                        "text" => $_POST["text_en"],
                    ];

                    $es = [
                        "id" => intval($_POST['id_es']),
                        "name" => $_POST["name_en"],
                        "title" => $_POST["title_es"],
                        "text" => $_POST["text_es"],
                    ];

                    $result_en = $this->contentModel->update($en["id"], $en["name"], $en["title"], $en["text"], "");

                    $result_es = $this->contentModel->update($es["id"], $es["name"], $es["title"], $es["text"], "");
                } else if(isset($_POST["delete"])) {
                    $result_en = $this->contentModel->delete($_POST['en']);
                    $result_es = $this->contentModel->delete($_POST['es']);
    
                    if ($result_en && $result_es) {
                        $data["notify"] = [
                            "type" => "success",
                            "message" => "'{$_POST['delete']}' eliminado correctamente"
                        ];
                    } else {
                        $data["notify"] = [
                            "type" => "error",
                            "message" => "Error al eliminar '{$_POST['delete']}'"
                        ];
                    }
                } else {
                    $image = $this->contentModel->read_by_id($_POST['id_en'])['image'];
                    if ($_FILES["image"]["size"] > 0) {
                        $image = ImageHandler::upload($_FILES["image"], "pictures");
                    }

                    $en = [
                        "id" => intval($_POST["id_en"]),
                        "name" => $_POST["name_en"],
                    ];

                    $es = [
                        "id" => intval($_POST["id_es"]),
                        "name" => $_POST["name_en"],
                    ];

                    $result_en = $this->contentModel->update($en['id'], $en["name"], "", "", $image);

                    $result_es = $this->contentModel->update($es['id'], $es["name"], "", "", $image);
                }

                if ($result_en && $result_es) {
                    $data["notify"] = [
                        "type" => "success",
                        "message" => "'{$_POST['name_en']}' modificado correctamente"
                    ];
                } else {
                    $data["notify"] = [
                        "type" => "error",
                        "message" => "Error al modificar '{$_POST['name_en']}'"
                    ];
                }
            } else if(isset($_POST["delete"])) {
                $result_en = $this->contentModel->delete($_POST['en']);
                $result_es = $this->contentModel->delete($_POST['es']);

                if ($result_en && $result_es) {
                    $data["notify"] = [
                        "type" => "success",
                        "message" => "'{$_POST['delete']}' eliminado correctamente"
                    ];
                } else {
                    $data["notify"] = [
                        "type" => "error",
                        "message" => "Error al eliminar '{$_POST['delete']}'"
                    ];
                }
            } else {
                if (isset($_POST["title_en"])) {
                    $en = [
                        "name" => $_POST["name"],
                        "title" => $_POST["title_en"],
                        "text" => $_POST["text_en"],
                    ];

                    $es = [
                        "name" => $_POST["name"],
                        "title" => $_POST["title_es"],
                        "text" => $_POST["text_es"],
                    ];

                    $result_en = $this->contentModel->create($en["name"], $en["title"], $en["text"], "", 5, 2);

                    $result_es = $this->contentModel->create($es["name"], $es["title"], $es["text"], "", 5, 1);
                } else {
                    if ($_FILES["image"]["size"] > 0) {
                        $image = ImageHandler::upload($_FILES["image"], "pictures");

                        $en = [
                            "name" => $_POST["name"],
                        ];

                        $es = [
                            "name" => $_POST["name"],
                        ];

                        $result_en = $this->contentModel->create($en["name"], "", "", $image, 5, 2);

                        $result_es = $this->contentModel->create($es["name"], "", "", $image, 5, 1);

                        if ($result_en && $result_es) {
                            $data["notify"] = [
                                "type" => "success",
                                "message" => "Elemento creado"
                            ];
                        } else {
                            $data["notify"] = [
                                "type" => "error",
                                "message" => "Error al crear el elemento"
                            ];
                        }
                    } else {
                        $data["notify"] = [
                            "type" => "error",
                            "message" => "Error al crear el elemento"
                        ];
                    }
                }
            }
        }

        $section = $this->sectionModel->read_by_id(5);
        $data["section"] = $section;
        Render::render_view("cms/gallery", $data);
    }

    public function contact()
    {
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['id_en'])) {
                $image = $this->contentModel->read_by_id($_POST['id_en'])['image'];
                if ($_FILES["image"]["size"] > 0) {
                    $image = ImageHandler::upload($_FILES["image"], "pictures");
                }

                $en = [
                    "id" => intval($_POST['id_en']),
                    "name" => $_POST["name_en"],
                    "title" => $_POST["title_en"],
                    "text" => $_POST["text_en"],
                ];

                $es = [
                    "id" => intval($_POST['id_es']),
                    "name" => $_POST["name_en"],
                    "title" => $_POST["title_es"],
                    "text" => $_POST["text_en"],
                ];

                $result_en = $this->contentModel->update($en["id"], $en["name"], $en["title"], $en["text"], $image);

                $result_es = $this->contentModel->update($es["id"], $es["name"], $es["title"], $es["text"], $image);

                if ($result_en && $result_es) {
                    $data["notify"] = [
                        "type" => "success",
                        "message" => "'{$_POST['name_en']}' modificado correctamente"
                    ];
                } else {
                    $data["notify"] = [
                        "type" => "error",
                        "message" => "Error al modificar '{$_POST['name_en']}'"
                    ];
                }
            } else if(isset($_POST["delete"])) {
                $result_en = $this->contentModel->delete($_POST['en']);
                $result_es = $this->contentModel->delete($_POST['es']);

                if ($result_en && $result_es) {
                    $data["notify"] = [
                        "type" => "success",
                        "message" => "'{$_POST['delete']}' eliminado correctamente"
                    ];
                } else {
                    $data["notify"] = [
                        "type" => "error",
                        "message" => "Error al eliminar '{$_POST['delete']}'"
                    ];
                }
            } else {
                if ($_FILES["image"]["size"] > 0) {
                    $image = ImageHandler::upload($_FILES["image"], "pictures");

                    $en = [
                        "name" => $_POST["name"],
                        "title" => $_POST["title_en"],
                        "text" => $_POST["text_en"],
                    ];
    
                    $es = [
                        "name" => $_POST["name"],
                        "title" => $_POST["title_es"],
                        "text" => $_POST["text_en"],
                    ];
    
                    $result_en = $this->contentModel->create($en["name"], $en["title"], $en["text"], $image, 6, 2);
    
                    $result_es = $this->contentModel->create($es["name"], $es["title"], $es["text"], $image, 6, 1);
    
                    if ($result_en && $result_es) {
                        $data["notify"] = [
                            "type" => "success",
                            "message" => "Elemento creado"
                        ];
                    } else {
                        $data["notify"] = [
                            "type" => "error",
                            "message" => "Error al crear el elemento"
                        ];
                    }
                } else {
                    $data["notify"] = [
                        "type" => "error",
                        "message" => "Error al crear el elemento"
                    ];
                }
            }
        }

        $section = $this->sectionModel->read_by_id(6);
        $data["section"] = $section;
        Render::render_view("cms/contact", $data);
    }
}
