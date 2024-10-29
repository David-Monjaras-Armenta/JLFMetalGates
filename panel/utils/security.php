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
            base64_encode($username) . "." . Security::hash($username . time()),
            time() + (86400 * 30),
            '/',
            '',
            true, 
            true
        );
        $_SESSION['username'] = $username;
    }

    public static function dropCookie()
    {
        setcookie(
            'auth_token',
            "",
            time() + (86400 * 30),
            '/',
            '',
            true, 
            true
        );
    }

    public static function get_username()
    {
        $username = explode(".", $_COOKIE['auth_token'])[0];
        return base64_decode($username);
    }
}
