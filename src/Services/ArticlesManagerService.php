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

    /**
     * @var \Cake\ORM\Table $articles
     */
    protected Table $articles;

    /**
     * __construct function
     */
    public function __construct()
    {
        $this->articles = $this->fetchTable('Articles');
    }

    /**
     * getAll function
     *
     * @return \Cake\ORM\Table
     */
    public function getAll(): Table
    {
        return $this->articles;
    }

    /**
     * getArticle function
     *
     * @param string $slug slug
     * @return \MeowBlog\Model\Entity\Article
     */
    public function getArticle(string $slug): Article
    {
        /** @var \MeowBlog\Model\Entity\Article $at */
        $at = $this->articles;

        /** @var \Cake\ORM\Query $q */
        $q = $at->findBySlug($slug);

        /** @var \MeowBlog\Model\Entity\Article $article */
        $article = $q->contain(['Users', 'Tags'])->firstOrfail();

        return $article;
    }

    /**
     * saveToDatabase function
     *
     * @param \MeowBlog\Model\Entity\Article $article model
     * @param \Cake\Http\ServerRequest $request from passed request
     * @return \MeowBlog\Model\Entity\Article|false
     */
    public function saveToDatabase(Article $article, ServerRequest $request): Article | false
    {
        $article = $this->articles->patchEntity($article, $request->getData());

        /** @var \MeowBlog\Model\Entity\Article $article */
        $article->user_id = $request->getAttribute('identity')->getIdentifier();

        /** @var \MeowBlog\Model\Entity\Article $savedArticle */
        $savedArticle = $this->articles->save($article);

        return $savedArticle;
    }
}
