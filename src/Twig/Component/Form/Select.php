<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Form;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * Labelled Bootstrap 5.3 select.
 *
 * Usage:
 *   <twig:Adminlte:Select name="role" label="Role" value="editor" :options="[
 *       { value: 'admin', label: 'Administrator' },
 *       { value: 'editor', label: 'Editor' },
 *   ]" />
 */
#[AsTwigComponent(name: 'Adminlte:Select', template: '@AdminLte/components/form/select.html.twig')]
final class Select
{
    public string $name;
    public ?string $label = null;

    /** @var list<array{value: string, label: string}> */
    public array $options = [];
    public ?string $value = null;
    public bool $required = false;
    public bool $multiple = false;
    public ?string $help = null;
    public ?string $id = null;

    public function fieldId(): string
    {
        return $this->id ?? 'alte_'.$this->name;
    }
}
