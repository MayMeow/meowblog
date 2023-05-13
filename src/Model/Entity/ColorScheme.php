<?php
declare(strict_types=1);

namespace MeowBlog\Model\Entity;

enum ColorScheme: string
{
    case Amber = 'themes/amber';
    case BlueGrey = 'themes/blue-grey';
    case Blue = 'themes/blue';
    case Cyan = 'themes/cyan';
    case DeepOrange = 'themes/deep-orange';
    case DeepPurple = 'themes/deep-purple';
    case Green = 'themes/green';
    case Indigo = 'themes/indigo';
    case LightBlue = 'themes/light-blue';
    case LightGreen = 'themes/light-green';
    case Lime = 'themes/lime';
    case Orange = 'themes/orange';
    case Pink = 'themes/pink';
    case Purple = 'themes/purple';
    case Red = 'themes/red';
    case Teal = 'themes/teal';
    case Yellow = 'themes/yellow';

    /**
     * Return list of cases that is uuitable for use with Html Selects
     *
     * @return array
     */
    public static function list(): array
    {
        $list = [];
        foreach (self::cases() as $case) {
            $list[$case->value] = $case->name;
        }

        return $list;
    }
}