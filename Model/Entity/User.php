<?php

use App\Model\Entity\AbstractEntity;

class User extends AbstractEntity
{
    public string $email;
    public string $username;
    private string $password;
    public string $confirm_code;
    public int $confirm;
    public array $role;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
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
     * @return User
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
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
     * @return User
     */
    public function setConfirmCode(string $confirm_code): self
    {
        $this->confirm_code = $confirm_code;
        return $this;
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
     * @return User
     */
    public function setConfirm(int $confirm): self
    {
        $this->confirm = $confirm;
        return $this;
    }

    /**
     * @return array
     */
    public function getRole(): array
    {
        return $this->role;
    }

    /**
     * @param array|null $role
     * @return User
     */
    public function setRole(?array $role): self
    {
        $this->role = $role;
        return $this;
    }





}