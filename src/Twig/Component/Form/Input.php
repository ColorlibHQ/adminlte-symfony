<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Form;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * A labelled Bootstrap 5.3 form control with an optional input-group icon.
 *
 * Usage:
 *   <twig:Adminlte:Input name="email" type="email" label="Email"
 *       icon="bi bi-envelope" placeholder="you@example.com" required />
 */
#[AsTwigComponent(name: 'Adminlte:Input', template: '@AdminLte/components/form/input.html.twig')]
final class Input
{
    public string $name;
    public string $type = 'text';
    public ?string $label = null;
    public ?string $value = null;
    public ?string $placeholder = null;
    public ?string $icon = null;
    public ?string $help = null;
    public bool $required = false;
    public ?string $id = null;

    public function inputId(): string
    {
        return $this->id ?? 'alte_'.$this->name;
    }
}
