<?php

require "../config/db.php";

class ContentModel
{
    private $db = null;

    public function __construct()
    {
        $this->db = DB::get_instace();
    }

    /**
     * Consulta todos los contenidos de la sección e idioma especificados
     * 
     * @param int $language id del idioma
     * @param int $section id de la sección
     * @return array arreglo de arreglos asosiativos con los contenidos
     */
    public function read($language, $section)
    {
        $contents = [];
        try {
            $conn = $this->db->get_connection();
            $stmt = $conn->prepare("SELECT * FROM cat_content WHERE id_section = ? AND id_language = ?");
            $stmt->bind_param("ii", $section, $language);

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $content = [
                        "id" => intval($row["id"]),
                        "name" => strval($row["v_name"]),
                        "value" => strval($row["v_value"]),
                        "language" => intval($row["id_language"]),
                    ];
                    array_push($contents, $content);
                }
            }
            
            $stmt->close();
        } catch (\Throwable $th) {
            $contents = [];
            Logger::log(Logger::$ERROR, $th);
        } finally {
            return $contents;
        }
    }

    /**
     * Modifica los datos del contenido especificado
     * 
     * @param int $id id del contenido
     * @param int $content valor del contenido
     * @return boolean true en caso de que se actualice el contenido, false en caso contrario
     */
    public function update($id, $value)
    {
        try {
            $conn = $this->db->get_connection();
            $stmt = $conn->prepare("UPDATE cat_content SET v_value = ? WHERE id = ?");
            $stmt->bind_param("si", $value, $id);

            if ($stmt->execute()) {
                $stmt->close();
                $conn->commit();
                return true;
            }
            
            $stmt->close();
            $conn->rollback();
            return false;
        } catch (\Throwable $th) {
            Logger::log(Logger::$ERROR, $th);
            return false;
        }
    }
}