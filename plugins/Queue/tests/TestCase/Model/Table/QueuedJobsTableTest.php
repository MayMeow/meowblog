<?php
declare(strict_types=1);

namespace Queue\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Queue\Model\Table\QueuedJobsTable;

/**
 * Queue\Model\Table\QueuedJobsTable Test Case
 */
class QueuedJobsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Queue\Model\Table\QueuedJobsTable
     */
    protected $QueuedJobs;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'plugin.Queue.QueuedJobs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('QueuedJobs') ? [] : ['className' => QueuedJobsTable::class];
        $this->QueuedJobs = $this->getTableLocator()->get('QueuedJobs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->QueuedJobs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \Queue\Model\Table\QueuedJobsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
