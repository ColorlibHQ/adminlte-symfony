<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Widget;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * Bootstrap 5.3 accordion wrapper. Pass the same `id` to each child
 * <twig:Adminlte:AccordionItem :parent="id"> for single-open behaviour.
 *
 * Usage:
 *   <twig:Adminlte:Accordion id="faq">
 *       <twig:Adminlte:AccordionItem id="q1" parent="faq" title="Question?" open>Answer</twig:Adminlte:AccordionItem>
 *   </twig:Adminlte:Accordion>
 */
#[AsTwigComponent(name: 'Adminlte:Accordion', template: '@AdminLte/components/widget/accordion.html.twig')]
final class Accordion
{
    public string $id;
    public bool $flush = false;
}
