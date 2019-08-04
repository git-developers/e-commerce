<?php

declare(strict_types=1);

namespace Bundle\CategoryBundle\Templating\Helper;

use Component\Grid\Definition\Action;
use Component\Grid\Definition\Field;
use Component\Grid\Definition\Filter;
use Component\Category\Renderer\CategoryRendererInterface;
use Component\Grid\View\GridView;
use Symfony\Component\Templating\Helper\Helper;
use Bundle\UserBundle\Entity\User;

class CategoryHelper extends Helper
{
    /**
     * @var UserRendererInterface
     */
    private $userRenderer;

    /**
     * @param UserRendererInterface $userRenderer
     */
    public function __construct(UserRendererInterface $userRenderer)
    {
        $this->userRenderer = $userRenderer;
    }

    // JAFETH
    public function tianosCategoryTree(User $user, $start, $length = null)
    {
        

        return "xxxxxxxxxxxx";
    }
	
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'sylius_grid';
    }
}
