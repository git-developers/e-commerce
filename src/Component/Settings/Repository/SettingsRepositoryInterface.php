<?php

declare(strict_types=1);

namespace Component\Settings\Repository;

use Component\Settings\Model\SettingsInterface;
use Component\Core\Repository\RepositoryInterface;

interface SettingsRepositoryInterface extends RepositoryInterface
{

//    /**
//     * @return array
//     */
//    public function gatazo(): array;

    public function find($id, $lockMode = NULL, $lockVersion = NULL);
    public function findAll(): array;

    /**
     * @param string $name
     * @param string $locale
     *
     * @return array|SettingsInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|SettingsInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
