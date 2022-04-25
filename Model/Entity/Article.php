<?php

use App\Model\Entity\AbstractEntity;

class Article extends AbstractEntity
{
    private string $content;
    private User $user_fk;

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Article
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return User
     */
    public function getUserFk(): User
    {
        return $this->user_fk;
    }

    /**
     * @param User $user_fk
     * @return Article
     */
    public function setUserFk(User $user_fk): self
    {
        $this->user_fk = $user_fk;
        return $this;
    }







}