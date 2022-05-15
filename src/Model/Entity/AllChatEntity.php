<?php

namespace App\Model\Entity;

class AllChatEntity extends AbstractEntity
{

    private string $content;
    private string $dateTime;
    private User $author;


    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return AllChatEntity
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getDateTime(): string
    {
        return $this->dateTime;
    }

    /**
     * @param string $dateTime
     * @return AllChatEntity
     */
    public function setDateTime(string $dateTime): self
    {
        $this->dateTime = $dateTime;
        return $this;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $author
     * @return AllChatEntity
     */
    public function setAuthor(User $author): self
    {
        $this->author = $author;
        return $this;
    }



}