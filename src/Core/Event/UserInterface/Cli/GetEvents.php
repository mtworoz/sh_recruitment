<?php

namespace App\Core\Event\UserInterface\Cli;

use App\Core\Event\Application\Service\EventService;
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
    public function __construct(private EventService $eventService)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $events = $this->eventService->getEvents();

        foreach ($events as $event){
            $output->writeln($event->id);
            $output->writeln($event->start);
            $output->writeln($event->end);
            $output->writeln($event->summary);
            $output->writeln('');
        }

        return Command::SUCCESS;
    }

}
