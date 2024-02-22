<?php

namespace App\Core\Event\UserInterface\Cli;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:event:get-events',
    description: 'Pobieranie eventów'
)]
class GetEvents extends Command
{

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('OK');
        return Command::SUCCESS;
    }

}
