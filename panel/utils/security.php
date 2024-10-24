<?php

class Security
{
    public static function hash($text)
    {
        return hash("sha256", $text);
    }

    public static function setCookie($username)
    {
        session_start();
        setcookie(
            'auth_token',
            Security::hash($username . time()),
            time() + (86400 * 30),
            '/',
            '',
            false, #cambiar a true cuando haya https
            true
        );
        $_SESSION['username'] = $username;
    }
}
