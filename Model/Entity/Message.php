<?php

namespace App\Model\Entity;

use App\Model\Entity\user;
use DateTime;

class Message
{
    private int $id;
    private string $content;
    private DateTime $date;
    private int $userId;

    /**
     * @return int|null
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Message
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     * @return Message
     */
    public function setDate(DateTime $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return int
     */
    public function getUser(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     * @return Message
     */
    public function setUser(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }


}