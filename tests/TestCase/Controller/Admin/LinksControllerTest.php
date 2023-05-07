<?php
declare(strict_types=1);

namespace MeowBlog\Test\TestCase\Controller\Admin;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use MeowBlog\Controller\Admin\LinksController;

/**
 * MeowBlog\Controller\Admin\LinksController Test Case
 *
 * @uses \MeowBlog\Controller\Admin\LinksController
 */
class LinksControllerTest extends TestCase
{
    use IntegrationTestTrait;

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
     * Test index method
     *
     * @return void
     * @uses \MeowBlog\Controller\Admin\LinksController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \MeowBlog\Controller\Admin\LinksController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \MeowBlog\Controller\Admin\LinksController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \MeowBlog\Controller\Admin\LinksController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \MeowBlog\Controller\Admin\LinksController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
