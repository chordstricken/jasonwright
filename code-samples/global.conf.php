<?php
/**
 * This file is included by default on every page
 * @since  Nov 18, 2014
 * @author  Jason Wright <jason.dee.wright@gmail.com>
 */

/**
 * custom autoloader. Used to include class files based on namespace
 * @param string $classname
 */
function custom_autoload($classname) {
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $classname) . '.php';
    if (file_exists(ROOTPATH . DIRECTORY_SEPARATOR . $path)) {
        include_once($path);
    }
}

spl_autoload_register('custom_autoload');

/**
 * custom Error Handler
 * @param int $errno
 * @param string $errstr
 * @param string $errfile
 * @param int $errline
 * @return false
 */
function custom_error_handler($errno, $errstr, $errfile, $errline) {
    error_log("Error $errno: $errstr in $errfile:$errline\n", 3, '/tmp/custom.log');
    http_response_code(500);
    // include_once(ROOTPATH . '/public_html/500.html');
    return false;
}

set_error_handler('custom_error_handler');

/**
 * Angular likes to pass data via json rather than traditional http query format
 */
global $_JSON;
if (!$_JSON = json_decode(file_get_contents('php://input'), true)) {
    $_JSON = [];
}