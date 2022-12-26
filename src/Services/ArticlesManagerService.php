<?php
declare(strict_types=1);

namespace MeowBlog\Services;

use Cake\Http\ServerRequest;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\ORM\Table;
use MeowBlog\Model\Entity\Article;

class ArticlesManagerService implements ArticlesManagerServiceInterface
{
    use LocatorAwareTrait;
    protected Table $articles;

    public function __construct()
    {
        $this->articles = $this->fetchTable('Articles');
    }

    public function getAll(): Table
    {
        return $this->articles;
    }

    /**
     * getArticle function
     *
     * @param string $slug
     * @return Article
     */
    public function getArticle(string $slug): Article
    {
        $q = $this->articles->findBySlug($slug);

        return $q->contain(['Users', 'Tags'])->firstOrfail();
    }

    /**
     * saveToDatabase function
     *
     * @param Article $article model
     * @param ServerRequest $request from passed request
     * @return Article|false
     */
    public function saveToDatabase(Article $article, ServerRequest $request): Article|false
    {
        $article = $this->articles->patchEntity($article, $request->getData());
        $article->user_id = $request->getAttribute('identity')->getIdentifier();

        return $this->articles->save($article);
    }
}