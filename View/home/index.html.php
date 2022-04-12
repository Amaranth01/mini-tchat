<p class="introduction">
    Vous êtes coincés sur un jeu vidéo et ne savez pas comment résoudre votre problème ? Posez votre question ici.
    <br>
    Les seules obligations sont le respect des autres, avoir une bonne dose d'humour et être de bonne humeur !
</p>
<div id="content">

<?php
use App\Model\Manager\MessageManager;?>
    <?php
        foreach (MessageManager::getMessage() as $message) {
    ?>
    <div class="tchat">
        <p class="user"><?=$message->getUser()->getUsername()?> : </p>
        <p><?=$message->getContent() ?></p>
    </div>

    <?php
        }
    ?>
</div>
<form action="" method="post">
    <?php
    //Remove the textarea if the user is not logged in
        if(UserController::userConnected()) { ?>
            <div>
                <textarea name="content" id="tchatMessage" cols="60" rows="5" maxlength="255"></textarea>
                <button id="addMessage">Envoyer </button>
            </div>
    <?php
        }
        else { ?>
            <p class="connexionMessage">Il faut être connecté pour pouvoir écrire un message</p>
     <?php
        }
    ?>
</form>