<?php

use App\Model\Entity\AbstractEntity;



class UserManager extends AbstractEntity
{
    const TABLE = "ndmp22_user";
    public static function makeUser(array $data): User
    {
        $user = (new User())
            ->setId($data['id'])
            ->setUsername($data['username'])
            ->setEmail($data['email'])
            ->setPassword($data['password'])
            ->setConfirmCode($data['confirm_code'])
            ->setConfirm($data['confirm'])
            ;
        return $user->setRole(RoleManager::getRolesByUserId($user));
    }

    public static function register($email, $username, $password, $confirm_code) :bool
    {
        $stmt = DB_Connect::dbConnect()->prepare("
            INSERT INTO ".self::TABLE." (email, username, password, confirm_code, confirm, role_fk)
            VALUES(:email, :username, :password, :confirm_code, :confirm, :role_fk)
        ");

        $role_fk = 1;
        $confirm = 0;

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':confirm_code', $confirm_code);
        $stmt->bindParam(':confirm', $confirm);
        $stmt->bindParam(':role_fk', $role_fk);

        if ($stmt->execute())
        {
            return true;
        }
        return false;
    }
}