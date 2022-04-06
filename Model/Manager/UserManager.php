<?php

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
    public static function getUser(int $id): ?User
    {
        $result = DB::getPDO()->query("SELECT * FROM user WHERE id = '$id'");
        return $result ? self::createUser($result->fetch()) : null;
    }

    public static function mailExist(string $mail): ?array
    {
        $stmt = DB::getPDO()->query("SELECT count(*) FROM user WHERE email = '$mail'");
        return $stmt->fetch();
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
}