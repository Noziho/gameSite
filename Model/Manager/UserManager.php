<?php

namespace App\Model\Manager;



use App\Model\DB_Connect;
use App\Model\Entity\User;

class UserManager
{
    const TABLE = "ndmp22_user";

    /**
     * @param array $data
     * @return User
     */
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

    /**
     * @param $email
     * @param $username
     * @param $password
     * @param $confirm_code
     * @return bool
     * A prepare query for add an user in DB.
     */
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


    /**
     * @param $email
     * @param $password_decode
     * @return void
     * Compare if password written by user is the same as Password on DB
     */
    public static function login($email, $password_decode)
    {
        $stmt = DB_Connect::dbConnect()->prepare("
            SELECT * FROM ". self::TABLE ." WHERE email = :email
        ");
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            $password = $stmt->fetch();
            if (isset($password['password'])) {
                if (password_verify($password_decode, $password['password'])) {
                    $user = self::makeUser($password);

                    if ($user->getConfirm() === 0) {
                        header("Location: /index.php?c=user&a=login&f=0");
                        exit();
                    }

                    if(!isset($_SESSION['user'])) {
                        $_SESSION['user'] = $user;
                    }

                }
                else {
                    header("Location: /index.php?c=user&a=login&f=0");
                }
            }
            else {
                header("Location: /index.php?c=user&a=login&f=1");
            }
        }
    }


    /**
     * @param string $username
     * @return User|null
     */
    public static function getUserByUserName(string $username): ?User
    {

        $query = DB_Connect::dbConnect()->prepare("SELECT * FROM " . self::TABLE . " WHERE username = :username");
        $query->bindParam(':username', $username);

        return $query->execute() ? self::makeUser($query->fetch()) : null;
    }


    /**
     * @param int $userId
     * @return User|null
     */
    public static function getUserById(int $userId): ?User
    {
        $query = DB_Connect::dbConnect()->query("SELECT * FROM " . self::TABLE . " WHERE id = $userId");
        return $query->execute() ? self::makeUser($query->fetch()) : null;
    }


    /**
     * @param User $user
     * @return void
     */
    public static function editConfirmationStatus(User $user)
    {
        DB_Connect::dbConnect()->query("UPDATE ".self::TABLE." SET confirm = 1 WHERE id = ". $user->getId());
    }


    /**
     * @param int $id
     * @return void
     */
    public static function deleteUser(int $id)
    {
        DB_Connect::dbConnect()->query("DELETE FROM ". self::TABLE . " WHERE id = $id ");
    }

    /**
     * @param int $id
     * @return int|mixed
     * Check if user exist on DB.
     */
    public static function userExist(int $id)
    {
        $query = DB_Connect::dbConnect()->query("SELECT count(*) as cnt FROM " . self::TABLE . " WHERE id = $id");
        return $query ? $query->fetch()['cnt'] : 0;
    }
}