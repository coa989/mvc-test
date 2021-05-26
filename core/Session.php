<?php

namespace app\core;

/**
 * Class Session
 * @package app\core
 */
class Session
{
    private const FLASH_KEY = 'flashMessages';

    /**
     * Session constructor.
     */
    public function __construct()
    {
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            $flashMessage['remove'] = true;
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        return $_SESSION[$key];
    }

    /**
     * @param $key
     */
    public function remove($key)
    {
        unset($_SESSION[$key]);
        session_destroy();
    }

    /**
     * @return bool
     */
    public function isGuest()
    {
        return !isset($_SESSION['user']);
    }

    /**
     * @param $key
     * @param $message
     */
    public function setFlash($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $message
        ];
    }

    /**
     * @param $key
     * @return bool|mixed
     */
    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    public function removeFlash()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => $flashMessage) {
            if ($flashMessage['remove']) {
                unset($flashMessages[$key]);
            }
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }


    public function __destruct()
    {
        $this->removeFlash();
    }
}