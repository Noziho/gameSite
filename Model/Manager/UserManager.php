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

    public static function getUserByUserName(string $username): ?User
    {

        $query = DB_Connect::dbConnect()->prepare("SELECT * FROM " . self::TABLE . " WHERE username = :username");
        $query->bindParam(':username', $username);

        return $query->execute() ? self::makeUser($query->fetch()) : null;
    }

    public static function editConfirmationStatus(User $user)
    {
        $stmt = DB_Connect::dbConnect()->query(
            "UPDATE ".self::TABLE." SET confirm = 1 WHERE id = ". $user->getId() ."
        ");
    }
}