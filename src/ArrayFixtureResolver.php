<?php

namespace Repositories\Core;

use Repositories\Core\Contracts\FixtureResolverInterface;

class ArrayFixtureResolver implements FixtureResolverInterface
{
    /**
     * @test
     */
    public function getFixtures($fixtures): ArrayRepository
    {
        // Assert $fixtures is an array

        return new ArrayRepository($fixtures);
    }
}
