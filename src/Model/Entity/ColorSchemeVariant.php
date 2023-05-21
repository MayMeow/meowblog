<?php
declare(strict_types=1);

namespace MeowBlog\Model\Entity;

enum ColorSchemeVariant: string
{
    case Default = 'auto';
    case Light = 'light';
    case Dark = 'dark';

    public static function list(): array
    {
        $list = [];
        foreach (self::cases() as $case) {
            $list[$case->value] = $case->name;
        }

        return $list;
    }
}