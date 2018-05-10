<?php

namespace RoCloud\UserBundle\Tests\Functional\Command;

use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use PHPUnit\Framework\TestCase;
use RoCloud\UserBundle\Command\CreateIngameAccountCommand;
use RoCloud\UserBundle\Entity\IngameAccountInterface;
use RoCloud\UserBundle\Entity\Manager\AccountManagerInterface;
use RoCloud\UserBundle\Repository\IngameAccountRepository;
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

        $user = $this->prophesize(UserInterface::class);
        $user->getEmail()->willReturn($email);

        $ingameAccount = $this->prophesize(IngameAccountInterface::class);

        $userManager = $this->prophesize(UserManagerInterface::class);
        $userManager
            ->findUserByUsername($username)
            ->willReturn($user->reveal());

        $accountRepository = $this->prophesize(IngameAccountRepository::class);
        $accountManager = $this->prophesize(AccountManagerInterface::class);
        $accountManager
            ->create($accountName, $password, $email, true)
            ->willReturn($ingameAccount->reveal());
        $accountManager->exists($username)->willReturn(false);

        $entityManager = $this->prophesize(EntityManager::class);
        $entityManager
            ->getRepository('RoCloudUserBundle:IngameAccount')
            ->willReturn($accountRepository->reveal());

        $entityManager
            ->persist($ingameAccount->reveal())
            ->shouldBeCalled();

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
        $tester->setInputs([$username, $accountName]);
        $tester->execute([
            'password' => $password,
        ]);

        $output = $tester->getDisplay();
        $this->assertContains('Please enter a username the new account will be created for', $output);
        $this->assertContains('Please enter a name for the ingame account', $output);
    }
}
