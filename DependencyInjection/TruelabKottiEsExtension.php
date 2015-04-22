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
class TruelabKottiEsExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
    }

    /**
     * Allow an extension to prepend the extension configurations.
     *
     * @param ContainerBuilder $container
     */
    public function prepend(ContainerBuilder $container)
    {
        $cmfRoutingConfig = array(
            'chain' => array(
                'routers_by_id' => array(
                    'cmf_routing.dynamic_router' => 100,
                    'router.default' => 200,
                )
            ),
            'dynamic' => array(
                'enabled' => true,
                'default_controller' => 'TruelabKottiFrontendBundle:Context:view',
                'route_provider_service_id' => 'truelab_kotti_frontend.route_provider'
            )
        );

        foreach ($container->getExtensions() as $name => $extension) {

            switch ($name) {
                case 'cmf_routing':
                    // set use_acme_goodbye to false in the config of
                    // acme_something and acme_other note that if the user manually
                    // configured use_acme_goodbye to true in the app/config/config.yml
                    // then the setting would in the end be true and not false
                    $container->prependExtensionConfig($name, $cmfRoutingConfig);
                    break;
            }
        }
    }
}
