<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus;

use Symfony\Component\Messenger\Envelope;

class SymfonyMessageBus implements MessageBusInterface
{
    private \Symfony\Component\Messenger\MessageBusInterface $bus;

    public function __construct(\Symfony\Component\Messenger\MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function dispatch(object $message, array $stamps = []): Envelope
    {
        return $this->bus->dispatch($message, $stamps);
    }
}