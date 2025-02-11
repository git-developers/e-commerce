<?php

declare(strict_types=1);

namespace Bundle\CategoryBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Bundle\CategoryBundle\Entity\Category;
use Bundle\CategoryBundle\Entity\CategoryHasProduct;
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

        if ($entity instanceof Category) {

            $entityType = $entity->getType();
//            $entityType = Category::isEntityType($entityTypeId);
            $entity->setType($entityType);

            $name = $entity->getName();
            $entity->setSlug(uniqid() . '-' . $this->slugify($name));
            $entity->setCreatedAt($this->setupCreatedAt($entity));

            return;
        } elseif ($entity instanceof CategoryHasProduct) {
            $entity->setCreatedAt($this->setupCreatedAt($entity));

            return;
        }
    }

    /**
     * This method will called on Doctrine postPersist event
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Category) {

            $entityType = $entity->getType();
//            $entityType = Category::getEntityTypeById($entityTypeId);
            $entity->setType($entityType);

            $entity->setUpdatedAt($this->dateTime);

            return;
        }
    }

    /**
     * This method will called on Doctrine postUpdate event
     */
    public function postUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Category) {

            return;
        }
    }

    /**
     * This method will called on Doctrine postRemove event
     */
    public function postRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Category) {

            return;
        }
    }

    /**
     * This method will called on Doctrine postLoad event
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof Category) {

            return;
        }
    }

}






