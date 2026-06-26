<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Widget;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * Topbar notifications dropdown. Place inside <twig:Adminlte:Topbar>.
 *
 * Usage:
 *   <twig:Adminlte:NavNotifications badge="3" :items="[
 *       { icon: 'bi bi-envelope', text: '4 new messages', time: '3 mins' },
 *   ]" />
 */
#[AsTwigComponent(name: 'Adminlte:NavNotifications', template: '@AdminLte/components/widget/nav_notifications.html.twig')]
final class NavNotifications
{
    public string $icon = 'bi bi-bell-fill';

    /** @var list<array{icon?: string, text: string, time?: string, url?: string}> */
    public array $items = [];
    public ?string $badge = null;
    public string $badgeClass = 'text-bg-warning';
    public string $footerText = 'See all notifications';
    public ?string $footerUrl = null;
}
