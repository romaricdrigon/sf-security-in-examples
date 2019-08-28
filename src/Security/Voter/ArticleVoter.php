<?php

namespace App\Security\Voter;

use App\Entity\Article;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class ArticleVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        return in_array($attribute, ['CAN_EDIT']) && $subject instanceof Article;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        // We support only users from our app
        if (!$user instanceof User) {
            return false;
        }

        switch ($attribute) {
            case 'CAN_EDIT':
                return $subject->getBlog()->getOwner()->getId() === $user->getId();
            default:
                // We don't know what to do here, attribute is unsupported
                break;
        }

        return false;
    }
}
