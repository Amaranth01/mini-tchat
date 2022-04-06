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
}