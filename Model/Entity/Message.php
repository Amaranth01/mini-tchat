<?php

namespace App\Model\Entity;

use App\Model\Entity\AbstractEntity;
use App\Model\Entity\user;
use DateTime;

class Message extends AbstractEntity
{
    private string $content;
    private DateTime $date;
    private User $user;

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
     * @return user
     */
    public function getUser(): user
    {
        return $this->user;
    }

    /**
     * @param user $user
     * @return Message
     */
    public function setUser(user $user): self
    {
        $this->user = $user;
        return $this;
    }


}