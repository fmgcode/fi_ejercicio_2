<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus\Event;

use App\Shared\Domain\Bus\Event\DomainEvent;
use App\Shared\Domain\Bus\Event\EventBus;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerDomainEventBus implements EventBus
{
    private MessageBusInterface $eventBus;

    public function __construct(MessageBusInterface $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event){
            $this->publisher($event);
        }
    }

    private function publisher(DomainEvent $domainEvent): void
    {
        try {
            $this->eventBus->dispatch($domainEvent);
        } catch (NoHandlerForMessageException $e) {
            throw new MessengerEventNotRegisteredError($domainEvent);
        } catch (HandlerFailedException $e) {
            throw $e->getPrevious() ?? $e;
        }
    }
}