<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Widget;

use ColorlibHQ\AdminLteBundle\Menu\MenuBuilder;
use ColorlibHQ\AdminLteBundle\Menu\MenuItem;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * ⌘K / Ctrl-K command palette. Indexes the sidebar menu into a searchable,
 * keyboard-navigable overlay (driven by the `adminlte--command-palette`
 * Stimulus controller). Drop it once, anywhere inside the layout.
 *
 * Usage: <twig:Adminlte:CommandPalette />
 */
#[AsTwigComponent(name: 'Adminlte:CommandPalette', template: '@AdminLte/components/widget/command_palette.html.twig')]
final class CommandPalette
{
    public function __construct(
        private readonly MenuBuilder $menuBuilder,
    ) {
    }

    /**
     * @return list<array{label: string, url: string, icon: string|null, group: string|null}>
     */
    public function getCommands(): array
    {
        $commands = [];
        $this->flatten($this->menuBuilder->build(), $commands, null);

        return $commands;
    }

    /**
     * @param list<MenuItem>                                                                 $items
     * @param list<array{label: string, url: string, icon: string|null, group: string|null}> $out
     */
    private function flatten(array $items, array &$out, ?string $group): void
    {
        foreach ($items as $item) {
            if ($item->header) {
                continue;
            }

            if ($item->hasChildren()) {
                $this->flatten($item->children, $out, $item->label);
            } elseif (null !== $item->url && '#' !== $item->url) {
                $out[] = [
                    'label' => $item->label,
                    'url' => $item->url,
                    'icon' => $item->icon,
                    'group' => $group,
                ];
            }
        }
    }
}
