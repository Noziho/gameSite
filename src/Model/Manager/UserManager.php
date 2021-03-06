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
            ->setConfirm($data['confirm']);
        return $user->setRole(RoleManager::getRolesByUserId($user));
    }

    /**
     * @param $email
     * @param $username
     * @param $password
     * @param $confirm_code
     * @return bool
     * Is prepare query for add a user in DB.
     */
    public static function register($email, $username, $password, $confirm_code): bool
    {
        $stmt = DB_Connect::dbConnect()->prepare("
            INSERT INTO " . self::TABLE . " (email, username, password, confirm_code, confirm, role_fk)
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


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


    /**
     * @param string $email
     * @param string $password_decode
     * @return void
     * Compare if password written by user is the same as Password on DB
     */
    public static function login(string $email, string $password_decode): void
    {
        $stmt = DB_Connect::dbConnect()->prepare("
            SELECT * FROM " . self::TABLE . " WHERE email = :email
        ");
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            $password = $stmt->fetch();
            if (password_verify($password_decode, $password['password'])) {
                $user = self::makeUser($password);

                if ($user->getConfirm() === 0) {
                    header("Location: /?c=user&a=login&f=0");
                    exit();
                }

                if (!isset($_SESSION['user'])) {
                    $_SESSION['user'] = $user;
                }
                header("Location: /?c=home&f=0");
            }else {
                header("Location: /?c=user&a=login&f=2");
            }

        } else {
            header("Location: /?c=user&a=login&f=3");
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
     * @param string $email
     * @return User|null
     */
    public static function getUserByEmail(string $email): ?User
    {

        $query = DB_Connect::dbConnect()->prepare("SELECT * FROM " . self::TABLE . " WHERE email = :email");
        $query->bindParam(':email', $email);

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
     * @param string $email
     * @return string
     */
    public static function mailExist(string $email): string
    {
        $query = DB_Connect::dbConnect()->query("SELECT count(*) as cnt FROM " . self::TABLE . " WHERE email = \"$email\"");
        return $query ? $query->fetch()['cnt'] : 0;
    }


    /**
     * @param string $username
     * @return string
     */
    public static function usernameExist(string $username): string
    {
        $query = DB_Connect::dbConnect()->query("SELECT count(*) as cnt FROM " . self::TABLE . " WHERE username = \"$username\"");
        return $query ? $query->fetch()['cnt'] : 0;
    }


    /**
     * @param User $user
     * @return void
     */
    public static function editConfirmationStatus(User $user): void
    {
        DB_Connect::dbConnect()->query("UPDATE " . self::TABLE . " SET confirm = 1 WHERE id = " . $user->getId());
    }


    /**
     * @param int $id
     * @return void
     */
    public static function deleteUser(int $id): void
    {
        DB_Connect::dbConnect()->query("DELETE FROM " . self::TABLE . " WHERE id = $id ");
    }

    /**
     * @param int $id
     * @param int $role_fk
     * @return void
     */
    public static function editUserRole (int $id, int $role_fk): void
    {
        $stmt = DB_Connect::dbConnect()->prepare("
            UPDATE ".self::TABLE." SET role_fk = :role_fk WHERE id = :id
        ");

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':role_fk', $role_fk);

        $stmt->execute();
    }

    /**
     * @param int $id
     * @return string Check if user exist on DB.
     * Check if user exist on DB.
     */
    public static function userExist(int $id): string
    {
        $query = DB_Connect::dbConnect()->query("SELECT count(*) as cnt FROM " . self::TABLE . " WHERE id = $id");
        return $query ? $query->fetch()['cnt'] : 0;
    }

    /**
     * @return array
     */
    public static function getAll(): array
    {
        $users = [];
        $query = DB_Connect::dbConnect()->query("SELECT * FROM " . self::TABLE);

        if ($query) {
            foreach ($query->fetchAll() as $userData) {
                $users[] = self::makeUser($userData);
            }
        }
        return $users;
    }

    /**
     * @param int $user_fk
     * @return void
     * update role for mute user.
     */
    public static function muteUser (int $user_fk): void
    {
        $query = DB_Connect::dbConnect()->query("UPDATE ".self::TABLE." SET role_fk = 4 WHERE id = $user_fk");
        $query->execute();

    }

    /**
     * @param int $user_fk
     * @return void
     * update role for demute user.
     */
    public static function unmuteUser (int $user_fk):void
    {
        $query = DB_Connect::dbConnect()->query("UPDATE ".self::TABLE." SET role_fk = 1 WHERE id = $user_fk");
        $query->execute();
    }

    /**
     * @param User $user
     * @param string $password
     * @return bool
     * update password on DB.
     */
    public static function editPassword (User $user, string $password): bool
    {
        $stmt = DB_Connect::dbConnect()->prepare("
            UPDATE " . self::TABLE . " SET password = :password WHERE id = " . $user->getId());

        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
            return true;
        }

        return false;

    }


}