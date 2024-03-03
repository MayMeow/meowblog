<?php
declare(strict_types=1);

namespace MeowBlog\Model\View;

use Cake\Datasource\Paging\PaginatedInterface;
use MeowBlog\Model\Entity\Node;

/**
 * @deprecated
 * @see https://github.com/MayMeow/meowblog/pull/48
 */
class NodeViewModel
{
    protected bool $isCurrentBlog;

    protected Node $node;

    public function __construct(Node $node, bool $isCurrentBlog = false)
    {
        $this->node = $node;
        $this->isCurrentBlog = $isCurrentBlog;
    }

    public function getNode(): Node
    {
        return $this->node;
    }

    public function isCurrentBlog(): bool
    {
        return $this->isCurrentBlog;
    }
}