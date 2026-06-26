<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Form;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * Bootstrap 5.3 button. Renders an `<a>` when `url` is set, otherwise a `<button>`.
 *
 * Usage:
 *   <twig:Adminlte:Button variant="primary" icon="bi bi-save" type="submit">Save</twig:Adminlte:Button>
 */
#[AsTwigComponent(name: 'Adminlte:Button', template: '@AdminLte/components/form/button.html.twig')]
final class Button
{
    /** primary | secondary | success | info | warning | danger | light | dark | link */
    public string $variant = 'primary';
    public string $type = 'button';
    public ?string $icon = null;
    public ?string $url = null;

    /** sm | lg | null */
    public ?string $size = null;
    public bool $outline = false;
    public bool $disabled = false;

    public function buttonClass(): string
    {
        $classes = ['btn', 'btn-'.($this->outline ? 'outline-' : '').$this->variant];

        if (null !== $this->size && '' !== $this->size) {
            $classes[] = 'btn-'.$this->size;
        }

        return implode(' ', $classes);
    }
}
