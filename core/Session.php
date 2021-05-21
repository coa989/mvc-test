<?php


namespace app\core;


class Session
{

    protected const FLASH_KEY = 'flashMessage';

    public function __construct()
    {
        session_start();
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($key)
    {
        return $_SESSION[$key];
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
        session_destroy();
    }

    public function isGuest()
    {
        return !isset($_SESSION['user']);
    }

    public function setFlash($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = $message;
    }

    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key];
    }


    public function removeFlash($key)
    {
        unset($_SESSION[self::FLASH_KEY][$key]);
    }
}