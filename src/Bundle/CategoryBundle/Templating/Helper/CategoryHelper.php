<?php

declare(strict_types=1);

namespace Bundle\CategoryBundle\Templating\Helper;

use Component\Grid\Definition\Action;
use Component\Grid\Definition\Field;
use Component\Grid\Definition\Filter;
use Component\Category\Renderer\CategoryRendererInterface;
use Component\Grid\View\GridView;
use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\DependencyInjection\ContainerInterface;
use JMS\Serializer\SerializationContext;

class CategoryHelper extends Helper
{
	
	/**
	 * @var \Twig_Environment
	 */
	private $twig;
	
	
	/**
	 * @var ContainerInterface
	 */
	private $container;
	
    /**
     * @var UserRendererInterface
     */
    private $userRenderer;

    /**
     * @param UserRendererInterface $userRenderer
     */
    public function __construct(
    	CategoryRendererInterface $userRenderer,
	    ContainerInterface $container,
	    \Twig_Environment $twig
    )
    {
	    $this->twig = $twig;
	    $this->container = $container;
	    $this->userRenderer = $userRenderer;
    }

    // JAFETH
    public function tianosCategoryTree($length = null)
    {
	    /**
	     * CATEGORIES
	     */
	    $categoryTree = $this->container->get('tianos.repository.category')->findAllParents();
	    $categoryTree = $this->getTreeEntities($categoryTree, 'tree');
	
	    return $this->twig->render('ThemesBundle:Default:categories.html.twig',
		    [
		    	'categoryTree' => $categoryTree
		    ]
	    );
    }
	
	private function getTreeEntities($parents, $serializeGroupName)
	{
		if(is_null($parents)){
			$parents = [];
		}
		
		$entity = [];
		foreach ($parents as $key => $parent) {
			$entity[$key]['parent'] = $this->getSerializeDecode($parent, $serializeGroupName);
			$children = $this->container->get('tianos.repository.category')->findAllByParent($parent);
			$entity[$key]['children'] = $this->getTreeEntities($children, $serializeGroupName);
		}
		
		return $entity;
	}
	
	protected function getSerializeDecode($object, $groupName)
	{
		$objects = $this->getSerialize($object, $groupName);
		return json_decode($objects, true);
	}
	
	protected function getSerialize($object, $groupName)
	{
		$serializer = $this->container->get('jms_serializer');
		
		return $serializer->serialize(
			$object,
			'json',
			SerializationContext::create()->setSerializeNull(true)->setGroups([$groupName])
		);
	}
	
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'sylius_grid';
    }
}
