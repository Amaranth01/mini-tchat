<?php

use App\Model\Entity\Message;
use App\Model\Manager\MessageManager;

require __DIR__ . '/../../Config.php';
require __DIR__ . '/../../Model/DB.php';

require __DIR__ . '/../../Model/Entity/Message.php';
require __DIR__ . '/../../Model/Entity/User.php';

require __DIR__ . '/../../Model/Manager/MessageManager.php';

session_start();

$payload = json_decode(file_get_contents('php://input'));

//We quit if the field is missing

if(empty($payload->content)) {
    // 400 = Bad Request.
    http_response_code(400);
    exit;
}

//We quit if the user is not connected
if (!isset($_SESSION['user'])) {
    // 400 = Bad Request.
    http_response_code(403);
    exit;
}
//Retrieve data
$content = trim(strip_tags($payload->content));
$user = $_SESSION['user'];

//Instantiate a new object
$message = new Message();
$message->setContent($content);
$message->setUser($user);

$messageManager = new MessageManager();
$messageManager->addMessage($content, $user->getId());

http_response_code(200);
exit;