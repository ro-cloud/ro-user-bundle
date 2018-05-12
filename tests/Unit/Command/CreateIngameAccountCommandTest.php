<?php

namespace RoCloud\UserBundle\Tests\Unit\Command;

use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use PHPUnit\Framework\TestCase;
use RoCloud\UserBundle\Command\CreateIngameAccountCommand;
use RoCloud\UserBundle\Entity\IngameAccountInterface;
use RoCloud\UserBundle\Entity\Manager\AccountManagerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * @author Black-Nobody <black-nobody@hotmail.de>
 * @covers \RoCloud\UserBundle\Command\CreateIngameAccountCommand
 */
class CreateIngameAccountCommandTest extends TestCase
{
    /**
     * @test
     */
    public function itCreatesNewIngameAccount()
    {
        $username = 'test-username';
        $accountName = 'new-account-username';
        $password = '1234password';
        $email = "test@email.tld";
        $sex = 'M';

        $user = $this->prophesize(UserInterface::class);
        $user->getEmail()->willReturn($email);

        $ingameAccount = $this->prophesize(IngameAccountInterface::class);

        $userManager = $this->prophesize(UserManagerInterface::class);
        $userManager
            ->findUserByUsername($username)
            ->willReturn($user->reveal());

        $accountManager = $this->prophesize(AccountManagerInterface::class);
        $accountManager
            ->create($accountName, $password, $email, $sex, true)
            ->willReturn($ingameAccount->reveal());
        $accountManager->exists($username)->willReturn(false);

        $entityManager = $this->prophesize(EntityManager::class);
        $entityManager
            ->persist($ingameAccount->reveal())
            ->shouldBeCalled();
        $entityManager->flush()->shouldBeCalled();

        $application = new Application();
        $application->add(
            new CreateIngameAccountCommand(
                null,
                $entityManager->reveal(),
                $accountManager->reveal(),
                $userManager->reveal()
            )
        );

        $command = $application->find('ro:create-user');

        $tester = new CommandTester($command);
        $tester->setInputs([$username, $accountName, $sex]);
        $tester->execute([
            'password' => $password,
        ]);

        $output = $tester->getDisplay();
        $this->assertContains('Please enter a username the new account will be created for', $output);
        $this->assertContains('Please enter a name for the ingame account', $output);
    }

    /**
     * @test
     * @expectedException \RoCloud\UserBundle\Exception\AccountAlreadyExistsException
     * @expectedExceptionMessage Account with the name "test-username" already exists
     * @expectedExceptionCode 1525989415
     */
    public function itThrowsExceptionWhenAccountAlreadyExists()
    {
        $username = 'test-username';
        $accountName = 'new-account-username';
        $password = '1234password';
        $sex = "M";
        $email = "test@email.tld";

        $ingameAccount = $this->prophesize(IngameAccountInterface::class);
        $user = $this->prophesize(UserInterface::class);
        $user->getEmail()->shouldNotBeCalled();

        $userManager = $this->prophesize(UserManagerInterface::class);
        $userManager->findUserByUsername($username)->willReturn($user->reveal());

        $accountManager = $this->prophesize(AccountManagerInterface::class);
        $accountManager->exists($username)->willReturn(true);
        $accountManager->create($accountName, $password, $email, $sex, true)->shouldNotBeCalled();

        $entityManager = $this->prophesize(EntityManager::class);
        $entityManager->persist($ingameAccount->reveal())->shouldNotBeCalled();
        $entityManager->flush()->shouldNotBeCalled();

        $application = new Application();
        $application->add(
            new CreateIngameAccountCommand(
                null,
                $entityManager->reveal(),
                $accountManager->reveal(),
                $userManager->reveal()
            )
        );

        $command = $application->find('ro:create-user');

        $tester = new CommandTester($command);
        $tester->setInputs([$username, $accountName, $sex]);
        $tester->execute([
            'password' => $password,
        ]);
    }

    /**
     * @test
     * @expectedException \RoCloud\UserBundle\Exception\UserNotFoundException
     * @expectedExceptionCode 1525989446
     * @expectedExceptionMessage User "username" not found
     */
    public function itThrowsExceptionWhenNoUserCouldBeFound()
    {
        $username = 'username';
        $password = '123456';
        $accountName = 'test-accountname';
        $sex = 'M';

        $entityManager = $this->prophesize(EntityManager::class);
        $accountManager = $this->prophesize(AccountManagerInterface::class);
        $userManager = $this->prophesize(UserManagerInterface::class);
        $userManager
            ->findUserByUsername($username)
            ->willReturn(null);

        $application = new Application();
        $application->add(
            new CreateIngameAccountCommand(
                null,
                $entityManager->reveal(),
                $accountManager->reveal(),
                $userManager->reveal()
            )
        );

        $command = $application->find('ro:create-user');

        $tester = new CommandTester($command);
        $tester->setInputs([$username, $accountName, $sex]);
        $tester->execute([
            'password' => $password,
        ]);
    }
}
