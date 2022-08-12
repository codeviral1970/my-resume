<?php

namespace App\EventSubscriber;

use App\Model\TimeStampInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;


class AdminSubscriber implements EventSubscriberInterface
{

  public static function getSubscribedEvents(): array
  {
    return [
        BeforeEntityPersistedEvent::class => ['setEntityCreatedAt'],
        BeforeEntityUpdatedEvent::class => ['setEntityUpdatedAt'],
    ];
  }

  public function setEntityCreatedAt(BeforeEntityPersistedEvent $event): void
  {
    
    $entity = $event->getEntityInstance();

    if(!$entity instanceof TimeStampInterface) 
    {
      return;
    }

    $entity->setCreatedAt(new \DateTimeImmutable())
    ->setUpdatedAt(new \DateTimeImmutable());
  }

  public function setEntityUpdatedAt(BeforeEntityUpdatedEvent $event): void
  {
    $entity = $event->getEntityInstance();

    if(!$entity instanceof TimeStampInterface) 
    {
      return;
    }

    $entity->setUpdatedAt(new \DateTimeImmutable());
  }
}