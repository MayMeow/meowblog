<?php
declare(strict_types=1);

namespace MeowBlog\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use MeowBlog\Model\Table\TagsTable;

/**
 * MeowBlog\Model\Table\TagsTable Test Case
 */
class TagsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \MeowBlog\Model\Table\TagsTable
     */
    protected $Tags;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Tags',
        'app.Nodes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Tags') ? [] : ['className' => TagsTable::class];
        $this->Tags = $this->getTableLocator()->get('Tags', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Tags);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \MeowBlog\Model\Table\TagsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \MeowBlog\Model\Table\TagsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
