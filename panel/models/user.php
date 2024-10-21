<?php

require "../config/db.php";

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
     * @return user arreglo asosiativo con los datos del usuario
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
                        "id" => $row("id"),
                        "email" => $row("id"),
                        "role" => $row("i_rolw"),
                        "status" => $row("b_status"),
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
}
