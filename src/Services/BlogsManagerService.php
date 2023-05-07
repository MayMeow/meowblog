<?php
declare(strict_types=1);

namespace MeowBlog\Services;

use Cake\Core\Configure;
use Cake\Http\ServerRequest;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\ORM\Table;
use MeowBlog\Model\Entity\Blog;
use MeowBlog\Model\Table\BlogsTable;

class BlogsManagerService implements BlogsManagerServiceInterface
{
    use LocatorAwareTrait;

    protected Table | BlogsTable $blogs;

    public function __construct()
    {
        $this->blogs = $this->fetchTable('Blogs');
    }

    /**
     * getTheme method
     * 
     * @param ServerRequest $request Server Request
     */
    public function getTheme(ServerRequest $request): string
    {
        try {
            /** @var Blog $blog */
            $blog = $this->blogs->findByDomain($request->getUri()->getHost())->firstOrFail();

            return $blog->theme;
        } catch (\Exception $e) {
            // do nothing here
        }

        return Configure::read('MeowBlog.theme');
    }

    public function getName(ServerRequest $request): string
    {
        try {
            /** @var Blog $blog */
            $blog = $this->blogs->findByDomain($request->getUri()->getHost())->firstOrFail();

            return $blog->title;
        } catch (\Exception $e) {
            // do nothing here
        }

        return Configure::read('MeowBlog.name');
    }

    public function getDescription(ServerRequest $request): string
    {
        try {
            /** @var Blog $blog */
            $blog = $this->blogs->findByDomain($request->getUri()->getHost())->firstOrFail();

            return $blog->description;
        } catch (\Exception $e) {
            // do nothing here
        }

        return Configure::read('MeowBlog.description');
    }

    public function getDefaultRoute(ServerRequest $request): ?string
    {
        try {
            /** @var Blog $blog */
            $blog = $this->blogs->findByDomain($request->getUri()->getHost())->firstOrFail();

            return $blog->default_route;
        } catch (\Exception $e) {
            // do nothing here
        }

        return null;
    }

    public function getLinks(ServerRequest $request): ?array
    {
        try {
            /** @var Blog $blog */
            $blog = $this->blogs->findByDomain($request->getUri()->getHost())->contain([
                'Links' => [
                    'sort' => ['Links.weight' => 'ASC']
                ]
            ])->firstOrFail();

            return $blog->links;
        } catch (\Exception $e) {
            // do nothing here
        }

        return null;
    }
}