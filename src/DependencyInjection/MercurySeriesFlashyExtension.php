<?php

namespace MercurySeries\FlashyBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class MercurySeriesFlashyExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $definition = $container->getDefinition('mercuryseries_flashy.flashy_notifier');

        if (null !== $config['session_store']) {
            $container->setAlias('mercuryseries_flashy.session_store', $config['session_store']);
        }

        $definition->setArgument(1, $config['flash_message_name']);
    }

    public function getAlias(): string
    {
        return 'mercuryseries_flashy';
    }
}
