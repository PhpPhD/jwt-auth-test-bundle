<?php

declare(strict_types=1);

namespace PhPhD\ApiTestBundle;

use PhPhD\ApiTestBundle\DependencyInjection\PhdApiTestExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/** @api */
final class PhdApiTestBundle extends Bundle
{
    /** @override */
    protected function createContainerExtension(): PhdApiTestExtension
    {
        return new PhdApiTestExtension();
    }
}
