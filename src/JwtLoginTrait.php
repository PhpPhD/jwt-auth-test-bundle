<?php

declare(strict_types=1);

namespace PhPhD\ApiTest;

use PhPhD\ApiTest\Authenticator\TestJwtAuthenticator;
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
        $testAuthenticator = $container->get('phd_api_test.jwt_authenticator.'.$authenticator);

        return $testAuthenticator->authenticateUser($userId);
    }
}
