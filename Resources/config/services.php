<?php

declare(strict_types=1);

use PhPhD\ApiTest\Authenticator\TestJwtAuthenticator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $container, ContainerBuilder $builder): void {
    $services = $container->services();

    /** @var array<string,array{user_provider:string}> $authenticatorsConfig */
    $authenticatorsConfig = $builder->getParameter('phd_api_test.config.authenticators');

    foreach ($authenticatorsConfig as $name => $authenticator) {
        $services
            ->set('phd_api_test.jwt_authenticator.'.$name, TestJwtAuthenticator::class)
            ->public()
            ->args([
                service($authenticator['user_provider']),
                service('lexik_jwt_authentication.jwt_manager'),
            ])
        ;
    }
};
