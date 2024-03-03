<?php
declare(strict_types=1);

namespace MeowBlog\Services;

use Cake\Database\Query\SelectQuery;
use Cake\Datasource\Paging\PaginatedResultSet;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\ServerRequest;
use Cake\ORM\Query;
use Cake\ORM\ResultSet;
use Cake\ORM\Table;
use MeowBlog\Controller\AppController;
use MeowBlog\Model\Entity\Node;
use MeowBlog\Model\Entity\NodeType;

interface NodesManagerServiceInterface
{
    /**
     * getNode function
     *
     * @param string $slug slug
     * @param \Cake\Http\ServerRequest $request from passed request
     * @return \MeowBlog\Model\Entity\Node
     */
    public function getNode(string $slug, ServerRequest $request): Node;

    /**
     * getAll function
     *
     * @param \Cake\Http\ServerRequest $request from passed request
     * @param bool $paginate whether to paginate or not
     * @param NodeType $nodeType node type
     * @param bool $publishedOnly whether to only get published nodes
     * @return ResultSetInterface|PaginatedResultSet|SelectQuery;
     */
    public function getAll(ServerRequest $request, AppController $controller, bool $paginate = true, NodeType $nodeType = NodeType::Node, bool $publishedOnly = true): ResultSetInterface|PaginatedResultSet|SelectQuery;

    /**
     * saveToDatabase function
     *
     * @param \MeowBlog\Model\Entity\Node $node model
     * @param \Cake\Http\ServerRequest $request from passed request
     * @return \MeowBlog\Model\Entity\Node|false
     */
    public function saveToDatabase(Node $node, ServerRequest $request): Node | false;

    /**
     * Return content of the homepage nodes
     * Home-page nodes are nodes that have title matched with the blog domain type must be Page
     *
     * @param ServerRequest $request
     * @return string|null
     */
    public function getHomePageContent(ServerRequest $request): ?string;

    /**
     * Return content of latest node (type: Node) tagged with Now
     *
     * @param ServerRequest $request
     * @return Node|null
     */
    public function getLatestNowPageContent(ServerRequest $request): ?Node;
}
