<?php
declare(strict_types=1);

namespace MeowBlog\Model\Entity;

enum ArticleType: string
{
    case Article = 'meowblog/articles.type.article';
    case Page = 'meowblog/articles.type.page';
    case Micro = 'meowblog/articles.type.micro';

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