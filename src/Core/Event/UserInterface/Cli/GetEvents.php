<?php

namespace App\Core\Event\UserInterface\Cli;

use App\Core\Event\Application\Service\EventServiceInterface;
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
    public function __construct(private EventServiceInterface $eventService)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $events = $this->eventService->getEvents();

            foreach ($events as $event) {
                $output->writeln('id: ' . $event->id);
                $output->writeln('start: ' . $event->start->format('Y-m-d'));
                $output->writeln('end: ' . $event->end->format('Y-m-d'));
                $output->writeln('summary: ' . $event->summary);
                $output->writeln('');
            }

            return Command::SUCCESS;

        } catch (\Exception $e) {

            $output->writeln('<error>' . $e->getMessage() . '</error>');
            return Command::FAILURE;

        }
    }

}
