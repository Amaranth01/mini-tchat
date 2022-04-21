<?php

use App\Model\Manager\MessageManager;

class MessageController
{
    public function addMessage()
    {
        $messageManager = new MessageManager();
        $array = [];

        foreach($messageManager->getMessage() as $value) {
            $sent = false;
            if ($value->getUser()->getId() === $_SESSION['user']->getId()) {
                $sent = true;
            }

            $array[] = [
                'id' => $value->getId(),
                'content' => $value->getContent(),
                'username' => $value->getUser()->getUsername(),
                'sent' => $sent,
            ];
        }

        echo json_encode($array);

        http_response_code(200);
        exit;
    }
}