<?php

class Render {
    public static function render_view($view, $data = []) {
        require_once dirname(__DIR__, 1) . '/views/' . $view . '.php';
    }
}