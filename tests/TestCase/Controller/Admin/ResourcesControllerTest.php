<?php
declare(strict_types=1);

namespace MeowBlog\Test\TestCase\Controller\Admin;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use MeowBlog\Controller\Admin\ResourcesController;

/**
 * MeowBlog\Controller\Admin\ResourcesController Test Case
 *
 * @uses \MeowBlog\Controller\Admin\ResourcesController
 */
class ResourcesControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Resources',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \MeowBlog\Controller\Admin\ResourcesController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \MeowBlog\Controller\Admin\ResourcesController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \MeowBlog\Controller\Admin\ResourcesController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \MeowBlog\Controller\Admin\ResourcesController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \MeowBlog\Controller\Admin\ResourcesController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
