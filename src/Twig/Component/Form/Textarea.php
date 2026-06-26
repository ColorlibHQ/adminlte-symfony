<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Form;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * Labelled Bootstrap 5.3 textarea.
 *
 * Usage: <twig:Adminlte:Textarea name="bio" label="Biography" :rows="4" placeholder="…" />
 */
#[AsTwigComponent(name: 'Adminlte:Textarea', template: '@AdminLte/components/form/textarea.html.twig')]
final class Textarea
{
    public string $name;
    public ?string $label = null;
    public ?string $value = null;
    public ?string $placeholder = null;
    public int $rows = 3;
    public bool $required = false;
    public ?string $help = null;
    public ?string $id = null;

    public function fieldId(): string
    {
        return $this->id ?? 'alte_'.$this->name;
    }
}
