<?php 

spl_autoload_register(function ($class) {
    require dirname(__DIR__) . "/classes/{$class}.php";
});

if(! isset($_SESSION)) {
    session_start();
}
