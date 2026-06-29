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
        return [
            ['header' => 'MAIN NAVIGATION'],
            ['label' => 'Dashboard', 'icon' => 'bi bi-speedometer', 'children' => [
                ['label' => 'Dashboard v1', 'url' => '/'],
                ['label' => 'Dashboard v2', 'url' => '/dashboard-v2.html'],
                ['label' => 'Dashboard v3', 'url' => '/dashboard-v3.html'],
            ]],
            ['label' => 'Widgets', 'icon' => 'bi bi-grid-1x2', 'children' => [
                ['label' => 'Small Box', 'url' => '/widgets-small-box.html'],
                ['label' => 'Info Box', 'url' => '/widgets-info-box.html'],
                ['label' => 'Cards', 'url' => '/widgets-cards.html'],
            ]],
            ['label' => 'UI Elements', 'icon' => 'bi bi-tree-fill', 'children' => [
                ['label' => 'General', 'url' => '/ui-general.html'],
                ['label' => 'Icons', 'url' => '/ui-icons.html'],
                ['label' => 'Timeline', 'url' => '/ui-timeline.html'],
            ]],
            ['label' => 'Forms', 'icon' => 'bi bi-input-cursor-text', 'children' => [
                ['label' => 'Elements', 'url' => '/forms-elements.html'],
                ['label' => 'Layout', 'url' => '/forms-layout.html'],
                ['label' => 'Validation', 'url' => '/forms-validation.html'],
                ['label' => 'Wizard', 'url' => '/forms-wizard.html'],
            ]],
            ['label' => 'Tables', 'icon' => 'bi bi-table', 'children' => [
                ['label' => 'Simple Tables', 'url' => '/tables-simple.html'],
                ['label' => 'Data Tables', 'url' => '/tables-data.html'],
            ]],
            ['label' => 'Mailbox', 'icon' => 'bi bi-envelope', 'children' => [
                ['label' => 'Inbox', 'url' => '/mailbox-inbox.html'],
                ['label' => 'Compose', 'url' => '/mailbox-compose.html'],
                ['label' => 'Read', 'url' => '/mailbox-read.html'],
            ]],
            ['header' => 'EXAMPLES'],
            ['label' => 'Calendar', 'icon' => 'bi bi-calendar3', 'url' => '/calendar.html'],
            ['label' => 'Kanban Board', 'icon' => 'bi bi-kanban', 'url' => '/kanban.html'],
            ['label' => 'Chat', 'icon' => 'bi bi-chat-dots', 'url' => '/chat.html'],
            ['label' => 'File Manager', 'icon' => 'bi bi-folder', 'url' => '/file-manager.html'],
            ['label' => 'Profile', 'icon' => 'bi bi-person-badge', 'url' => '/profile.html'],
            ['label' => 'Projects', 'icon' => 'bi bi-folder2-open', 'url' => '/projects.html'],
            ['label' => 'Invoice', 'icon' => 'bi bi-receipt', 'url' => '/invoice.html'],
            ['label' => 'Pricing', 'icon' => 'bi bi-tag', 'url' => '/pricing.html'],
            ['label' => 'Settings', 'icon' => 'bi bi-gear', 'url' => '/settings.html'],
            ['label' => 'FAQ', 'icon' => 'bi bi-question-circle', 'url' => '/faq.html'],
            ['label' => 'Error pages', 'icon' => 'bi bi-exclamation-octagon', 'children' => [
                ['label' => '404', 'url' => '/404.html'],
                ['label' => '500', 'url' => '/500.html'],
                ['label' => 'Maintenance', 'url' => '/maintenance.html'],
            ]],
            ['header' => 'ACCOUNT'],
            ['label' => 'Login', 'icon' => 'bi bi-box-arrow-in-right', 'url' => '/login.html'],
            ['label' => 'Register', 'icon' => 'bi bi-person-plus', 'url' => '/register.html'],
            ['label' => 'Lockscreen', 'icon' => 'bi bi-lock', 'url' => '/lockscreen.html'],
            ['label' => 'AdminLTE.io', 'icon' => 'bi bi-globe', 'url' => 'https://adminlte.io', 'target' => '_blank'],
        ];
    }
}
