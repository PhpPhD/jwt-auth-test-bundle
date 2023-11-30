<?php

declare(strict_types=1);

namespace PhPhD\JwtAuthTestBundle\DependencyInjection;

use Exception;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\AbstractExtension;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

final class PhdJwtAuthTestExtension extends AbstractExtension
{
    public const ALIAS = 'phd_jwt_auth_test';

    /**
     * @psalm-suppress MoreSpecificImplementedParamType
     *
     * @param array<array-key,array{authenticators:mixed}> $config
     *
     * @override
     *
     * @throws Exception
     */
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $builder->setParameter('phd_jwt_auth_test.config.authenticators', $config['authenticators']);

        $container->import(__DIR__.'/../Resources/config/services.php');
    }

    /**
     * @psalm-suppress MoreSpecificImplementedParamType
     *
     * @param array<array-key,mixed> $config
     *
     * @override
     */
    public function getConfiguration(array $config, ContainerBuilder $container): ?ConfigurationInterface
    {
        return new Configuration();
    }

    /** @override */
    public function getAlias(): string
    {
        return self::ALIAS;
    }
}
