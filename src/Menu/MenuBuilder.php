<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Menu;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Turns the config-driven menu definition into a tree of {@see MenuItem}s.
 *
 * Each raw item is an associative array, e.g.:
 *
 *   ['label' => 'Dashboard', 'route' => 'app_dashboard', 'icon' => 'bi bi-speedometer2']
 *   ['header' => 'MANAGEMENT']
 *   ['label' => 'Users', 'icon' => 'bi bi-people', 'permission' => 'ROLE_ADMIN', 'children' => [
 *       ['label' => 'All users', 'route' => 'app_user_index'],
 *   ]]
 *   ['label' => 'Docs', 'url' => 'https://adminlte.io', 'target' => '_blank']
 *
 * Supported keys: label, header, route, route_params, url, target, icon,
 * badge, badge_class, permission, children.
 */
final class MenuBuilder
{
    /**
     * @param array<int, array<string, mixed>> $menuConfig
     */
    public function __construct(
        private readonly UrlGeneratorInterface $urlGenerator,
        private readonly RequestStack $requestStack,
        private readonly ?AuthorizationCheckerInterface $authorizationChecker,
        private readonly array $menuConfig,
    ) {
    }

    /**
     * @return list<MenuItem>
     */
    public function build(): array
    {
        return $this->buildItems($this->menuConfig);
    }

    /**
     * @param array<int, array<string, mixed>> $items
     *
     * @return list<MenuItem>
     */
    private function buildItems(array $items): array
    {
        $result = [];

        foreach ($items as $raw) {
            if (!\is_array($raw) || !$this->isGranted($raw)) {
                continue;
            }

            if (isset($raw['header'])) {
                $result[] = new MenuItem(label: (string) $raw['header'], header: true);

                continue;
            }

            /** @var array<int, array<string, mixed>> $childConfig */
            $childConfig = $raw['children'] ?? [];
            $children = $this->buildItems($childConfig);
            $url = $this->resolveUrl($raw);

            $result[] = new MenuItem(
                label: (string) ($raw['label'] ?? ''),
                url: $url,
                icon: isset($raw['icon']) ? (string) $raw['icon'] : null,
                children: $children,
                active: $this->isActive($url, $children),
                badge: isset($raw['badge']) ? (string) $raw['badge'] : null,
                badgeClass: (string) ($raw['badge_class'] ?? 'text-bg-secondary'),
                target: isset($raw['target']) ? (string) $raw['target'] : null,
            );
        }

        return $result;
    }

    /**
     * @param array<string, mixed> $raw
     */
    private function resolveUrl(array $raw): ?string
    {
        if (isset($raw['url'])) {
            return (string) $raw['url'];
        }

        if (isset($raw['route'])) {
            /** @var array<string, mixed> $params */
            $params = $raw['route_params'] ?? [];

            return $this->urlGenerator->generate((string) $raw['route'], $params);
        }

        return null;
    }

    /**
     * A leaf is active when its URL matches the current path; a branch is active
     * when any descendant is active.
     *
     * @param list<MenuItem> $children
     */
    private function isActive(?string $url, array $children): bool
    {
        foreach ($children as $child) {
            if ($child->active) {
                return true;
            }
        }

        $request = $this->requestStack->getCurrentRequest();
        if (null === $request || null === $url || '' === $url || '#' === $url) {
            return false;
        }

        $path = $request->getPathInfo();
        if ($url === $path) {
            return true;
        }

        // Highlight ancestors of the current page, but never let "/" match everything.
        return '/' !== $url && str_starts_with($path, rtrim($url, '/').'/');
    }

    /**
     * @param array<string, mixed> $raw
     */
    private function isGranted(array $raw): bool
    {
        if (!isset($raw['permission'])) {
            return true;
        }

        if (null === $this->authorizationChecker) {
            return true;
        }

        try {
            return $this->authorizationChecker->isGranted($raw['permission']);
        } catch (\Throwable) {
            // No token yet (e.g. firewall not set up for this path): hide the item.
            return false;
        }
    }
}
