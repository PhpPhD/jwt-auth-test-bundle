<?php

declare(strict_types=1);

namespace PhPhD\JwtAuthTestBundle\Tests\Unit\Stub\Outlet;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class KernelTestCaseStub extends TestCase
{
    private static ?ContainerInterface $container = null;

    public static function setContainer(?ContainerInterface $container): void
    {
        self::$container = $container;
    }

    /** @psalm-suppress PossiblyUnusedMethod */
    protected static function getContainer(): ?ContainerInterface
    {
        return self::$container;
    }
}
