<?php

class ImageHandler
{
    public static function upload($image, $path, $name)
    {
        $basePath = dirname(__DIR__, 1) . "/images";
        if (!is_dir($basePath . "/" . $path)) {
            mkdir($basePath . "/" . $path, 0777, true);
        }

        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $name = $name . '.' . $ext;
        $file_name = $basePath . "/" . $path . "/" . $name;

        if (is_file($file_name)) {
            unlink($file_name);
        }

        $check = getimagesize($image['tmp_name']);

        if ($check !== false || $ext == "svg") {
            // Mover el archivo a la carpeta de destino
            if (move_uploaded_file($image['tmp_name'], $file_name)) {
                return $path . "/" . $name;
            }
        }

        return "";
    }
}