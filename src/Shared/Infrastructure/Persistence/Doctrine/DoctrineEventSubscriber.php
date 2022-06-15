<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Persistence\Doctrine;

use App\Entity\AggregateRoot;
use App\Shared\Domain\Bus\Event\EventBus;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class DoctrineEventSubscriber implements EventSubscriberInterface
{
    private EventBus $eventBus;

    public function __construct(EventBus $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
            Events::postUpdate,
            Events::postRemove,
        ];
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $this->publishEvents($args);
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
        $this->publishEvents($args);
    }

    public function postRemove(LifecycleEventArgs $args): void
    {
        $this->publishEvents($args);
    }

    private function publishEvents(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if($entity instanceof AggregateRoot){
            $this->eventBus->publish(...$entity->pullDomainEvents());
        }
    }
}