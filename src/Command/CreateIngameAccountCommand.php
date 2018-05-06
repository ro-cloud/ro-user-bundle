<?php

namespace RoCloud\UserBundle\Command;

use RoCloud\UserBundle\Repository\IngameAccountRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * @author Black-Nobody <black-nobody@hotmail.de>
 */
class CreateIngameAccountCommand extends Command
{
    /**
     * @var IngameAccountRepository
     */
    private $accountRepository;

    /**
     * CreateIngameAccountCommand constructor.
     *
     * @param null|string $name
     * @param IngameAccountRepository $accountRepository
     */
    public function __construct(?string $name = null, IngameAccountRepository $accountRepository)
    {
        parent::__construct('ro:create-user');
        $this->accountRepository = $accountRepository;
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
            ]);
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        if (empty($input->getArgument('user'))) {
            $symfonyStyle = new SymfonyStyle($input, $output);

            $user = $symfonyStyle->ask('Please enter a username the new account will be created for');
            $input->setArgument('user', $user);
        }

        if (empty($input->getArgument('account-name'))) {
            $symfonyStyle = new SymfonyStyle($input, $output);

            $accountName = $symfonyStyle->ask('Please enter a name for the ingame account');
            $input->setArgument('account-name', $accountName);
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $symfonyStyle = new SymfonyStyle($input, $output);
        $password = $symfonyStyle->askHidden('Enter a password for the new ingame account');
    }
}
