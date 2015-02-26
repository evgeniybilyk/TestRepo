<?php
class Thread_logout implements iThread
{
    public function Init()
    {
        Access_Logout();
    }

    public function Show()
    {
        global $GLOBAL_TEMPLATE;

        $GLOBAL_TEMPLATE->insert("page", "login");
    }

}