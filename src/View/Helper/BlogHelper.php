<?php
declare(strict_types=1);

namespace MeowBlog\View\Helper;

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\View\Helper;
use MeowBlog\Services\BlogsManagerService;
use MeowBlog\Services\BlogsManagerServiceInterface;
use MeowBlog\Services\UsersManagerService;

/**
 * Blog helper
 */
class BlogHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    protected BlogsManagerServiceInterface $blogManager;

    public function initialize(array $config): void
    {
        parent::initialize($config);

        if (!isset($this->blogManager)) {
            $this->blogManager = new BlogsManagerService();
        }
    }

    /**
     * isLoggedIn method
     *
     * @return bool
     */
    public function isLoggedIn(): bool
    {
        $loggedID = $this->getView()->getRequest()->getSession()->read('Auth.id');

        if ($loggedID) {
            return true;
        }

        return false;
    }

    /**
     * getLoggedUser method
     *
     * @return string
     */
    public function getName(): string
    {
        $manager = $this->blogManager;
        $request = $this->getView()->getRequest();
        
        return Cache::remember('blog_name_' . $request->getUri()->getHost(), function () use ($manager, $request) {
            return $manager->getName($request);
        });
    }

    /**
     * getLoggedUser method
     *
     * @return string
     */
    public function getDescription(): string
    {
        $manager = $this->blogManager;
        $request = $this->getView()->getRequest();
        
        return Cache::remember('blog_description_' . $request->getUri()->getHost(), function () use ($manager, $request) {
            return $manager->getDescription($request);
        });
    }

    /**
     * getTheme method
     *
     * @return string
     */
    public function getTheme(): string
    {
        $manager = $this->blogManager;
        $request = $this->getView()->getRequest();
        
        return Cache::remember('blog_theme_' . $request->getUri()->getHost(), function () use ($manager, $request) {
            return 'themes/'. $manager->getTheme($request);
        });
    }

    /**
     * getLinks method
     *
     * @return array<\MeowBlog\Model\Entity\Link>|null
     */
    public function getLinks(): ?array
    {
        $manager = $this->blogManager;
        $request = $this->getView()->getRequest();

        return Cache::remember('blog_links_' . $request->getUri()->getHost(), function () use ($manager, $request) {
            return $manager->getLinks($request);
        });
    }
}
