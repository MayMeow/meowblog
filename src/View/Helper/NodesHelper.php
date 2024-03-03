<?php
declare(strict_types=1);

namespace MeowBlog\View\Helper;

use Cake\Cache\Cache;
use Cake\Http\ServerRequest;
use Cake\View\Helper;
use Cake\View\View;
use MeowBlog\Model\Entity\Node;
use MeowBlog\Services\NodesManagerService;
use MeowBlog\Services\NodesManagerServiceInterface;
use MeowBlog\Services\BlogsManagerService;
use MeowBlog\Services\BlogsManagerServiceInterface;

/**
 * Nodes helper
 */
class NodesHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected array $_defaultConfig = [];

    protected BlogsManagerServiceInterface $blogManager;

    public function initialize(array $config): void
    {
        parent::initialize($config);

        if (!isset($this->nodesManager)) {
            $this->blogManager = new BlogsManagerService();
        }
    }

    protected function getBlogId(ServerRequest $request): ?int
    {
        $manager = $this->blogManager;

        return Cache::remember('blog_description_' . $request->getUri()->getHost(), function() use ($manager, $request) {
            return $manager->getId($request);
        });
    }

    public function isInCurrentBlog(Node $node): bool
    {        
        return $this->getBlogId($this->getView()->getRequest()) == $node->blog?->id ? true : false;
    }
}
