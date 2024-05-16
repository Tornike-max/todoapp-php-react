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
        return $_SESSION[$key];
    }

    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function remove($key)
    {
        unset($_SESSION[$key]);
    }
}
