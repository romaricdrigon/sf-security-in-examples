<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class InitUserFilterSubscriber implements EventSubscriberInterface
{
    private $tokenStorage;
    private $entityManager;

    public function __construct(TokenStorageInterface $tokenStorage, EntityManagerInterface $entityManager)
    {
        $this->tokenStorage = $tokenStorage;
        $this->entityManager = $entityManager;
    }

    public function onRequest()
    {
        if (!$this->tokenStorage->getToken() || !$user = $this->tokenStorage->getToken()->getUser()) {
            return;
        }

        if (!$user instanceof User) {
            return;
        }

        $this->entityManager->getFilters()->enable('blog_filter');
        $this->entityManager->getFilters()->getFilter('blog_filter')->setParameter('user', $user->getId());
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => 'onRequest',
        ];
    }
}
