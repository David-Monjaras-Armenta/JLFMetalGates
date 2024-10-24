<?php

# Parsear la URL a un array
$url = [];
if (isset($_GET['url'])) {
    $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
}

# Se busca el controllador
$controller = null;
if (file_exists('./controllers/' . ucfirst($url[0]) . 'Controller.php')) {
    $controller = ucfirst($url[0]) . "Controller";
    unset($url[0]);
}

# Se importa el controlador
require_once './controllers/' . $controller . '.php';
$controller = new $controller;

# Se busca el método del controlador
$method = null;
if (isset($url[1])) {
    if (method_exists($controller, $url[1])) {
        $method = $url[1];
        unset($url[1]);
    }
}

# Se obtienen los parámetros
$params = $url ? array_values($url) : [];

# Se ejecuta el método y función
call_user_func_array([$controller, $method], $params);
