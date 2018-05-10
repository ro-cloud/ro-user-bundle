<?php

namespace RoCloud\UserBundle\Exception;

/**
 * Class AccountAlreadyExistsException.
 */
class AccountAlreadyExistsException extends \Exception
{
    protected $message = 'Account already exists';
}
