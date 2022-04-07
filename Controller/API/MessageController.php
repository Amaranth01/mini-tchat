<?php

use App\Controller\AbstractController;
use App\Model\Entity\Message;

class MessageController extends AbstractController
{
    public function addMessage()
    {
        $payload = file_get_contents('php://input');
        $payload = json_decode($payload);

        if (empty($payload->content)) {
            // not authorized
            http_response_code(403);
            exit;
        }

        $content = $this->clean($payload->content);

        $message = (new Message())
            ->setContent($content)
            ->setUser($_SESSION['user'])
            ->setDate(new DateTime())
            ;

        if (MessageManager::addMessage($message)) {
            echo json_encode([
                'id'=>$message->getId(),
                'content'=>$message->getContent(),
                'user'=>$message->getUser()->getUsername(),
            ]);
            http_response_code(200);
            exit;
        }
        http_response_code(200);
        exit;
    }
}