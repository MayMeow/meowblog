<?php
declare(strict_types=1);

namespace MeowBlog\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * NodesTagsFixture
 */
class NodesTagsFixture extends TestFixture
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
                'node_id' => 1,
                'tag_id' => 1,
            ],
        ];
        parent::init();
    }
}
