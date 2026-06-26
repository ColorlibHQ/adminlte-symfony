<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Widget;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * Bootstrap 5.3 modal. Body is the default slot; open it with a trigger using
 * `data-bs-toggle="modal" data-bs-target="#{id}"`.
 *
 * Usage:
 *   <twig:Adminlte:Modal id="confirm" title="Confirm" size="lg" centered footer="<button class='btn btn-primary'>OK</button>">
 *       Are you sure?
 *   </twig:Adminlte:Modal>
 */
#[AsTwigComponent(name: 'Adminlte:Modal', template: '@AdminLte/components/widget/modal.html.twig')]
final class Modal
{
    public string $id;
    public ?string $title = null;

    /** '' | sm | lg | xl */
    public string $size = '';
    public bool $scrollable = false;
    public bool $centered = false;
    public ?string $footer = null;

    public function dialogClass(): string
    {
        $classes = ['modal-dialog'];

        if ('' !== $this->size) {
            $classes[] = 'modal-'.$this->size;
        }
        if ($this->centered) {
            $classes[] = 'modal-dialog-centered';
        }
        if ($this->scrollable) {
            $classes[] = 'modal-dialog-scrollable';
        }

        return implode(' ', $classes);
    }
}
