<?php

include_once dirname(__DIR__, 1) . "/config/db.php";
include_once dirname(__DIR__, 1) . '/utils/logs.php';

class LanguageModel
{
    private $db = null;

    public function __construct()
    {
        $this->db = DB::get_instace();
    }

    /**
     * Consulta los idiomas del sistema
     * 
     * @return array arreglo de arreglos asosiativos con los idiomas
     */
    public function read()
    {
        $languages = [];
        try {
            $conn = $this->db->get_connection();
            $stmt = $conn->prepare("SELECT * FROM cat_language");

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $language = [
                        "id" => intval($row["id"]),
                        "icon" => strval($row["v_icon"]),
                        "name" => strval($row["v_name"]),
                        "status" => boolval($row["b_status"]),
                    ];
                    array_push($languages, $language);
                }
            }
            $stmt->close();
        } catch (\Throwable $th) {
            $languages = [];
            Logger::log(Logger::$ERROR, $th);
        } finally {
            return $languages;
        }
    }
}