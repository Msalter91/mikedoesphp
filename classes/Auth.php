<?php 


class Auth {
    /** 
     * Returns the users authentication status 
     * 
     * @return Boolean True if user is logged in, false is not
    */
    public static function isLoggedIn(): bool
    {
        return (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']);
    } 

    public static function requireLogin(): void
    {
        if (!static::isLoggedIn()) {
            die('unauthorized');
        }
    }

    public static function login(): void
    {
        session_regenerate_id(true);
        $_SESSION['is_logged_in'] = true;
    }

    public static function logout() {
        // Unset all the session variables.
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.

session_destroy();
    }
}