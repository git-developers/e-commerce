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

namespace spec\Component\Registry;

require_once __DIR__ . '/Fixture/SampleServiceInterface.php';

use PhpSpec\ObjectBehavior;
use spec\Component\Registry\Fixture\SampleServiceInterface;
use Component\Registry\ExistingServiceException;
use Component\Registry\NonExistingServiceException;
use Component\Registry\ServiceRegistryInterface;

final class ServiceRegistrySpec extends ObjectBehavior
{
    function let(): void
    {
        $this->beConstructedWith(SampleServiceInterface::class);
    }

    function it_implements_service_registry_interface(): void
    {
        $this->shouldImplement(ServiceRegistryInterface::class);
    }

    function it_initializes_services_array_by_default(): void
    {
        $this->all()->shouldReturn([]);
    }

    function it_registers_service_with_given_interface(SampleServiceInterface $service): void
    {
        $this->has('test')->shouldReturn(false);
        $this->register('test', $service);

        $this->has('test')->shouldReturn(true);
        $this->get('test')->shouldReturn($service);
    }

    function it_registers_service_with_given_parent_class(\stdClass $service): void
    {
        $this->beConstructedWith(\stdClass::class);
        $this->has('test')->shouldReturn(false);
        $this->register('test', $service);

        $this->has('test')->shouldReturn(true);
        $this->get('test')->shouldReturn($service);
    }

    function it_throws_exception_when_trying_to_register_service_with_taken_interface(SampleServiceInterface $service): void
    {
        $this->register('test', $service);

        $this
            ->shouldThrow(ExistingServiceException::class)
            ->duringRegister('test', $service)
        ;
    }

    function it_throws_exception_when_trying_to_register_service_with_taken_parent_class(\stdClass $service): void
    {
        $this->beConstructedWith(\stdClass::class);
        $this->register('test', $service);

        $this
            ->shouldThrow(ExistingServiceException::class)
            ->duringRegister('test', $service)
        ;
    }

    function it_throws_exception_when_trying_to_register_service_without_required_interface(
        \stdClass $service
    ): void {
        $this
            ->shouldThrow(\InvalidArgumentException::class)
            ->duringRegister('test', $service)
        ;
    }

    function it_unregisters_service_with_given_interface(SampleServiceInterface $service): void
    {
        $this->register('foo', $service);
        $this->has('foo')->shouldReturn(true);

        $this->unregister('foo');
        $this->has('foo')->shouldReturn(false);
    }

    function it_unregisters_service_with_given_parent_class(\stdClass $service): void
    {
        $this->beConstructedWith(\stdClass::class);
        $this->register('foo', $service);
        $this->has('foo')->shouldReturn(true);

        $this->unregister('foo');
        $this->has('foo')->shouldReturn(false);
    }

    function it_retrieves_registered_service_by_interface(SampleServiceInterface $service): void
    {
        $this->register('test', $service);
        $this->get('test')->shouldReturn($service);
    }

    function it_retrieves_registered_service_by_parent_class(\stdClass $service): void
    {
        $this->beConstructedWith(\stdClass::class);
        $this->register('test', $service);
        $this->get('test')->shouldReturn($service);
    }

    function it_throws_exception_if_trying_to_get_service_of_non_existing_type(): void
    {
        $this
            ->shouldThrow(new NonExistingServiceException('service', 'foo', []))
            ->duringGet('foo')
        ;
    }
}
