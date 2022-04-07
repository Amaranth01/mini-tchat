<?php

use App\Model\DB;
use App\Model\Entity\Message;

class MessageManager
{
    public function getMessage()
    {
        $result = DB::getPDO()->query("SELECT * FROM message ORDER BY date DESC LIMIT 30 ");
        $message = $result->fetchAll();
    }

    public static function addMessage(Message $message): bool
    {
        $stmt = DB::getPDO()->prepare("
            INSERT INTO message (id, content, user_id1) VALUES (:id, :content, :user)
        ");

        $stmt->bindValue(':id', $message->getId());
        $stmt->bindValue(':content', $message->getContent());
        $stmt->bindValue(':user', $message->getUser()->getId());

        $result = $stmt->execute();
        $message->setId(DB::getPDO()->lastInsertId());
        return $result;
    }
}