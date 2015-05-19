<?php

namespace Truelab\KottiEsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class TruelabKottiEsExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $container->setParameter('truelab_kotti_es.host', $config['host']);
        $container->setParameter('truelab_kotti_es.port', $config['port']);
        $container->setParameter('truelab_kotti_es.index', $config['index']);
        $container->setParameter('truelab_kotti_es.alias_map', $config['alias_map']);
        $container->setParameter('truelab_kotti_es.util.query_string_default_options', $config['query_string_util']);

        $loader->load('services.xml');
    }
}
