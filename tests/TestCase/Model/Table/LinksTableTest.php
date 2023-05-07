<?php
declare(strict_types=1);

namespace MeowBlog\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use MeowBlog\Model\Table\LinksTable;

/**
 * MeowBlog\Model\Table\LinksTable Test Case
 */
class LinksTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \MeowBlog\Model\Table\LinksTable
     */
    protected $Links;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Links',
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
        $config = $this->getTableLocator()->exists('Links') ? [] : ['className' => LinksTable::class];
        $this->Links = $this->getTableLocator()->get('Links', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Links);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \MeowBlog\Model\Table\LinksTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \MeowBlog\Model\Table\LinksTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
