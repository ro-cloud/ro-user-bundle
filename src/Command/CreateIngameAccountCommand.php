<?php

namespace RoCloud\UserBundle\Command;

use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\UserManagerInterface;
use RoCloud\UserBundle\Entity\Manager\AccountManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @author Black-Nobody <black-nobody@hotmail.de>
 */
class CreateIngameAccountCommand extends Command
{
    /**
     * @var AccountManagerInterface
     */
    private $accountManager;

    /**
     * @var UserManagerInterface
     */
    private $userManager;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * CreateIngameAccountCommand constructor.
     *
     * @param null|string $name
     * @param EntityManager $objectManager
     * @param AccountManagerInterface $accountManager
     * @param UserManagerInterface $userManager
     */
    public function __construct(
        ?string $name,
        EntityManager $objectManager,
        AccountManagerInterface $accountManager,
        UserManagerInterface $userManager
    ) {
        parent::__construct('ro:create-user');

        $this->entityManager = $objectManager;
        $this->accountManager = $accountManager;
        $this->userManager = $userManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Creates an ingame account for given user')
            ->setDefinition([
                new InputArgument(
                    'user',
                    InputArgument::REQUIRED,
                    'The user the new account will be created for'
                ),
                new InputArgument(
                    'account-name',
                    InputArgument::REQUIRED,
                    'The ingame account name'
                ),
                new InputArgument(
                    'password',
                    InputArgument::REQUIRED,
                    'Leave this empty, to enter the password hidden'
                ),
                new InputOption(
                    'active',
                    'a',
                    InputOption::VALUE_OPTIONAL,
                    'Boolean. False will deactivate the user on creation',
                    true
                ),
            ]);
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $consoleHelper = new SymfonyStyle($input, $output);

        if (empty($input->getArgument('user'))) {
            $user = $consoleHelper->ask('Please enter a username the new account will be created for');
            $input->setArgument('user', $user);
        }

        if (empty($input->getArgument('account-name'))) {
            $accountName = $consoleHelper->ask('Please enter a name for the ingame account');
            $input->setArgument('account-name', $accountName);
        }

        if (empty($input->getArgument('password'))) {
            $password = $consoleHelper->askHidden('Please enter a password for the new ingame account');
            $input->setArgument('password', $password);
        }
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int - Statuscode for cli
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $username = $input->getArgument('user');
        $user = $this->userManager->findUserByUsername($username);

        if (empty($user)) {
            // @TODO: Replace generic exception by more verbose one
            throw new \Exception('User not found');
        }

        $accountName = $input->getArgument('account-name');
        $password = $input->getArgument('password');

        if (!$this->accountManager->exists($username)) {
            $newAccount = $this->accountManager
                ->create($accountName, $password, $user->getEmail(), $input->getOption('active'));
            $this->entityManager->persist($newAccount);

            return 0;
        }

        return -1;
    }
}
