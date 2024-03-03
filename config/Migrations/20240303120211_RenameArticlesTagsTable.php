<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class RenameArticlesTagsTable extends AbstractMigration
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
        $table = $this->table('articles_tags');
        $table->rename('nodes_tags');

        $table->renameColumn('article_id', 'node_id');

        $table->update();
    }
}
