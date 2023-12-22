<?php
declare(strict_types=1);

namespace MeowBlog\Services;

use Cake\Datasource\Paging\PaginatedResultSet;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\ServerRequest;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\ORM\Query;
use Cake\ORM\ResultSet;
use Cake\ORM\Table;
use Cake\Utility\Text;
use MeowBlog\Controller\AppController;
use MeowBlog\Model\Entity\Article;
use MeowBlog\Model\Entity\ArticleType;
use MeowBlog\Model\Table\ArticlesTable;
use MeowBlog\Model\View\ArticleViewModel;

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
    public function getAll(ServerRequest $request, AppController $controller, bool $paginate = true, ArticleType $articleType = ArticleType::Article, bool $publishedOnly = true): ResultSetInterface|PaginatedResultSet
    {   
        $domain = $request->getUri()->getHost();
        $blog = $this->articles->Blogs->find('domain', domain: $domain)->first();

        // if blog exists find only blog's article otherwise find show all
        if ($blog) {
            $articles = $this->articles->find()->contain(['Users', 'Blogs'])->where([
                'Articles.blog_id' => $blog->id,
                'Articles.article_type' => $articleType->value,
            ]);
        } else {
            $articles = $this->articles->find()->contain(['Users', 'Blogs'])->where([
                'Articles.article_type' => $articleType->value,
            ]);
        }

        if ($publishedOnly) {
            $articles = $articles->where(['Articles.published' => 1]);
        }
        
        if ($paginate) {
            $articles = $controller->paginate($articles);
        }

        return $articles;
    }

    /**
     * getArticle function
     *
     * @param string $slug slug
     * !! use ArticleController instead, it contains ServerRequest
     * @param \Cake\Http\ServerRequest $request from passed request
     * @return \MeowBlog\Model\Entity\Article
     */
    public function getArticle(string $slug, ServerRequest $request): Article
    {
        /** @var \MeowBlog\Model\Table\ArticlesTable $articleTable */
        $articleTable = $this->articles;

        /** @var \Cake\ORM\Query $q */
        $q = $articleTable->find('slug', slug: $slug)->where(['Blogs.domain' => $request->getUri()->getHost()]);

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

    public function getHomePageContent(ServerRequest $request): ?string
    {
        /** @var \MeowBlog\Model\Table\ArticlesTable $articleTable */
        $articleTable = $this->articles;

        /** @var \Cake\ORM\Query $q */
        $q = $articleTable->find('slug', slug: Text::slug($request->getUri()->getHost()))->where([
            'Blogs.domain' => $request->getUri()->getHost(),
            'Articles.article_type' => ArticleType::Page->value,
            'Articles.published' => 1,
        ]);

        /** @var \MeowBlog\Model\Entity\Article $savedArticle */
        $article = $q->contain(['Blogs'])->first();

        return $article ? $article->body : null;
    }

    public function getLatestNowPageContent(ServerRequest $request): ?Article
    {
        $article = $this->articles->find('now', domain: $request->getUri()->getHost())->first();

        return $article ? $article : null;
    }
}
