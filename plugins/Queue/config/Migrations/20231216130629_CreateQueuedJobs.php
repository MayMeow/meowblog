<?php
declare(strict_types=1);

use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CreateQueuedJobs extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('queued_jobs');
        // job class name
        $table->addColumn('reference', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        // data for job
        $table->addColumn('data', 'text', [
            'default' => null,
            'null' => true,
        ]);
        // Priorityof the job from 1 for lovest
        $table->addColumn('priority', 'integer', [
            'default' => 1,
            'limit' => 11,
            'null' => false,
        ]);
        // When the job should run
        $table->addColumn('not_before', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        // Time when the job was finished
        // Important for recurring jobs
        $table->addColumn('finished', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();

        if ($this->adapter instanceof MysqlAdapter) {
            $table->changeColumn('data', 'text', [
                'limit' => MysqlAdapter::TEXT_LONG,
                'default' => null,
                'null' => true,
            ]);
        }
    }
}
