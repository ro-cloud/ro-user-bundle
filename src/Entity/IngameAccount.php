<?php

namespace RoCloud\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Black-Nobody <black-nobody@hotmail.de>
 *
 * @ORM\Table(name="login")
 * @ORM\Entity(repositoryClass="RoCloud\UserBundle\Repository\IngameAccountRepository")
 */
class IngameAccount implements IngameAccountInterface
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="account_id", type="integer", length=11, nullable=false)
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $accountId;

    /**
     * @var string
     *
     * @ORM\Column(name="userid", type="string", length=23, nullable=false)
     *
     * @Assert\NotBlank
     */
    protected $userid;

    /**
     * @var string
     *
     * @ORM\Column(name="user_pass", type="string", length=32, nullable=false)
     *
     * @Assert\NotBlank
     */
    protected $userPass;

    /**
     * @var string - Can only be 'M' => male, 'F' => female or 'S' => server
     *
     * @ORM\Column(name="sex", type="string", length=1, nullable=false)
     *
     * @Assert\Choice(choices={"M", "F", "S"})
     */
    protected $sex;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=39, nullable=false)
     * @Assert\Email
     */
    protected $email;

    /**
     * @var int
     *
     * @ORM\Column(name="group_id", type="smallint", length=3, nullable=false, options={"default": 0})
     */
    protected $groupId = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="state", type="integer", length=11, nullable=false, options={"unsigned":true, "default": 0})
     */
    protected $state = 0;

    /**
     * @var integer - Timestamp
     *
     * @ORM\Column(name="unban_time", type="integer", length=11, nullable=false, options={"unsigned": true, "default": 0})
     */
    protected $unbanTime = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="expiration_time", type="integer", length=11, nullable=false, options={"unsigned":true, "default": 0})
     */
    protected $expirationTime = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="logincount", type="integer", length=9, nullable=false, options={"unsigned":true, "default": 0})
     */
    protected $logincount = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastlogin", type="datetime")
     */
    protected $lastlogin;

    /**
     * The IP address will be masked on save. There's no reason to save it anyway.
     *
     * @var string
     *
     * @ORM\Column(name="last_ip", type="string", length=100, nullable=false, options={"default": ""})
     *
     * @Assert\Ip
     */
    protected $lastIp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="date")
     */
    protected $birthdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="character_slots", type="smallint", length=3, nullable=false, options={"unsigned":true, "default": 0})
     */
    protected $characterSlots = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="pincode", type="string", length=4, nullable=false)
     */
    protected $pincode;

    /**
     * @var int
     *
     * @ORM\Column(name="pincode_change", type="integer", length=11, nullable=false, options={"unsigned":true, "default": 0})
     */
    protected $pincodeChange = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="vip_time", type="integer", length=11, nullable=false, options={"unsigned":true, "default": 0})
     */
    protected $vipTime = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="old_group", type="smallint", length=3, nullable=false, options={"unsigned":true, "default": 0})
     */
    protected $oldGroup = 0;

    /**
     * @var OwnerInterface
     *
     * @ORM\ManyToOne(targetEntity="RoCloud\UserBundle\Entity\OwnerInterface", inversedBy="accounts")
     */
    protected $owner;

    public function __construct()
    {
        $this->lastlogin = new \DateTime();
    }

    /**
     * @return int
     */
    public function getAccountId(): int
    {
        return $this->accountId;
    }

    /**
     * @param int $accountId
     *
     * @return IngameAccount
     */
    public function setAccountId(int $accountId): IngameAccount
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserid(): string
    {
        return $this->userid;
    }

    /**
     * @param string $userid
     *
     * @return IngameAccount
     */
    public function setUserid(string $userid): IngameAccount
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserPass(): string
    {
        return $this->userPass;
    }

    /**
     * @param string $userPass
     *
     * @return IngameAccount
     */
    public function setUserPass(string $userPass): IngameAccount
    {
        $this->userPass = $userPass;

        return $this;
    }

    /**
     * @return string
     */
    public function getSex(): string
    {
        return $this->sex;
    }

    /**
     * @param string $sex
     *
     * @return IngameAccount
     */
    public function setSex(string $sex): IngameAccount
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return IngameAccount
     */
    public function setEmail(string $email): IngameAccount
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return int
     */
    public function getGroupId(): int
    {
        return $this->groupId;
    }

    /**
     * @param int $groupId
     *
     * @return IngameAccount
     */
    public function setGroupId(int $groupId): IngameAccount
    {
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * @return int
     */
    public function getState(): int
    {
        return $this->state;
    }

    /**
     * @param int $state
     *
     * @return IngameAccount
     */
    public function setState(int $state): IngameAccount
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return int
     */
    public function getUnbanTime(): int
    {
        return $this->unbanTime;
    }

    /**
     * @param int $unbanTime
     *
     * @return IngameAccount
     */
    public function setUnbanTime(int $unbanTime): IngameAccount
    {
        $this->unbanTime = $unbanTime;

        return $this;
    }

    /**
     * @return int
     */
    public function getExpirationTime(): ?int
    {
        return $this->expirationTime;
    }

    /**
     * @param int $expirationTime
     *
     * @return IngameAccount
     */
    public function setExpirationTime(int $expirationTime): IngameAccount
    {
        $this->expirationTime = $expirationTime;

        return $this;
    }

    /**
     * @return int
     */
    public function getLogincount(): int
    {
        return $this->logincount;
    }

    /**
     * @param int $logincount
     *
     * @return IngameAccount
     */
    public function setLogincount(int $logincount): IngameAccount
    {
        $this->logincount = $logincount;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLastlogin(): \DateTime
    {
        return $this->lastlogin;
    }

    /**
     * @param \DateTime $lastlogin
     *
     * @return IngameAccount
     */
    public function setLastlogin(\DateTime $lastlogin): IngameAccount
    {
        $this->lastlogin = $lastlogin;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastIp(): string
    {
        return $this->lastIp;
    }

    /**
     * @param string $lastIp
     *
     * @return IngameAccount
     */
    public function setLastIp(string $lastIp): IngameAccount
    {
        // @TODO: Refactor later to make this a little nicer
        if (filter_var($lastIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            // This will replace last two segments by '0'
            $lastIp = inet_ntop(inet_pton($lastIp) & '255.255.0.0');
        } elseif (filter_var($lastIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            // Thi will replace last 6 segments to '0000'
            $lastIp = inet_ntop(inet_pton($lastIp) & 'ffff:ffff:0000:0000:0000:0000:0000:0000');
        }

        $this->lastIp = $lastIp;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBirthdate(): \DateTime
    {
        return $this->birthdate;
    }

    /**
     * @param \DateTime $birthdate
     *
     * @return IngameAccount
     */
    public function setBirthdate(\DateTime $birthdate): IngameAccount
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * @return int
     */
    public function getCharacterSlots(): int
    {
        return $this->characterSlots;
    }

    /**
     * @param int $characterSlots
     *
     * @return IngameAccount
     */
    public function setCharacterSlots(int $characterSlots): IngameAccount
    {
        $this->characterSlots = $characterSlots;

        return $this;
    }

    /**
     * @return string
     */
    public function getPincode(): string
    {
        return $this->pincode;
    }

    /**
     * @param string $pincode
     *
     * @return IngameAccount
     */
    public function setPincode(string $pincode): IngameAccount
    {
        $this->pincode = $pincode;

        return $this;
    }

    /**
     * @return int
     */
    public function getPincodeChange(): int
    {
        return $this->pincodeChange;
    }

    /**
     * @param int $pincodeChange
     *
     * @return IngameAccount
     */
    public function setPincodeChange(int $pincodeChange): IngameAccount
    {
        $this->pincodeChange = $pincodeChange;

        return $this;
    }

    /**
     * @return int
     */
    public function getVipTime(): int
    {
        return $this->vipTime;
    }

    /**
     * @param int $vipTime
     *
     * @return IngameAccount
     */
    public function setVipTime(int $vipTime): IngameAccount
    {
        $this->vipTime = $vipTime;

        return $this;
    }

    /**
     * @return int
     */
    public function getOldGroup(): int
    {
        return $this->oldGroup;
    }

    /**
     * @param int $oldGroup
     *
     * @return IngameAccount
     */
    public function setOldGroup(int $oldGroup): IngameAccount
    {
        $this->oldGroup = $oldGroup;

        return $this;
    }

    /**
     * Returns whether the account is active or not
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isBanned() || (new \DateTime())->getTimestamp() > $this->getExpirationTime();
    }

    /**
     * Returns whether the account is banned or not
     *
     * @return bool
     */
    public function isBanned(): bool
    {
        return $this->state > 0 || (new \DateTime())->getTimestamp() < $this->getUnbanTime();
    }

    /**
     * @return UserInterface
     */
    public function getOwner(): UserInterface
    {
        return $this->owner;
    }

    /**
     * @param UserInterface $owner
     *
     * @return IngameAccount
     */
    public function setOwner(UserInterface $owner): IngameAccount
    {
        $this->owner = $owner;

        return $this;
    }
}
