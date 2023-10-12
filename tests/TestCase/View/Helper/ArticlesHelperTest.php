<?php
declare(strict_types=1);

namespace MeowBlog\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use MeowBlog\View\Helper\ArticlesHelper;

/**
 * MeowBlog\View\Helper\ArticlesHelper Test Case
 */
class ArticlesHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \MeowBlog\View\Helper\ArticlesHelper
     */
    protected $Articles;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->Articles = new ArticlesHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Articles);

        parent::tearDown();
    }
}
