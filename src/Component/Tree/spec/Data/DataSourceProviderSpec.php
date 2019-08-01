<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\Component\Tree\Data;

use PhpSpec\ObjectBehavior;
use Component\Tree\Data\DataSourceInterface;
use Component\Tree\Data\DataSourceProviderInterface;
use Component\Tree\Data\DriverInterface;
use Component\Tree\Data\UnsupportedDriverException;
use Component\Tree\Definition\Tree;
use Component\Tree\Parameters;
use Component\Registry\ServiceRegistryInterface;

final class DataSourceProviderSpec extends ObjectBehavior
{
    function let(ServiceRegistryInterface $driversRegistry): void
    {
        $this->beConstructedWith($driversRegistry);
    }

    function it_implements_grid_data_provider_interface(): void
    {
        $this->shouldImplement(DataSourceProviderInterface::class);
    }

    function it_uses_a_correct_driver_to_get_the_data_for_a_grid(
        ServiceRegistryInterface $driversRegistry,
        DataSourceInterface $dataSource,
        DriverInterface $driver,
        Tree $grid
    ): void {
        $parameters = new Parameters();

        $grid->getDriver()->willReturn('doctrine/orm');
        $grid->getDriverConfiguration()->willReturn(['resource' => 'sylius.tax_category']);

        $driversRegistry->has('doctrine/orm')->willReturn(true);
        $driversRegistry->get('doctrine/orm')->willReturn($driver);
        $driver->getDataSource(['resource' => 'sylius.tax_category'], $parameters)->willReturn($dataSource);

        $this->getDataSource($grid, $parameters)->shouldReturn($dataSource);
    }

    function it_throws_an_exception_if_driver_is_not_supported(Tree $grid, ServiceRegistryInterface $driversRegistry): void
    {
        $parameters = new Parameters();

        $grid->getDriver()->willReturn('doctrine/banana');
        $driversRegistry->has('doctrine/banana')->willReturn(false);

        $this
            ->shouldThrow(new UnsupportedDriverException('doctrine/banana'))
            ->during('getDataSource', [$grid, $parameters])
        ;
    }
}
