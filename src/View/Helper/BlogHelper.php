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

    /**
     * getLoggedUser method
     *
     * @return string
     */
    public function getName(): string
    {
        return Configure::read('MeowBlog.name');
    }

    /**
     * getLoggedUser method
     *
     * @return string
     */
    public function getDescription(): string
    {
        return Configure::read('MeowBlog.description');
    }

    /**
     * getTheme method
     *
     * @return string
     */
    public function getTheme(): string
    {
        return 'themes/' . Configure::read('MeowBlog.theme');
    }
}
