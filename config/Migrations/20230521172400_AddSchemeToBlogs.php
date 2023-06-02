<?php
declare(strict_types=1);

use MeowBlog\Model\Entity\ColorSchemeVariant;
use Migrations\AbstractMigration;

class AddSchemeToBlogs extends AbstractMigration
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
        $table = $this->table('blogs');
        $table->addColumn('scheme', 'string', [
            'default' => ColorSchemeVariant::Default->value,
            'limit' => 255,
            'null' => false,
        ]);
        $table->update();
    }
}
