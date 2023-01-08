<?php
declare(strict_types=1);

namespace MeowBlog\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

/**
 * MeowBlog\Controller\HomeController Test Case
 *
 * @uses \MeowBlog\Controller\HomeController
 */
class HomeControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        //'app.Home',
    ];

    /**
     * Test index method
     *
     * @return void
     * @uses \MeowBlog\Controller\HomeController::index()
     */
    public function testIndex(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
