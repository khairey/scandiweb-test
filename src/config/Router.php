<?php

namespace src\config;

class Router
{
    private array $requestRoutes = [];

    public function request($url, $fn)
    {
        $this->requestRoutes[$url] = $fn;
    }

    public function resolve()
    {
        $url = $_SERVER['REQUEST_URI'] ?? '/';
        // remove folder name in localhost
        $url = str_replace("/scandiweb-test", "", $url);
        $fn = $this->requestRoutes[$url] ?? null;
        if ($fn) {
            call_user_func($fn);
        } else {
            echo "Page Not Found";
        }
    }
}
