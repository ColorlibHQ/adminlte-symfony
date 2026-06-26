<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Menu;

/**
 * A single, resolved entry in the sidebar menu tree.
 *
 * Produced by {@see MenuBuilder} from the config-driven menu definition with
 * routes already resolved to URLs and the active state computed for the
 * current request.
 */
final class MenuItem
{
    /**
     * @param list<MenuItem> $children
     */
    public function __construct(
        public readonly string $label,
        public readonly ?string $url = null,
        public readonly ?string $icon = null,
        public readonly array $children = [],
        public readonly bool $active = false,
        public readonly ?string $badge = null,
        public readonly string $badgeClass = 'text-bg-secondary',
        public readonly bool $header = false,
        public readonly ?string $target = null,
    ) {
    }

    public function hasChildren(): bool
    {
        return [] !== $this->children;
    }
}
