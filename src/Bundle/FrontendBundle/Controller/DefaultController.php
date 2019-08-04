<?php

declare(strict_types=1);

namespace Bundle\FrontendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;

class DefaultController extends BaseController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request): Response
    {
        $options = $request->attributes->get('_tianos');

        $template = $options['template'] ?? null;
        $vars = $options['vars'] ?? null;
        Assert::notNull($template, 'Template is not configured.');
	
	    /**
	     * PRODUCTS
	     */
	    $products = $this->get('tianos.repository.product')->findFeatured();
	    $products = $this->rowImages($products);
	    $products = $this->getSerializeDecode($products, 'frontend');
	
	    /**
	     * CATEGORIES
	     */
	    $categoryTree = $this->get('tianos.repository.category')->findAllParents();
	    $categoryTree = $this->getTreeEntities($categoryTree, 'tree');
	
	
//	    echo "POLLO:: <pre>";
//	    print_r($categoryTree);
//	    exit;
	    
        
        return $this->render($template, [
            'products' => $products,
            'categoryTree' => $categoryTree,
            'vars' => $vars,
        ]);

//        return $this->render('default/index.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
//        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function contactUsFacebookAction(Request $request): Response
    {
        header('Location: https://www.facebook.com/Apptianos');
        die();
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function contactUsTwitterAction(Request $request): Response
    {
        header('Location: https://twitter.com/tianosApp');
        die();
    }
	
	private function getTreeEntities($parents, $serializeGroupName)
	{
		if(is_null($parents)){
			$parents = [];
		}
		
		$entity = [];
		foreach ($parents as $key => $parent) {
			$entity[$key]['parent'] = $this->getSerializeDecode($parent, $serializeGroupName);
			$children = $this->get('tianos.repository.category')->findAllByParent($parent);
			$entity[$key]['children'] = $this->getTreeEntities($children, $serializeGroupName);
		}
		
		return $entity;
	}
}
