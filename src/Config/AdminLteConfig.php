<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Config;

/**
 * Read-only accessor over the resolved bundle configuration.
 *
 * Exposed to Twig as the `adminlte` global, e.g. `{{ adminlte.title }}`,
 * `{{ adminlte.bodyClass }}`, `{{ adminlte.colorMode }}`.
 */
final class AdminLteConfig
{
    /**
     * @param array{
     *     title: string,
     *     title_short: string,
     *     color_mode: 'light'|'dark'|'auto',
     *     dashboard_route: string|null,
     *     logo: array{text: string, image: string|null, alt: string},
     *     layout: array{fixed_sidebar: bool, fixed_footer: bool, sidebar_mini: bool, sidebar_collapsed: bool, boxed: bool},
     *     topbar: array{enabled: bool, search: bool, fullscreen_toggle: bool},
     *     footer: array{enabled: bool, copyright: string|null, text: string|null, version: string|null}
     * } $config
     */
    public function __construct(
        private readonly array $config,
    ) {
    }

    public function getTitle(): string
    {
        return $this->config['title'];
    }

    public function getTitleShort(): string
    {
        return $this->config['title_short'];
    }

    /** @return 'light'|'dark'|'auto' */
    public function getColorMode(): string
    {
        return $this->config['color_mode'];
    }

    public function getDashboardRoute(): ?string
    {
        return $this->config['dashboard_route'];
    }

    /** @return array{text: string, image: string|null, alt: string} */
    public function getLogo(): array
    {
        return $this->config['logo'];
    }

    /** @return array{enabled: bool, search: bool, fullscreen_toggle: bool} */
    public function getTopbar(): array
    {
        return $this->config['topbar'];
    }

    /** @return array{enabled: bool, copyright: string|null, text: string|null, version: string|null} */
    public function getFooter(): array
    {
        return $this->config['footer'];
    }

    /**
     * Classes for the AdminLTE 4 `<body>` element, derived from the layout config.
     */
    public function getBodyClass(): string
    {
        $layout = $this->config['layout'];

        $classes = ['sidebar-expand-lg', 'bg-body-tertiary'];

        if ($layout['fixed_sidebar']) {
            $classes[] = 'layout-fixed';
        }
        if ($layout['fixed_footer']) {
            $classes[] = 'layout-footer-fixed';
        }
        if ($layout['boxed']) {
            $classes[] = 'layout-boxed';
        }
        if ($layout['sidebar_collapsed']) {
            $classes[] = 'sidebar-collapse';
        }

        return implode(' ', $classes);
    }
}
