<?php

declare(strict_types=1);

namespace Bundle\PagesBundle\Controller;

use Webmozart\Assert\Assert;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Bundle\CoreBundle\Controller\BaseController;

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
		
		return $this->render($template, [
			'products' => null,
			'vars' => $vars,
		]);
	}
	
	/**
	 * @param Request $request
	 * @return Response
	 */
	public function aboutUsAction(Request $request): Response
	{
		$options = $request->attributes->get('_tianos');
		
		$template = $options['template'] ?? null;
		$vars = $options['vars'] ?? null;
		Assert::notNull($template, 'Template is not configured.');
		
		return $this->render($template, [
			'products' => null,
			'vars' => $vars,
		]);
	}

}
