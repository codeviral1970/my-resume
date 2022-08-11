<?php

namespace App\EventSubscriber;

use DateTime;
use DateTimeZone;
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

    public function setEntityCreatedAt(BeforeEntityPersistedEvent $event)
    {
      $date = new DateTime();
      $date->format('Y-m-d H:i:s');
       $entity = $event->getEntityInstance();
        
       if (!$entity instanceof TimeStampInterface) {
           return;
       }

       $entity->setCreatedAt($date);
       //dd($entity);
    }

    public function setEntityUpdatedAt(BeforeEntityUpdatedEvent $event)
    {
       $date = new DateTime();
      $date->format('Y-m-d H:i:s');
        $entity = $event->getEntityInstance();

        if (!$entity instanceof TimeStampInterface) {
            return;
        }

        $entity->setUpdatedAt($date);
        dd($entity);
    }

  // public static function getSubscribedEvents()
  // {
  //   return [
  //     BeforeEntityPersistedEvent::class => ['setEntityCreatedAt'],
  //     BeforeEntityUpdatedEvent::class => ['setEntityUpdatedAt']
  //   ];
  // }

  // public function setEntityCreatedAt(BeforeEntityPersistedEvent $event): void
  // {
  //   $entity = $event->getEntityInstance();


  //   if(!$entity instanceof TimeStampInterface) 
  //   {
  //     return;
  //   }

  //   $entity->setCreatedAt(new \DateTime());
  // }

  //  public function setEntityUpdatedAt(BeforeEntityUpdatedEvent $event): void
  // {
  //   $entity = $event->getEntityInstance();

  //   if(!$entity instanceof TimeStampInterface) 
  //   {
  //     return;
  //   }

  //   $entity->setUpdatedAt(new \DateTime());
  // }


}