<?php
declare(strict_types=1);

namespace MeowBlog\Services;

use Cake\Http\ServerRequest;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\ORM\Query;
use Cake\ORM\Table;
use MeowBlog\Model\Entity\Article;
use MeowBlog\Model\Table\ArticlesTable;

class ArticlesManagerService implements ArticlesManagerServiceInterface
{
    use LocatorAwareTrait;

    /**
     * @var \Cake\ORM\Table $articles
     */
    protected Table | ArticlesTable $articles;

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
     * @return \Cake\ORM\Table|\Cake\ORM\Query
     */
    public function getAll(ServerRequest $request): Table | Query
    {   
        try {
            $blog = $this->articles->Blogs->find()->where(['Blogs.domain' => $request->getUri()->getHost()])->firstOrFail();

            return $this->articles->find()->where(['Articles.blog_id' => $blog->id]);
        } catch (\Exception $e) {
            // do nothing here
        }

        return $this->articles;
    }

    /**
     * getArticle function
     *
     * @param string $slug slug
     * @param \Cake\Http\ServerRequest $request from passed request
     * @return \MeowBlog\Model\Entity\Article
     */
    public function getArticle(string $slug, ServerRequest $request): Article
    {
        /** @var \MeowBlog\Model\Table\ArticlesTable $at */
        $at = $this->articles;

        /** @var \Cake\ORM\Query $q */
        $q = $at->findBySlug($slug)->where(['Blogs.domain' => $request->getUri()->getHost()]);

        /** @var \MeowBlog\Model\Entity\Article $article */
        $article = $q->contain(['Users', 'Tags', 'Blogs'])->firstOrfail();

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
