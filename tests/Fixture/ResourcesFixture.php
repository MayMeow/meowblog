<?php
declare(strict_types=1);

namespace MeowBlog\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ResourcesFixture
 */
class ResourcesFixture extends TestFixture
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
                'name' => 'Lorem ipsum dolor sit amet',
                'path' => 'Lorem ipsum dolor sit amet',
                'size' => 1,
                'created' => '2023-12-26 09:09:28',
                'modified' => '2023-12-26 09:09:28',
            ],
        ];
        parent::init();
    }
}
