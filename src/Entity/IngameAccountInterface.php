<?php

namespace RoCloud\UserBundle\Entity;

use FOS\UserBundle\Model\UserInterface;

/**
 * @author Black-Nobody <black-nobody@hotmail.de>
 */
interface IngameAccountInterface
{
    /**
     * Returns the account id. Should start with 2000000
     *
     * @return int
     */
    public function getAccountId(): int;

    /**
     * Sets the account id
     *
     * @param int $accountId
     *
     * @return IngameAccountInterface
     */
    public function setAccountId(int $accountId): IngameAccountInterface;

    /**
     * @return string
     */
    public function getUserid(): string;

    /**
     * @param string $userid
     *
     * @return IngameAccountInterface
     */
    public function setUserid(string $userid): IngameAccountInterface;

    /**
     * @return string
     */
    public function getUserPass(): string;

    /**
     * @param string $userPass
     *
     * @return IngameAccountInterface
     */
    public function setUserPass(string $userPass): IngameAccountInterface;

    /**
     * @return string
     */
    public function getSex(): string;

    /**
     * @param string $sex
     *
     * @return IngameAccountInterface
     */
    public function setSex(string $sex): IngameAccountInterface;

    /**
     * @return string
     */
    public function getEmail(): string;

    /**
     * @param string $email
     *
     * @return IngameAccountInterface
     */
    public function setEmail(string $email): IngameAccountInterface;

    /**
     * @return int
     */
    public function getGroupId(): int;

    /**
     * Sets the group id of the user account
     *
     * @param int $groupId
     *
     * @return IngameAccountInterface
     */
    public function setGroupId(int $groupId): IngameAccountInterface;

    /**
     * @return int
     */
    public function getState(): int;

    /**
     * Sets the state of an account
     *
     * @param int $state
     *
     * @return IngameAccountInterface
     */
    public function setState();

    /**
     * @return int
     */
    public function getUnbanTime(): int;

    /**
     * @param int $unbanTime
     *
     * @return IngameAccountInterface
     */
    public function setUnbanTime(int $unbanTime): IngameAccountInterface;

    /**
     * @return int
     */
    public function getExpirationTime(): int;

    /**
     * @param int $expirationTime
     *
     * @return IngameAccountInterface
     */
    public function setExpirationTime(int $expirationTime): IngameAccountInterface;

    /**
     * @return int
     */
    public function getLogincount(): int;

    /**
     * @param int $logincount
     *
     * @return IngameAccountInterface
     */
    public function setLogincount(int $logincount): IngameAccountInterface;

    /**
     * @return \DateTime
     */
    public function getLastlogin(): \DateTime;

    /**
     * @param \DateTime $lastLogin
     *
     * @return IngameAccountInterface
     */
    public function setLastlogin(\DateTime $lastLogin): IngameAccountInterface;

    /**
     * @return string
     */
    public function getLastIp(): string;

    /**
     * @param string $lastIp
     *
     * @return IngameAccountInterface
     */
    public function setLastIp(string $lastIp): IngameAccountInterface;

    /**
     * @return \DateTime
     */
    public function getBirthdate(): \DateTime;

    /**
     * @param \DateTime $birthdate
     *
     * @return IngameAccountInterface
     */
    public function setBirthdate(\DateTime $birthdate): IngameAccountInterface;

    public function getCharacterSlots(): int;

    /**
     * @param int $characterSlots
     *
     * @return IngameAccountInterface
     */
    public function setCharacterSlots(int $characterSlots): IngameAccountInterface;

    /**
     * @return string
     */
    public function getPincode(): string;

    /**
     * @param string $pincode
     *
     * @return IngameAccountInterface
     */
    public function setPincode(string $pincode): IngameAccountInterface;

    /**
     * @return int
     */
    public function getPincodeChange(): int;

    /**
     * @param int $pincodeChange
     *
     * @return IngameAccountInterface
     */
    public function setPincodeChange(int $pincodeChange): IngameAccountInterface;

    /**
     * @return int
     */
    public function getVipTime(): int;

    /**
     * @param int $vipTime
     *
     * @return IngameAccountInterface
     */
    public function setVipTime(int $vipTime): IngameAccountInterface;

    /**
     * @return int
     */
    public function getOldGroup(): int;

    /**
     * @param int $oldGroup
     *
     * @return IngameAccountInterface
     */
    public function setOldGroup(int $oldGroup): IngameAccountInterface;

    /**
     * Returns whether the account is active or not
     *
     * @return bool
     */
    public function isActive();

    /**
     * Returns whether the account is banned or not
     *
     * @return bool
     */
    public function isBanned();

    /**
     * @return UserInterface
     */
    public function getOwner(): UserInterface;

    /**
     * @param UserInterface $owner
     *
     * @return IngameAccountInterface
     */
    public function setOwner(UserInterface $owner): IngameAccountInterface;
}
