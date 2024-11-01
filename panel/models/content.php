<?php

include_once dirname(__DIR__, 1) . "/config/db.php";
include_once dirname(__DIR__, 1) . '/utils/logs.php';
include_once dirname(__DIR__, 1) . '/utils/image.php';
class ContentModel
{
    private $db = null;

    public function __construct()
    {
        $this->db = DB::get_instace();
    }

    /**
     * Crea un nuevo contenido
     * 
     * @param string $name nombre del contenido
     * @param string $title titulo del contenido
     * @param string $text texto del contenido
     * @param string $image imagen del contenido
     * @param int $section id de la sección del contenido
     * @param int $language id del idioma del contenido
     * @return boolean true en caso de que se registre el contenido, false en caso contrario
     */
    public function create($name, $title, $text, $image, $section, $language)
    {
        try {
            $conn = $this->db->get_connection();
            $stmt = $conn->prepare("INSERT INTO cat_content (v_name, v_title, v_text, v_image, id_section, id_language) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("ssssii", $name, $title, $text, $image, $section, $language);

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
            $stmt = $conn->prepare("SELECT * FROM cat_content WHERE id_section = ? AND id_language = ? AND b_status = 1");
            $stmt->bind_param("ii", $section, $language);

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $content = [
                        "id" => intval($row["id"]),
                        "name" => strval($row["v_name"]),
                        "title" => strval($row["v_title"]),
                        "text" => strval($row["v_text"]),
                        "image" => ImageHandler::build_image_route(strval($row["v_image"])),
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
     * Consulta el contenido con el id especificado
     * 
     * @param int $id id de la imagen
     * @return array arreglo asosiativo con los datos del contenido
     */
    public function read_by_id($id)
    {
        $content = [];
        try {
            $conn = $this->db->get_connection();
            $stmt = $conn->prepare("SELECT * FROM cat_content WHERE id = ?");
            $stmt->bind_param("i", $id);

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $content = [
                        "id" => intval($row["id"]),
                        "name" => strval($row["v_name"]),
                        "title" => strval($row["v_title"]),
                        "text" => strval($row["v_text"]),
                        "image" => $row["v_image"],
                        "language" => intval($row["id_language"]),
                    ];
                }
            }
            
            $stmt->close();
        } catch (\Throwable $th) {
            $content = [];
            Logger::log(Logger::$ERROR, $th);
        } finally {
            return $content;
        }
    }

    /**
     * Modifica los datos del contenido especificado
     * 
     * @param int $id id del contenido
     * @param string $name nombre del contenido
     * @param string $title titulo del contenido
     * @param string $text texto del contenido
     * @param string $image imagen del contenido
     * @return boolean true en caso de que se actualice el contenido, false en caso contrario
     */
    public function update($id, $name, $title, $text, $image)
    {
        try {
            $conn = $this->db->get_connection();
            $stmt = $conn->prepare("UPDATE cat_content SET v_name=?, v_title=?, v_text=?, v_image=?, d_modify_date = NOW() WHERE id = ?");
            $stmt->bind_param("ssssi", $name, $title, $text, $image, $id);

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

    /**
     * Elimina lógicamente el contenido especificado
     * 
     * @param int $id id del contenido
     * @return boolean true en caso de que se elimine el contenido, false en caso contrario
     */
    public function delete($id)
    {
        try {
            $conn = $this->db->get_connection();
            $stmt = $conn->prepare("UPDATE cat_content SET b_status=0, d_modify_date = NOW() WHERE id = ?");
            $stmt->bind_param("i", $id);

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
