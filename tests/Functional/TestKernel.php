<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Tests\Functional;

use ColorlibHQ\AdminLteBundle\AdminLteBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Symfony\UX\TwigComponent\TwigComponentBundle;

/**
 * Minimal kernel that boots the bundle alongside Twig + UX Twig Component so the
 * functional tests can render real component output.
 */
final class TestKernel extends Kernel
{
    use MicroKernelTrait;

    public function registerBundles(): iterable
    {
        return [
            new FrameworkBundle(),
            new TwigBundle(),
            new TwigComponentBundle(),
            new AdminLteBundle(),
        ];
    }

    public function getProjectDir(): string
    {
        return \dirname(__DIR__, 2);
    }

    public function getCacheDir(): string
    {
        return sys_get_temp_dir().'/adminlte-symfony-tests/cache/'.$this->environment;
    }

    public function getBuildDir(): string
    {
        return $this->getCacheDir();
    }

    public function getLogDir(): string
    {
        return sys_get_temp_dir().'/adminlte-symfony-tests/log';
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->extension('framework', [
            'secret' => 'test',
            'test' => true,
            'http_method_override' => false,
            'handle_all_throwables' => true,
            'php_errors' => ['log' => true],
            'router' => ['utf8' => true],
        ]);

        $container->extension('twig', [
            'default_path' => '%kernel.project_dir%/templates',
        ]);

        $container->extension('admin_lte', [
            'title' => 'Test Admin',
            'dashboard_route' => 'test_dashboard',
            'footer' => ['version' => 'v1.0.0'],
            'menu' => [
                ['label' => 'Dashboard', 'route' => 'test_dashboard', 'icon' => 'bi bi-speedometer2'],
                ['header' => 'MANAGEMENT'],
                [
                    'label' => 'Users',
                    'icon' => 'bi bi-people',
                    'children' => [
                        ['label' => 'All users', 'url' => '/admin/users', 'badge' => '12'],
                    ],
                ],
                ['label' => 'Docs', 'url' => 'https://adminlte.io', 'icon' => 'bi bi-book', 'target' => '_blank'],
            ],
        ]);
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->add('test_dashboard', '/admin');
    }
}
