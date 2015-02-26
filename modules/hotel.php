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

    }

    public function Show()
    {
        global $GLOBAL_TEMPLATE, $GLOBAL_DATABASE;

        $GLOBAL_TEMPLATE->insert("CONFIG_UPLOAD_DIR",CONFIG_UPLOAD_DIR);
        $GLOBAL_TEMPLATE->insert("allRooms", $GLOBAL_DATABASE->selectRooms());
        $GLOBAL_TEMPLATE->insert("page", "hotel");
    }

}