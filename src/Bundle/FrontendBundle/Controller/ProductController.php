<?php

declare(strict_types=1);

namespace Bundle\FrontendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Bundle\CoreBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;

class ProductController extends BaseController
{

    /**
     * @param Request $request
     * @return Response
     */
    public function detailAction(Request $request, $slug): Response
    {
        $options = $request->attributes->get('_tianos');

        $template = $options['template'] ?? null;
        $vars = $options['vars'] ?? null;
        Assert::notNull($template, 'Template is not configured.');
	
        
	    $product = $this->get('tianos.repository.product')->findBySlug($slug);
	    $product = $this->rowImage($product);
//	    $products = $this->getSerializeDecode($products, 'frontend');
	
//	    echo "POLLO:: <pre>";
//	    print_r($products);
//	    exit;
        
        
        return $this->render($template, [
            'product' => $product,
            'vars' => $vars,
        ]);
    }

}
