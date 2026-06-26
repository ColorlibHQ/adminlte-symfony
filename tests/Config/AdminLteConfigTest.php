<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Tests\Config;

use ColorlibHQ\AdminLteBundle\Config\AdminLteConfig;
use PHPUnit\Framework\TestCase;

final class AdminLteConfigTest extends TestCase
{
    public function testBodyClassReflectsLayoutFlags(): void
    {
        $config = new AdminLteConfig($this->config([
            'fixed_sidebar' => true,
            'fixed_footer' => true,
            'sidebar_mini' => true,
            'sidebar_collapsed' => true,
            'boxed' => true,
        ]));

        $classes = explode(' ', $config->getBodyClass());

        self::assertContains('sidebar-expand-lg', $classes);
        self::assertContains('layout-fixed', $classes);
        self::assertContains('layout-footer-fixed', $classes);
        self::assertContains('layout-boxed', $classes);
        self::assertContains('sidebar-collapse', $classes);
    }

    public function testBodyClassOmitsDisabledFlags(): void
    {
        $config = new AdminLteConfig($this->config([
            'fixed_sidebar' => false,
            'fixed_footer' => false,
            'sidebar_mini' => true,
            'sidebar_collapsed' => false,
            'boxed' => false,
        ]));

        $classes = explode(' ', $config->getBodyClass());

        self::assertNotContains('layout-fixed', $classes);
        self::assertNotContains('layout-footer-fixed', $classes);
        self::assertNotContains('layout-boxed', $classes);
        self::assertNotContains('sidebar-collapse', $classes);
    }

    public function testScalarAccessors(): void
    {
        $config = new AdminLteConfig($this->config());

        self::assertSame('AdminLTE', $config->getTitle());
        self::assertSame('auto', $config->getColorMode());
        self::assertNull($config->getDashboardRoute());
    }

    /**
     * @param array<string, bool> $layout
     *
     * @return array<string, mixed>
     */
    private function config(array $layout = []): array
    {
        return [
            'title' => 'AdminLTE',
            'title_short' => 'ALTE',
            'color_mode' => 'auto',
            'dashboard_route' => null,
            'logo' => ['text' => '<b>Admin</b>LTE', 'image' => null, 'alt' => 'AdminLTE Logo'],
            'layout' => array_merge([
                'fixed_sidebar' => true,
                'fixed_footer' => false,
                'sidebar_mini' => true,
                'sidebar_collapsed' => false,
                'boxed' => false,
            ], $layout),
            'topbar' => ['enabled' => true, 'search' => true, 'fullscreen_toggle' => true],
            'footer' => ['enabled' => true, 'copyright' => null, 'text' => null, 'version' => null],
        ];
    }
}
