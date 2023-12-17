<?php
declare(strict_types=1);

use Migrations\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class UpdateCollationForData extends AbstractMigration
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

        if ($this->adapter instanceof MysqlAdapter) {
            $table->changeColumn('data', 'text', [
                'limit' => MysqlAdapter::TEXT_LONG,
                'default' => null,
                'null' => true,
                'collation' => 'utf8mb4_unicode_ci',
            ]);

            $table->save();
        }
    }
}
