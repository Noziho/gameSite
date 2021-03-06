<?php

namespace App\Model\Manager;



use App\Model\DB_Connect;
use App\Model\Entity\Role;
use App\Model\Entity\User;

class RoleManager
{
    const TABLE = "ndmp22_role";

    /**
     * @param User $user
     * @return array
     */
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
                    ->setName($roleData['name'])
                ;
            }
        }

        return $roles;
    }
}