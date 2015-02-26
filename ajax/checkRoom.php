<?php
error_reporting(0);

include("../configs/config.php");
include("../configs/database.php");
include("../configs/template.php");

include("../".SMARTY_CLASS_FILE);

include("../system/thread.php");
include("../system/template.php");
include("../system/access.php");
include("../system/database.php");
include("../system/globals.php");

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

//    echo 'Это ajax запрос!';

    $date_order = $_POST["date_order"];
    $num_room = intval($_POST["num_room"]);
    if (preg_match("/^[\d]{4}-[\d]{2}-[\d]{2}$/i", $date_order))
    {
        if($GLOBAL_DATABASE->checkOrderRoom($num_room, $date_order) == 0) {
            if($GLOBAL_DATABASE->insertOrderRoom($num_room, $date_order)) {
                echo "success";
            }
        } else {
            echo "reserved";
        }
    } else
        echo "ERROR date format";
}

exit();