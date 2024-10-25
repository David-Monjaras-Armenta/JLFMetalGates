<?php

include_once dirname(__DIR__, 1) . "/utils/render.php";
include_once dirname(__DIR__, 1) . "/utils/logs.php";
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

                $result_en = $this->contentModel->update($en["id"], $en["name"], $en["title"], $en["text"], "pictures/home/img_desktop1.webp, pictures/home/img_tablet1.webp, pictures/home/img_mobile1.webp");

                $result_es = $this->contentModel->update($es["id"], $es["name"], $es["title"], $es["text"], "pictures/home/img_desktop1.webp, pictures/home/img_tablet1.webp, pictures/home/img_mobile1.webp");

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
            } else {
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

                $result_en = $this->contentModel->create($en["name"], $en["title"], $en["text"], "pictures/home/img_desktop1.webp, pictures/home/img_tablet1.webp, pictures/home/img_mobile1.webp", 2, 2);

                $result_es = $this->contentModel->create($es["name"], $es["title"], $es["text"], "pictures/home/img_desktop1.webp, pictures/home/img_tablet1.webp, pictures/home/img_mobile1.webp", 2, 1);

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

                $result_en = $this->contentModel->update($en["id"], $en["name"], $en["title"], "", "pictures/solutions/img_before2.webp, pictures/solutions/img_after2.webp");

                $result_es = $this->contentModel->update($es["id"], $es["name"], $es["title"], "", "pictures/solutions/img_before2.webp, pictures/solutions/img_after2.webp");

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
            } else {
                $en = [
                    "name" => $_POST["name"],
                    "title" => $_POST["title_en"],
                ];

                $es = [
                    "name" => $_POST["name"],
                    "title" => $_POST["title_es"],
                ];

                $result_en = $this->contentModel->create($en["name"], $en["title"], "", "pictures/solutions/img_before2.webp, pictures/solutions/img_after2.webp", 3, 2);

                $result_es = $this->contentModel->create($es["name"], $es["title"], "", "pictures/solutions/img_before2.webp, pictures/solutions/img_after2.webp", 3, 1);

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

                $result_en = $this->contentModel->update($en["id"], $en["name"], $en["title"], $en["text"], "pictures/about/icon3.webp");

                $result_es = $this->contentModel->update($es["id"], $es["name"], $es["title"], $es["text"], "pictures/about/icon3.webp");

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
            } else {
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

                $result_en = $this->contentModel->create($en["name"], $en["title"], $en["text"], "pictures/about/icon3.webp", 4, 2);

                $result_es = $this->contentModel->create($es["name"], $es["title"], $es["text"], "pictures/about/icon3.webp", 4, 1);

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
                        "text" => $_POST["text_en"],
                    ];
    
                    $result_en = $this->contentModel->update($en["id"], $en["name"], $en["title"], $en["text"], "");
    
                    $result_es = $this->contentModel->update($es["id"], $es["name"], $es["title"], $es["text"], "");
                } else {
                    $en = [
                        "id" => intval($_POST["id_en"]),
                        "name" => $_POST["name_en"],
                    ];
    
                    $es = [
                        "id" => intval($_POST["id_es"]),
                        "name" => $_POST["name_en"],
                    ];
    
                    $result_en = $this->contentModel->update($en['id'], $en["name"], "", "", "pictures/gallery/image2.webp");
    
                    $result_es = $this->contentModel->update($es['id'], $es["name"], "", "", "pictures/about/pictures/gallery/image2.webp");
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
                        "text" => $_POST["text_en"],
                    ];
    
                    $result_en = $this->contentModel->create($en["name"], $en["title"], $en["text"], "", 5, 2);
    
                    $result_es = $this->contentModel->create($es["name"], $es["title"], $es["text"], "", 5, 1);
                } else {
                    $en = [
                        "name" => $_POST["name"],
                    ];
    
                    $es = [
                        "name" => $_POST["name"],
                    ];
    
                    $result_en = $this->contentModel->create($en["name"], "", "", "pictures/gallery/image.webp", 5, 2);
    
                    $result_es = $this->contentModel->create($es["name"], "", "", "pictures/about/pictures/gallery/image.webp", 5, 1);
                }

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

                $result_en = $this->contentModel->update($en["id"], $en["name"], $en["title"], $en["text"], "");

                $result_es = $this->contentModel->update($es["id"], $es["name"], $es["title"], $es["text"], "");

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
            } else {
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

                $result_en = $this->contentModel->create($en["name"], $en["title"], $en["text"], "", 6, 2);

                $result_es = $this->contentModel->create($es["name"], $es["title"], $es["text"], "", 6, 1);

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
            }
        }

        $section = $this->sectionModel->read_by_id(6);
        $data["section"] = $section;
        Render::render_view("cms/contact", $data);
    }
}
