<?php

include_once dirname(__DIR__, 1) . "/config/db.php";
include_once dirname(__DIR__, 1) . '/utils/logs.php';

class UserModel
{
    private $db = null;

    public function __construct()
    {
        $this->db = DB::get_instace();
    }

    /**
     * Consulta el usuario con el correo y contraseña especificados
     * 
     * @param string $email correo del usuario
     * @param string $password contraseña del usuario (cifrada en SHA256)
     * @return array arreglo asosiativo con los datos del usuario
     */
    public function read_by_email($email, $password)
    {
        $user = [];
        try {
            $conn = $this->db->get_connection();
            $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE v_email = ? AND v_password = ?");
            $stmt->bind_param("ss", $email, $password);

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $user = [
                        "id" => intval($row["id"]),
                        "email" => strval($row["v_email"]),
                        "role" => intval($row["i_role"]),
                        "status" => boolval($row["b_status"]),
                    ];
                }
            }
            $stmt->close();
        } catch (\Throwable $th) {
            $user = [];
            Logger::log(Logger::$ERROR, $th);
        } finally {
            return $user;
        }
    }

    /**
     * Consulta el usuario con el correo especificado
     * 
     * @param string $email correo del usuario
     * @return array arreglo asosiativo con los datos del usuario
     */
    public function read_current($email)
    {
        $user = [];
        try {
            $conn = $this->db->get_connection();
            $stmt = $conn->prepare("SELECT * FROM tbl_user WHERE v_email = ?");
            $stmt->bind_param("s", $email);

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $user = [
                        "id" => intval($row["id"]),
                        "email" => strval($row["v_email"]),
                        "password" => strval($row["v_password"]),
                        "role" => intval($row["i_role"]),
                        "status" => boolval($row["b_status"]),
                    ];
                }
            }
            $stmt->close();
        } catch (\Throwable $th) {
            $user = [];
            Logger::log(Logger::$ERROR, $th);
        } finally {
            return $user;
        }
    }

    /**
     * Modifica los datos del usuario especificado
     * 
     * @param int $id id del usuario
     * @param string $email nuevo email del usuario
     * @param string $password nuevo password del usuario
     * @return boolean true en caso de que se actualice el usuario, false en caso contrario
     */
    public function update($id, $email, $password)
    {
        try {
            $conn = $this->db->get_connection();
            $stmt = $conn->prepare("UPDATE tbl_user SET v_email=?, v_password=?,d_modify_date = NOW() WHERE id = ?");
            $stmt->bind_param("ssi", $email, $password, $id);

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