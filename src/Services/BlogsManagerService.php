<?php
declare(strict_types=1);

namespace MeowBlog\Services;

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Http\ServerRequest;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\ORM\Table;
use MeowBlog\Model\Entity\Blog;
use MeowBlog\Model\Entity\ColorScheme;
use MeowBlog\Model\Entity\ColorSchemeVariant;
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

            return ColorScheme::from($blog->theme)->value;
        } catch (\Exception $e) {
            // do nothing here
        }

        return Configure::read('MeowBlog.theme');
    }

    /**
     * Get Color scheme variant
     *
     * @param ServerRequest $request
     * @return string
     */
    public function getSchemeVariant(ServerRequest $request): string
    {
        try {
            /** @var Blog $blog */
            $blog = $this->blogs->findByDomain($request->getUri()->getHost())->firstOrFail();

            return ColorSchemeVariant::from($blog->scheme)->value;
        } catch (\Exception $e) {
            // do nothing here
        }

        return ColorSchemeVariant::Default->value;
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

    public function clearLinkCache(int $id): void
    {
        $blog = $this->blogs->get($id);

        Cache::delete('blog_links_' . $blog->domain, '_blogs_long_');
    }
}