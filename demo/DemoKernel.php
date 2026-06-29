<?php

declare(strict_types=1);

namespace App\Demo;

use ColorlibHQ\AdminLteBundle\AdminLteBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Symfony\UX\TwigComponent\TwigComponentBundle;

/**
 * Runnable demo kernel for the AdminLTE Symfony bundle. Boots the bundle with a
 * full, core-mirroring sidebar menu so every demo template renders inside the
 * real layout. Used by demo/export.php to static-export the showcase to HTML
 * (the layout pulls CSS/JS from the jsDelivr CDN, so the output is a fully
 * self-contained static site deployable to Cloudflare Pages).
 */
final class DemoKernel extends Kernel
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
        return \dirname(__DIR__);
    }

    public function getCacheDir(): string
    {
        return sys_get_temp_dir().'/adminlte-symfony-demo/cache/'.$this->environment;
    }

    public function getBuildDir(): string
    {
        return $this->getCacheDir();
    }

    public function getLogDir(): string
    {
        return sys_get_temp_dir().'/adminlte-symfony-demo/log';
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->extension('framework', [
            'secret' => 'demo',
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
            'title' => 'AdminLTE 4 · Symfony',
            'logo' => [
                'image' => 'https://cdn.jsdelivr.net/npm/admin-lte@4.0.2/dist/assets/img/AdminLTELogo.png',
                'text' => 'AdminLTE 4',
                'alt' => 'AdminLTE Logo',
            ],
            'dashboard_route' => 'demo_home',
            'footer' => ['version' => 'v4.0.2'],
            'menu' => self::menu(),
        ]);
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        // A single named route so the sidebar brand can resolve dashboard_route.
        $routes->add('demo_home', '/');
    }

    /**
     * The sidebar menu, mirroring the core AdminLTE 4 demo. URL-based (not route-
     * based) so the static export links straight to the generated .html files.
     *
     * @return list<array<string,mixed>>
     */
    public static function menu(): array
    {
        $menu = [
            ['header' => 'MAIN NAVIGATION'],
            ['label' => 'Dashboard', 'icon' => 'bi bi-speedometer', 'children' => [
                ['label' => 'Dashboard v1', 'url' => '/'],
                ['label' => 'Dashboard v2', 'url' => '/dashboard-v2'],
                ['label' => 'Dashboard v3', 'url' => '/dashboard-v3'],
            ]],
            ['label' => 'Widgets', 'icon' => 'bi bi-grid-1x2', 'children' => [
                ['label' => 'Small Box', 'url' => '/widgets-small-box'],
                ['label' => 'Info Box', 'url' => '/widgets-info-box'],
                ['label' => 'Cards', 'url' => '/widgets-cards'],
            ]],
            ['label' => 'UI Elements', 'icon' => 'bi bi-tree-fill', 'children' => [
                ['label' => 'General', 'url' => '/ui-general'],
                ['label' => 'Icons', 'url' => '/ui-icons'],
                ['label' => 'Timeline', 'url' => '/ui-timeline'],
            ]],
            ['label' => 'Forms', 'icon' => 'bi bi-input-cursor-text', 'children' => [
                ['label' => 'Elements', 'url' => '/forms-elements'],
                ['label' => 'Layout', 'url' => '/forms-layout'],
                ['label' => 'Validation', 'url' => '/forms-validation'],
                ['label' => 'Wizard', 'url' => '/forms-wizard'],
            ]],
            ['label' => 'Tables', 'icon' => 'bi bi-table', 'children' => [
                ['label' => 'Simple Tables', 'url' => '/tables-simple'],
                ['label' => 'Data Tables', 'url' => '/tables-data'],
            ]],
            ['label' => 'Mailbox', 'icon' => 'bi bi-envelope', 'children' => [
                ['label' => 'Inbox', 'url' => '/mailbox-inbox'],
                ['label' => 'Compose', 'url' => '/mailbox-compose'],
                ['label' => 'Read', 'url' => '/mailbox-read'],
            ]],
            ['header' => 'EXAMPLES'],
            ['label' => 'Calendar', 'icon' => 'bi bi-calendar3', 'url' => '/calendar'],
            ['label' => 'Kanban Board', 'icon' => 'bi bi-kanban', 'url' => '/kanban'],
            ['label' => 'Chat', 'icon' => 'bi bi-chat-dots', 'url' => '/chat'],
            ['label' => 'File Manager', 'icon' => 'bi bi-folder', 'url' => '/file-manager'],
            ['label' => 'Profile', 'icon' => 'bi bi-person-badge', 'url' => '/profile'],
            ['label' => 'Projects', 'icon' => 'bi bi-folder2-open', 'url' => '/projects'],
            ['label' => 'Invoice', 'icon' => 'bi bi-receipt', 'url' => '/invoice'],
            ['label' => 'Pricing', 'icon' => 'bi bi-tag', 'url' => '/pricing'],
            ['label' => 'Settings', 'icon' => 'bi bi-gear', 'url' => '/settings'],
            ['label' => 'FAQ', 'icon' => 'bi bi-question-circle', 'url' => '/faq'],
            ['label' => 'Error pages', 'icon' => 'bi bi-exclamation-octagon', 'children' => [
                ['label' => '404', 'url' => '/404'],
                ['label' => '500', 'url' => '/500'],
                ['label' => 'Maintenance', 'url' => '/maintenance'],
            ]],
            ['header' => 'ACCOUNT'],
            ['label' => 'Login', 'icon' => 'bi bi-box-arrow-in-right', 'url' => '/login'],
            ['label' => 'Register', 'icon' => 'bi bi-person-plus', 'url' => '/register'],
            ['label' => 'Lockscreen', 'icon' => 'bi bi-lock', 'url' => '/lockscreen'],
            ['label' => 'AdminLTE.io', 'icon' => 'bi bi-globe', 'url' => 'https://adminlte.io', 'target' => '_blank'],
        ];

        // Default each treeview child to the bi-circle icon, mirroring the core demo.
        foreach ($menu as &$item) {
            if (!empty($item['children'])) {
                foreach ($item['children'] as &$child) {
                    $child['icon'] ??= 'bi bi-circle';
                }
                unset($child);
            }
        }
        unset($item);

        return $menu;
    }
}
