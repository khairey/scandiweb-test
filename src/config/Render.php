<?php

namespace src\config;

class Render
{
    public static function view($view, $params = [])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include __DIR__ . "../../views/$view.php";
        $content = ob_get_clean();
        include __DIR__ . "../../views/layouts/_layout.php";
    }
}
