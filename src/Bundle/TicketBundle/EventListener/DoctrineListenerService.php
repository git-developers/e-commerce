<?php

declare(strict_types=1);

namespace Bundle\TicketBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Bundle\TicketBundle\Entity\Ticket;
use Bundle\TicketBundle\Entity\PaymentType;
use Cocur\Slugify\Slugify;
use Bundle\CoreBundle\EventListener\BaseDoctrineListenerService;

// https://coderwall.com/p/es3zkw/symfony2-listen-doctrine-events

class DoctrineListenerService extends BaseDoctrineListenerService implements EventSubscriber
{

    public function __construct(TokenStorage $tokenStorage)
    {
        parent::__construct($tokenStorage);
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [
            'preUpdate',
            'prePersist',
            'preRemove',
            'preFlush',
            'postFlush',
            'postPersist',
            'postUpdate',
            'postRemove',
            'postLoad',
            'onFlush',
        ];
    }

    /**
     * This method will called on Doctrine postPersist event
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
//        $entityManager = $args->getEntityManager();
//        $className = $entityManager->getClassMetadata(get_class($entity))->getName();

        if ($entity instanceof Ticket) {
        	
            $name = $entity->getName();
            $entity->setSlug($this->slugify($name));
            $entity->setCreatedAt($this->setupCreatedAt($entity));
            $entity->setUserCreate($this->getUser()->getId());
            
            return;
        } elseif ($entity instanceof PaymentType) {
	        $name = $entity->getName();
	        $entity->setSlug($this->slugify($name));
	        $entity->setCreatedAt($this->setupCreatedAt($entity));
        }
    }

    /**
     * This method will called on Doctrine postPersist event
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Ticket){
            $entity->setUpdatedAt($this->dateTime);
	        $entity->setUserUpdate($this->getUser()->getId());

            return;
        }
    }

    /**
     * This method will called on Doctrine postUpdate event
     */
    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Ticket){

            return;
        }
    }

    /**
     * This method will called on Doctrine postRemove event
     */
    public function postRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Ticket){

            return;
        }
    }

    /**
     * This method will called on Doctrine postLoad event
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Ticket){

            return;
        }
    }

}






