<h1>Connectez-vous</h1>

    <form action="/index.php?c=user&a=connexion" method="post" id="form">
        <label for="username">Pseudo</label>
        <input type="text" name="username" id="username">

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">

        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <input type="submit" name="submit" value="Envoyer">
    </form>

    <p>Pas de compte ? <a href="/index.php?c=user&a=reg">Inscrivez-vous !</a></p>