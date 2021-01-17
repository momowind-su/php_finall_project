<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("controllers/AuthController.php");
require_once("controllers/UserController.php");


define("CONTROLLERS_PATH", "controllers");
define("CONTROLLER_SUFFICS", "Controller");
define("SEPARATOR","/");

if(isset($_GET['m']) && isset($_GET['a']))
{
    $m = ucfirst($_GET['m']);
    $className = $m.CONTROLLER_SUFFICS;

    
    if (!class_exists($className) || !method_exists ( $className , $_GET['a'] )) {
        require_once("404.html");
        die();
    }
    $class = new $className;
    call_user_func([$class, $_GET['a']], $_REQUEST);
}
else{
    require_once("404.html");
    // call_user_func(["PostsController", "show_posts"], $_REQUEST);
    die();
}

?>