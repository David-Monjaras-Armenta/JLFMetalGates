<?php
include_once '../../vendor/autoload.php';
include_once '../utils/logs.php';

# Carga de las variables de entorno
use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

class DB
{
    private static $instance = null;
    private $conn = null;

    private $host;
    private $user;
    private $password;
    private $database;

    public function __construct()
    {
        $this->host = $_ENV['DB_HOST'];
        $this->user = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASS'];
        $this->database = $_ENV['DB_NAME'];
    }

    /**
     * Devuelve una instancia única de la clase DB
     */
    public static function get_instace()
    {
        if (self::$instance === null) {
            self::$instance = new DB();
        }
        return self::$instance;
    }

    /**
     * Devuelve una conexión válida a la base de datos
     * 
     * @return mysqli conexión a la base de datos (null en caso de error)
     */
    public function get_connection()
    {
        try {
            if ($this->conn == null) {
                $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);
                $this->conn->autocommit(false);
            }
        } catch (\Throwable $th) {
            $this->conn = null;
            Logger::log(Logger::$ERROR, $th);
        } finally {
            return $this->conn;
        }
    }

    /**
     * Cierra la conexión a la base de datos si es que esta abierta
     */
    public function close_connection()
    {
        if ($this->conn != null) {
            $this->conn->close();
        }
    }
}