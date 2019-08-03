<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\DataFixtures\ORM;

use Bundle\ProductBundle\Entity\Product;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class Load_19_ProductoData extends AbstractFixture implements OrderedFixtureInterface
{

    protected $applicationUrl;

    public function __construct($applicationUrl)
    {
        $this->applicationUrl = $applicationUrl;
    }

    public function load(ObjectManager $manager)
    {

        $category_1 = $this->getReference('category-1');
        $category_2 = $this->getReference('category-2');
        $category_3 = $this->getReference('category-3');
        
        $unit_1 = $this->getReference('unit-1');
        $brand_1 = $this->getReference('brand-1');

		
	
	    /**
	     * CATEGORY 1
	     */
        $entity = new Product();
	    $entity->setColor('#0000FF');
	    $entity->setStock(35);
	    $entity->setCode('111');
	    $entity->setPrice(25.33);
	    $entity->setUnit($unit_1);
	    $entity->setBrand($brand_1);
	    $entity->setModel('AX-123');
	    $entity->setName('Producto 1');
	    $entity->setDescriptionShort('Lorem ipsum dolor sit amet conse ctetuar adipisicing elit');
	    $entity->setDescriptionLong('<p><b>Car owners</b> know the real value of choosing quality wheels and tyres. Even if you have the most powerful engine, the next generation power transmission system and premium super-trick suspension.</p><p><b>We keep track</b> of the latest web design trends and try hard to keep our estore up-to-date and modern. It is designed in such a way that nothing will distract you from the items worth your attention.</p>');
	    $entity->setIsFeatured(true);
	    $entity->setCategory($category_1);
        $manager->persist($entity);
        $this->addReference('product-1', $entity);

        $entity = new Product();
	    $entity->setColor('#FF0000');
	    $entity->setStock(67);
	    $entity->setCode('222');
	    $entity->setPrice(67.77);
	    $entity->setUnit($unit_1);
	    $entity->setBrand($brand_1);
	    $entity->setModel('AX-567');
	    $entity->setName('Producto 2');
	    $entity->setDescriptionShort('Lorem ipsum dolor sit amet conse ctetuar adipisicing elit');
	    $entity->setDescriptionLong('<p><b>Car owners</b> know the real value of choosing quality wheels and tyres. Even if you have the most powerful engine, the next generation power transmission system and premium super-trick suspension.</p><p><b>We keep track</b> of the latest web design trends and try hard to keep our estore up-to-date and modern. It is designed in such a way that nothing will distract you from the items worth your attention.</p>');
	    $entity->setCategory($category_1);
        $manager->persist($entity);
        $this->addReference('product-2', $entity);
        
        $entity = new Product();
	    $entity->setColor('#00FF00');
	    $entity->setStock(25);
	    $entity->setCode('333');
	    $entity->setPrice(15.33);
	    $entity->setUnit($unit_1);
	    $entity->setBrand($brand_1);
	    $entity->setModel('HB-9876');
	    $entity->setName('Producto 3');
	    $entity->setDescriptionShort('Lorem ipsum dolor sit amet conse ctetuar adipisicing elit');
	    $entity->setDescriptionLong('<p><b>Car owners</b> know the real value of choosing quality wheels and tyres. Even if you have the most powerful engine, the next generation power transmission system and premium super-trick suspension.</p><p><b>We keep track</b> of the latest web design trends and try hard to keep our estore up-to-date and modern. It is designed in such a way that nothing will distract you from the items worth your attention.</p>');
	    $entity->setCategory($category_1);
        $manager->persist($entity);
        $this->addReference('product-3', $entity);
        
        $entity = new Product();
	    $entity->setColor('#0000FF');
	    $entity->setStock(98);
	    $entity->setCode('444');
	    $entity->setPrice(12.33);
	    $entity->setUnit($unit_1);
	    $entity->setBrand($brand_1);
	    $entity->setModel('AX-123');
	    $entity->setName('Producto 4');
	    $entity->setDescriptionShort('Lorem ipsum dolor sit amet conse ctetuar adipisicing elit');
	    $entity->setDescriptionLong('<p><b>Car owners</b> know the real value of choosing quality wheels and tyres. Even if you have the most powerful engine, the next generation power transmission system and premium super-trick suspension.</p><p><b>We keep track</b> of the latest web design trends and try hard to keep our estore up-to-date and modern. It is designed in such a way that nothing will distract you from the items worth your attention.</p>');
	    $entity->setIsFeatured(true);
	    $entity->setCategory($category_1);
        $manager->persist($entity);
        $this->addReference('product-4', $entity);
        
        $entity = new Product();
	    $entity->setColor('#FF0000');
	    $entity->setStock(15);
	    $entity->setCode('555');
	    $entity->setPrice(43.33);
	    $entity->setUnit($unit_1);
	    $entity->setBrand($brand_1);
	    $entity->setModel('KOP-768');
	    $entity->setName('Producto 5');
	    $entity->setDescriptionShort('Lorem ipsum dolor sit amet conse ctetuar adipisicing elit');
	    $entity->setDescriptionLong('<p><b>Car owners</b> know the real value of choosing quality wheels and tyres. Even if you have the most powerful engine, the next generation power transmission system and premium super-trick suspension.</p><p><b>We keep track</b> of the latest web design trends and try hard to keep our estore up-to-date and modern. It is designed in such a way that nothing will distract you from the items worth your attention.</p>');
	    $entity->setCategory($category_1);
        $manager->persist($entity);
        $this->addReference('product-5', $entity);

        

	    /**
	     * CATEGORY 2
	     */
        $entity = new Product();
	    $entity->setColor('#00FF00');
	    $entity->setStock(35);
	    $entity->setCode('666');
	    $entity->setPrice(23.44);
	    $entity->setUnit($unit_1);
	    $entity->setBrand($brand_1);
	    $entity->setModel('78U-GJU');
	    $entity->setName('Producto 6');
	    $entity->setDescriptionShort('Lorem ipsum dolor sit amet conse ctetuar adipisicing elit');
	    $entity->setDescriptionLong('<p><b>Car owners</b> know the real value of choosing quality wheels and tyres. Even if you have the most powerful engine, the next generation power transmission system and premium super-trick suspension.</p><p><b>We keep track</b> of the latest web design trends and try hard to keep our estore up-to-date and modern. It is designed in such a way that nothing will distract you from the items worth your attention.</p>');
	    $entity->setIsFeatured(true);
	    $entity->setCategory($category_2);
        $manager->persist($entity);
        $this->addReference('product-6', $entity);

        $entity = new Product();
	    $entity->setColor('#0000FF');
	    $entity->setStock(67);
	    $entity->setCode('777');
	    $entity->setPrice(99.22);
	    $entity->setUnit($unit_1);
	    $entity->setBrand($brand_1);
	    $entity->setModel('SWE-876');
	    $entity->setName('Producto 7');
	    $entity->setDescriptionShort('Lorem ipsum dolor sit amet conse ctetuar adipisicing elit');
	    $entity->setDescriptionLong('<p><b>Car owners</b> know the real value of choosing quality wheels and tyres. Even if you have the most powerful engine, the next generation power transmission system and premium super-trick suspension.</p><p><b>We keep track</b> of the latest web design trends and try hard to keep our estore up-to-date and modern. It is designed in such a way that nothing will distract you from the items worth your attention.</p>');
	    $entity->setCategory($category_2);
        $manager->persist($entity);
        $this->addReference('product-7', $entity);
        
        $entity = new Product();
	    $entity->setColor('#FF0000');
	    $entity->setStock(25);
	    $entity->setCode('888');
	    $entity->setPrice(77.88);
	    $entity->setUnit($unit_1);
	    $entity->setBrand($brand_1);
	    $entity->setModel('xsd-8643');
	    $entity->setName('Producto 8');
	    $entity->setDescriptionShort('Lorem ipsum dolor sit amet conse ctetuar adipisicing elit');
	    $entity->setDescriptionLong('<p><b>Car owners</b> know the real value of choosing quality wheels and tyres. Even if you have the most powerful engine, the next generation power transmission system and premium super-trick suspension.</p><p><b>We keep track</b> of the latest web design trends and try hard to keep our estore up-to-date and modern. It is designed in such a way that nothing will distract you from the items worth your attention.</p>');
	    $entity->setIsFeatured(true);
	    $entity->setCategory($category_2);
        $manager->persist($entity);
        $this->addReference('product-8', $entity);
        
        $entity = new Product();
	    $entity->setColor('#0000FF');
	    $entity->setStock(98);
	    $entity->setCode('999');
	    $entity->setPrice(41.66);
	    $entity->setUnit($unit_1);
	    $entity->setBrand($brand_1);
	    $entity->setModel('SWE-543');
	    $entity->setName('Producto 9');
	    $entity->setDescriptionShort('Lorem ipsum dolor sit amet conse ctetuar adipisicing elit');
	    $entity->setDescriptionLong('<p><b>Car owners</b> know the real value of choosing quality wheels and tyres. Even if you have the most powerful engine, the next generation power transmission system and premium super-trick suspension.</p><p><b>We keep track</b> of the latest web design trends and try hard to keep our estore up-to-date and modern. It is designed in such a way that nothing will distract you from the items worth your attention.</p>');
	    $entity->setIsFeatured(true);
	    $entity->setCategory($category_2);
        $manager->persist($entity);
        $this->addReference('product-9', $entity);
	
	
	    /**
	     * CATEGORY 3
	     */
        $entity = new Product();
	    $entity->setColor('#FF0000');
	    $entity->setStock(78);
	    $entity->setCode('1010');
	    $entity->setPrice(67.55);
	    $entity->setUnit($unit_1);
	    $entity->setBrand($brand_1);
	    $entity->setModel('AWS-543');
	    $entity->setName('Producto 10');
	    $entity->setDescriptionShort('Lorem ipsum dolor sit amet conse ctetuar adipisicing elit');
	    $entity->setDescriptionLong('<p><b>Car owners</b> know the real value of choosing quality wheels and tyres. Even if you have the most powerful engine, the next generation power transmission system and premium super-trick suspension.</p><p><b>We keep track</b> of the latest web design trends and try hard to keep our estore up-to-date and modern. It is designed in such a way that nothing will distract you from the items worth your attention.</p>');
	    $entity->setCategory($category_3);
        $manager->persist($entity);
        $this->addReference('product-10', $entity);
        
        $entity = new Product();
	    $entity->setColor('#0000FF');
	    $entity->setStock(34);
	    $entity->setCode('1111');
	    $entity->setPrice(45.22);
	    $entity->setUnit($unit_1);
	    $entity->setBrand($brand_1);
	    $entity->setModel('YTR-984');
	    $entity->setName('Producto 11');
	    $entity->setDescriptionShort('Lorem ipsum dolor sit amet conse ctetuar adipisicing elit');
	    $entity->setDescriptionLong('<p><b>Car owners</b> know the real value of choosing quality wheels and tyres. Even if you have the most powerful engine, the next generation power transmission system and premium super-trick suspension.</p><p><b>We keep track</b> of the latest web design trends and try hard to keep our estore up-to-date and modern. It is designed in such a way that nothing will distract you from the items worth your attention.</p>');
	    $entity->setIsFeatured(true);
	    $entity->setCategory($category_3);
        $manager->persist($entity);
        $this->addReference('product-11', $entity);
        
        $entity = new Product();
	    $entity->setColor('#0000FF');
	    $entity->setStock(34);
	    $entity->setCode('1111');
	    $entity->setPrice(12.22);
	    $entity->setUnit($unit_1);
	    $entity->setBrand($brand_1);
	    $entity->setModel('DR-6537');
	    $entity->setName('Producto 12');
	    $entity->setDescriptionShort('Lorem ipsum dolor sit amet conse ctetuar adipisicing elit');
	    $entity->setDescriptionLong('<p><b>Car owners</b> know the real value of choosing quality wheels and tyres. Even if you have the most powerful engine, the next generation power transmission system and premium super-trick suspension.</p><p><b>We keep track</b> of the latest web design trends and try hard to keep our estore up-to-date and modern. It is designed in such a way that nothing will distract you from the items worth your attention.</p>');
	    $entity->setIsFeatured(true);
	    $entity->setCategory($category_3);
        $manager->persist($entity);
        $this->addReference('product-12', $entity);
        
        $entity = new Product();
	    $entity->setColor('#0000FF');
	    $entity->setStock(66);
	    $entity->setCode('1111');
	    $entity->setPrice(77.22);
	    $entity->setUnit($unit_1);
	    $entity->setBrand($brand_1);
	    $entity->setModel('FG-765');
	    $entity->setName('Producto 13');
	    $entity->setDescriptionShort('Lorem ipsum dolor sit amet conse ctetuar adipisicing elit');
	    $entity->setDescriptionLong('<p><b>Car owners</b> know the real value of choosing quality wheels and tyres. Even if you have the most powerful engine, the next generation power transmission system and premium super-trick suspension.</p><p><b>We keep track</b> of the latest web design trends and try hard to keep our estore up-to-date and modern. It is designed in such a way that nothing will distract you from the items worth your attention.</p>');
	    $entity->setIsFeatured(true);
	    $entity->setCategory($category_3);
        $manager->persist($entity);
        $this->addReference('product-13', $entity);
        
        $entity = new Product();
	    $entity->setColor('#0000FF');
	    $entity->setStock(99);
	    $entity->setCode('1111');
	    $entity->setPrice(77.22);
	    $entity->setUnit($unit_1);
	    $entity->setBrand($brand_1);
	    $entity->setModel('DF-768');
	    $entity->setName('Producto 14');
	    $entity->setDescriptionShort('Lorem ipsum dolor sit amet conse ctetuar adipisicing elit');
	    $entity->setDescriptionLong('<p><b>Car owners</b> know the real value of choosing quality wheels and tyres. Even if you have the most powerful engine, the next generation power transmission system and premium super-trick suspension.</p><p><b>We keep track</b> of the latest web design trends and try hard to keep our estore up-to-date and modern. It is designed in such a way that nothing will distract you from the items worth your attention.</p>');
	    $entity->setIsFeatured(false);
	    $entity->setCategory($category_3);
        $manager->persist($entity);
        $this->addReference('product-14', $entity);
        
        $entity = new Product();
	    $entity->setColor('#00FF00');
	    $entity->setStock(88);
	    $entity->setCode('1212');
	    $entity->setPrice(55.33);
	    $entity->setUnit($unit_1);
	    $entity->setBrand($brand_1);
	    $entity->setModel('SWE-345');
	    $entity->setName('Producto 15');
	    $entity->setDescriptionShort('Lorem ipsum dolor sit amet conse ctetuar adipisicing elit');
	    $entity->setDescriptionLong('<p><b>Car owners</b> know the real value of choosing quality wheels and tyres. Even if you have the most powerful engine, the next generation power transmission system and premium super-trick suspension.</p><p><b>We keep track</b> of the latest web design trends and try hard to keep our estore up-to-date and modern. It is designed in such a way that nothing will distract you from the items worth your attention.</p>');
	    $entity->setCategory($category_3);
        $manager->persist($entity);
        $this->addReference('product-15', $entity);

        
        
        $manager->flush();

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 19;
    }
}