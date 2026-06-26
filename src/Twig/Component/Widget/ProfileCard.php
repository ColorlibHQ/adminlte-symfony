<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Widget;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * AdminLTE 4 profile card (avatar + name + title + optional body slot).
 *
 * Usage:
 *   <twig:Adminlte:ProfileCard name="Nina Mcintire" title="Software Engineer" image="/img/user.jpg" variant="primary">
 *       …list-group / stats…
 *   </twig:Adminlte:ProfileCard>
 */
#[AsTwigComponent(name: 'Adminlte:ProfileCard', template: '@AdminLte/components/widget/profile_card.html.twig')]
final class ProfileCard
{
    public string $name = '';
    public ?string $title = null;
    public ?string $image = null;

    /** primary | secondary | success | info | warning | danger */
    public string $variant = 'primary';
}
