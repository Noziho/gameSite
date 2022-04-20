<?php

use App\Model\Entity\AbstractEntity;


class RoleManager extends AbstractEntity
{
    const TABLE = "ndmp22_role";
    public static function getRolesByUserId(User $user): array
    {
        $roles = [];
        $query = DB_Connect::dbConnect()->query("
            SELECT * FROM ".self::TABLE." WHERE id IN (SELECT role_fk FROM ndmp22_user WHERE id = {$user->getId()});
        ");

        if($query){
            foreach($query->fetchAll() as $roleData) {
                $roles[] = (new Role())
                    ->setId($roleData['id'])
                    ->setName($roleData['role_name'])
                ;
            }
        }

        return $roles;
    }
}