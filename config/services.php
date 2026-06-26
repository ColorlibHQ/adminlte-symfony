<?php

declare(strict_types=1);

use ColorlibHQ\AdminLteBundle\Config\AdminLteConfig;
use ColorlibHQ\AdminLteBundle\Menu\MenuBuilder;
use ColorlibHQ\AdminLteBundle\Twig\AdminLteExtension;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $container): void {
    $services = $container->services()
        ->defaults()
            ->autowire()
            ->autoconfigure();

    // Resolved bundle configuration, exposed to Twig as the `adminlte` global.
    $services->set(AdminLteConfig::class)
        ->arg('$config', '%adminlte.config%');

    // Config-driven sidebar menu builder. The authorization checker is optional:
    // when symfony/security-bundle is absent, `permission` filters are ignored.
    $services->set(MenuBuilder::class)
        ->arg('$menuConfig', '%adminlte.menu%')
        ->arg('$authorizationChecker', service('security.authorization_checker')->nullOnInvalid());

    // Twig globals + functions (adminlte, adminlte_menu()).
    $services->set(AdminLteExtension::class);

    // Auto-register every #[AsTwigComponent] in src/Twig/Component/.
    $services->load('ColorlibHQ\\AdminLteBundle\\Twig\\Component\\', '../src/Twig/Component/');
};
