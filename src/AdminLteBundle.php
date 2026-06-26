<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle;

use Symfony\Component\AssetMapper\AssetMapperInterface;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

/**
 * Official AdminLTE 4 integration for Symfony.
 *
 * Bootstrap 5.3 + AssetMapper + Twig Components, with a config-driven sidebar
 * menu, SSR-safe dark mode and an optional theme for EasyAdmin.
 */
final class AdminLteBundle extends AbstractBundle
{
    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
                ->scalarNode('title')
                    ->info('Default <title> and topbar brand text.')
                    ->defaultValue('AdminLTE')
                ->end()
                ->scalarNode('title_short')
                    ->info('Collapsed-sidebar brand text.')
                    ->defaultValue('ALTE')
                ->end()
                ->enumNode('color_mode')
                    ->info('Initial color mode. "auto" follows the OS preference.')
                    ->values(['light', 'dark', 'auto'])
                    ->defaultValue('auto')
                ->end()
                ->scalarNode('dashboard_route')
                    ->info('Route used by the sidebar brand link.')
                    ->defaultNull()
                ->end()
                ->arrayNode('logo')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('text')->defaultValue('<b>Admin</b>LTE')->end()
                        ->scalarNode('image')->info('Path/URL to a logo image.')->defaultNull()->end()
                        ->scalarNode('alt')->defaultValue('AdminLTE Logo')->end()
                    ->end()
                ->end()
                ->arrayNode('layout')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('fixed_sidebar')->defaultTrue()->end()
                        ->booleanNode('fixed_footer')->defaultFalse()->end()
                        ->booleanNode('sidebar_mini')->defaultTrue()->end()
                        ->booleanNode('sidebar_collapsed')->defaultFalse()->end()
                        ->booleanNode('boxed')->defaultFalse()->end()
                    ->end()
                ->end()
                ->arrayNode('topbar')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('enabled')->defaultTrue()->end()
                        ->booleanNode('search')->defaultTrue()->end()
                        ->booleanNode('fullscreen_toggle')->defaultTrue()->end()
                    ->end()
                ->end()
                ->arrayNode('footer')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('enabled')->defaultTrue()->end()
                        ->scalarNode('copyright')->defaultNull()->end()
                        ->scalarNode('text')->defaultNull()->end()
                        ->scalarNode('version')->defaultNull()->end()
                    ->end()
                ->end()
                ->variableNode('menu')
                    ->info('Config-driven sidebar menu. See README for the item shape.')
                    ->defaultValue([])
                ->end()
            ->end()
        ;
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $builder->setParameter('adminlte.config', $config);
        $builder->setParameter('adminlte.menu', $config['menu'] ?? []);

        $container->import('../config/services.php');
    }

    public function prependExtension(ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        // Expose the bundle's assets to AssetMapper (the production path) under
        // the "@colorlibhq/adminlte-symfony" namespace. No-op when AssetMapper
        // isn't installed — the inline color-mode script + CDN layout still work.
        if (!interface_exists(AssetMapperInterface::class)) {
            return;
        }

        $builder->prependExtensionConfig('framework', [
            'asset_mapper' => [
                'paths' => [
                    __DIR__.'/../assets' => '@colorlibhq/adminlte-symfony',
                ],
            ],
        ]);
    }

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
