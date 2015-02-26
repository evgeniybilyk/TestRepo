<?php
class Thread_hotel implements iThread
{
    protected $updRoom;
    protected $act;

    public function __construct() {
        $this->updRoom = array();
    }

    public function Init()
    {
        global $GLOBAL_DATABASE;

        $this->act = "add";

        $act = $_GET["act"];
        if($act == "add"&&isset($_POST["subb"])) {
            $num = intval($_POST["num"]);
            $type = $_POST["type"];
            $col_windows = $_POST["col_windows"];
            $price = $_POST["price"];
            $descr = $_POST["descr"];

            if($num > 0) {
                if($GLOBAL_DATABASE->checkRoom($num) == 0) {

                    $uploadOk = 0;
                    $newNameFile = "";
                    if($_FILES["photo"]["error"] == 0) {

                        $target_dir = "./".CONFIG_UPLOAD_DIR;
                        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
                        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

                        echo "<br>".$imageFileType;

                        if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"
                            || $imageFileType == "gif" )
                        {
                            $better_token = md5(uniqid(rand(),1));
                            $newNameFile = $better_token.".".$imageFileType;
                            $destination = $target_dir.$newNameFile;

                            $manipulator = new ImageManipulator($_FILES['photo']['tmp_name']);
                            $newImage = $manipulator->resample(200, 200);
                            try {
                                $newImage->save($destination);
                                $uploadOk = 1;
                            } catch(Exception $e) {
                                $e->getMessage();
                            }

//                            if(move_uploaded_file($_FILES["photo"]["tmp_name"], $destination)){
//                                $uploadOk = 1;
//                            }
                        }
                    }

                    if($uploadOk == 0)
                        $newNameFile = "";

                    if($GLOBAL_DATABASE->insertRoom($num, $newNameFile, $type, $col_windows, $price, $descr))
                        echo "<script>document.location='admin.php?page=hotel'</script>";

                }
                else
                    echo "Такой номер квартиры уже есть<br>";
            }
            else
                echo "Введите номер квартиры<br>";

        } elseif($act == "del") {
            $num = intval($_GET["num"]);
            if($GLOBAL_DATABASE->delRoom($num))
                echo "<script>document.location='admin.php?page=hotel'</script>";

        } elseif($act == "upd") {
            $num = intval($_GET["num"]);
            $this->updRoom = $GLOBAL_DATABASE->selectRoom($num);
            $this->act = "upd_save";
        }
        elseif($act == "upd_save"&&isset($_POST["subb"])) {
            $num = intval($_POST["num"]);
            //$photo = $_POST["photo"];
            $type = $_POST["type"];
            $col_windows = $_POST["col_windows"];
            $price = $_POST["price"];
            $descr = $_POST["descr"];

            if($num > 0) {
                if($GLOBAL_DATABASE->checkRoom($num) > 0) {

                    $uploadOk = 0;
                    $newNameFile = "";
                    if($_FILES["photo"]["error"] == 0) {
                        $target_dir = "./".CONFIG_UPLOAD_DIR;
                        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
                        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

                        if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"
                            || $imageFileType == "gif" )
                        {
                            $better_token = md5(uniqid(rand(),1));
                            $newNameFile = $better_token.".".$imageFileType;
                            $destination = $target_dir.$newNameFile;

                            $manipulator = new ImageManipulator($_FILES['photo']['tmp_name']);
                            $newImage = $manipulator->resample(200, 200);
                            try {
                                $newImage->save($destination);
                                $uploadOk = 1;
                            } catch(Exception $e) {
                                $e->getMessage();
                                $uploadOk = 0;
                            }

//                            if(move_uploaded_file($_FILES["photo"]["tmp_name"], $destination)){
//                                $uploadOk = 1;
//                            }
                        }
                    }

                    if($uploadOk == 0)
                        $newNameFile = "";

                    if($GLOBAL_DATABASE->updRoom($num, $newNameFile, $type, $col_windows, $price, $descr))
                        echo "<script>document.location='admin.php?page=hotel'</script>";
                }
                else
                    echo "Такой квартиры нету<br>";
            }
            else
                echo "Введите номер квартиры<br>";
        }
    }

    public function Show()
    {
        global $GLOBAL_TEMPLATE, $GLOBAL_DATABASE;

        $GLOBAL_TEMPLATE->insert("CONFIG_UPLOAD_DIR",CONFIG_UPLOAD_DIR);
        $GLOBAL_TEMPLATE->insert("updRoom", $this->updRoom);
        $GLOBAL_TEMPLATE->insert("act", $this->act);
        $GLOBAL_TEMPLATE->insert("allRooms", $GLOBAL_DATABASE->selectRooms());
        $GLOBAL_TEMPLATE->insert("page", "hotel");
    }

}