<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Widget;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * Bootstrap 5.3 nav-tabs inside a card. Each item is
 * `{ id, title, content (HTML), active? }`.
 *
 * Usage:
 *   <twig:Adminlte:Tabs id="demo" :items="[
 *       { id: 'home', title: 'Home', content: '<p>…</p>', active: true },
 *       { id: 'profile', title: 'Profile', content: '<p>…</p>' },
 *   ]" />
 */
#[AsTwigComponent(name: 'Adminlte:Tabs', template: '@AdminLte/components/widget/tabs.html.twig')]
final class Tabs
{
    public string $id = 'tabs';

    /** @var list<array{id: string, title: string, content?: string, active?: bool}> */
    public array $items = [];
}
