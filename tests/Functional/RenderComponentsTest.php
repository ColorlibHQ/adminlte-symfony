<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;

final class RenderComponentsTest extends KernelTestCase
{
    protected static function getKernelClass(): string
    {
        return TestKernel::class;
    }

    public function testFullDashboardRenders(): void
    {
        self::bootKernel();
        $container = self::getContainer();
        // Give the menu/active-state logic a current request.
        $container->get('request_stack')->push(Request::create('/admin'));

        /** @var Environment $twig */
        $twig = $container->get('twig');
        $html = $twig->render('@AdminLte/demo/dashboard.html.twig');

        // Layout shell
        self::assertStringContainsString('class="app-wrapper"', $html);
        self::assertStringContainsString('app-header navbar', $html);
        self::assertStringContainsString('app-sidebar', $html);
        self::assertStringContainsString('app-footer', $html);
        self::assertStringContainsString('data-bs-theme', $html);

        // Widgets from the demo
        self::assertStringContainsString('small-box', $html);
        self::assertStringContainsString('New Orders', $html);
        self::assertStringContainsString('info-box', $html);
        self::assertStringContainsString('card card-primary card-outline', $html);

        // Footer config came through
        self::assertStringContainsString('v1.0.0', $html);
    }

    public function testSidebarMenuRendersConfigDrivenItems(): void
    {
        self::bootKernel();
        $container = self::getContainer();
        $container->get('request_stack')->push(Request::create('/admin'));

        /** @var Environment $twig */
        $twig = $container->get('twig');
        $html = $twig->createTemplate('<twig:Adminlte:Sidebar />')->render();

        self::assertStringContainsString('nav-header', $html); // the "MANAGEMENT" header item
        self::assertStringContainsString('Dashboard', $html);
        self::assertStringContainsString('nav-treeview', $html); // the Users submenu
        self::assertStringContainsString('nav-badge', $html); // the "12" badge
        self::assertStringContainsString('target="_blank"', $html); // the external Docs link
        // The dashboard route ("/admin") matches the current request → active.
        self::assertMatchesRegularExpression('/nav-link active[^>]*>\s*<i class="nav-icon bi bi-speedometer2/', $html);
    }

    public function testStandaloneComponentRenders(): void
    {
        self::bootKernel();
        /** @var Environment $twig */
        $twig = self::getContainer()->get('twig');

        $html = $twig->createTemplate(
            '<twig:Adminlte:SmallBox title="150" text="Orders" variant="success" icon="bi bi-bag" url="/x" />'
        )->render();

        self::assertStringContainsString('small-box text-bg-success', $html);
        self::assertStringContainsString('<h3>150</h3>', $html);
        self::assertStringContainsString('small-box-footer', $html);
    }
}
