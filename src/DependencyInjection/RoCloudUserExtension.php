<?php

namespace RoCloud\UserBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @author Black-Nobody <black-nobody@hotmail.de>
 */
class RoCloudUserExtension extends Extension
{
    /**
     * Loads a specific configuration.
     *
     * @param array $configs
     * @param ContainerBuilder $container
     *
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        if (isset($config['user'])) {
            $this->processUserConfig($config['user'], $container);
        }
    }

    /**
     * @param array $userConfig
     * @param ContainerBuilder $container
     */
    protected function processUserConfig(array $userConfig, ContainerBuilder $container)
    {
        $eventSubscriber = $container->getDefinition('rocloud.event_subscriber.user_extender');

        $eventSubscriber
            ->setArgument('user', $userConfig)
            ->addTag('doctrine.event_subscriber');
    }
}
