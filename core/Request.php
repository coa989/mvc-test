<?php


namespace app\core;


class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'];
        // proveravamo poziciju ?
        $position = strpos($path, '?');
        // ako ne postoji vracamo $path
        if ($position === false) {
            return $path;
        }
        // ako postoji vracamo $path do ?
        return substr($path, 0, $position);
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}