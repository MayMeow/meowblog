<?php
declare(strict_types=1);

namespace MeowBlog\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use MeowBlog\View\Helper\BlogHelper;

/**
 * MeowBlog\View\Helper\BlogHelper Test Case
 */
class BlogHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \MeowBlog\View\Helper\BlogHelper
     */
    protected $Blog;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->Blog = new BlogHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Blog);

        parent::tearDown();
    }
}
