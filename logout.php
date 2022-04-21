<?php 

require 'includes/init.php';

// Initialize the session.
// If you are using session_name("something"), don't forget it now!
session_start();

Auth::logout();

Url::redirect('/mikedoesphp/index.php');