<?php
declare(strict_types=1);

namespace MeowBlog\Services;

use Cake\Datasource\Paging\PaginatedResultSet;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\ServerRequest;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\ORM\Query;
use Cake\ORM\Query\SelectQuery;
use Cake\ORM\ResultSet;
use Cake\ORM\Table;
use Cake\Utility\Text;
use MeowBlog\Controller\AppController;
use MeowBlog\Model\Entity\Node;
use MeowBlog\Model\Entity\NodeType;
use MeowBlog\Model\Table\NodesTable;
use MeowBlog\Model\View\NodeViewModel;

class NodesManagerService implements NodesManagerServiceInterface
{
    use LocatorAwareTrait;

    /**
     * @var \Cake\ORM\Table $nodes
     */
    protected Table | NodesTable $nodes;

    /**
     * __construct function
     */
    public function __construct()
    {
        $this->nodes = $this->fetchTable('Nodes');
    }

    /**
     * getAll function
     * 
     * !! consolidate this. Each service should only return SelectQuery
     *
     * @return ResultSetInterface|PaginatedResultSet|SelectQuery
     */
    public function getAll(ServerRequest $request, AppController $controller, bool $paginate = true, NodeType $nodeType = NodeType::Node, bool $publishedOnly = true): ResultSetInterface|PaginatedResultSet|SelectQuery
    {   
        $domain = $controller->getRequest()->getUri()->getHost();
        $blog = $this->nodes->Blogs->find('domain', domain: $domain)->first();

        // if blog exists find only blog's node otherwise find show all
        if ($blog) {
            $nodes = $this->nodes->find()->contain(['Users', 'Blogs'])->where([
                'Nodes.blog_id' => $blog->id,
                'Nodes.node_type' => $nodeType->value,
            ]);
        } else {
            $nodes = $this->nodes->find()->contain(['Users', 'Blogs'])->where([
                'Nodes.node_type' => $nodeType->value,
            ]);
        }

        if ($publishedOnly) {
            $nodes = $nodes->where(['Nodes.published' => 1]);
        }
        
        if ($paginate) {
            $nodes = $controller->paginate($nodes);
        }

        return $nodes;
    }

    /**
     * getNode function
     *
     * @param string $slug slug
     * !! use NodeController instead, it contains ServerRequest
     * @param \Cake\Http\ServerRequest $request from passed request
     * @return \MeowBlog\Model\Entity\Node
     */
    public function getNode(string $slug, ServerRequest $request): Node
    {
        /** @var \MeowBlog\Model\Table\NodesTable $nodeTable */
        $nodeTable = $this->nodes;

        /** @var \Cake\ORM\Query $q */
        $q = $nodeTable->find('slug', slug: $slug)->where(['Blogs.domain' => $request->getUri()->getHost()]);

        /** @var \MeowBlog\Model\Entity\Node $node */
        $node = $q->contain(['Users', 'Tags', 'Blogs'])->firstOrfail();

        return $node;
    }

    /**
     * saveToDatabase function
     *
     * @param \MeowBlog\Model\Entity\Node $node model
     * @param \Cake\Http\ServerRequest $request from passed request
     * @return \MeowBlog\Model\Entity\Node|false
     */
    public function saveToDatabase(Node $node, ServerRequest $request): Node | false
    {
        $node = $this->nodes->patchEntity($node, $request->getData());

        /** @var \MeowBlog\Model\Entity\Node $node */
        $node->user_id = $request->getAttribute('identity')->getIdentifier();

        /** @var \MeowBlog\Model\Entity\Node $savedNode */
        $savedNode = $this->nodes->save($node);

        return $savedNode;
    }

    public function getHomePageContent(ServerRequest $request): ?string
    {
        /** @var \MeowBlog\Model\Table\NodesTable $nodeTable */
        $nodeTable = $this->nodes;

        /** @var \Cake\ORM\Query $q */
        $q = $nodeTable->find('slug', slug: Text::slug($request->getUri()->getHost()))->where([
            'Blogs.domain' => $request->getUri()->getHost(),
            'Nodes.node_type' => NodeType::Page->value,
            'Nodes.published' => 1,
        ]);

        /** @var \MeowBlog\Model\Entity\Node $savedNode */
        $node = $q->contain(['Blogs'])->first();

        return $node ? $node->body : null;
    }

    public function getLatestNowPageContent(ServerRequest $request): ?Node
    {
        $node = $this->nodes->find('now', domain: $request->getUri()->getHost())->first();

        return $node ? $node : null;
    }
}
