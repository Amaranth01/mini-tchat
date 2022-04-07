<?php

use App\Model\DB;

class MessageManager
{
    function getMessage()
    {
        $result = DB::getPDO()->query("SELECT * FROM message ORDER BY date DESC LIMIT 30 ");
        $message = $result->fetchAll();
    }
}