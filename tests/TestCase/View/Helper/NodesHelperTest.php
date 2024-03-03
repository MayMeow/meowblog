<?php
declare(strict_types=1);

namespace MeowBlog\Test\TestCase\View\Helper;

use Cake\TestSuite\TestCase;
use Cake\View\View;
use MeowBlog\View\Helper\NodesHelper;

/**
 * MeowBlog\View\Helper\NodesHelper Test Case
 */
class NodesHelperTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \MeowBlog\View\Helper\NodesHelper
     */
    protected $Nodes;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $view = new View();
        $this->Nodes = new NodesHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Nodes);

        parent::tearDown();
    }
}
