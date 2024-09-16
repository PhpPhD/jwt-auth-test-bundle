<?php

declare(strict_types=1);

namespace PhPhD\ApiTesting\Bundle;

use PhPhD\ApiTesting\Bundle\DependencyInjection\PhdApiTestingExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/** @api */
final class PhdApiTestingBundle extends Bundle
{
    /** @override */
    protected function createContainerExtension(): PhdApiTestingExtension
    {
        return new PhdApiTestingExtension();
    }
}
