<?php

namespace App\Model\Entity;

class News extends AbstractEntity
{
    private string $content;
    private int $user_fk;


    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return News
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return int
     */
    public function getUserFk(): int
    {
        return $this->user_fk;
    }

    /**
     * @param int $user_fk
     * @return News
     */
    public function setUserFk(int $user_fk): self
    {
        $this->user_fk = $user_fk;
        return $this;
    }


}