<?php

include("configs/config.php");
include("configs/database.php");
include("configs/template.php");

include(SMARTY_CLASS_FILE);

include("system/thread.php");
include("system/template.php");
include("system/access.php");
include("system/database.php");
include("system/globals.php");

if(!isset($_GET['page'])&&$_GET['page']=="")
    $page="hotel";
else
    $page = $_GET['page'];

$file_name = "./modules/{$page}.php";
if(file_exists($file_name)) {
    include($file_name);
    $class_name = "Thread_$page";
    if(class_exists($class_name)) {
        $obj = new $class_name();

        $obj->Init();
        $obj->Show();
    }
}

$GLOBAL_TEMPLATE->toScreen(TEMPLATE_INDEX);