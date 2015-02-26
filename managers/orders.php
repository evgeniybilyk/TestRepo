<?php
class Thread_orders implements iThread
{

    public function Init()
    {
        // TODO: Implement Init() method.
    }

    public function Show()
    {
        global $GLOBAL_TEMPLATE, $GLOBAL_DATABASE;

        $GLOBAL_TEMPLATE->insert("allOrderRooms", $GLOBAL_DATABASE->selectOrderRooms());
        $GLOBAL_TEMPLATE->insert("page", "orders");

    }
}