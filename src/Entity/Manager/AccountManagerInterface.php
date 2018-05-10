<?php

namespace RoCloud\UserBundle\Entity\Manager;

use RoCloud\UserBundle\Entity\IngameAccountInterface;

/**
 * @author Black-Nobody <black-nobody@hotmail.de>
 */
interface AccountManagerInterface
{
    /**
     * The state value for an unbanned account
     */
    const STATE_UNBANNED = 0;

    /**
     * The value for a banned account
     */
    const STATE_BANNED = 100;

    /**
     * Creates the IngameAccountInterface model and returns it.
     * This method will only create an object but not persist your entity.
     *
     * @param string $username
     * @param string $password
     * @param string $email
     * @param bool $active
     *
     * @return IngameAccountInterface
     */
    public function create(string $username, string $password, string $email, bool $active): IngameAccountInterface;

    /**
     * Checks if an account already exists
     *
     * @param string $username
     *
     * @return bool
     */
    public function exists(string $username): bool ;

    /**
     * Sets the values for banning an account
     *
     * @param IngameAccountInterface $ingameAccount
     *
     * @return IngameAccountInterface
     */
    public function ban(IngameAccountInterface $ingameAccount): IngameAccountInterface;

    /**
     * Sets the values for banning an account for a specific time
     *
     * @param IngameAccountInterface $ingameAccount
     * @param \DateTime $banUntil
     *
     * @return IngameAccountInterface
     */
    public function banFor(IngameAccountInterface $ingameAccount, \DateTime $banUntil): IngameAccountInterface;

    /**
     * Changes the group of a user
     *
     * @param IngameAccountInterface $ingameAccount
     * @param int $groupId
     *
     * @return IngameAccountInterface
     */
    public function changeGroup(IngameAccountInterface $ingameAccount, int $groupId): IngameAccountInterface;

    /**
     * Hashes the password by given algorithm.
     *
     * Currently only 'plain' and 'md5' is supported.
     *
     * @param string $password
     *
     * @return string
     */
    public function hashPassword(string $password): string;
}
