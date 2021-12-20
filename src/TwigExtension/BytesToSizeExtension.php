<?php

namespace Depa\TwigExtensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class TemplateVarExtension
 * @package FileRepository\TwigExtension
 */
class BytesToSizeExtension extends AbstractExtension
{

    public function getFunctions(): array
    {
        return [
            new TwigFunction('bytesToSize', [$this, 'bytesToSizeFunction']),
        ];
    }

    /**
     * @param $var
     * @param $type
     * @return string|null String with the object name or url
     * @example {{ fileRepository('bvs-Imagebroschüre', 'name')}}
     */
    function bytesToSizeFunction($bytes): ?string
    {
        $kilobyte = 1024;
        $megabyte = $kilobyte * 1024;
        $gigabyte = $megabyte * 1024;
        $terabyte = $gigabyte * 1024;

        if($bytes < $kilobyte)
        {
            return $bytes. ' B';
        }elseif ($bytes < $megabyte)
        {
            return number_format(($bytes/$kilobyte),2).' KiB';
        }
        elseif ($bytes < $gigabyte)
        {
            return number_format(($bytes/$megabyte),2).' MiB';
        }
        elseif ($bytes < $terabyte)
        {
            return number_format(($bytes/$gigabyte),2).' GiB';
        }
        else{
            return number_format(($bytes/$terabyte),2).' TiB';
        }
        return NULL;
    }
}
