<?php

namespace App\Model\Manager;

use App\Model\DB;
use App\Model\Entity\Message;
use UserManager;

class MessageManager
{
    public static function getMessage(): array
    {
        $messages = [];
        $stmt = DB::getPDO()->query("SELECT * FROM message ORDER BY id DESC LIMIT 30 ");
        if($stmt) {
            $userManager = new UserManager();
            foreach ($stmt->fetchAll() as $value) {
                $messages[] = self::createMessage($value, $userManager);
            }
        }
        return $messages;

    }

    /**
     * Add a new message
     * @param $content
     * @param $user
     * @return bool
     */
    public static function addMessage($content, $user): bool
    {
        $stmt = DB::getPDO()->prepare("
            INSERT INTO message (content, user_id1) VALUES (:content, :user)
        ");

        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':user', $user);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    private static function createMessage(array $data, $userManager): Message
    {

        return (new Message())
            ->setId($data['id'])
            ->setUser($userManager->getUser($data['user_id1']))
            ->setContent($data['content'])
            ;
    }
}