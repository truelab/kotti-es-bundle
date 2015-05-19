<?php

namespace Truelab\KottiEsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('truelab_kotti_es');

        $rootNode
            ->children()
                ->scalarNode('host')
                    ->defaultValue('localhost')
                ->end()
                ->scalarNode('port')
                    ->defaultValue('9200')
                ->end()
                ->scalarNode('index')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->arrayNode('alias_map')
                    ->useAttributeAsKey('name')
                    ->prototype('scalar')->end()
                ->end()
                ->arrayNode('query_string_util')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('clean_query_text_pattern')->defaultValue('/([\"\<\>\^\?\*\~\.\!\(\)\+\-\=\:\{\}\/\\\])|(\|{2})|(&{2})/')->end()
                        ->scalarNode('escape_query_text_pattern')->defaultValue('/([\"\<\>\^\?\*\~\.\!\(\)\+\-\=\:\{\}\/\\\])|(\|{2})|(&{2})/')->end()
                        ->scalarNode('escape_query_text_replacement')->defaultValue('\\\\${1}${2}${3}')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
