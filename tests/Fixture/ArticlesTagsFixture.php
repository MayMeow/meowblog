<?php
declare(strict_types=1);

namespace MeowBlog\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ArticlesTagsFixture
 */
class ArticlesTagsFixture extends TestFixture
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
                'article_id' => 1,
                'tag_id' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
