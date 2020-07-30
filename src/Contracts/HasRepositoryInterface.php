<?php

namespace Prozorov\Repositories\Contracts;

interface HasRepositoryInterface
{
    /**
     * @return RepositoryInterface
     */
    public static function getRepository(): RepositoryInterface;
}
