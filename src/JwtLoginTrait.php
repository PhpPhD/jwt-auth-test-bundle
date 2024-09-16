<?php

declare(strict_types=1);

namespace PhPhD\ApiTesting;

use PhPhD\ApiTesting\Authenticator\TestJwtAuthenticator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/** @mixin KernelTestCase */
trait JwtLoginTrait
{
    private function login(string $userId, string $authenticator = 'default'): string
    {
        /** @var ContainerInterface $container */
        $container = self::getContainer();

        /** @var TestJwtAuthenticator $testAuthenticator */
        $testAuthenticator = $container->get('phd_api_testing.jwt_authenticator.'.$authenticator);

        return $testAuthenticator->authenticateUser($userId);
    }
}
