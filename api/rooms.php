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

echo json_encode($GLOBAL_DATABASE->selectRoomsForApi(), JSON_UNESCAPED_SLASHES);