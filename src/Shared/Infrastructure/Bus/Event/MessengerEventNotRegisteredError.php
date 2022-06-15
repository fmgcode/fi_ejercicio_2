<?php

namespace App\Shared\Infrastructure\Bus\Event;

use App\Shared\Domain\Bus\Event\DomainEvent;
use RuntimeException;

class MessengerEventNotRegisteredError extends RuntimeException
{
    public function __construct(DomainEvent $domainEvent)
    {
        $domainEventClass = get_class($domainEvent);

        parent::__construct("The event <$domainEventClass> hasn't a event handler associated");
    }
}