<?php

namespace App\EventSubscriber;

use App\Entity\Post;
use DateTimeImmutable;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class EasyAdminSubscriber implements EventSubscriberInterface
{

    private $slugger;
    private $security;

    public function __construct(SluggerInterface $slugger,Security $security)
    {
        $this->slugger = $slugger;
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class =>['setPostSlugAndDateAndUser'],
        ];
    }

    public function setPostSlugAndDateAndUser (BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();
        if(!($entity instanceof Post)){
            return;
        }

        $slug = $this->slugger->slug($entity->getTitle());
        $entity->setSlug($slug);
        $date = new DateTimeImmutable('now');
        $entity->setCreatedAt($date);
        $entity->setUpdatedAt($date);

        $user = $this->security->getUser();
        $entity->setUser($user);

    }
}
