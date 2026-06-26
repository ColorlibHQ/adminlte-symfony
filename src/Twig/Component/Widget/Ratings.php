<?php

declare(strict_types=1);

namespace ColorlibHQ\AdminLteBundle\Twig\Component\Widget;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/**
 * Star rating display.
 *
 * Usage: <twig:Adminlte:Ratings :value="3.5" :max="5" variant="warning" showValue />
 */
#[AsTwigComponent(name: 'Adminlte:Ratings', template: '@AdminLte/components/widget/ratings.html.twig')]
final class Ratings
{
    public float $value = 0.0;
    public int $max = 5;

    /** Star colour. */
    public string $variant = 'warning';
    public bool $showValue = false;

    /**
     * @return list<'full'|'half'|'empty'>
     */
    public function stars(): array
    {
        $stars = [];
        for ($i = 1; $i <= $this->max; ++$i) {
            if ($this->value >= $i) {
                $stars[] = 'full';
            } elseif ($this->value >= $i - 0.5) {
                $stars[] = 'half';
            } else {
                $stars[] = 'empty';
            }
        }

        return $stars;
    }
}
