<?php

namespace RoCloud\UserBundle\Entity\Manager;

use RoCloud\UserBundle\Entity\IngameAccount;
use RoCloud\UserBundle\Entity\IngameAccountInterface;
use RoCloud\UserBundle\Repository\IngameAccountRepository;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

/**
 * @author Black-Nobody <black-nobody@hotmail.de>
 */
class AccountManager implements AccountManagerInterface
{
    /**
     * @var PasswordEncoderInterface
     */
    private $passwordEncoder;
    /**
     * @var IngameAccountRepository
     */
    private $accountRepository;

    /**
     * AccountManager constructor.
     *
     * @param PasswordEncoderInterface $passwordEncoder
     * @param IngameAccountRepository $accountRepository
     */
    public function __construct(PasswordEncoderInterface $passwordEncoder, IngameAccountRepository $accountRepository)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->accountRepository = $accountRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function create(string $username, string $password, string $email, bool $active): IngameAccountInterface
    {
        /**
         * @TODO: Make the account configurable for future versions
         */
        $user = new IngameAccount();
        $user
            ->setUserid($username)
            ->setUserPass($this->hashPassword($password))
            ->setEmail($email);

        if ($active) {
            $user->setState(AccountManagerInterface::STATE_UNBANNED);
        }

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function exists(string $username): bool
    {
        return $this->accountRepository->findOneByUsername($username) instanceof IngameAccountInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function ban(IngameAccountInterface $ingameAccount): IngameAccountInterface
    {
        $ingameAccount->setState(AccountManagerInterface::STATE_BANNED);

        return $ingameAccount;
    }

    /**
     * {@inheritdoc}
     */
    public function banFor(IngameAccountInterface $ingameAccount, \DateTime $banUntil): IngameAccountInterface
    {
        $unbanTimestamp = $banUntil->getTimestamp();
        $ingameAccount->setUnbanTime($unbanTimestamp);

        return $ingameAccount;
    }

    /**
     * {@inheritdoc}
     */
    public function changeGroup(IngameAccountInterface $ingameAccount, int $groupId): IngameAccountInterface
    {
        $ingameAccount->setGroupId($groupId);

        return $ingameAccount;
    }

    /**
     * {@inheritdoc}
     */
    public function hashPassword(string $password): string
    {
        // Due to missing salting support in rAthena, just set the salt to a empty string
        return $this->passwordEncoder->encodePassword($password, '');
    }
}
