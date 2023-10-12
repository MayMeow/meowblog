<?php
declare(strict_types=1);

namespace MeowBlog\Model\View;

use Cake\Datasource\Paging\PaginatedInterface;
use MeowBlog\Model\Entity\Article;

/**
 * @deprecated
 * @see https://github.com/MayMeow/meowblog/pull/48
 */
class ArticleViewModel
{
    protected bool $isCurrentBlog;

    protected Article $article;

    public function __construct(Article $article, bool $isCurrentBlog = false)
    {
        $this->article = $article;
        $this->isCurrentBlog = $isCurrentBlog;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }

    public function isCurrentBlog(): bool
    {
        return $this->isCurrentBlog;
    }
}