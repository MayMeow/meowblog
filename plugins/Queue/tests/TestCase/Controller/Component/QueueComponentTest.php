<?php
declare(strict_types=1);

namespace Queue\Test\TestCase\Controller\Component;

use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;
use Queue\Controller\Component\QueueComponent;

/**
 * Queue\Controller\Component\QueueComponent Test Case
 */
class QueueComponentTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Queue\Controller\Component\QueueComponent
     */
    protected $Queue;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->Queue = new QueueComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Queue);

        parent::tearDown();
    }
}
