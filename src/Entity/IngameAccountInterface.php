<?php

namespace RoCloud\UserBundle\Entity;

/**
 * @author Black-Nobody <black-nobody@hotmail.de>
 */
interface IngameAccountInterface
{
    /**
     * Sets the state of an account
     *
     * @param int $state
     *
     * @return IngameAccountInterface
     */
    public function setState(int $state);

    /**
     * Sets the group id of the user account
     *
     * @param int $id
     *
     * @return IngameAccountInterface
     */
    public function setGroupId(int $id);

    /**
     * @param int $unbanTime
     *
     * @return IngameAccountInterface
     */
    public function setUnbanTime(int $unbanTime);

    /**
     * Returns whether the account is active or not
     *
     * @return bool
     */
    public function isActive(): bool;

    /**
     * Returns whether the account is banned or not
     *
     * @return bool
     */
    public function isBanned(): bool;
}
