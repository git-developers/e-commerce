<?php

declare(strict_types=1);

namespace Bundle\CategoryBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Component\Resource\Metadata\Metadata;
use Bundle\ResourceBundle\ResourceBundle;
use Bundle\CoreBundle\Controller\BaseController;
use Webmozart\Assert\Assert;

class FrontendController extends BaseController
{

//    public function __construct() {
////        parent::__construct($requestConfigurationFactory);
//    }

    public function indexAction(Request $request): Response
    {
        $parameters = [
            'driver' => ResourceBundle::DRIVER_DOCTRINE_ORM,
        ];
        $applicationName = $this->container->getParameter('application_name');
        $this->metadata = new Metadata('tianos', $applicationName, $parameters);
//        $this->metadata = new Metadata('product', $applicationName, $parameters);

        $configuration = $this->get('tianos.resource.configuration.factory')->create($this->metadata, $request);
        $service = $configuration->getRepositoryService();
        $method = $configuration->getRepositoryMethod();

        $repository = $this->get($service);
        $products = $repository->$method();

        $products = $this->getSerialize($products, 'product');

        return $this->render(
            'CategoryBundle:CategoryFrontend:index.html.twig',
            [
                'products' => $products,
            ]
        );
    }
	
	
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
		
		
		$category = $this->get('tianos.repository.category')->findBySlug($slug);

//	    echo "POLLO:: <pre>";
//	    print_r($products);
//	    exit;
		
		
		return $this->render($template, [
			'category' => $category,
			'vars' => $vars,
		]);
	}
}
