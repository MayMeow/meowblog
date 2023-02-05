<?php
declare(strict_types=1);

namespace MeowBlog\Services;

use Cake\Http\ServerRequest;
use Cake\ORM\Query;
use Cake\ORM\Table;
use MeowBlog\Model\Entity\Article;

interface ArticlesManagerServiceInterface
{
    /**
     * getArticle function
     *
     * @param string $slug slug
     * @return \MeowBlog\Model\Entity\Article
     */
    public function getArticle(string $slug): Article;

    /**
     * getAll function
     *
     * @param \Cake\Http\ServerRequest $request from passed request
     * @return \Cake\ORM\Table|\Cake\ORM\Query
     */
    public function getAll(ServerRequest $request): Table | Query;

    /**
     * saveToDatabase function
     *
     * @param \MeowBlog\Model\Entity\Article $article model
     * @param \Cake\Http\ServerRequest $request from passed request
     * @return \MeowBlog\Model\Entity\Article|false
     */
    public function saveToDatabase(Article $article, ServerRequest $request): Article | false;
}
