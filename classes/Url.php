<?php 

class Url {
    /**
 * @param string $path for the URL for the redirct 
 * 
 * @return void
 */

public static function redirect(string $path) {
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
        $protocol = 'https';
    }
    else {
        $protocol ='http';
    }

    header("Location: ${protocol}://{$_SERVER['HTTP_HOST']}${path}");
    exit;
}
}