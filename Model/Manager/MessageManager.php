<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\Message;

class MessageManager
{
    public static function getMessage(): array
    {
        $messages = [];
        $result = DB::getPDO()->query("SELECT * FROM message ORDER BY date DESC LIMIT 30 ");
        if($result) {
            $messageManager = new MessageManager();

            foreach ($result->fetchAll() as $messageData) {
                $messages[] = (new Message())
                    ->setContent($messageData['content'])
                    ->setUser($messageData['user_id1'])
                    ;
            }
        }
        return $messages;

    }

    public static function addMessage(Message $message): bool
    {
        $stmt = DB::getPDO()->prepare("
            INSERT INTO message (content, date, user_id1) VALUES (:content, :date, :user)
        ");

        $stmt->bindValue(':content', $message->getContent());
        $stmt->bindValue(':date', $message->getDate());
        $stmt->bindValue(':user', $message->getUser());

        return $stmt->execute();
    }
}