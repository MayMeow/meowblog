<?php
declare(strict_types=1);

namespace MeowBlog\Services;

use Cake\Http\ServerRequest;
use Cake\ORM\Table;
use MeowBlog\Model\Entity\Article;

interface ArticlesManagerServiceInterface
{
    /**
     * getArticle function
     *
     * @param string $slug
     * @return Article
     */
    public function getArticle(string $slug): Article;

    /**
     * getAll function
     *
     * @return Table
     */
    public function getAll(): Table;

    /**
     * saveToDatabase function
     *
     * @param Article $article model
     * @param ServerRequest $request from passed request
     * @return Article|false
     */
    public function saveToDatabase(Article $article, ServerRequest $request): Article|false;
}