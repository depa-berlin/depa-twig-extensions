<?php

namespace Depa\TwigExtensions;

use FileEye\MimeMap\Extension;
use FileEye\MimeMap\MalformedTypeException;
use FileEye\MimeMap\Type;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Class TemplateVarExtension
 * @package FileRepository\TwigExtension
 */
class MimeTypeExtension extends AbstractExtension
{

    public function getFilters(): array
    {
        return [
            new TwigFilter('mimetype', [$this, 'mimeTypeFilter']),
        ];
    }

    /**
     * @param $var
     * @param $type
     * @return string|null String with the object name or url
     * @example {{ fileRepository('(application/pdf', 'name')}}
     */

    /**
     * @param string $data
     * @param string $type
     * @param false $strict
     * @return string|null
     * @example {{ file.mime | mimetype('getDefaultExtension',true)}}
     */
    function mimeTypeFilter(?string $data, $type = 'getDefaultExtension', $strict = false): ?string
    {

        switch ($type) {
            case 'getDefaultExtension':
                try {
                    $mimeMapType = new Type($data);
                    return $mimeMapType->getDefaultExtension($strict);
                    break;
                }catch (MalformedTypeException $e){
                    return "";
                    break;
                }
            case 'getDefaultType':
                $ext = new Extension($data);
                return $ext->getDefaultType($strict);
                break;
            default:
                return $data . " >>$type unknown";
        }
    }
}
