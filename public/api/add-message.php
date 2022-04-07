<?php

use App\Model\Entity\Message;

require __DIR__ . '/../../Config.php';
require __DIR__ . '/../../Model/DB.php';

require __DIR__ . '/../../Model/Entity/Message.php';
require __DIR__ . '/../../Model/Entity/User.php';

require __DIR__ . '/../../Model/Manager/MessageManager.php';

$payload = file_get_contents('php://input');
$payload = json_encode($payload);

//We quit if the field is missing

if(empty($payload->content)) {
    // 400 = Bad Request.
    http_response_code(400);
    exit;
}

//We quit if the user is not connected

if (!isset($_SESSION['user'])) {
    // 400 = Bad Request.
    http_response_code(400);
    exit;
}

//clean data
$content = trim(strip_tags(htmlentities(($payload->content))));
$date =

$message = (new Message())
    ->setContent($content)
    ->setDate(new DateTime())
    ->setUser($_SESSION['user'])
    ;

if(MessageManager::addMessage($message)) {
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