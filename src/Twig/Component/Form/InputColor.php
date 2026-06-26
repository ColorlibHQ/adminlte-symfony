<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Form;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * Bootstrap 5.3 native colour picker.
 *
 * Usage: <twig:Adminlte:InputColor name="accent" label="Accent colour" value="#0d6efd" />
 */
#[AsTwigComponent(name: 'Adminlte:InputColor', template: '@AdminLte/components/form/input_color.html.twig')]
final class InputColor
{
    public string $name;
    public ?string $label = null;
    public string $value = '#0d6efd';
    public ?string $help = null;
    public ?string $id = null;

    public function fieldId(): string
    {
        return $this->id ?? 'alte_'.$this->name;
    }
}
