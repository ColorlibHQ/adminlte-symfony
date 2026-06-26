<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Widget;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * AdminLTE 4 timeline container. Wrap one or more <twig:Adminlte:TimelineItem />.
 */
#[AsTwigComponent(name: 'Adminlte:Timeline', template: '@AdminLte/components/widget/timeline.html.twig')]
final class Timeline
{
}
