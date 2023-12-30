<?php

declare(strict_types=1);

namespace PhPhD\JwtAuthTestBundle;

use PhPhD\JwtAuthTestBundle\DependencyInjection\PhdJwtAuthTestExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/** @api */
final class PhdJwtAuthTestBundle extends Bundle
{
    /** @override */
    protected function createContainerExtension(): PhdJwtAuthTestExtension
    {
        return new PhdJwtAuthTestExtension();
    }
}
