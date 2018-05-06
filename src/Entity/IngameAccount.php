<?php

namespace RoCloud\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author Black-Nobody <black-nobody@hotmail.de>
 * @ORM\Table(name="login")
 */
class IngameAccount
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="account_id", type="integer", length=11, nullable=false)
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(initialValue=2000000)
     */
    protected $accountId;

    /**
     * @var string
     *
     * @ORM\Column(name="userid", type="string", length=23, nullable=false)
     */
    protected $userid;

    /**
     * @var string
     *
     * @ORM\Column(name="user_pass", type="string", length=32, nullable=false)
     */
    protected $userPass;

    /**
     * @var string
     *
     * @ORM\Column(name="sex", columnDefinition="ENUM('M', 'F', 'S'), nullable=false)
     */
    protected $sex;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=39, nullable=false)
     */
    protected $email;

    /**
     * @var int
     *
     * @ORM\Column(name="group_id", type="integer", length=3, nullable=false)
     */
    protected $groupId;

    /**
     * @var int
     *
     * @ORM\Column(name="state", type="integer", length=11, nullable=false, options={"unsigned":true})
     */
    protected $state;

    /**
     * @var integer - Timestamp
     *
     * @ORM\Column(name="unban_time", type="integer", length=11, nullable=false, options={"unsigned": true})
     */
    protected $unbanTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="expiration_time", type="integer", length=11, nullable=false, options={"unsigned":true})
     */
    protected $expirationTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="logincount", type="integer", length=9, nullable=false, options={"unsigned":true})
     */
    protected $logincount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastlogin", type="datetime")
     */
    protected $lastlogin;

    /**
     * @var string
     *
     * @ORM\Column(name="last_ip", type="string", length=100, nullable=false)
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
     * @ORM\Column(name="character_slots", type="integer", length=3, nullable=false, options={"unsigned":true, "default": 0})
     */
    protected $characterSlots;

    /**
     * @var string
     *
     * @ORM\Column(name="pincode", type="string", length=4, nullable=false)
     */
    protected $pincode;

    /**
     * @var int
     *
     * @ORM\Column(name="pincode_change", type="integer", length=11, nullable=false, options={"unsigned":true})
     */
    protected $pincodeChange;

    /**
     * @var int
     *
     * @ORM\Column(name="vip_time", type="integer", length=11, nullable=false, options={"unsigned":true})
     */
    protected $vipTime;

    /**
     * @var int
     *
     * @ORM\Column(name="old_group", type="integer", length=3, nullable=false, options={"unsigned":true, "default": 0})
     */
    protected $oldGroup;
}
