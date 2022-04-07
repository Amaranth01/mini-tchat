<?php

use App\Model\DB;
use App\Model\Entity\User;

class UserManager
{
    /**
     * Create a new User
     * @param array $data
     * @return User
     */
    private static function createUser(array $data): User
    {
        //Prepare the creation of the new user
        return (new User())
            ->setId($data['id'])
            ->setEmail($data['email'])
            ->setUsername($data['username'])
            ->setPassword($data['password'])
            ;
    }

    /**
     * Find a user with their id.
     * @param int $id
     * @return User
     */
    public function getUser(int $id): ?User
    {
        $user = null;
        $query = DB::getPDO()->query("SELECT * FROM user  WHERE id = '$id'");

        if ($query && $data = $query->fetch()) {
            $user = self::createUser($data);
        }
        return $user;
    }

    /**
     * @param User $user
     * @return bool
     */
    public static function addUser(User $user): bool
    {
        $stmt = DB::getPDO()->prepare("
            INSERT INTO user (email, username, password) 
            VALUES (:email, :username, :password)
        ");

        $stmt->bindValue('email', $user->getEmail());
        $stmt->bindValue('username', $user->getUsername());
        $stmt->bindValue('password', $user->getPassword());

        $result = $stmt->execute();
        $user->setId(DB::getPDO()->lastInsertId());

        return $result;
    }

    /**
     * Checks if an email address is already present in the DB.
     * @param string $mail
     * @return array
     */
    public static function mailExists(string $mail): ?array
    {
        $result = DB::getPDO()->query("SELECT count(*) FROM user WHERE email = '$mail'");
        return $result->fetch();
    }

    /**
     * Find a user by email
     * @param string $email
     * @return User|null
     */
    public static function getUserByMail(string $email): ?User
    {
        $stmt = DB::getPDO()->prepare("SELECT * FROM user WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email);
        return $stmt->execute() ? self::createUser($stmt->fetch()) : null;
    }
}