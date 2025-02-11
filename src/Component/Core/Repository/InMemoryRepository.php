<?php

declare(strict_types=1);

namespace Component\Resource\Repository;

use ArrayObject;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Component\Resource\Exception\UnexpectedTypeException;
use Component\Resource\Exception\UnsupportedMethodException;
use Component\Resource\Model\ResourceInterface;
use Component\Resource\Repository\Exception\ExistingResourceException;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class InMemoryRepository implements RepositoryInterface
{
    /**
     * @var PropertyAccessor
     */
    protected $accessor;

    /**
     * @var ArrayObject
     */
    protected $arrayObject;

    /**
     * @var string
     */
    protected $interface;

    /**
     * @param string $interface | Fully qualified name of the interface.
     *
     * @throws \InvalidArgumentException
     * @throws UnexpectedTypeException
     */
    public function __construct(string $interface)
    {
        if (!in_array(ResourceInterface::class, class_implements($interface), true)) {
            throw new UnexpectedTypeException($interface, ResourceInterface::class);
        }

        $this->interface = $interface;
        $this->accessor = PropertyAccess::createPropertyAccessor();
        $this->arrayObject = new ArrayObject();
    }

    /**
     * {@inheritdoc}
     *
     * @throws ExistingResourceException
     * @throws UnexpectedTypeException
     */
    public function add(ResourceInterface $resource): void
    {
        if (!$resource instanceof $this->interface) {
            throw new UnexpectedTypeException($resource, $this->interface);
        }

        if (in_array($resource, $this->findAll())) {
            throw new ExistingResourceException();
        }

        $this->arrayObject->append($resource);
    }

    /**
     * {@inheritdoc}
     */
    public function remove(ResourceInterface $resource): void
    {
        $newResources = array_filter($this->findAll(), function ($object) use ($resource) {
            return $object !== $resource;
        });

        $this->arrayObject->exchangeArray($newResources);
    }

    /**
     * {@inheritdoc}
     *
     * @throws UnsupportedMethodException
     */
    public function find($id, $lockMode = NULL, $lockVersion = NULL)
    {
        return $this->findOneBy(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return $this->arrayObject->getArrayCopy();
    }

    /**
     * {@inheritdoc}
     */
    public function findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null): array
    {
        $results = $this->findAll();

        if (!empty($criteria)) {
            $results = $this->applyCriteria($results, $criteria);
        }

        if (!empty($orderBy)) {
            $results = $this->applyOrder($results, $orderBy);
        }

        $results = array_slice($results, $offset ?? 0, $limit);

        return $results;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException
     */
    public function findOneBy(array $criteria): ?ResourceInterface
    {
        if (empty($criteria)) {
            throw new \InvalidArgumentException('The criteria array needs to be set.');
        }

        $results = $this->applyCriteria($this->findAll(), $criteria);

        if ($result = reset($results)) {
            return $result;
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getClassName(): string
    {
        return $this->interface;
    }

    /**
     * {@inheritdoc}
     */
    public function createPaginator(array $criteria = [], array $sorting = []): iterable
    {
        $resources = $this->findAll();

        if (!empty($sorting)) {
            $resources = $this->applyOrder($resources, $sorting);
        }

        if (!empty($criteria)) {
            $resources = $this->applyCriteria($resources, $criteria);
        }

        return new Pagerfanta(new ArrayAdapter($resources));
    }

    /**
     * @param ResourceInterface[] $resources
     * @param array               $criteria
     *
     * @return ResourceInterface[]|array
     */
    private function applyCriteria(array $resources, array $criteria): array
    {
        foreach ($this->arrayObject as $object) {
            foreach ($criteria as $criterion => $value) {
                if ($value !== $this->accessor->getValue($object, $criterion)) {
                    $key = array_search($object, $resources);
                    unset($resources[$key]);
                }
            }
        }

        return $resources;
    }

    /**
     * @param ResourceInterface[] $resources
     * @param array               $orderBy
     *
     * @return ResourceInterface[]
     */
    private function applyOrder(array $resources, array $orderBy): array
    {
        $results = $resources;

        foreach ($orderBy as $property => $order) {
            $sortable = [];

            foreach ($results as $key => $object) {
                $sortable[$key] = $this->accessor->getValue($object, $property);
            }

            if (RepositoryInterface::ORDER_ASCENDING === $order) {
                asort($sortable);
            }
            if (RepositoryInterface::ORDER_DESCENDING === $order) {
                arsort($sortable);
            }

            $results = [];

            foreach ($sortable as $key => $propertyValue) {
                $results[$key] = $resources[$key];
            }
        }

        return $results;
    }
}
