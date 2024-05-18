<?php

namespace app\core;

class Session
{
    public function __construct()
    {
        session_start();
    }

    public function getSession($key)
    {
        $session = isset($_SESSION[$key]) ? $_SESSION[$key] : null;
        var_dump($session);
        return $session;
    }

    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function start_session()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
        session_destroy();
    }
}
