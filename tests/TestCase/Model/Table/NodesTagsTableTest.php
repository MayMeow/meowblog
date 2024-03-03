<?php
declare(strict_types=1);

namespace MeowBlog\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use MeowBlog\Model\Table\NodesTagsTable;

/**
 * MeowBlog\Model\Table\NodesTagsTable Test Case
 */
class NodesTagsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \MeowBlog\Model\Table\NodesTagsTable
     */
    protected $NodesTags;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.NodesTags',
        'app.Nodes',
        'app.Tags',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('NodesTags') ? [] : ['className' => NodesTagsTable::class];
        $this->NodesTags = $this->getTableLocator()->get('NodesTags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->NodesTags);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \MeowBlog\Model\Table\NodesTagsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \MeowBlog\Model\Table\NodesTagsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
