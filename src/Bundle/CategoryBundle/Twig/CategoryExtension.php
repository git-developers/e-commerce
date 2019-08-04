<?php

declare(strict_types=1);

namespace Bundle\CategoryBundle\Twig;

use Bundle\CategoryBundle\Templating\Helper\CategoryHelper;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig_Environment;

final class CategoryExtension extends \Twig_Extension
{
	/**
	 * @var ContainerInterface
	 */
	private $container;
	
    /**
     * @var CategoryHelper
     */
    private $categoryHelper;

    /**
     * @param CategoryHelper $userHelper
     */
//    public function __construct(CategoryHelper $categoryHelper, ContainerInterface $container)
    public function __construct(CategoryHelper $categoryHelper)
    {
        $this->categoryHelper = $categoryHelper;
//        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction('tianos_category_tree', [$this->categoryHelper, 'tianosCategoryTree'], ['is_safe' => ['html']]),
        ];
    }

    public function initRuntime(Twig_Environment $environment)
    {
        // TODO: Implement initRuntime() method.
    }

    public function getGlobals()
    {
        // TODO: Implement getGlobals() method.
    }

    public function getName()
    {
        // TODO: Implement getName() method.
    }
}
