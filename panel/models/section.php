<?php

include_once dirname(__DIR__, 1) . "/config/db.php";
include_once dirname(__DIR__, 1) . '/utils/logs.php';
include_once dirname(__DIR__, 1) . '/models/content.php';

class SectionModel
{
    private $db = null;
    private $contentModel = null;

    public function __construct()
    {
        $this->db = DB::get_instace();
        $this->contentModel = new ContentModel();
    }

    /**
     * Consulta todas las secciones
     * 
     * @return array arreglo de arreglos asosiativos con los datos de las secciones
     */
    public function read()
    {
        $sections = [];
        try {
            $conn = $this->db->get_connection();
            $stmt = $conn->prepare("SELECT * FROM cat_section WHERE b_status = 1");

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $section = [
                        "id" => intval($row["id"]),
                        "name" => strval($row["v_name"]),
                        "email" => strval($row["v_background"]),
                        "status" => boolval($row["b_status"]),
                        "en" => $this->contentModel->read(2, intval($row["id"])),
                        "es" => $this->contentModel->read(1, intval($row["id"])),
                    ];
                    array_push($sections, $section);
                }
            }
            
            $stmt->close();
        } catch (\Throwable $th) {
            $sections = [];
            Logger::log(Logger::$ERROR, $th);
        } finally {
            return $sections;
        }
    }

    /**
     * Consulta la sección con el id especificado
     * 
     * @return array arreglo asosiativo con los datos de la seccion
     */
    public function read_by_id($id)
    {
        $section = [];
        try {
            $conn = $this->db->get_connection();
            $stmt = $conn->prepare("SELECT * FROM cat_section WHERE id = ?");
            $stmt->bind_param("i", $id);

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $section = [
                        "id" => intval($row["id"]),
                        "name" => strval($row["v_name"]),
                        "email" => strval($row["v_background"]),
                        "status" => boolval($row["b_status"]),
                        "en" => $this->contentModel->read(2, intval($row["id"])),
                        "es" => $this->contentModel->read(1, intval($row["id"])),
                    ];
                }
            }
            
            $stmt->close();
        } catch (\Throwable $th) {
            $section = [];
            Logger::log(Logger::$ERROR, $th);
        } finally {
            return $section;
        }
    }
}
