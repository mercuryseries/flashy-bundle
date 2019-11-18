<?php

namespace MercurySeries\FlashyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('mercuryseries_flashy');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('flash_message_name')
                    ->info("The name to use as the flash message key in the session store")
                    ->defaultValue('mercuryseries_flashy_notification')
                ->end()
                ->scalarNode('session_store')
                    ->info("The session store to use for storing flash messages")
                    ->defaultNull()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
