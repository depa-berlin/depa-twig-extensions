<?php

namespace Depa\TwigExtensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class ShuffleExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('shuffle', [ $this , 'twigShuffleFilter']),
        ];
    }

    /**
     * Shuffles an array.
     *
     * @param array|\Traversable $array An array
     *
     * @return array
     */
    function twigShuffleFilter($array)
    {
        if ($array instanceof \Traversable) {
            $array = iterator_to_array($array, false);
        }

        shuffle($array);

        return $array;
    }
}
