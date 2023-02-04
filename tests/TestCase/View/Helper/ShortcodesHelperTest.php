<?php
declare(strict_types=1);

namespace MeowBlog\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use MeowBlog\View\Helper\ShortcodesHelper;

/**
 * MeowBlog\View\Helper\ShortcodesHelper Test Case
 */
class ShortcodesHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \MeowBlog\View\Helper\ShortcodesHelper
     */
    protected $Shortcodes;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->Shortcodes = new ShortcodesHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Shortcodes);

        parent::tearDown();
    }
}
