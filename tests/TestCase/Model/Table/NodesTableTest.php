<?php
declare(strict_types=1);

namespace MeowBlog\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use MeowBlog\Model\Table\NodesTable;

/**
 * App\Model\Table\NodesTable Test Case
 */
class NodesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \MeowBlog\Model\Table\NodesTable
     */
    protected $Nodes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Nodes',
        'app.Users',
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
        $config = $this->getTableLocator()->exists('Nodes') ? [] : ['className' => NodesTable::class];
        $this->Nodes = $this->getTableLocator()->get('Nodes', $config);
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

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \MeowBlog\Model\Table\NodesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \MeowBlog\Model\Table\NodesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
