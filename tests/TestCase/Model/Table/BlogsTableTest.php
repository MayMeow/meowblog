<?php
declare(strict_types=1);

namespace MeowBlog\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use MeowBlog\Model\Table\BlogsTable;

/**
 * MeowBlog\Model\Table\BlogsTable Test Case
 */
class BlogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \MeowBlog\Model\Table\BlogsTable
     */
    protected $Blogs;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Blogs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Blogs') ? [] : ['className' => BlogsTable::class];
        $this->Blogs = $this->getTableLocator()->get('Blogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Blogs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \MeowBlog\Model\Table\BlogsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
