<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Category\Renderer;

use Bundle\CoreBundle\Services\Button;
use Bundle\ResourceBundle\User\Parser\OptionsParserInterface;
use Component\Grid\Definition\Action;
use Component\Grid\Definition\Field;
use Component\Grid\Definition\Filter;
use Component\Category\Renderer\CategoryRendererInterface;
use Component\Grid\View\GridViewInterface;
use Bundle\GridBundle\Services\Grid\Builder\DataTableMapper;
use Bundle\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class TwigCategoryRenderer implements CategoryRendererInterface
{
    /**
     * @var GridRendererInterface
     */
    private $gridRenderer;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var OptionsParserInterface
     */
    private $optionsParser;

    /**
     * @var array
     */
    private $actionTemplates;

    /**
     * @param GridRendererInterface $gridRenderer
     * @param \Twig_Environment $twig
     * @param OptionsParserInterface $optionsParser
     * @param array $actionTemplates
     */
    public function __construct(
        CategoryRendererInterface $gridRenderer,
        \Twig_Environment $twig,
        OptionsParserInterface $optionsParser,
        array $actionTemplates = []
    ) {
        $this->gridRenderer = $gridRenderer;
        $this->twig = $twig;
        $this->optionsParser = $optionsParser;
        $this->actionTemplates = $actionTemplates;
    }
	
	//JAFETH
	public function tianosCategoryTree($length = null)
	{
		
		return "88888888";
	}
}
