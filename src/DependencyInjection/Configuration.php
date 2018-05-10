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

//        $rootNode
//            ->children()
//                ->scalarNode('account_class')
//                    ->defaultValue(IngameAccount::class)
//                ->end()
//                ->scalarNode('user_class')
//                    ->isRequired()
//                ->end()
//            ->end();

        return $treeBuilder;
    }
}
