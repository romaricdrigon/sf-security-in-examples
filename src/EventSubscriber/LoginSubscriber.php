<?php

namespace App\EventSubscriber;

use App\Entity\LoginAttempt;
use App\Event\FailedLogin;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LoginSubscriber implements EventSubscriberInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function onLogin(FailedLogin $event)
    {
        $attempt = new LoginAttempt($event->getUsername());

        $this->entityManager->persist($attempt);
        $this->entityManager->flush();
    }

    public static function getSubscribedEvents()
    {
        return [
            FailedLogin::class => 'onLogin',
        ];
    }
}
