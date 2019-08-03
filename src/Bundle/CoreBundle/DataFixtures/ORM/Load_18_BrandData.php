<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Bundle\ProductBundle\Entity\Brand;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class Load_18_BrandData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {

        $entity = new Brand();
	    $entity->setName('Brand 1');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('brand-1', $entity);
        
	    $entity = new Brand();
	    $entity->setName('Brand 2');
	    $entity->setIsActive(true);
	    $manager->persist($entity);
	    $this->addReference('brand-2', $entity);
	    
        $entity = new Brand();
	    $entity->setName('Brand 3');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('brand-3', $entity);
        
        $entity = new Brand();
	    $entity->setName('Brand 4');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('brand-4', $entity);

        $entity = new Brand();
	    $entity->setName('Brand 5');
	    $entity->setIsActive(true);
        $manager->persist($entity);
        $this->addReference('brand-5', $entity);
        
        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 18;
    }
}