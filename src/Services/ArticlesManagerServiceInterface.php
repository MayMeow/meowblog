<?php
declare(strict_types=1);

namespace MeowBlog\Services;

use Cake\Http\ServerRequest;
use Cake\ORM\Query;
use Cake\ORM\Table;
use MeowBlog\Controller\AppController;
use MeowBlog\Model\Entity\Article;
use MeowBlog\Model\Entity\ArticleType;

interface ArticlesManagerServiceInterface
{
    /**
     * getArticle function
     *
     * @param string $slug slug
     * @param \Cake\Http\ServerRequest $request from passed request
     * @return \MeowBlog\Model\Entity\Article
     */
    public function getArticle(string $slug, ServerRequest $request): Article;

    /**
     * getAll function
     *
     * @param \Cake\Http\ServerRequest $request from passed request
     * @param bool $paginate whether to paginate or not
     * @param ArticleType $articleType article type
     * @param bool $publishedOnly whether to only get published articles
     * @return array<\MeowBlog\Model\View\ArticleViewModel> array of articles
     */
    public function getAll(ServerRequest $request, AppController $controller, bool $paginate = true, ArticleType $articleType = ArticleType::Article, bool $publishedOnly = true): array;

    /**
     * saveToDatabase function
     *
     * @param \MeowBlog\Model\Entity\Article $article model
     * @param \Cake\Http\ServerRequest $request from passed request
     * @return \MeowBlog\Model\Entity\Article|false
     */
    public function saveToDatabase(Article $article, ServerRequest $request): Article | false;

    /**
     * Return content of the homepage articles
     * Home-page articles are articles that have title matched with the blog domain type must be Page
     *
     * @param ServerRequest $request
     * @return string|null
     */
    public function getHomePageContent(ServerRequest $request): ?string;

    /**
     * Return content of latest article (type: Article) tagged with Now
     *
     * @param ServerRequest $request
     * @return Article|null
     */
    public function getLatestNowPageContent(ServerRequest $request): ?Article;
}
