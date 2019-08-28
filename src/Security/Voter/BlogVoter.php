<?php

namespace App\Security\Voter;

use App\Entity\Blog;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class BlogVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        return in_array($attribute, ['CAN_EDIT']) && $subject instanceof Blog;
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
                return $subject->getOwner()->getId() === $user->getId();
            default:
                // We don't know what to do here, attribute is unsupported
                break;
        }

        return false;
    }
}
