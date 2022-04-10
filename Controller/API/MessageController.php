<?php

use App\Controller\AbstractController;
use App\Model\Entity\Message;
use App\Model\Manager\MessageManager;

class MessageController extends AbstractController
{
    public function addMessage($payload)
    {
        $content = $this->clean($payload->content);

        $message = (new Message())
            ->setContent($content)
            ->setUser($_SESSION['user']->getId())
            ->setDate(new DateTime())
            ;

        if (MessageManager::addMessage($message)) {
            http_response_code(200);
            exit;
        }
        http_response_code(200);
        exit;
    }
}