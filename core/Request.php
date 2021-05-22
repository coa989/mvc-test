<?php

namespace app\core;

/**
 * Class Request
 * @package app\core
 */
class Request
{
    /**
     * @return false|mixed|string
     */
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

    /**
     * @return string
     */
    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @return array
     */
    public function getBody()
    {
        $body = [];

        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }

    /**
     * @return bool
     */
    public function isPost()
    {
        return $this->getMethod() === 'post';
    }

    /**
     * @return bool
     */
    public function isGet()
    {
        return $this->getMethod() === 'get';
    }
}