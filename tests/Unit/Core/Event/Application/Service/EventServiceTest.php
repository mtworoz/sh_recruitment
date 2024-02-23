<?php

namespace App\Tests\Unit\Core\Event\Application\Service;
use App\Core\Event\Domain\DTO\EventDTO;
use App\Core\Event\Domain\Exception\InvalidDateTimeException;
use PHPUnit\Framework\TestCase;
use App\Core\Event\Application\Service\EventService;
use App\Common\ICal\Cache\ICalEventFetcherInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class EventServiceTest extends TestCase
{
    private EventService $eventService;
    private ICalEventFetcherInterface $iCalEventFetcherMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->iCalEventFetcherMock = $this->createMock(ICalEventFetcherInterface::class);
        $eventDispatcherMock = $this->createMock(EventDispatcherInterface::class);
        $this->eventService = new EventService($this->iCalEventFetcherMock, $eventDispatcherMock);
    }

    public function validEventsProvider(): array
    {
        return [
            [['id' => 1, 'start' => '2024-02-24', 'end' => '2024-02-25', 'summary' => 'Test event']],
        ];
    }

    /**
     * @dataProvider validEventsProvider
     */
    public function testGetEventsReturnsCorrectEventData(array $eventData)
    {
        $this->iCalEventFetcherMock->expects($this->once())
            ->method('fetchAndCacheEvents')
            ->willReturn([$eventData]);

        $events = $this->eventService->getEvents();

        $this->assertCount(1, $events);
        $this->assertInstanceOf(EventDTO::class, $events[0]);
        $this->assertEquals($eventData['id'], $events[0]->id);
        $this->assertEquals(new \DateTime($eventData['start']), $events[0]->start);
        $this->assertEquals(new \DateTime($eventData['end']), $events[0]->end);
        $this->assertEquals($eventData['summary'], $events[0]->summary);
    }

    public function invalidDateProvider(): array
    {
        return [
            [['id' => 1, 'start' => 'invalid_date', 'end' => '2024-02-25', 'summary' => 'Test event']],
        ];
    }

    /**
     * @dataProvider invalidDateProvider
     */
    public function testGetEventsThrowsInvalidDateTimeExceptionOnInvalidDate(array $eventData)
    {
        $this->iCalEventFetcherMock->expects($this->once())
            ->method('fetchAndCacheEvents')
            ->willReturn([$eventData]);

        $this->expectException(InvalidDateTimeException::class);

        $this->eventService->getEvents();
    }

}
