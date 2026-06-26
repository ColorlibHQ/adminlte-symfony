<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Widget;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * Topbar tasks dropdown (label + progress). Place inside <twig:Adminlte:Topbar>.
 *
 * Usage:
 *   <twig:Adminlte:NavTasks badge="5" :items="[
 *       { text: 'Design some buttons', progress: 20, variant: 'danger' },
 *   ]" />
 */
#[AsTwigComponent(name: 'Adminlte:NavTasks', template: '@AdminLte/components/widget/nav_tasks.html.twig')]
final class NavTasks
{
    public string $icon = 'bi bi-list-check';

    /** @var list<array{text: string, progress: int, variant?: string, url?: string}> */
    public array $items = [];
    public ?string $badge = null;
    public string $badgeClass = 'text-bg-success';
    public string $footerText = 'See all tasks';
    public ?string $footerUrl = null;
}
