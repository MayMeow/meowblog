<?php
declare(strict_types=1);

namespace Queue\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * QueuedJobsFixture
 */
class QueuedJobsFixture extends TestFixture
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
                'reference' => 'Lorem ipsum dolor sit amet',
                'data' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'priority' => 1,
                'not_before' => '2023-12-16 15:32:27',
                'finished' => '2023-12-16 15:32:27',
                'created' => '2023-12-16 15:32:27',
                'modified' => '2023-12-16 15:32:27',
            ],
        ];
        parent::init();
    }
}
