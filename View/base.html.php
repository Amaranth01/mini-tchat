<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/asset/css/style.css">
</head>
<body>

<?php
if (isset($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);

    foreach ($errors as $error) { ?>
        <div class="message error">
            <button name="button" class="close">X</button>
            <?= $error ?>
        </div> <?php
    }
}

// Handling success messages.
if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']);
    ?>
    <div class="message success">
        <button name="button" class="close">X</button>
        <?= $success ?>
    </div> <?php
}
?>
<h1>Bienvenue sur le tchat d'entraide </h1>
<div>
    <nav>
        <ul>
            <?php
            //Remove the link if the user is not logged in
            if(UserController::userConnected()) { ?>
                <li><a href="/index.php?c=logout&a=logout">Déconnexion</a></li>
                <?php
            }
            else { ?>
                <li><a href="/index.php?c=user&a=conn">Connexion / Inscription</a></li>
                <?php
            }
            ?>
        </ul>
    </nav>
</div>
    <main class="container">
        <?= $html ?>
    </main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="/asset/js/message.js"></script>
<script src="/asset/js/app.js"></script>
</body>
</html>