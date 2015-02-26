<?php
/**
 * Стартуем сессию
 */
session_start();

//error_reporting(E_ALL);
//ini_set("display_errors","on");

include("configs/config.php");
include("configs/database.php");
include("configs/template.php");

include(SMARTY_CLASS_FILE);

include("system/thread.php");
include("system/template.php");
include("system/access.php");
include("system/database.php");
include("system/globals.php");
include("system/ImageManipulator.php");

if(!isset($_GET['page'])&&$_GET['page']=="")
    $page="login";
else
    $page = $_GET['page'];

if(!Access_AdminAuthorized())
    $page = "login";

$file_name = "./managers/{$page}.php";
if(file_exists($file_name)) {
    include($file_name);
    $class_name = "Thread_$page";
    if(class_exists($class_name)) {
        $obj = new $class_name();

        $obj->Init();
        $obj->Show();
    }
}

//$GLOBAL_TEMPLATE->insert("page", $page);
$GLOBAL_TEMPLATE->toScreen(TEMPLATE_ADMIN);