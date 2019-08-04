<?php

declare(strict_types=1);

namespace Bundle\CategoryBundle\Twig;

use Bundle\CategoryBundle\Templating\Helper\CategoryHelper;
use Twig_Environment;

final class CategoryExtension extends \Twig_Extension
{
    /**
     * @var CategoryHelper
     */
    private $userHelper;

    /**
     * @param CategoryHelper $userHelper
     */
    public function __construct(CategoryHelper $userHelper)
    {
        $this->categoryHelper = $userHelper;
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
