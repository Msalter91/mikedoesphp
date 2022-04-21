<?php 


class Auth {
    /** 
     * Returns the users authentication status 
     * 
     * @return Boolean True if user is logged in, false is not
    */
    public static function isLoggedIn() {
        return (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']);
    } 
}