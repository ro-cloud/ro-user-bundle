<?php

namespace RoCloud\UserBundle\DependencyInjection;

use RoCloud\UserBundle\Entity\IngameAccount;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('rocloud_user_bundle');

        $rootNode
            ->children()
                ->arrayNode('user')
                    ->children()
                        ->scalarNode('class')->end()
                        ->arrayNode('mapping')
                            ->arrayPrototype()
                                ->children()
                                    ->scalarNode('field')
                                        ->defaultValue('accounts')
                                    ->end()
                                    ->scalarNode('type')
                                        ->defaultValue('oneToMany')
                                    ->end()
                                    ->arrayNode('cascade')->end()
                                    ->arrayNode('joinTable')
                                        ->arrayPrototype()
                                            ->children()
                                                ->scalarNode('name')->end()
                                                ->arrayNode('joinColumns')->end()
                                                ->arrayNode('inverseJoinColumns')->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
