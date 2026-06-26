<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Widget;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * Topbar messages dropdown. Place inside <twig:Adminlte:Topbar>.
 *
 * Usage:
 *   <twig:Adminlte:NavMessages badge="2" :items="[
 *       { image: '/img/u1.jpg', name: 'Brad Diesel', message: 'Call me…', time: '4 hours' },
 *   ]" />
 */
#[AsTwigComponent(name: 'Adminlte:NavMessages', template: '@AdminLte/components/widget/nav_messages.html.twig')]
final class NavMessages
{
    public string $icon = 'bi bi-chat-text-fill';

    /** @var list<array{image?: string, name: string, message: string, time?: string, url?: string}> */
    public array $items = [];
    public ?string $badge = null;
    public string $badgeClass = 'text-bg-danger';
    public string $footerText = 'See all messages';
    public ?string $footerUrl = null;
}
