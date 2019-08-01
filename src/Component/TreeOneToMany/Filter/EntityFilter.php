<?php

declare(strict_types=1);

namespace Component\TreeOneToMany\Filter;

use Component\TreeOneToMany\Data\DataSourceInterface;
use Component\TreeOneToMany\Filtering\FilterInterface;

final class EntityFilter implements FilterInterface
{
    /**
     * {@inheritdoc}
     */
    public function apply(DataSourceInterface $dataSource, string $name, $data, array $options): void
    {
        if (empty($data)) {
            return;
        }

        $fields = $options['fields'] ?? [$name];

        $expressionBuilder = $dataSource->getExpressionBuilder();

        $expressions = [];
        foreach ($fields as $field) {
            $expressions[] = $expressionBuilder->equals($field, $data);
        }

        $dataSource->restrict($expressionBuilder->orX(...$expressions));
    }
}
