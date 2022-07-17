<?php
declare(strict_types=1);

namespace Tools\Test\TestCase\Command;

use Cake\TestSuite\ConsoleIntegrationTestTrait;
use Cake\TestSuite\TestCase;
use Tools\Command\GenerateSecurityKeyCommand;

/**
 * Tools\Command\GenerateSecurityKeyCommand Test Case
 *
 * @uses \Tools\Command\GenerateSecurityKeyCommand
 */
class GenerateSecurityKeyCommandTest extends TestCase
{
    use ConsoleIntegrationTestTrait;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->useCommandRunner();
    }
    /**
     * Test buildOptionParser method
     *
     * @return void
     * @uses \Tools\Command\GenerateSecurityKeyCommand::buildOptionParser()
     */
    public function testBuildOptionParser(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test execute method
     *
     * @return void
     * @uses \Tools\Command\GenerateSecurityKeyCommand::execute()
     */
    public function testExecute(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
