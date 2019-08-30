<?php

namespace App\Event;

class FailedLogin
{
    private $username;
    private $date;

    public function __construct(string $username)
    {
        $this->date = new \DateTimeImmutable('now');
        $this->username = $username;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }
}
