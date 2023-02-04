<?php
declare(strict_types=1);

namespace MeowBlog\Test\TestCase\Controller\Admin;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * MeowBlog\Controller\Admin\TagsController Test Case
 *
 * @uses \MeowBlog\Controller\Admin\TagsController
 */
class TagsControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Tags',
        'app.Articles',
        'app.ArticlesTags',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \MeowBlog\Controller\Admin\TagsController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     * @uses \MeowBlog\Controller\Admin\TagsController::view()
     */
    public function testView(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     * @uses \MeowBlog\Controller\Admin\TagsController::add()
     */
    public function testAdd(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     * @uses \MeowBlog\Controller\Admin\TagsController::edit()
     */
    public function testEdit(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     * @uses \MeowBlog\Controller\Admin\TagsController::delete()
     */
    public function testDelete(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
