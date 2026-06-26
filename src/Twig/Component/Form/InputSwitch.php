<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Form;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * Bootstrap 5.3 switch (toggle checkbox).
 *
 * Usage: <twig:Adminlte:InputSwitch name="notifications" label="Email notifications" checked />
 */
#[AsTwigComponent(name: 'Adminlte:InputSwitch', template: '@AdminLte/components/form/input_switch.html.twig')]
final class InputSwitch
{
    public string $name;
    public ?string $label = null;
    public bool $checked = false;
    public string $value = '1';
    public bool $required = false;
    public ?string $id = null;

    public function fieldId(): string
    {
        return $this->id ?? 'alte_'.$this->name;
    }
}
