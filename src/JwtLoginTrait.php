<?php

declare(strict_types=1);

namespace PhPhD\JwtAuthTest;

use PhPhD\JwtAuthTest\Authenticator\TestAuthenticator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/** @mixin KernelTestCase */
trait JwtLoginTrait
{
    private function login(string $userId, string $authenticator = 'default'): string
    {
        /** @var ContainerInterface $container */
        $container = self::getContainer();

        /** @var TestAuthenticator $testAuthenticator */
        $testAuthenticator = $container->get('phd_jwt_auth_test.authenticator.'.$authenticator);

        return $testAuthenticator->authenticateUser($userId);
    }
}
