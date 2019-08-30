<?php

namespace App\Exception;

use Symfony\Component\Security\Core\Exception\AuthenticationException;

class TooMuchLoginAttemptException extends AuthenticationException
{
    // We can customize message displayed to the user here
    public function getMessageKey()
    {
        return 'Maximum number of attempts exceeded! Please wait a few minutes.';
    }
}
