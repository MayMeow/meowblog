<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateLinks extends AbstractMigration
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
        $table = $this->table('links');
        $table->addColumn('blog_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('url', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('weight', 'integer', [
            'default' => 10,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('external', 'boolean', [
            'default' => false,
            'null' => false,
        ]);
        $table->create();
    }
}
