<?php

declare(strict_types=1);

namespace Component\OneToMany\Repository;

use Component\Core\Repository\RepositoryInterface;

interface OneToManyRightRepositoryInterface extends RepositoryInterface
{
    public function find($id, $lockMode = NULL, $lockVersion = NULL);
    public function searchBoxRight($q, $offset = 0, $limit = 50): array;
    public function findAllOffsetLimit($offset = 0, $limit = 50): array;
}
