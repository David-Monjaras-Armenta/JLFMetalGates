<?php

class Logger {
    public static $DEBUG = "DEBUG"; 
    public static $INFO = "INFO"; 
    public static $WARINGIN = "WARNING"; 
    public static $ERROR = "ERROR"; 

    /**
     * Registra el mensaje especificado en un archivo .log llamado como el día en curso, si el
     * archivo no existe, lo crea
     * 
     * @param string $level (INFO, DEBUG, WARNING, ERROR)
     * @param string $message mensaje que se desea loggear
     */
    public static function log($level="INFO", $message)
    {
        # Se obtiene el path de la raíz del proyecto
        $path = dirname(__DIR__, 2);
        # Se define el nombre del archivo log
        $dir = $path . '/logs/' . date('Y-m-d') . '.log';
        
        # Se verifica si existe la carpeta logs, si no existe se crea
        if (!is_dir($path . '/logs')) {
            mkdir($path . '/logs', 0777, true);
        }

        # Se verifica si existe el archivo log, si no existe se crea
        if (!file_exists($dir)) {
            $file = fopen($dir, 'w');
            if($file) {
                fclose($file);
            }
        }

        # Se registra el log
        $date = date('Y-m-d H:i:s');
        $formatted_message = "$level [$date]: $message" . PHP_EOL;
        file_put_contents($dir, $formatted_message, FILE_APPEND);
    }
}