<?php
class Thread_login implements iThread
{
    public function Init()
    {
        if(!Access_AdminAuthorized()) {
//            echo "<pre>";
//            print_r($_POST);
//            echo "</pre>";

            $login = $_POST["login"];
            $passwd = $_POST["passwd"];
            AccessAdm_Login($login, $passwd);
        }
    }

    public function Show()
    {
        global $GLOBAL_TEMPLATE;

        $GLOBAL_TEMPLATE->insert("page", "login");
        if(Access_AdminAuthorized())
            $GLOBAL_TEMPLATE->insert('redirect',true);
    }

}