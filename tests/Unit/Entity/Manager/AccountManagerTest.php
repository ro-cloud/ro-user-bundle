<?php

namespace RoCloud\UserBundle\Tests\Unit\Entity\Manager;

use PHPUnit\Framework\TestCase;
use RoCloud\UserBundle\Entity\IngameAccount;
use RoCloud\UserBundle\Entity\IngameAccountInterface;
use RoCloud\UserBundle\Entity\Manager\AccountManager;
use RoCloud\UserBundle\Repository\IngameAccountRepository;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

/**
 * @author Black-Nobody <black-nobody@hotmail.de>
 * @covers \RoCloud\UserBundle\Entity\Manager\AccountManager
 */
class AccountManagerTest extends TestCase
{
    /**
     * @test
     */
    public function itReturnsNewIngameAccount()
    {
        $username = 'test';
        $password = '123456';
        $email = 'test@example.tld';
        $sex = 'M';
        $active = true;

        $passwordEncoder = $this->prophesize(PasswordEncoderInterface::class);
        $passwordEncoder
            ->encodePassword($password, '')
            ->willReturn(md5($password));

        $accountRepository = $this->prophesize(IngameAccountRepository::class);
        $accountRepository
            ->findOneByUsername($username)
            ->willReturn(null);

        $sut = new AccountManager($passwordEncoder->reveal(), $accountRepository->reveal());
        /** @var IngameAccount $newAccount */
        $newAccount = $sut->create($username, $password, $email, $sex, $active);

        $this->assertInstanceOf(IngameAccountInterface::class, $newAccount);
        $this->assertEquals($username, $newAccount->getUserid());
        $this->assertEquals(md5($password), $newAccount->getUserPass());
        $this->assertEquals($email, $newAccount->getEmail());
        $this->assertEquals($active, $newAccount->isActive());
        $this->assertEquals($sex, $newAccount->getSex());
        $this->assertFalse($newAccount->isBanned());
    }

    /**
     * @test
     */
    public function itCanBanUserPermanently()
    {
        $username = 'test';
        $password = '123456';
        $email = 'test@example.tld';
        $sex = 'M';
        $active = true;

        $passwordEncoder = $this->prophesize(PasswordEncoderInterface::class);
        $passwordEncoder
            ->encodePassword($password, '')
            ->willReturn(md5($password));

        $accountRepository = $this->prophesize(IngameAccountRepository::class);
        $accountRepository->findOneByUsername($username)->willReturn(null);

        $sut = new AccountManager($passwordEncoder->reveal(), $accountRepository->reveal());
        /** @var IngameAccount $newAccount */
        $newAccount = $sut->create($username, $password, $email, $sex, $active);

        $updatedAccount = $sut->ban($newAccount);

        $this->assertTrue($newAccount->isBanned());
        $this->assertSame($newAccount, $updatedAccount);
    }

    /**
     * @test
     */
    public function itCanBanUserForCertainTime()
    {
        $username = 'test';
        $password = '123456';
        $email = 'test@example.tld';
        $sex = 'M';
        $active = true;

        $passwordEncoder = $this->prophesize(PasswordEncoderInterface::class);
        $passwordEncoder
            ->encodePassword($password, '')
            ->willReturn(md5($password));

        $accountRepository = $this->prophesize(IngameAccountRepository::class);
        $accountRepository->findOneByUsername($username)->willReturn(null);

        $sut = new AccountManager($passwordEncoder->reveal(), $accountRepository->reveal());
        /** @var IngameAccount $newAccount */
        $newAccount = $sut->create($username, $password, $email, $sex, $active);

        $banUntil = new \DateTime('+1 week');
        $sut->banFor($newAccount, $banUntil);

        $this->assertTrue($newAccount->isBanned(), '"$newAccount" must be banned');
        $this->assertSame(
            $banUntil->getTimestamp(),
            $newAccount->getUnbanTime(),
            'UnbanTime is not correct'
        );
    }

    /**
     * @test
     */
    public function itCanChangeTheAccountsGroup()
    {
        $username = 'test';
        $password = '123456';
        $email = 'test@example.tld';
        $sex = 'M';
        $active = true;

        $groupId = 99;

        $passwordEncoder = $this->prophesize(PasswordEncoderInterface::class);
        $passwordEncoder
            ->encodePassword($password, '')
            ->willReturn(md5($password));

        $accountRepository = $this->prophesize(IngameAccountRepository::class);
        $accountRepository->findOneByUsername($username)->willReturn(null);

        $sut = new AccountManager($passwordEncoder->reveal(), $accountRepository->reveal());
        /** @var IngameAccount $newAccount */
        $newAccount = $sut->create($username, $password, $email, $sex, $active);

        $sut->changeGroup($newAccount, $groupId);

        $this->assertSame($groupId, $newAccount->getGroupId());
    }

    /**
     * @test
     */
    public function itChecksIfAccountnameAlreadyExists()
    {
        $username = 'test';

        $account = $this->prophesize(IngameAccountInterface::class);
        $passwordEncoder = $this->prophesize(PasswordEncoderInterface::class);
        $accountRepository = $this->prophesize(IngameAccountRepository::class);
        $accountRepository
            ->findOneByUsername($username)
            ->shouldBeCalled()
            ->willReturn($account->reveal());

        $accountRepository
            ->findOneByUsername($username . '1')
            ->shouldBeCalled()
            ->willReturn(null);

        $sut = new AccountManager($passwordEncoder->reveal(), $accountRepository->reveal());

        $result = $sut->exists($username);
        $this->assertTrue($result);

        $result = $sut->exists($username . '1');
        $this->assertFalse($result);
    }
}
