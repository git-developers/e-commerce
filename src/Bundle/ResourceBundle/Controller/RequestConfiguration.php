<?php

declare(strict_types=1);

namespace Bundle\ResourceBundle\Controller;

use Component\Resource\Metadata\MetadataInterface;
use Bundle\GridBundle\Services\Grid\Builder\DataTableMapper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PropertyAccess\PropertyAccess;

class RequestConfiguration
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var MetadataInterface
     */
    private $metadata;

    /**
     * @var Parameters
     */
    private $parameters;

    /**
     * @param MetadataInterface $metadata
     * @param Request $request
     * @param Parameters $parameters
     */
//    public function __construct(Request $request, Parameters $parameters)
//    {
////        $this->metadata = $metadata;
//        $this->request = $request;
//        $this->parameters = $parameters;
//    }
    public function __construct(MetadataInterface $metadata, Request $request, Parameters $parameters)
    {
        $this->metadata = $metadata;
        $this->request = $request;
        $this->parameters = $parameters;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return MetadataInterface
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @return Parameters
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return string|null
     */
    public function getSection()
    {
        return $this->parameters->get('section');
    }

    /**
     * @return bool
     */
    public function isHtmlRequest()
    {
        return 'html' === $this->request->getRequestFormat();
    }

    /**
     * @param $name
     *
     * @return string|null
     */
    public function getDefaultTemplate($name)
    {
        $templatesNamespace = (string) $this->metadata->getTemplatesNamespace();

        if (false !== strpos($templatesNamespace, ':')) {
            return sprintf('%s:%s.%s', $templatesNamespace ?: ':', $name, 'twig');
        }

        return sprintf('%s/%s.%s', $templatesNamespace, $name, 'twig');
    }

    /**
     * @param $name
     *
     * @return mixed|null
     */
    public function getTemplate($name)
    {
        $template = $this->parameters->get('template', $this->getDefaultTemplate($name));

        if (null === $template) {
            throw new \RuntimeException(sprintf('Could not resolve template for resource "%s".', $this->metadata->getAlias()));
        }

        return $template;
    }

//    JAFETH
    public function getEntity()
    {
        if (!$this->parameters->has('entity')) {
            return null;
        }

        return $this->parameters->get('entity');
    }


    /**
     * @return string|null
     */
    public function getFormType()
    {
        $form = $this->parameters->get('form');
        if (isset($form['type'])) {
            return $form['type'];
        }

        if (is_string($form)) {
            return $form;
        }

        $form = $this->metadata->getClass('form');
        if (is_string($form)) {
            return $form;
        }

        return sprintf('%s_%s', $this->metadata->getApplicationName(), $this->metadata->getName());
    }

    /**
     * @return array
     */
    public function getFormOptions()
    {
        $form = $this->parameters->get('form');
        if (isset($form['options'])) {
            return $form['options'];
        }

        return [];
    }

    /**
     * @param $name
     *
     * @return string
     */
    public function getRouteName($name)
    {
        $sectionPrefix = $this->getSection() ? $this->getSection() . '_' : '';

        return sprintf('%s_%s%s_%s', $this->metadata->getApplicationName(), $sectionPrefix, $this->metadata->getName(), $name);
    }

    /**
     * @param $name
     *
     * @return mixed|string|null
     */
    public function getRedirectRoute($name)
    {
        $redirect = $this->parameters->get('redirect');

        if (null === $redirect) {
            return $this->getRouteName($name);
        }

        if (is_array($redirect)) {
            if (!empty($redirect['referer'])) {
                return 'referer';
            }

            return $redirect['route'];
        }

        return $redirect;
    }

    /**
     * Get url hash fragment (#text) which is you configured.
     *
     * @return string
     */
    public function getRedirectHash()
    {
        $redirect = $this->parameters->get('redirect');

        if (!is_array($redirect) || empty($redirect['hash'])) {
            return '';
        }

        return '#' . $redirect['hash'];
    }

    /**
     * Get redirect referer, This will detected by configuration
     * If not exists, The `referrer` from headers will be used.
     *
     * @return string
     */
    public function getRedirectReferer()
    {
        $redirect = $this->parameters->get('redirect');
        $referer = $this->request->headers->get('referer');

        if (!is_array($redirect) || empty($redirect['referer'])) {
            return $referer;
        }

        if ($redirect['referer'] === true) {
            return $referer;
        }

        return $redirect['referer'];
    }

    /**
     * @param object|null $resource
     *
     * @return array
     */
    public function getRedirectParameters($resource = null)
    {
        $redirect = $this->parameters->get('redirect');

        if ($this->areParametersIntentionallyEmptyArray($redirect)) {
            return [];
        }

        if (!is_array($redirect)) {
            $redirect = ['parameters' => []];
        }

        $parameters = $redirect['parameters'] ?? [];
        $parameters = $this->addExtraRedirectParameters($parameters);

        if (null !== $resource) {
            $parameters = $this->parseResourceValues($parameters, $resource);
        }

        return $parameters;
    }

    /**
     * @param array $parameters
     *
     * @return array
     */
    private function addExtraRedirectParameters($parameters)
    {
        $vars = $this->getVars();
        $accessor = PropertyAccess::createPropertyAccessor();

        if ($accessor->isReadable($vars, '[redirect][parameters]')) {
            $extraParameters = $accessor->getValue($vars, '[redirect][parameters]');

            if (is_array($extraParameters)) {
                $parameters = array_merge($parameters, $extraParameters);
            }
        }

        return $parameters;
    }

    /**
     * @return bool
     */
    public function isLimited()
    {
        return (bool) $this->parameters->get('limit', false);
    }

    /**
     * @return int|null
     */
    public function getLimit()
    {
        $limit = null;

        if ($this->isLimited()) {
            $limit = (int) $this->parameters->get('limit', 10);
        }

        return $limit;
    }

    /**
     * @return bool
     */
    public function isPaginated()
    {
        $pagination = $this->parameters->get('paginate', true);

        return $pagination !== false && $pagination !== null;
    }

    /**
     * @return int
     */
    public function getPaginationMaxPerPage()
    {
        return (int) $this->parameters->get('paginate', 10);
    }

    /**
     * @return bool
     */
    public function isFilterable()
    {
        return (bool) $this->parameters->get('filterable', false);
    }

    /**
     * @param array $criteria
     *
     * @return array
     */
    public function getCriteria(array $criteria = [])
    {
        $defaultCriteria = array_merge($this->parameters->get('criteria', []), $criteria);

        if ($this->isFilterable()) {
            return $this->getRequestParameter('criteria', $defaultCriteria);
        }

        return $defaultCriteria;
    }

    /**
     * @return bool
     */
    public function isSortable()
    {
        return (bool) $this->parameters->get('sortable', false);
    }

    /**
     * @param array $sorting
     *
     * @return array
     */
    public function getSorting(array $sorting = [])
    {
        $defaultSorting = array_merge($this->parameters->get('sorting', []), $sorting);

        if ($this->isSortable()) {
            $sorting = $this->getRequestParameter('sorting');
            foreach ($defaultSorting as $key => $value) {
                if (!isset($sorting[$key])) {
                    $sorting[$key] = $value;
                }
            }

            return $sorting;
        }

        return $defaultSorting;
    }

    /**
     * @param $parameter
     * @param array $defaults
     *
     * @return array
     */
    public function getRequestParameter($parameter, $defaults = [])
    {
        return array_replace_recursive(
            $defaults,
            $this->request->get($parameter, [])
        );
    }

    /**
     * @return string|null
     */
    public function getRepositoryMethod()
    {
        if (!$this->parameters->has('repository')) {
            return null;
        }

        $repository = $this->parameters->get('repository');

        return is_array($repository) ? $repository['method'] : $repository;
    }
    
    public function getRolesAllow()
    {
        if (!$this->parameters->has('roles_allow')) {
            return null;
        }

        $roles = $this->parameters->get('roles_allow');

        return is_array($roles) ? $roles : [];
    }

    public function getRepositoryMethodOne()
    {
        if (!$this->parameters->has('repository')) {
            return null;
        }

        $repository = $this->parameters->get('repository');

        return is_array($repository) ? $repository['box_one']['method'] : $repository;
    }

    public function getRepositoryMethodTwo()
    {
        if (!$this->parameters->has('repository')) {
            return null;
        }

        $repository = $this->parameters->get('repository');

        return is_array($repository) ? $repository['box_two']['method'] : $repository;
    }

    public function getRepositoryMethodThree()
    {
        if (!$this->parameters->has('repository')) {
            return null;
        }

        $repository = $this->parameters->get('repository');

        return is_array($repository) ? $repository['box_three']['method'] : $repository;
    }

    public function getRepositoryMethodFour()
    {
        if (!$this->parameters->has('repository')) {
            return null;
        }

        $repository = $this->parameters->get('repository');

        return is_array($repository) ? $repository['box_four']['method'] : $repository;
    }

    public function getRepositoryService()
    {
        if (!$this->parameters->has('repository')) {
            return null;
        }

        $repository = $this->parameters->get('repository');

        return is_array($repository) ? $repository['service'] : $repository;
    }

    public function getRepositoryServiceOne()
    {
        if (!$this->parameters->has('repository')) {
            return null;
        }

        $repository = $this->parameters->get('repository');

        return is_array($repository) ? $repository['box_one']['service'] : $repository;
    }

    public function getRepositoryServiceTwo()
    {
        if (!$this->parameters->has('repository')) {
            return null;
        }

        $repository = $this->parameters->get('repository');

        return is_array($repository) ? $repository['box_two']['service'] : $repository;
    }

    public function getRepositoryServiceThree()
    {
        if (!$this->parameters->has('repository')) {
            return null;
        }

        $repository = $this->parameters->get('repository');

        return is_array($repository) ? $repository['box_three']['service'] : $repository;
    }

    public function getRepositoryServiceFour()
    {
        if (!$this->parameters->has('repository')) {
            return null;
        }

        $repository = $this->parameters->get('repository');

        return is_array($repository) ? $repository['box_four']['service'] : $repository;
    }

//    public function hasOneToMany($key)
//    {
//        if($this->parameters->has('one_to_many')){
//            $oneToMany = $this->parameters->get('one_to_many');
//            return array_key_exists($key, $oneToMany);
//        }
//    }

    /**
     * @return array
     */
    public function getRepositoryArguments()
    {
        if (!$this->parameters->has('repository')) {
            return [];
        }

        $repository = $this->parameters->get('repository');

        if (!isset($repository['arguments'])) {
            return [];
        }

        return is_array($repository['arguments']) ? $repository['arguments'] : [$repository['arguments']];
    }

    /**
     * @return string|null
     */
    public function getFactoryMethod()
    {
        if (!$this->parameters->has('factory')) {
            return null;
        }

        $factory = $this->parameters->get('factory');

        return is_array($factory) ? $factory['method'] : $factory;
    }

    public function getAction()
    {
        if (!$this->parameters->has('action')) {
            return null;
        }

        return $this->parameters->get('action');
    }

    /**
     * @return array
     */
    public function getFactoryArguments()
    {
        if (!$this->parameters->has('factory')) {
            return [];
        }

        $factory = $this->parameters->get('factory');

        if (!isset($factory['arguments'])) {
            return [];
        }

        return is_array($factory['arguments']) ? $factory['arguments'] : [$factory['arguments']];
    }

    /**
     * @param null $message
     *
     * @return mixed|null
     */
    public function getFlashMessage($message)
    {
        return $this->parameters->get('flash', sprintf('%s.%s.%s', $this->metadata->getApplicationName(), $this->metadata->getName(), $message));
    }

    /**
     * @return mixed|null
     */
    public function getSortablePosition()
    {
        return $this->parameters->get('sortable_position', 'position');
    }

    /**
     * @return mixed|null
     */
    public function getSerializationGroups()
    {
        return $this->parameters->get('serialization_groups', []);
    }

    /**
     * @return mixed|null
     */
    public function getSerializationVersion()
    {
        return $this->parameters->get('serialization_version');
    }

    /**
     * @return string|null
     */
    public function getEvent()
    {
        return $this->parameters->get('event');
    }

    /**
     * @return bool
     */
    public function hasPermission()
    {
        return false !== $this->parameters->get('permission', false);
    }

    /**
     * @param string $name
     *
     * @return string
     *
     * @throws \LogicException
     */
    public function getPermission($name)
    {
        $permission = $this->parameters->get('permission');

        if (null === $permission) {
            throw new \LogicException('Current action does not require any authorization.');
        }

        if (true === $permission) {
            return sprintf('%s.%s.%s', $this->metadata->getApplicationName(), $this->metadata->getName(), $name);
        }

        return $permission;
    }

    /**
     * @return bool
     */
    public function isHeaderRedirection()
    {
        $redirect = $this->parameters->get('redirect');

        if (!is_array($redirect) || !isset($redirect['header'])) {
            return false;
        }

        if ('xhr' === $redirect['header']) {
            return $this->getRequest()->isXmlHttpRequest();
        }

        return (bool) $redirect['header'];
    }

    public function getVars()
    {
        $vars = $this->parameters->get('vars', []);
        return json_decode(json_encode($vars));
    }

    public function getRepositoryVars()
    {
        if (!$this->parameters->has('repository')) {
            return null;
        }

        $repository = array_replace([
            'vars' => null
        ], $this->parameters->get('repository'));

        $repository = json_decode(json_encode($repository));

        return $repository->vars;
    }

    public function getRepositoryVarsOne()
    {
        if (!$this->parameters->has('repository')) {
            return null;
        }

        $repository = $this->parameters->get('repository');
        $repository = json_decode(json_encode($repository));

        return is_object($repository) ? $repository->box_one->vars : $repository;
    }

    public function getRepositoryVarsTwo()
    {
        if (!$this->parameters->has('repository')) {
            return null;
        }

        $repository = $this->parameters->get('repository');
        $repository = json_decode(json_encode($repository));

        return is_object($repository) ? $repository->box_two->vars : $repository;
    }

    public function getRepositoryVarsThree()
    {
        if (!$this->parameters->has('repository')) {
            return null;
        }

        $repository = $this->parameters->get('repository');
        $repository = json_decode(json_encode($repository));

        return is_object($repository) ? $repository->box_three->vars : $repository;
    }

    /**
     * @param array  $parameters
     * @param object $resource
     *
     * @return array
     */
    private function parseResourceValues(array $parameters, $resource)
    {
        $accessor = PropertyAccess::createPropertyAccessor();

        if (empty($parameters)) {
            return ['id' => $accessor->getValue($resource, 'id')];
        }

        foreach ($parameters as $key => $value) {
            if (is_array($value)) {
                $parameters[$key] = $this->parseResourceValues($value, $resource);
            }

            if (is_string($value) && 0 === strpos($value, 'resource.')) {
                $parameters[$key] = $accessor->getValue($resource, substr($value, 9));
            }
        }

        return $parameters;
    }

    /**
     * @return bool
     */
    public function hasGrid()
    {
        return $this->parameters->has('grid');
    }

    /**
     * @return bool
     */
    public function hasTree()
    {
        return $this->parameters->has('tree');
    }

    /**
     * @return bool
     */
    public function hasOneToMany($key)
    {
        if($this->parameters->has('one_to_many')){
            $oneToMany = $this->parameters->get('one_to_many');
            return array_key_exists($key, $oneToMany);
        }

        return false;
    }

    /**
     * @return bool
     */
    public function hasTreeOneToMany($key)
    {
        if($this->parameters->has('tree_one_to_many')){
            $oneToMany = $this->parameters->get('tree_one_to_many');
            return array_key_exists($key, $oneToMany);
        }

        return false;
    }

    /**
     * @return string
     *
     * @throws \LogicException
     */
    public function getGrid()
    {
        if (!$this->hasGrid()) {
            throw new \LogicException('Current action does not use grid.');
        }

        return $this->parameters->get('grid');
    }

    public function getModal()
    {
        if (!$this->hasGrid()) {
            throw new \LogicException('Modal:: Current action does not use grid.');
        }

        $grid = $this->parameters->get('grid');

        if (!isset($grid['modal'])) {
            return [];
        }

        return $grid['modal'];
    }

    public function getTree()
    {
        if (!$this->hasTree()) {
            throw new \LogicException('Current action does not use tree.');
        }

        return $this->parameters->get('tree');
    }

    public function oneToManyBox()
    {
        if (!$this->hasOneToMany('box')) {
            throw new \LogicException('Current action does not use: oneToManyBox.');
        }

        return $this->parameters->getChild('one_to_many', 'box');
    }

    public function treeOneToManyBox()
    {
        if (!$this->hasTreeOneToMany('box')) {
            throw new \LogicException('Current action does not use: treeOneToManyBox.');
        }

        return $this->parameters->getChild('tree_one_to_many', 'box');
    }

    public function treeOneToManyBoxLeft()
    {
        if (!$this->hasTreeOneToMany('box_left')) {
            throw new \LogicException('Current action does not use: treeOneToManyBoxLeft.');
        }

        return $this->parameters->getChild('tree_one_to_many', 'box_left');
    }

    public function oneToManyBoxLeft()
    {
        if (!$this->hasOneToMany('box_left')) {
            throw new \LogicException('Current action does not use: oneToManyBoxLeft.');
        }

        return $this->parameters->getChild('one_to_many', 'box_left');
    }

    public function oneToManyBoxRight()
    {
        if (!$this->hasOneToMany('box_right')) {
            throw new \LogicException('Current action does not use: oneToManyBoxRight.');
        }

        return (object) $this->parameters->getChild('one_to_many', 'box_right');
    }

    public function treeOneToManyBoxRight()
    {
        if (!$this->hasTreeOneToMany('box_right')) {
            throw new \LogicException('Current action does not use: treeOneToManyBoxRight.');
        }

        return (object) $this->parameters->getChild('tree_one_to_many', 'box_right');
    }

    public function getGridDataTable(string $key = null)
    {
        if (!$this->hasGrid()) {
            throw new \LogicException('Current action does not use grid.');
        }

        $grid = $this->parameters->get('grid');

        if (!isset($grid[DataTableMapper::DATATABLE])) {
            return [];
        }

        return is_array($grid[DataTableMapper::DATATABLE][$key]) ?
            $grid[DataTableMapper::DATATABLE][$key] : [$grid[DataTableMapper::DATATABLE][$key]];
    }

    /**
     * @return bool
     */
    public function hasStateMachine()
    {
        return $this->parameters->has('state_machine');
    }

    /**
     * @return string
     */
    public function getStateMachineGraph()
    {
        $options = $this->parameters->get('state_machine');

        return $options['graph'] ?? null;
    }

    /**
     * @return string
     */
    public function getStateMachineTransition()
    {
        $options = $this->parameters->get('state_machine');

        return $options['transition'] ?? null;
    }

    /**
     * @return bool
     */
    public function isCsrfProtectionEnabled()
    {
        return $this->parameters->get('csrf_protection', true);
    }

    /**
     * @param mixed $redirect
     *
     * @return bool
     */
    private function areParametersIntentionallyEmptyArray($redirect)
    {
        return isset($redirect['parameters']) && is_array($redirect['parameters']) && empty($redirect['parameters']);
    }
	
	public function getFilesUploadService()
	{
		if (!$this->parameters->has('files_upload')) {
			return null;
		}
		
		$filesUpload = $this->parameters->get('files_upload');
		return json_decode(json_encode($filesUpload));
	}
}
