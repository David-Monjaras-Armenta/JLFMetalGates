<?php

require "../config/db.php";

class ContactModel
{
    private $db = null;

    public function __construct()
    {
        $this->db = DB::get_instace();
    }

    /**
     * Registra un contacto con los datos especificados
     * 
     * @param string $name nombre del contacto
     * @param string $email correo del contacto
     * @param string $phone teléfono del contacto
     * @param string $message mensaje del contacto
     * @return boolean true en caso de registrar el contacto, false en caso contrario
     */
    public function create($name, $email, $phone, $message)
    {
        try {
            $conn = $this->db->get_connection();
            $stmt = $conn->prepare("INSERT INTO tbl_contact (v_name, v_email, v_phone, v_message) VALUES (?,?,?,?)");
            $stmt->bind_param("ssss", $name, $email, $phone, $message);

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
     * Consulta todos los contactos sin atender
     * 
     * @return array arreglo de arreglos asosiativos con los contactos
     */
    public function read()
    {
        $contacts = [];
        try {
            $conn = $this->db->get_connection();
            $stmt = $conn->prepare("SELECT * FROM tbl_contact WHERE b_status = 1 ORDER BY d_record_date ASC");

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $contact = [
                        "id" => intval($row["id"]),
                        "name" => strval($row["v_name"]),
                        "email" => strval($row["v_email"]),
                        "phone" => strval($row["v_phone"]),
                        "message" => strval($row["v_message"]),
                        "status" => boolval($row["b_status"]),
                        "record_date" => new DateTime($row["d_record_date"]),
                    ];
                    array_push($contacts, $contact);
                }
            }
            
            $stmt->close();
        } catch (\Throwable $th) {
            $contacts = [];
            Logger::log(Logger::$ERROR, $th);
        } finally {
            return $contacts;
        }
    }

    /**
     * Modifica el estatus de un contacto
     * 
     * @param int $id id del contacto
     * @return boolean true en caso de que se actualice el contacto, false en caso contrario
     */
    public function update($id)
    {
        try {
            $conn = $this->db->get_connection();
            $stmt = $conn->prepare("UPDATE tbl_contact SET b_status = 0 WHERE id = ?");
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