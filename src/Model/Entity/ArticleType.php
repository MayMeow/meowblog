<?php
declare(strict_types=1);

namespace MeowBlog\Model\Entity;

enum ArticleType: string
{
    case Article = 'meowblog/articles.type.article';
    case Page = 'meowblog/articles.type.page';
}