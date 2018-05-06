<?php

namespace RoCloud\UserBundle\Entity;

/**
 * @author Black-Nobody <black-nobody@hotmail.de>
 */
interface AccountManagerInterface
{
    public function create(string $username, string $password, string $email): IngameAccountInterface;
}
