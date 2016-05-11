<?php

namespace Intbizth\Bundle\AdminBundle\DependencyInjection;

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
class IntbizthAdminExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }

    /**
     * {@inheritdoc}
     */
    public function prepend(ContainerBuilder $container)
    {
        $this->processConfiguration(new Configuration(), $container->getExtensionConfig($this->getAlias()));

        $container->prependExtensionConfig('sylius_grid', array(
            'templates' => array(
                'action' => array(
                    'create' => 'IntbizthAdminBundle:Grid/Action:create.html.twig',
                    'update' => 'IntbizthAdminBundle:Grid/Action:update.html.twig',
                    'delete' => 'IntbizthAdminBundle:Grid/Action:delete.html.twig',
                    'link' => 'IntbizthAdminBundle:Grid/Action:link.html.twig',
                    'show' => 'IntbizthAdminBundle:Grid/Action:show.html.twig',
                    'route' => 'IntbizthAdminBundle:Grid/Action:route.html.twig',
                ),
                'filter' => array(
                    'string' => 'IntbizthAdminBundle:Grid/Filter:string.html.twig',
                ),
            )
        ));
    }
}
