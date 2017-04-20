<?php
namespace controllers;

/**
 * This controller handles authentication checks
 * @author Jason Wright <jason.dee.wright@gmail.com>
 * @since Nov 18, 2014
 */
class Login
{
    /**
     * Returns the user's login status
     * @return bool
     */
    public static function valid()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        return isset($_SESSION['passphrase']) && hash('sha512', $_SESSION['passphrase']) == PASSPHRASE;
    }

    /**
     * Checks the user's auth status
     */
    public static function page_auth()
    {
        if (!self::valid()) {
            require_once(ROOTPATH . '/views/track/login.php');
            die();
        }
    }

    /**
     * Checks the user's auth status
     */
    public static function ajax_auth()
    {
        if (!self::valid()) {
            http_response_code(500);
            die();
        }
    }

}