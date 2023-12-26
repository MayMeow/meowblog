<?php
declare(strict_types=1);

namespace MeowBlog\Test\TestCase\Form;

use Cake\TestSuite\TestCase;
use MeowBlog\Form\ResourceUploadForm;

/**
 * MeowBlog\Form\ResourceUploadForm Test Case
 */
class ResourceUploadFormTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \MeowBlog\Form\ResourceUploadForm
     */
    protected $ResourceUpload;

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->ResourceUpload = new ResourceUploadForm();
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->ResourceUpload);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \MeowBlog\Form\ResourceUploadForm::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
