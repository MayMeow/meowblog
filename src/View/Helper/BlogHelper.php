<?php
declare(strict_types=1);

namespace MeowBlog\View\Helper;

use Cake\Core\Configure;
use Cake\View\Helper;

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

    public function getName(): string
    {
        return Configure::read('MeowBlog.name');
    }

    public function getDescription(): string
    {
        return Configure::read('MeowBlog.description');
    }

    public function getTheme(): string
    {
        return 'themes/' . Configure::read('MeowBlog.theme');
    }
}
