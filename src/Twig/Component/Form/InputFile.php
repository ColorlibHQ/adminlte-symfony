<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Form;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * Labelled Bootstrap 5.3 file input.
 *
 * Usage: <twig:Adminlte:InputFile name="avatar" label="Avatar" accept="image/*" help="PNG or JPG." />
 */
#[AsTwigComponent(name: 'Adminlte:InputFile', template: '@AdminLte/components/form/input_file.html.twig')]
final class InputFile
{
    public string $name;
    public ?string $label = null;
    public bool $multiple = false;
    public ?string $accept = null;
    public bool $required = false;
    public ?string $help = null;
    public ?string $id = null;

    public function fieldId(): string
    {
        return $this->id ?? 'alte_'.$this->name;
    }
}
