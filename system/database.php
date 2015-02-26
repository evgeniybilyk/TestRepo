<?php

/**
 * Class Database
 * Класс для работы с базой данных
 */
class Database
{
    private static $instance;  // экземпляра объекта
    private $ResConnection;

    /**
     *
     */
    private function  __construct() {}

    /**
     * @return Database
     */
    public static function getInstance() {
        if ( empty(self::$instance) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param $server
     * @param $username
     * @param $password
     * @param $dbname
     */
    public function connect ($server,$username,$password,$dbname) {
        $this->ResConnection = mysql_connect($server,$username,$password);
        mysql_select_db($dbname,$this->ResConnection);
    }

    /**
     *  Метод добавления комнаты в базу
     *
     * @param $num
     * @param $photo
     * @param $type
     * @param $col_windows
     * @return bool
     */
    public function insertRoom($num, $photo, $type, $col_windows, $price, $descr) {
        $num = intval($num);
        $photo = mysql_escape_string($photo);
        $type = mysql_escape_string($type);
        $col_windows = intval($col_windows);
        $price = number_format($price, 2, '.', '');
        $descr = mysql_escape_string($descr);

        $strQuery = "INSERT INTO hotel_rooms(`num`, `photo`, `type`, `col_windows`, `price`, `descr`) VALUES " .
                    "('$num','$photo','$type','$col_windows', '$price', '$descr')";

        if(mysql_query($strQuery, $this->ResConnection))
            return true;
        else
            return false;
    }

    public function updRoom($num, $photo, $type, $col_windows, $price, $descr) {
        $num = intval($num);
        $photo = mysql_escape_string($photo);
        $type = mysql_escape_string($type);
        $col_windows = intval($col_windows);
        $price = number_format($price, 2, '.', '');
        $descr = mysql_escape_string($descr);

        $updPhoto = "";
        if($photo != "")
            $updPhoto = "`photo`='$photo',";

        $strQuery = "UPDATE hotel_rooms " .
                        "SET $updPhoto `type`='$type', `col_windows`='$col_windows',  `price`='$price', `descr`='$descr' " .
                    "WHERE `num`= '$num'";

        if(mysql_query($strQuery, $this->ResConnection))
            return true;
        else
            return false;
    }

    /**
     *
     *
     * @param $num
     * @return int
     */
    public function checkRoom($num) {
        $count = 0;
        $num = intval($num);
        $strQuery = "SELECT count(*) `count` FROM hotel_rooms WHERE num = '$num' LIMIT 1";
        if($res = mysql_query($strQuery)) {
            if($row = mysql_fetch_assoc($res)) {
                $count = $row['count'];
            }

            mysql_free_result($res);
        }

        return $count;
    }

    /**
     * @param $num
     * @param $date
     * @return int
     */
    public function checkOrderRoom($num, $date) {
        $count = 0;
        $num = intval($num);
        $date = mysql_escape_string($date);
        $strQuery = "SELECT count(*) `count` FROM orders WHERE num_room = '$num' AND date_order='$date' LIMIT 1";
        if($res = mysql_query($strQuery)) {
            if($row = mysql_fetch_assoc($res)) {
                $count = $row['count'];
            }

            mysql_free_result($res);
        }

        return $count;
    }

    /**
     * @param $num
     * @param $date
     * @return int
     */
    public function insertOrderRoom($num, $date) {
        $num = intval($num);
        $date = mysql_escape_string($date);
        $strQuery = "INSERT INTO orders(`num_room`, `date_order`) VALUES " .
                    "('$num','$date')";

        if(mysql_query($strQuery, $this->ResConnection))
            return true;
        else
            return false;

    }

    /**
     *
     * @param $num
     * @return array
     */
    public function selectRooms() {
        $arrRes = array();

        $strQuery = "SELECT * FROM hotel_rooms";
        if($res = mysql_query($strQuery)) {
            while($row = mysql_fetch_assoc($res)) {
                $arrRes[$row["num"]] = $row;
            }

            mysql_free_result($res);
        }

        return $arrRes;
    }

    /**
     *
     * @param $num
     * @return array
     */
    public function selectRoomsForApi() {
        $arrRes = array();

        $strQuery = "SELECT * FROM hotel_rooms";
        if($res = mysql_query($strQuery)) {
            while($row = mysql_fetch_assoc($res)) {
                $arrRes[$row["num"]]["num"] = $row["num"];
                $arrRes[$row["num"]]["photo"] = "http://".$_SERVER["SERVER_NAME"]."/".CONFIG_UPLOAD_DIR.$row["photo"];
                $arrRes[$row["num"]]["type"] = $row["type"];
                $arrRes[$row["num"]]["col_windows"] = $row["col_windows"];
                $arrRes[$row["num"]]["price"] = $row["price"];
                $arrRes[$row["num"]]["descr"] = $row["descr"];
            }

            mysql_free_result($res);
        }

        return $arrRes;
    }

    /**
     *
     * @param $num
     * @return array
     */
    public function selectRoom($num) {
        $arrRes = array();

        $num = intval($num);
        $strQuery = "SELECT * FROM hotel_rooms WHERE num = '$num'";
        if($res = mysql_query($strQuery)) {
            if($row = mysql_fetch_assoc($res)) {
                $arrRes = $row;
            }

            mysql_free_result($res);
        }

        return $arrRes;
    }

    /**
     *
     * @param $num
     * @return bool
     */
    public function delRoom($num)
    {
        $num = intval($num);
        if($num > 0) {
            $strQuery = "DELETE FROM hotel_rooms WHERE num='$num' LIMIT 1";

            if(mysql_query($strQuery, $this->ResConnection))
                return true;
            else
                return false;
        }
    }

    public function selectOrderRooms()
    {
        $arrRes = array();

        $strQuery = "SELECT o.id, o.num_room, o.date_order, r.type, r.col_windows, r.price, r.descr " .
                    "FROM orders o INNER JOIN hotel_rooms r ON o.num_room=r.num";
        if($res = mysql_query($strQuery)) {
            while($row = mysql_fetch_assoc($res)) {
                $arrRes[$row["id"]] = $row;
            }

            mysql_free_result($res);
        }

        return $arrRes;
    }
}