<?php

namespace Repositories\Core\Tests\Resolvers;

use Mockery\Adapter\Phpunit\MockeryTestCase;
use Psr\Container\ContainerInterface;
use Repositories\Core\Resolvers\ContainerAwareResolver;
use Repositories\Core\Exceptions\CouldNotResolve;
use Repositories\Core\Tests\Support\UserRepository;
use Repositories\Core\Tests\Support\SimpleContainer;
use Mockery;

class ContainerAwareResolverTest extends MockeryTestCase
{
    protected $container;

    public function setUp(): void
    {
        parent::setUp();

        $this->container = new SimpleContainer();
    }

    /**
     * @test
     */
    public function exception_is_thrown_if_not_resolved()
    {
        $requestedRepository = UserRepository::class;

        $resolver = new ContainerAwareResolver($this->container);

        $this->expectException(CouldNotResolve::class);

        $resolver->resolve($requestedRepository);
    }

    /**
     * @test
     */
    public function exception_is_thrown_if_resolved_not_a_repository()
    {
        $requestedRepository = UserRepository::class;

        $this->container->resolved[$requestedRepository] = new \stdClass();

        $resolver = new ContainerAwareResolver($this->container);

        $this->expectException(CouldNotResolve::class);

        $resolver->resolve($requestedRepository);
    }

    /**
     * @test
     */
    public function repository_is_resolved()
    {
        $requestedRepository = new UserRepository();

        $this->container->resolved[get_class($requestedRepository)] = $requestedRepository;

        $resolver = new ContainerAwareResolver($this->container);

        $this->assertSame(
            $requestedRepository,
            $resolver->resolve(get_class($requestedRepository))
        );
    }
}
