<?php

use App\Model\Entity\AbstractEntity;

class User extends AbstractEntity
{
    public string $email;
    public string $pseudo;
    private string $password;
    public string $confirm_code;
    public int $confirm;
    public Role $role;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     */
    public function setPseudo(string $pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getConfirmCode(): string
    {
        return $this->confirm_code;
    }

    /**
     * @param string $confirm_code
     */
    public function setConfirmCode(string $confirm_code): void
    {
        $this->confirm_code = $confirm_code;
    }

    /**
     * @return int
     */
    public function getConfirm(): int
    {
        return $this->confirm;
    }

    /**
     * @param int $confirm
     */
    public function setConfirm(int $confirm): void
    {
        $this->confirm = $confirm;
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * @param Role $role
     */
    public function setRole(Role $role): void
    {
        $this->role = $role;
    }





}