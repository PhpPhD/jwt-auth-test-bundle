<?php

declare(strict_types=1);

namespace PhPhD\ApiTestingBundle;

use PhPhD\ApiTestingBundle\DependencyInjection\PhdApiTestingExtension;
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
