<?php

use App\Controller\AbstractController;
use App\Model\Entity\user;

class UserController extends AbstractController
{
    public function conn()
    {
        $this->render('page/connexion');
    }

    public function reg()
    {
        $this->render('page/register');
    }

    /**
     * Add a user
     */
    public function register ()
    {
        //Cleans and checks the security of elements
        if ($this->formSubmitted()) {
            $mail = $this->clean($this->formField('email'));
            $username = $this->clean($this->formField('username'));
            $password = $this->formField('password');
            $passwordR = $this->formField('passwordR');

            $error = [];
            $mail = filter_var($mail, FILTER_SANITIZE_EMAIL);

            // Send a message if the email address is not valid.
            if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $error[] = "L'adresse mail n'est pas valide";
            }

            // Returns an error if the username is not 2 characters
            if (!strlen($username) >= 2) {
                $error[] = "Le nom, ou pseudo, doit faire au moins 2 caractères";
            }

            // Returns an error if the password does not contain all the requested characters.
            if (!preg_match('/^(?=.*[!@#$%^&*-\])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $password)) {
                $error[] = "Le mot de passe doit contenir une majuscule, un chiffre et un caractère spécial";
            }

            // Passwords do not match
            if ($password !== $passwordR) {
                $error[] = "Les mots de passe ne correspondent pas";
            }

            //Count the mistakes
            if (count($error) > 0) {
                $_SESSION['errors'] = $error;
            } else {
                //If no error is detected the program goes to else and authorizes the recording
                $user = (new User())
                    ->setUsername($username)
                    ->setEmail($mail)
                    ->setPassword(password_hash($password, PASSWORD_DEFAULT))
                ;
                //If no email is found, we launch the addUser function
                if(0 == UserManager::getUserByMail($user->getEmail())['count(*)']) {
                    UserManager::addUser($user);
                    //If the ID is not null, we pass the user in the session
                    if (null!== $user->getId()) {
                        $_SESSION['success'] = "Félicitations votre compte est actif";
                        $user->setPassword('');
                        $_SESSION['user'] = $user;
                    }
                    else {
                        $_SESSION['errors'] = ["Impossible de vous enregistrer"];
                    }
                }
                else {
                    $_SESSION['errors'] = ["Cette adresse mail existe déjà !"];
                }
            }
        }
        $this->render('home/index');
    }

    /**
     * User login
     * @return void
     */
    public function connexion()
    {
        if($this->formSubmitted()) {
            $errorMessage = "Votre nom d'utilisateur, ou le mot de passe est incorrect";
            $password = $this->formField('password');
            $mail = $this->clean($this->formField('email'));
            $username = $this->clean($this->formField('username'));

            //Check that the fields are not empty
            if (empty($password) || empty($username) ||empty($mail)) {
                $errorMessage = "L'un des champ est manquant";
                $_SESSION['errors'][] = $errorMessage;
                $this->render('home/index');
                exit();
            }
            //Traces the user by his email to verify that he exists
            $user = UserManager::getUserByMail($mail);
            if (null === $user) {
                $errorMessage = "Adresse mail inconnue";
                $_SESSION['errors'][] = $errorMessage;
                $this->render('home/index');
                exit();
            }
            else {
                //Compare the password entered and written in the DB
                if (password_verify($password, $user->getPassword())) {
                    $user->setPassword('');
                    $_SESSION['user'] = $user;
                }
                else {
                    $_SESSION['errors'][] = $errorMessage;
                }
            }
        }
        $successMessage = "Vous êtes connecté";
        $_SESSION['success'] = $successMessage;
        $this->render('home/index');
    }

    /**
     * Checks that the form fields are present
     * @param string $field
     * @param null $default
     * @return mixed|string
     */
    public function formField(string $field, $default = null)
    {
        if (!isset($_POST[$field])) {
            return (null === $default) ? '' : $default;
        }
        return $_POST[$field];
    }
}