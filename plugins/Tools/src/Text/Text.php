<?php
declare(strict_types=1);

namespace Tools\Text;

class Text
{

    /**
     * Converts a string to camel case.
     *
     * @param string $string The string to convert.
     * @param bool $capitalizeFirstCharacter If true, capitalize the first character in $string.
     * @return string The converted string.
     */
    public function underscoreToCammelCase(string $string, bool $capitalizeFirstCharacter = false): string
    {
        $cammelCaed =  str_replace('_', '', ucwords($string, '_'));

        if (!$capitalizeFirstCharacter) {
            $cammelCaed = lcfirst($cammelCaed);
        }

        return $cammelCaed;
    }

    /**
     * Converts a string to underscore case.
     *
     * @param string $string The string to convert.
     * @return string The converted string.
     */
    public function cammelCaseToUnderscore(string $string): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $string));
    }
}