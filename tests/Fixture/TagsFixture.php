<?php
declare(strict_types=1);

namespace MeowBlog\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TagsFixture
 */
class TagsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'title' => 'Lorem ipsum dolor sit amet',
                'created' => 1658080825,
                'modified' => 1658080825,
            ],
        ];
        parent::init();
    }
}
