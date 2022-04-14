<?php 
/** 
 * Returns the users authentication status 
 * 
 * @return Boolean True if user is logged in, false is not
*/
function isLoggedIn() {
    return (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']);
}